<?php

namespace core;

class App
{
    private $_db;
    private $_router;

    /** @var static */
    public static $app;

    public function __construct()
    {
        static::$app = $this;

        $this->_router = new Router();
        $this->_db = new Db();
    }

    public function run()
    {
        $this->_router->run();
    }

    public function getDb()
    {
        return $this->_db;
    }
}
