<?php
/**
 * Session.
 */
require_once("../bootstrap/Session.class.php");

Bootstrap\Session::start();

/**
 * Database and functionality.
 */
require_once("../bootstrap/Database.class.php");

/**
 * Load models. (This is not doing anything yet.)
 */
require_once("../bootstrap/Model.class.php");

/**
 * Load Middlewares.
 */
require_once("../bootstrap/Middleware.class.php");

Bootstrap\Middleware::loadAll();

/**
 * Loading Routing system.
 */
require_once("../bootstrap/Route.class.php");

/**
 * Loading Controller system.
 */
require_once("../bootstrap/Controller.class.php");

/**
 * Loading the application itsellf by including web.
 */
require_once("../Route/web.php");