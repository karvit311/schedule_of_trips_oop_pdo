<?php
	require_once 'database.php';
	require_once 'application/core/model.php';
	require_once 'application/core/view.php';
	require_once 'application/core/controller.php';
	require_once 'application/core/route.php';
	application\core\Route::start(); // запускаем маршрутизатор
?>