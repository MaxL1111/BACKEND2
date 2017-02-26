<?php

namespace App\Models;

use App\Model;

use App\Db as Db;


class Admin extends Model
{
    const TABLE = 'product';

    public $prise;
    public $category;
    public $tovar;
    public $id;
    
    //метод выборки всех записей из таблицы
    public static function findAll()
    {
        $db = new \App\Db();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC',
            [], static::class
        );
    }

    //валидация данных в форме добавления новости
    public function validate($tovar, $category, $prise)
    {
        $obj = new \App\Validation();
        $tovar = $obj->clean($tovar);
        $category = $obj->clean($category);
        $prise = $obj->clean($prise);
        $data = [];

        if (!empty($tovar) && !empty($category) && !empty($prise)) {
            $data['tovar'] = $tovar;
            $data['category'] = $category;
            $data['prise'] = $prise;
            return $data;
        }

    }


}