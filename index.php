<?php

require __DIR__ . '/autoload.php';

$url = $_SERVER['REQUEST_URI'];


$ctrl = $_GET['ctrl'] ?: 'Admin';
$action = $_GET['act'] ?: 'Index';

$controllerClassName = '\\App\\Controllers\\' . $ctrl;
$contloller = new $controllerClassName;

