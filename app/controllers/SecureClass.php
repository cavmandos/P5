<?php

class Security {
    public static function secureHTML($element){
        return htmlentities($element);
    }
    public static function isAllowed(){
        return(!empty($_SESSION['login']) && $_SESSION['login']['rank'] == 1);
    }

    public static function getRandomToken($length = 32){
    $string = sha1(rand());
    $randomString = substr($string, 0, $length);
    return $randomString;
    }
}