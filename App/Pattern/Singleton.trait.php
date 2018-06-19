<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
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
