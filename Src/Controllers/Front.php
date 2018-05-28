<?php
namespace Src\Controllers;

use App\Viewer;

class Front extends Main
{
    const MAX_POST = 4;

    // affiche la liste des billets sur la page d'accueil avec un maximum de 4 billets suivant la constance MAX_POST
    public function index()
    {
        $billets = $this->Billets->readAll(0, self::MAX_POST);
        $view = new Viewer('Front/index', 'Accueil');
        $view->createFile(['billets' => $billets]);
    }
    public function posting($id)
    {
        $billets = $this->Billets->read($id);
        $comments = $this->Comments->read($id);
        $view = new Viewer('Front/post', 'Déatils d\'un article');
        $view->createFile(['billets'=>$billets,'comments' =>$comments]);
    }
}
