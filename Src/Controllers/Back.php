<?php
namespace Src\Controllers;

use Src\Controllers\Main;
use Src\Managers\Users;
use App\Viewer;

class Back extends Main
{
    public function login()
    {
        if ($this->isLogged()) {
            header('Location;'.BASEPATH.'/Front/Home');
        }
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $this->Users->connexion($_POST['username'], $_POST['password']);
        }
        if (isset($_SESSION['id'])) {
            header('Location:'.BASEPATH.'Back/Dasboard/');
        }
        $_SESSION['is_logged'] = 1;
        $user = $this->Users;
        $view = new Viewer('Back/index', 'Mon Blog _ login');
        $view->createFile(['user' => $user]);
    }
    public function logout()
    {
        if (!empty($_SESSION)) {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }
        header('Location: '.\BASEPATH.'Back/login');
        exit;
    }

    public function onBoard()
    {
        if (!$this->isLogged()) {
            exit;
        }
        $billets = $this->Billets->readAll();
        $comments = $this->Comments->readAll();
        $users = $this->Users->userAll();
        $view = new Viewer("Back/Dashboard", "Mon Blog _ Tableau de bord");
        $view->createFile(['articles' => $articles,'comments'=>$comments,'users'=>$users]);
    }
    public function listeUser()
    {
        if (!$this->isLogged()) {
            exit;
        }
        $users = $this->Users->userAll();
        $view = new Viewer('Back/Users', 'Liste des Utilisateurs');
        $view->createFile(['users'=>$user]);
    }
    public function signup()
    {
        if (!$this->isLogged()) {
            exit;
        }
        if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])) {
            $result = $this->Users->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
        }
        $user =$this->Users;
        $view = new Viewer('Back/signup', 'Ajouter un utilisateur');
        $view->createFile(['user'=>$user]);
    }
}
