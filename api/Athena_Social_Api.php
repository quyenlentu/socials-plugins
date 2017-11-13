<?php
class Athena_Social_Api{

    protected function _request($url, $headers = false) {
        $ch = curl_init();
        $timeout = 50; // set to zero for no timeout
        if($headers) {
            curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    protected function _serializeParams($params) {
        $p = array();
        foreach($params as $key => $value) {
            $p[] = $key.'='.urlencode($value);
        }
        return implode('&', $p);
    }
}