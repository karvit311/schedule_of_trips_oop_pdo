<?php
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';
include 'application/App.php';
$app = \Application\App::getInstance();
$app->run();
?>