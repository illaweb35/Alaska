<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */




require_once 'pattern/Singleton.trait.php';

use app\pattern\Singleton;

/**
 *Class Autoloader pour chargement automatique des classes et interfaces du site
 */
class Autoloader
{
    use Singleton;

    public static function init()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    public static function autoload($class)
    {
        $class = str_replace(__NAMESPACE__, '', $class);
        $class = str_replace('\\', '/', $class);
        $file = (dirname(__DIR__) . '/' . $class . '.php');
        require_once $file;
    }
}
