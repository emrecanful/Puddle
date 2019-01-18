<?php

if( !function_exists('asset') )
{
    function asset($route)
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/$route";
    }
}

if( !function_exists('isActive') )
{
    function isActive($route)
    {
        if( $_SERVER['REQUEST_URI'] == $route )
        {
            return "active";
        }
        else
        {
            return "";
        }
    }
}