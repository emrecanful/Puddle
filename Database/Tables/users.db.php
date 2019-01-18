<?php

use Database\Migration;

class users extends Migration {

    protected static $columns;

    function __construct()
    {
        self::$columns = ["tableData" => ["CHARACTER_SET" => "utf8"], "Columns" => [
            "username"  =>  "varchar(255)|notnull",
            "password"  =>   "text|notnull",
            "fullname"  =>   "text|notnull",
            "remember_token"    => "text|null",
            "activation_token"  =>   "text|null",
            "status"    =>  "int(0)|null|default 0"
        ]];
    }

    public function start()
    {
        parent::engineStart('users', self::$columns);
    }
    
}