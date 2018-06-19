<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace Src\Controllers;

use App\Viewer;

class Front extends Main
{
    const MAX_POST = 4;

    // affiche la liste des billets sur la page d'accueil avec un maximum de 4 billets suivant la constance MAX_POST
    public function Index()
    {
        $billets = $this->billetManager->readFront(0, self::MAX_POST);
        $view = new Viewer('Front/Index', 'Alaska _ Accueil');
        $view->createFile(['billets' => $billets]);
    }
    // affiche les détails d'un billet
    public function Posting($id)
    {
        $billets = $this->billetManager->read($id);
        $comments = $this->commentManager->read($id);
        $view = new Viewer('Front/Post', 'Alaska _ Détails d\'un article');
        $view->createFile(['billets'=>$billets,'comments' =>$comments]);
    }
    // affichage des billets en liste
    public function List()
    {
        $billets =$this->billetManager->readFront(0, 100);
        $view = new Viewer('Front/List', 'Alaska _ Liste des billets');
        $view->createFile(['billets' => $billets]);
    }
    // création d'un commentaire pour le billet en cour
    public function Create()
    {
        $comment = $this->commentManager->create();
        if ($comment !== false) {
            header('Location:'.\BASEPATH.'Front/Posting/'.$comment);
            exit();
        }
    }
    //Signaler un commentaire a l'admin
    public function Signaler($id)
    {
        $comment = $this->commentManager->Moderate($id);
        if ($comment !== false) {
            header('Location:'.\BASEPATH.'Front/Posting/'.$comment);
            exit();
        }
    }
}
