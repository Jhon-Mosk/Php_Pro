<?php

namespace app\engine;

use PDO;

class Db
{
    private $config;

    private $connection = null;

    public function __construct($driver = null, $host = null, $login = null, $password = null, $database = null, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection()
    {
        if (is_null($this->connection)) {
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->connection = new PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password'],
                $opt
            );
        }

        return $this->connection;
    }

    private function prepareDsnString()
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryOneObject($sql, $params, $class)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);

        return $STH->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, PDO::PARAM_INT);
        $STH->execute();

        return $STH->fetchAll();
    }

    public function queryJoin($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);

        $STH->execute($params);

        return $STH->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
}
