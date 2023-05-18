<?php

class Security
{


    // Return element secure element
    public static function secureHTML($element)
    {
        return htmlspecialchars($element, ENT_NOQUOTES);
    }


    // Check if logged
    public static function isAllowed()
    {
        $session = isset($_SESSION['login']) ? $_SESSION['login'] : null;
        if(empty($session) === FALSE){
            return 1;
        } else {
            return 0;
        }
    }


    // Get a random token
    public static function getRandomToken($length = 32)
    {
        $string = sha1(rand());
        $randomString = substr($string, 0, $length);
        return $randomString;
    }


    // Escape output
    public static function escapeOutput($data)
    {
        $response = htmlspecialchars($data, (ENT_QUOTES | ENT_HTML5), 'UTF-8');
        return $response;
    }


    // Display alert box
    public static function getAlerts()
    {
        $sessionAlert = isset($_SESSION['alert']) ? $_SESSION['alert'] : array();

        if (is_array($sessionAlert)) {
            foreach ($sessionAlert as $alert) {
                $type = isset($alert['type']) ? htmlspecialchars($alert['type'], ENT_QUOTES, 'UTF-8') : '';
                $message = isset($alert['message']) ? htmlspecialchars($alert['message'], ENT_QUOTES, 'UTF-8') : '';

                echo "<div class='text-center m-0 alert {$type}' role='alert'>{$message}</div>";
            }
            unset($_SESSION['alert']);
        }
    }


    // Echo function
    public static function display($data)
    {
        echo $data;
    }

}