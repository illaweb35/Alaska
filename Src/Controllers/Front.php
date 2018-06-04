<?php
namespace Src\Controllers;

use App\Viewer;

class Front extends Main
{
    const MAX_POST = 4;

    // affiche la liste des billets sur la page d'accueil avec un maximum de 4 billets suivant la constance MAX_POST
    public function index()
    {
        $billets = $this->billetManager->readAll(0, self::MAX_POST);
        $view = new Viewer('Front/index', 'Accueil');
        $view->createFile(['billets' => $billets]);
    }
    // affiche les détails d'un billet
    public function posting($id)
    {
        $billets = $this->billetManager->read($id);
        $comments = $this->commentManager->read($id);
        $view = new Viewer('Front/post', 'Détails d\'un article');
        $view->createFile(['billets'=>$billets,'comments' =>$comments]);
    }
    // affichage des billets en liste
    public function list()
    {
        $billets =$this->billetManager->readAll();
        $view = new Viewer('Front/list', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }
    // création d'un commentaire pour le billet en cour
    public function addComment()
    {
        $comment = $this->commentManager->create();
        if ($comment !== false) {
            header('Location:'.BASEPATH.'Front/posting/'.$comment);
            exit();
        }
    }
}
