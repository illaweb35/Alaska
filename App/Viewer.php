<?php
namespace App;

use App\Alert;

class Viewer
{
    private $_file;
    private $_title;

    public function __construct($action, $title)
    {
        $this->_file = '../Src/Views/'.$action.'.phtml';
        $this->_title = $title;
    }
    public function View($data)
    {
        $view = $this->createFile($data);
        echo $view;
    }
    public function createFile($data)
    {
        if (\file_exists($this->_file)) {
            \ob_start();
            \extract($data, EXTR_OVERWRITE);
            require_once $this->_file;
            $content = \ob_get_clean();
            $title = $this->_title;
            require_once('../Src/Views/Template.phtml');
        } else {
            throw new \Exception(Alert::getError($errorMsg ="Fichier View :' .$this->_file. 'introuvable", 1));
        }
    }
}
