<?php
require_once PLUGIN_DIR."api/Athena_Social_Api.php";

class Athena_Facebook_Api extends Athena_Social_Api{
    public function getResults($pageId, $accessToken){
        if(!empty($pageId)) {
            $requestParams = array(
                'access_token' => $accessToken,
                'fields'=>'id,from,message,message_tags,picture,link,type,created_time,object_id',
                'limit' => 50
            );
            $result = $this->_request('https://graph.facebook.com/'.$pageId.'/posts/?'.$this->_serializeParams($requestParams));
            $result = json_decode($result);
            if($result->data) {
                // parse medias
                global $wpdb;
                $posts_table = $wpdb->prefix . 'posts';
                $sql = "DELETE FROM {$posts_table} WHERE post_type = 'facebook'";
                $delete = $wpdb->query($sql);
                foreach($result->data as $post) {
                    // get photo if post has photo type
                    if($post->type == 'photo' && !empty($post->object_id)) {
                        $urlPicture = 'https://graph.facebook.com/'.$post->object_id.'/picture?'.$this->_serializeParams(
                                array(
                                    'type'=>'normal',
                                    'redirect'=>'false' ,
                                    'access_token' => $accessToken
                                )
                            );
                        $rawDataPhoto = $this->_request($urlPicture);
                        $dataPhoto = json_decode($rawDataPhoto);

                        $post->photo = array(
                            'src' => $dataPhoto->data->url,
                            'width' => 500,
                            'height' => 500
                        );
                    }
                    $createTime = $newDate = date("d-F", strtotime($post->created_time));
                    $post_id = wp_insert_post( array(
                        'post_status' => 'publish',
                        'post_type' => 'facebook',
                        'post_title' => $post->from->name,
                        'post_content' => $post->message
                    ) );
                    update_post_meta( $post_id, 'photo', $post->photo['src'] );
                    update_post_meta( $post_id, 'link', 'https://www.facebook.com/profile.php?id='.$post->from->id );
                    update_post_meta( $post_id, 'created_time', $createTime );
                    if($post_id){
                        echo "<p>".$post->from->name."-".$post->message."....DONE!</p>";
                    }
                    /*// parse and add to collection
                    $mediaObj = $this->_parsePost($post);
                    $this->_items->add($mediaObj);*/
                    //$this->_result->code = 200;
                    //$this->_result->success = true;
                }
            } else {
                //$this->_result->msg .= $result->meta->error_message;
            }
        } else {
            //$this->_result->msg = 'Renseignez l\'id de la page facebook';
        }
    }
}