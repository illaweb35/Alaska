<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/

use App\Router;
use App\Config;

require_once('../App/Autoloader.php');
require_once('../App/Config.php');
Autoloader::init();
$route = new Router();
$route->initRoute();
