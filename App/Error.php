<?php
namespace App;

abstract class Error
{
    public function getError($errorMsg)
    {
        $view = new View("Error", 'Page d\'erreur');
        $view->generate(array('errorMsg' => $errorMsg));
        require_once('../src/views/ErrorView.phtml');
    }
}
