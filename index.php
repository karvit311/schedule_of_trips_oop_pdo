<?php

ini_set('display_errors', 1);
define('ROOT', dirname(__FILE__));
require_once(__DIR__ . '/vendor/autoload.php');

$router = new \Application\core\App();
$router->run();
