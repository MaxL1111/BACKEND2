<?php


namespace App\Controllers;


class Base
{
    public function action($action)
    {
        $methodName = 'action' . $action;
        return $this->$methodName();
    }

}