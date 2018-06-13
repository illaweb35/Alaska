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
        $view = new Viewer('Back/Edit_billet', " Alaska _ Modification d'un billet");
        $view->createFile(['billets'=>$billets]);
    }
    // Creation d'un utilisateur
    public function Create_user()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $users = $this->userManager->Create();
            if ($users !== false) {
                header('Location:'.\BASEPATH.'Back/Users');
                exit();
            }
            $view = new Viewer('Back/Users', 'Alaska _ Ajout utilisateur');
            $view->createFile(['users'=>$users]);
        }
    }
    // Mise a jour d'un utilisateur
    public function Update_user($id)
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $users = $this->userManager->Update($id);
            if ($billets !== false) {
                header('Location:'.\BASEPATH.'Back/Users');
                exit();
            }
        }
        $users = $this->userManager->Read($id);
        $view = new Viewer('Back/Edit_user', 'Alaska _ Modification utilisateur');
        $view->createFile(['users'=>$users]);
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
    public function Delete_com($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $comments = $this->commentManager->Delete($id);
        header('Location:'.\BASEPATH.'Back/Dashboard');
        exit();
    }
    public function Delete_user($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $users = $this->userManager->Delete($id);
        header('Location: '.\BASEPATH.'Back/ListUsers');
    }
}
