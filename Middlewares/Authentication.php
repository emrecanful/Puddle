<?php
namespace Middlewares;

use Bootstrap\Route;

class Authentication {

    public function check()
    {
        if( !isset($_SESSION['user']) )
        {
            Route::redirectTo("/auth/login");
        }
    }
}