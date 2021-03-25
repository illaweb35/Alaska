<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */


namespace app\pattern;

/**
 * Trait Singleton instanciation unique d'une classe
 * Instance de classe unique
 */
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
