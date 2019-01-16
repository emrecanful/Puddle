<?php

require_once("../bootstrap/Session.class.php");

Bootstrap\Session::start();

require_once("../bootstrap/Database.class.php");
require_once("../bootstrap/Model.class.php");
require_once("../bootstrap/Route.class.php");
require_once("../bootstrap/Controller.class.php");
require_once("../Route/web.php");