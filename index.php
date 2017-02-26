<?php

require __DIR__ . '/autoload.php';

$ctrl = $_GET['ctrl'] ?: 'Admin';
$action = $_GET['act'] ?: 'Index';

$controllerClassName = '\\App\\Controllers\\' . $ctrl;
$contloller = new $controllerClassName;
$contloller->action($action);