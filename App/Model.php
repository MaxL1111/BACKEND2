<?php

namespace App;


abstract class Model
{

    const TABLE = '';

    public $id;


   //метод выборки всех записей из таблицы
    public static function findAll($page)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE ,
            [],
            static::class
        );
    }

    //метод выборки одной записи из таблицы
    public static function findOneById($id)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $db = Db::instance();
        return $db->query(
            $sql,
            [':id' => $id],
            static::class
        )[0];
    }

    //метод проверки существования записи
    public function isNew()
    {
        return empty($this->id);
    }

    //метод вставки новой записи в таблицу
    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

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
        $db = Db::instance();
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
        $db = Db::instance();
        $db->execute($sql, $columns);
    }

    //метод удаления записи в таблице
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, [':id' => $id])[0];
    }


}