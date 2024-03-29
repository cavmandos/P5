<?php

require './config.php';

abstract class Model
{

    private static $pdo;


    // Set Database
    private static function setBdd()
    {
        try {
            self::$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWORD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (Exception $e) {
            Security::display($e);
        }
    }


    // Get Database
    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }

    
}
