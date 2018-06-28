<?php
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/vendor/autoload.php');
require_once(ROOT.'/application/core/route.php');
require_once(ROOT.'/database.php');
 
// подключаем конфигурацию URL
$routes=ROOT.'/application/routes.php';
$router = new Application\core\App();
$router->run();