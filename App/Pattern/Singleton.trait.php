<?php
namespace App\Pattern;

trait Singleton
{
    protected static $_instance = null;

    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Singleton();
        }
        return self::$_instance;
    }
}
