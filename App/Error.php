<?php
namespace App;

use App\Viewer;

class Error
{
    public static function getError($errorMsg)
    {
        $view = new Viewer("Error", 'Page d\'erreur');
        $view->createFile(['errorMsg' => $errorMsg]);
        require_once('../Src/Views/Error.phtml');
    }
}
