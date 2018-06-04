<?php
namespace Src\Controllers;

use App\Viewer;

class Back extends Main
{
    // retour à l'accueil si déconnecté
    public function index()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
    }
    //affichage Tableau de bord si connecté
    public function onBoard()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }

        $billets = $this->billetManager->readAll();
        $comments = $this->commentManager->readAll();
        $users = $this->userManager->userAll();
        $view = new Viewer("Back/Dashboard", "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets,'comments'=>$comments,'users'=>$users]);
    }

    public function list()
    {
        $billets =$this->billetManager->readAll();
        $view = new Viewer('Back/list', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }
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
    public function params()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        $user = $this->userManager->userAll();
        $view = new Viewer('Back/params', 'Alaska _ Paramètres');
        $view->createFile(['user'=>$user]);
    }
    public function newUser()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }

        if (isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['role'])) {
            if ($_SERVER['REQUEST_METHOD']=== 'post') {
                $user = $this->userManager->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
            }
        }
        $view = new Viewer('Back/signup', 'Ajouter un utilisateur');
        $view->createFile(array('user'=>$user));
    }
    public function editUser()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
    }
}
