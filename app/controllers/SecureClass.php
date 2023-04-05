<?php

class Security {
    public static function secureHTML($element){
        return htmlentities($element);
    }
    public static function isAllowed(){
        if(!empty($_SESSION['login'])){
            return 1;
        } else {
            return 0;
        }
    }

    public static function isAdmin(){
        $admin = $_SESSION['login']['rank'];
        if($admin==1){
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
}