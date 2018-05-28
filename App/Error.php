<?php
namespace App;

class Error
{
    public static function getError($errorMsg)
    {
        $view = new Viewer("Error", 'Page d\'erreur');
        $view->generate(['errorMsg' => $errorMsg]);
        require_once('../Src/Views/ErrorView.phtml');
    }
}
