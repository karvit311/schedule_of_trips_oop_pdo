<?php
ini_set('display_errors', 1);
require_once 'application/bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';
// $app = new App();
// $app->start();
// $config = require_once 'application/bootstrap.php';

// (new yii\web\Application($config))->run();
include '../../Application/App.php';
$app = \Application\App::getInstance();
$app->run();
?>