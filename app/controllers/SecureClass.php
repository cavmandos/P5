<?php

class Security {
    public static function secureHTML($element){
        return htmlspecialchars($element, ENT_NOQUOTES);
    }
    public static function isAllowed(){
        if(!empty($_SESSION['login'])){
            return 1;
        } else {
            return 0;
        }
    }

    public static function getRandomToken($length = 32){
    $string = sha1(rand());
    $randomString = substr($string, 0, $length);
    return $randomString;
    }

    public static function escapeOutput($data){
        $response = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        echo $response;
    }
}