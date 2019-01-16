<?php
namespace Bootstrap;

class Session {

    public function start($name = 'NNC_SSID')
    {
        @session_name( $name );
        @session_start();

        if( !isset($_SESSION['CSRF']) || empty($_SESSION['CSRF']) )
        {
            $_SESSION['CSRF'] = bin2hex( random_bytes(128) );
        }

        if( !isset($_SESSION['REM']) || empty($_SESSION['REM']) )
        {
            $_SESSION['REM'] = bin2hex( random_bytes(64) );
        }
    }


    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function unset($name)
    {
        $_SESSION[$name] = null;
        unset( $_SESSION[$name] );
    }

}