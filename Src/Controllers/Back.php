<?php
namespace Src\Controllers;

use App\Viewer;

class Back extends Main
{
    // retour à l'accueil si déconnecté
    public function Index()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
    }
    //affichage Tableau de bord si connecté
    public function Dashboard()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }

        $billets = $this->billetManager->readAll();
        $comments = $this->commentManager->readAll();
        $comModerate =$this->commentManager->readModerate();
        $users = $this->userManager->userAll();
        $view = new Viewer("Back/Dashboard", "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets,'comments'=>$comments,'users'=>$users,'comModerate'=> $comModerate]);
    }

    public function List()
    {
        $billets =$this->billetManager->readAll();
        $view = new Viewer('Back/list', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }

    public function Params()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        $user = $this->userManager->userAll();
        $view = new Viewer('Back/params', 'Alaska _ Paramètres');
        $view->createFile(['user'=>$user]);
    }
    public function AddUser()
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
        header('Location:'.\BASEPATH.'Main/Login');
        exit();
    }
}
