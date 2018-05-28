<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Router;
use App\Config;

require_once('../App/Autoloader.php');
require_once('../App/Config.php');
Autoloader::init();
$route = new Router();
$route->initRoute();
