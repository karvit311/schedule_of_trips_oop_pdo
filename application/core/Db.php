<?php

namespace core;

class Db
{
    private $_dns;
    private $_user;
    private $_password;
    private $_pdo;

    public function __construct()
    {
        $config = require_once(__DIR__ . '/../../database.php');
        $this->_dns = $config['dns'];
        $this->_password = $config['password'];
        $this->_user = $config['user'];
        $this->_pdo = new \PDO($this->_dns, $this->_user, $this->_password);
    }

    public function rawSql($sql)
    {
        return $this->_pdo->query($sql);
    }
}
