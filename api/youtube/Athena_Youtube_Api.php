<?php
require_once PLUGIN_DIR."api/Athena_Social_Api.php";

class Athena_Youtube_Api extends Athena_Social_Api{
    public function getResults($playlistId, $apiKey){
        $apiCount = 50;
        if(!empty($playlistId)) {
            $result = $this->_request('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $playlistId . '&maxResults=' . $apiCount . '&key=' . $apiKey);
            $result = json_decode($result);
            if (!empty($result->items)) {
                // parse medias
                global $wpdb;
                $posts_table = $wpdb->prefix . 'posts';
                $sql = "DELETE FROM {$posts_table} WHERE post_type = 'youtube'";
                $delete = $wpdb->query($sql);
                foreach ($result->items as $video) {
                    $createTime = $newDate = date("d-F", strtotime($video->publishedAt));
                    $post_id = wp_insert_post( array(
                        'post_status' => 'publish',
                        'post_type' => 'youtube',
                        'post_title' => $video->snippet->title,
                        'post_content' => $video->snippet->description
                    ) );
                    update_post_meta( $post_id, 'photo', $video->snippet->thumbnails->maxres->url );
                    update_post_meta( $post_id, 'link', 'https://www.youtube.com/watch?v='.$video->snippet->resourceId->videoId );
                    update_post_meta( $post_id, 'created_time', $createTime );
                    if($post_id){
                        echo "<p>".$video->snippet->title."-".$video->snippet->description."....DONE!</p>";
                    }
                }
            } else {
                echo $result->meta->error_message;
            }
        } else {
            echo 'Renseignez un id dans le paramÃ¨tre "playlistId" de la config pour cette mÃ©thode';
        }
    }
}