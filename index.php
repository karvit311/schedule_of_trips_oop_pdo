<?php
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/application/core/route.php');
 
// подключаем конфигурацию URL
$routes=ROOT.'/application/routes.php';
 
// запускаем роутер
$router = new Application\core\Router($routes);
$router->run();