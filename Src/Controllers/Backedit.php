<?php
namespace Src\Controllers;

use App\Viewer;

class Backedit extends Main
{
    // création d'un Billet
    public function write()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            $billet = $this->billetManager->create();
            if ($billet !== false) {
                header('Location:'.\BASEPATH.'Back/onBoard');
                exit();
            }
        }
        $view = new Viewer('Back/write', " Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }
    // Update du billet
    public function modif($id)
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            $billet = $this->billetManager->read();
            if ($billet !== false) {
                header('Location:'.\BASEPATH.'Back/onBoard');
                exit();
            }
        }
        $view = new Viewer('Back/write', " Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }

    public function editUser()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
            exit();
        }
    }
}
