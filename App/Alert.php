<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace App;

use App\Viewer;

class Alert
{
    public static function getError($errorMsg)
    {
        $view = new Viewer("Error", 'Page d\'erreur');
        $view->createFile(['errorMsg' => $errorMsg]);
        require_once('../Src/Views/Error.phtml');
    }
}
