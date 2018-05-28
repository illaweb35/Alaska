<?php
require_once('Pattern/Singleton.trait.php');
use Alaska\App\Pattern\Singleton;

class Autoloader
{
    use Singleton;

    public static function init()
    {
        spl_autoload_register([__CLASS__,'autoload']);
    }
    public static function autoload($class)
    {
        $class = str_replace(__NAMESPACE__, '', $class);
        $class = str_replace('\\', '/', $class);
        require_once(dirname(__DIR__).'/'.$class.'.php');
    }
}
