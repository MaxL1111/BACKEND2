<?php


namespace App\Controllers;

use App\View;

class Admin
    extends Base
{
    protected $view;

    
    public function __construct()
    {
        $this->view = new View();
    }

    
    //контроллер вывода страницы панели администратора (admin.php)
    public function actionIndex()
    {
        $this->view->display(__DIR__ . '/../templates/admin.php');
    }

    
    //контроллер вывода всех позиций товара в шаблон admin.php
    public function actionAll()
    {
        $this->view->news = \App\Models\Admin::findAll();
        $this->view->display(__DIR__ . '/../templates/table.php');
    }

    
    //контроллер добавления позиции товара в панели администратора
    public function actionInsertOne()
    {
        $tovar = $_POST['tovar'];
        $category = $_POST['category'];
        $prise = $_POST['prise'];

        $obj = new \App\Models\Admin();
        $data = $obj->validate($tovar, $category, $prise);

        if (!empty($data['tovar'] && $data['category'] && $data['prise'])) {
            $position = new \App\Models\Admin();
            $position->tovar = $data['tovar'];
            $position->category = $data['category'];
            $position->prise = $data['prise'];
            $position->insert();
        }
    }


    //контроллер обновления в базе данных отредактированной позиции товара в панели администратора
    public function actionEditOne()
    {
        
        if(!empty($_POST['id']) && !empty($_POST['tovar']) && !empty($_POST['category']) && !empty($_POST['prise'])){
            $tovar = $_POST['tovar'];
            $category = $_POST['category'];
            $prise = $_POST['prise'];

            $obj = new \App\Models\Admin();
            $data = $obj->validate($tovar, $category, $prise);

            if (!empty($_POST['id'] && $data['tovar'] && $data['category'] && $data['prise'])) {
                $position = new \App\Models\Admin();
                $position->id = $_POST['id'];
                $position->tovar = $data['tovar'];
                $position->category = $data['category'];
                $position->prise = $data['prise'];
                $position->update();
            }

        } else {
            die;
        }

    }

    
    //контроллер удаления позиции товара
    public function actionDelete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $position = new \App\Models\Admin();
            $position->delete($id);
        }
    }

}