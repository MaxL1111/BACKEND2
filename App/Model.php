<?php

namespace App;


abstract class Model
{

    const TABLE = '';

    public $id;


    //метод выборки всех записей из таблицы
    public static function findAll()
    {
        $db = new \App\Db();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }


    //метод проверки существования записи
    public function isNew()
    {
        return empty($this->id);
    }

    //метод вставки новой записи в таблицу
    public function insert()
    {
        /* if (!$this->isNew()) {
             return;
         }
 */
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' 
        (' . implode(',', $columns) . ')
        VALUES
        (' . implode(',', array_keys($values)) . ')
        ';
        $db = new \App\Db();
        $db->execute($sql, $values);
    }

    //метод обновления записи в таблице
    public function update()
    {
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            $columns[':' . $k] = $v;
            if ('id' == $k) {
                continue;
            }
            $values[] = $k . '=:' . $k;
        }

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $values) . ' WHERE id=:id';
        $db = new \App\Db();
        $db->execute($sql, $columns);
    }

    //метод удаления записи в таблице
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = new \App\Db();
        $db->execute($sql, [':id' => $id])[0];
    }


}