<?php


namespace App;

class Db
{
    private $dbh;


    function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=backend';
        $this->dbh = new \PDO ($dsn, 'root', '');
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


}