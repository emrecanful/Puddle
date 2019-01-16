<?php
namespace Bootstrap;


class Route {

    private static $validRoutes = [];

    public static function get($route, $function, $data = [])
    {
        array_push(self::$validRoutes, $route);
        if( $_SERVER['REQUEST_URI'] == $route )
        {
            
            if( is_callable($function) )
            {
                $function->__invoke();
            }
            else
            {
                $fData = explode("@", $function);
                
                if( file_exists("../Controllers/$fData[0].php") ) {
                    require_once("../Controllers/$fData[0].php");
                    $fData[0]::{$fData[1]}($data);
                }
                else
                {
                    die("Ctritical error. Controller is not found.");
                }
            }
        }
    }

    public static function post($route, $function, $data = [])
    {
        array_push(self::$validRoutes, $route);
        if( $_SERVER['REQUEST_URI'] == $route )
        {
            if( isset($_POST['CSRF']) && hash_equals( $_POST['CSRF'], $_SESSION['CSRF'] ) )
            {
                if( is_callable($function) )
                {
                    $function->__invoke();
                }
                else
                {
                    $fData = explode("@", $function);

                    if( file_exists("../Controllers/$fData[0].php") ) {
                        require_once("../Controllers/$fData[0].php");
                        $fData[0]::{$fData[1]}($data);
                    }
                    else
                    {
                        die("Crticial error. Controller is not found.");
                    }
                    
                }
            }
            else
            {
                header("HTTP/1.1 401 Unauthorized");
                exit;
            }
            
        }
    }

    public static function match($methods, $route, $function)
    {
        array_push(self::$validRoutes, $route);
    }

    public static function redirect($route, $to)
    {
        array_push(self::$validRoutes, $route);

        if( $_SERVER['REQUEST_URI'] == $route )
        {
            header("Location: ".$to);
        }
    }



    public static function error($code, $function)
    {
        if( $code == "404" && !in_array($_SERVER['REQUEST_URI'], self::$validRoutes) )
        {
            if( is_callable($function) )
            {
                $function->__invoke();
            }
            else
            {
                $fData = explode("@", $function);
                
                if( file_exists("../Controllers/$fData[0].php") ) {
                    require_once("../Controllers/$fData[0].php");
                    $fData[0]::{$fData[1]}($data);
                }
                else
                {
                    die("Ctritical error. Controller is not found.");
                }
            }
        }
    }

    
}