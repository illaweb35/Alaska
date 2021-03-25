<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

use app\Router;
use app\Config;


require_once '../app/Autoloader.php';
require_once '../app/Config.php';
// initialisation de l'autoloader
Autoloader::init();
// instanciation du routeur
$route = new Router();
//appel à la fonction intialisation de la route
$route->initRoute();
