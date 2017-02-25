<?php


//namespace App;

class Db
{
    private $dbh;
    private $className = 'stdClass';

    protected function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=backend';
        $this->dbh = new PDO ($dsn, 'root', '');
    }

    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }

    public function query($sql, $params, $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    //реализован генератор
    public function queryEach($sql, $params, $class)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);

        if (false !== $res) {
            while ($result = $sth->fetch()) {
                yield $result;
            }
        }
    }


    public function nav($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if (false !== $res) {
            return $sth->fetchAll();
        }
        return [];
    }


}