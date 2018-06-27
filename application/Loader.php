<?php
namespace Application;
class Loader {

    private function __construct() {

    }

    public static function registerAutoLoad() {
        spl_autoload_register(array("\Application\Loader", 'autoload'));
    }

    public static function audoload($class) {
        echo $class;
    }
}