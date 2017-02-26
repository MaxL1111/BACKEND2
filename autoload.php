<?php

function my_app_autoload($class)
{
    include __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
}

spl_autoload_register('my_app_autoload');

