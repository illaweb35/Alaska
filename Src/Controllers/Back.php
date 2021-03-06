<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace Src\Controllers;

use app\Viewer;

/**
 * Classe Back controleur pour les méthodes du back office si connecté en admin
 * Hérite de la classe Main
 */
class Back extends Main
{
    /**
     * retour à l'accueil si déconnecté
     */

    public function Index()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
    }

    /**
     * Affichage Tableau de bord si connecté
     */
    public function Dashboard()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $billets = $this->billetManager->ReadFront(0, 100);
        $all_billets = $this->billetManager->readAll();
        $comments = $this->commentManager->ReadAll();
        $commentModerate = $this->commentManager->ReadModerate();
        $users = $this->userManager->UserAll();
        $view = new Viewer('Back/Dashboard', "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets, 'all_billets' => $all_billets, 'comments' => $comments, 'users' => $users, 'commentModerate' => $commentModerate]);
    }

    /**
     * Affichage de la liste des billets
     */
    public function ListPost()
    {
        $billets = $this->billetManager->ReadAll(0, 100);
        $view = new Viewer('Back/List', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }

    /**
     * Affichage de la liste des utilisateurs
     */
    public function ListUsers()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $users = $this->userManager->UserAll();
        $view = new Viewer('Back/ListUsers', 'Alaska _ Paramètres');
        $view->createFile(['users' => $users]);
    }

    /**
     * Vérification si commentaire est modéré
     * @param $id = l'identifiant du commentaire .
     */
    public function Check($id)
    {
        $comment = $this->commentManager->Moderate($id);
        if ($comment !== false) {
            header('Location:' . \BASEPATH . 'Back/Dashboard/' . $comment);
            exit();
        }
    }
}
