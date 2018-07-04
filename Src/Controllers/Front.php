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

/**
*Class Front pour la gestion des managers pour la partie visiteur
* Hérite de la class Main
*/
class Front extends Main
{

    /**
    * affiche la liste des billets sur la page d'accueil avec un maximum de 4 billets suivant la constance MAX_POST
    */
    public function Index()
    {
        $billets = $this->billetManager->ReadFront(0, \MAX_POST);
        $view = new Viewer('Front/Index', 'Alaska _ Accueil');
        $view->createFile(['billets' => $billets]);
    }
    /**
    *Affiche les détails d'un billet
    *@param  $id = identifiant du billet
    */
    public function Posting($id)
    {
        $billets = $this->billetManager->Read($id);
        $comments = $this->commentManager->Read($id);
        $view = new Viewer('Front/Post', 'Alaska _ Détails d\'un article');
        $view->createFile(['billets'=>$billets,'comments' =>$comments]);
    }
    /**
    *Affiche la liste des billets
    */
    public function List()
    {
        $billets =$this->billetManager->ReadFront(0, 100);
        $view = new Viewer('Front/List', 'Alaska _ Liste des billets');
        $view->createFile(['billets' => $billets]);
    }
    /**
    *Création d'un commentaire pour le billet
    */
    public function Create_com()
    {
        $comment = $this->commentManager->Create();
        if ($comment !== false) {
            header('Location:'.\BASEPATH.'Front/Posting/'.$comment);
            exit();
        }
    }
    /**
    *Signaler un commentaire a l'admin
    */
    public function Signaler($id)
    {
        $comment = $this->commentManager->Moderate($id);
        if ($comment !== false) {
            header('Location:'.\BASEPATH.'Front/Posting/'.$comment);
            exit();
        }
    }
}
