<?php
namespace Src\Controllers;

use App\Viewer;
use App\Error;

class Backedit extends Main
{
    // création d'un Billet
    public function Create()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $billets = $this->billetManager->Create();
            if ($billets !== false) {
                header('Location:'.\BASEPATH.'Back/Dashboard');
                exit();
            }
        }
        $view = new Viewer('Back/Write', "Alaska _ Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }
    // Update du billet
    public function Update($id)
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $billets = $this->billetManager->Update($id);

            if ($billets !== false) {
                header('Location:'.\BASEPATH.'Back/List');
                exit();
            }
        }
        $billets = $this->billetManager->Read($id);
        $view = new Viewer('Back/Edit', " Alaska _ Modification d'un billet");
        $view->createFile(['billets'=>$billets]);
    }

    public function CreateUser()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $users = $this->userManager->Create();
            if ($billets !== false) {
                header('Location:'.\BASEPATH.'Back/ListUsers');
                exit();
            }
            $view = new Viewer('Back/ListUsers', 'Alaska _ Ajout utilisateur');
            $view->createFile(['users'=>$users]);
        }
    }
    public function Delete($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }

        $billets = $this->billetManager->Delete($id);
        header('Location:'.\BASEPATH.'Back/List');
        exit();
    }
    public function comDelete($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $comments = $this->commentManager->Delete($id);
        header('Location:'.\BASEPATH.'Back/Dashboard');
        exit();
    }
    public function userDelete($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $users = $this->userManager->Delete($id);
        header('Location: '.\BASEPATH.'Back/ListUsers');
    }
}
