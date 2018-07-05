<?php

namespace Application\core;

class Db
{
    private static $_instance = null;
    private $_stmt;
    private $_dsn;
    private $_user;
    private $_password;
    private $_pdo;
    private $conn;

    public function __construct()
    {
        try {
            $config = require_once(__DIR__ . '/../../database.php');
            $this->_dsn = $config['dsn'];
            $this->_password = $config['password'];
            $this->_user = $config['user'];
            $this->_pdo = new \PDO($this->_dsn, $this->_user, $this->_password);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public static function getInstance() 
    {
        if(!isset(self::$_instance)) {
            self::$_instance = new Db();
        }
        return self::$_instance;
    }

    public function query($query) 
    {
        $this->_stmt = $this->_pdo->prepare($query);
        return $this->_stmt;
    }

    public function rawSql($sql)
    {
        return $this->_pdo->query($sql);
    }

    public function resultSet() 
    {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount() 
    {
        return $this->_stmt->rowCount();
    }

    public function single() 
    {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }
}
  