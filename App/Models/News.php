<?php

namespace App\Models;

use App\Model;

use App\Db as Db;

/**
 * Class News
 * @package App\Models
 *
 * @property \App\Models\Comment $comment
 */
class News extends Model
{
    const TABLE = 'news';

    public $title;
    public $date;
    public $text;
    public $id;

    public function __get($k)
    {
        switch ($k) {
            case 'autorcom':
                return Comment::findOneById($this->id);
                break;
            default:
                return null;
        }
    }


    public function __isset($k)
    {
        switch ($k) {
            case 'autorcom':
                return !empty($this->id);
                break;
            default:
                return false;
        }
    }

    //метод выборки всех записей из таблицы новостей, по 5 новостей на страницу
  /*
    public static function findAll($page)
    {
        $start = $page * 5 - 5;
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $start . ', 5',
            [],
            static::class
        );
    }
*/
    public static function findAll($page)
    {
        $start = $page * 5 - 5;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $start . ', 5';
        return $db->queryEach($sql, [], static::class);
    }

    //функция подсчета общего количества записей в таблице news
    // и определения вывода нужной страницы
    public static function count($page)
    {
        $db = Db::instance();
        $sq = 'SELECT COUNT(*) FROM ' . static::TABLE;
        $nume = $db->nav(
            $sq,
            [],
            static::class
        );
        $count_post = $nume[0][0];
        $total = intval(($count_post - 1) / 5) + 1;
        $page = intval($page);
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        $data = [];
        $data[0] = $page;
        $data[1] = $nume[0][0];
        return $data;

    }


    //валидация данных в форме добавления новости
    public function validate($title, $date, $text)
    {
        $obj = new \App\Validation();
        $title = $obj->clean($title);
        $date = $obj->clean($date);
        $text = $obj->clean($text);
        $data = [];

        if (!empty($title) && !empty($date) && !empty($text)) {
            $data['title'] = $title;
            $data['date'] = $date;
            $data['text'] = $text;
            return $data;
        }

    }


}