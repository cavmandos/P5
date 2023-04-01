<?php

class Security {
    public static function secureHTML($element){
        return htmlentities($element);
    }
}