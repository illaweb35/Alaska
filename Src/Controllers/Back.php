<?php
namespace Src\Controllers;

use App\Viewer;

class Back extends Main
{
    // retour à l'accueil si déconnecté
    public function Index()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
    }
    //affichage Tableau de bord si connecté
    public function Dashboard()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $billets = $this->billetManager->readFront(0, 100);
        $all_billets = $this->billetManager->readAll();
        $comments = $this->commentManager->readAll();
        $commentModerate =$this->commentManager->readModerate();
        $users = $this->userManager->userAll();
        $view = new Viewer('Back/Dashboard', "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets,'all_billets'=>$all_billets,'comments'=>$comments,'users'=>$users,'commentModerate'=> $commentModerate]);
    }

    public function List()
    {
        $billets =$this->billetManager->readAll(0, 100);
        $view = new Viewer('Back/List', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }

    public function Params()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        $user = $this->userManager->userAll();
        $view = new Viewer('Back/Params', 'Alaska _ Paramètres');
        $view->createFile(['user'=>$user]);
    }
    public function Check($id)
    {
        $comment = $this->commentManager->Moderate($id);
        if ($comment !== false) {
            header('Location:'.\BASEPATH.'Back/Dashboard/'.$comment);
            exit();
        }
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
}
