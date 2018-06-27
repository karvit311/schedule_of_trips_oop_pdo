<?php
namespace Application;
include_once 'Loader.php';
class App {

    private static $_instance=null;

    private function __construct() {
        \Application\Loader::registerAutoLoad();
    }

    public function run(){
        
    }
      /**
      *
      *  Return \KF\App
      */

    public static function getInstance(){
        if (self::$_instance == null) {
            self::$_instance = new \Application\App();
        }
        return self::$_instance;
    }
}