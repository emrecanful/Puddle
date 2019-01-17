<?php
namespace Bootstrap;

class Middleware {

    public function middleware($name, $data = [])
    {
        require_once("../Middlewares/$name.php");

        $construct = new $name($data);

        return $construct;
    }

    public function loadAll()
    {
        foreach( glob("../Middlewares/*.php") as $filename )
        {
            require_once($filename);
        }
    }
}