<?php
namespace Src\Controllers;

use Src\Controllers\Main;
use Src\Managers\Users;
use App\Viewer;

class Back extends Main
{
    // retour à l'accueil si deéconnecté
    public function index()
    {
        if (!$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
    }
    //affichage Tableau de bord si connecté
    public function onBoard()
    {
        if (!$this->isLogged()) {
            exit;
        }
        $billets = $this->Billets->readAll();
        $comments = $this->Comments->readAll();
        $users = $this->Users->userAll();
        $view = new Viewer("Back/Dashboard", "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets,'comments'=>$comments,'users'=>$users]);
    }
    //affichage de la liste des utilisateurs
    public function listeUser()
    {
        if (!$this->isLogged()) {
            exit;
        }
        $users = $this->Users->userAll();
        $view = new Viewer('Back/Users', 'Liste des Utilisateurs');
        $view->createFile(['users'=>$user]);
    }
    // inscription
    public function signup()
    {
        if (!$this->isLogged()) {
            exit;
        }
        if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])) {
            $user = $this->Users->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
        }
        $user = $this->Users;
        $view = new Viewer('Back/signup', 'Ajouter un utilisateur');
        $view->createFile(['user'=>$user]);
    }
}
