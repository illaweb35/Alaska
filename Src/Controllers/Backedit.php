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
 * Classe Backedit gere la gestion des controleurs pour la modification des billets et commentaires si connecté
 * Hérite de la calsse Main
 */
class Backedit extends Main
{
    /**
     * création d'un Billet
     */
    public function Create()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $billets = $this->billetManager->Create();
            if ($billets !== false) {
                header('Location:' . \BASEPATH . 'Back/ListPost');
                exit();
            }
        }
        $billets = $this->billetManager->ReadAll();
        $view = new Viewer('Back/Write', "Alaska _ Ecriture d'un billet");
        $view->createFile(['billets' => $billets]);
    }

    /**
     * Mise à jour du billet
     * @param  $id = identifiant du billet
     */
    public function Update($id)
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $billets = $this->billetManager->Update($id);
            if ($billets !== false) {
                header('Location:' . \BASEPATH . 'Back/ListPost');
                exit();
            }
        }
        // Lecture du billet existant pour affichage des données avant modification
        $billets = $this->billetManager->Read($id);
        $view = new Viewer('Back/Edit_billet', " Alaska _ Modifs d'un billet");
        $view->createFile(['billets' => $billets]);
    }

    /**
     * Création d'un utilisateur
     */
    public function Create_user()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $users = $this->userManager->Create();
            if ($users !== false) {
                header('Location:' . \BASEPATH . 'Back/ListUsers');
                exit();
            }
            $view = new Viewer('Back/Users', 'Alaska _ Ajout utilisateur');
            $view->createFile(['users' => $users]);
        }
    }

    /**
     * Mise à jour d'un utilisateur
     * @param  $id = identifiant de l'utilisateur
     */
    public function Update_user($id)
    {
        //Verification si l'utilisateur est bien connecté a l'admin
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $users = $this->userManager->Update($id);
            if ($users !== false) {
                header('Location:' . \BASEPATH . 'Back/ListUsers');
                exit();
            }
        }
        // Lecture des données existante de l'utilisateur avant modification
        $users = $this->userManager->Read($id);
        $view = new Viewer('Back/Edit_user', 'Alaska _ Modification utilisateur');
        $view->createFile(['users' => $users]);
    }

    /**
     * Suppression d'un billet
     * @param  $id = identifiant du billet
     */
    public function Delete($id)
    {
        //Verification si l'utilisateur est bien connecté a l'admin
        if (!isset($_SESSION['authenticated']) and !$this->login()) {
            header('Location:' . \BASEPATH . 'Front/Index');
            exit();
        }
        $billets = $this->billetManager->Delete($id);
        header('Location:' . \BASEPATH . 'Back/ListPost');
        exit();
    }

    /**
     * Suppression image
     * @param $id = identifiant du billet
     */
    public function Delete_img($id)
    {
        //Verification si l'utilisateur est bien connecté a l'admin
        if (!isset($_SESSION['authenticated']) and !$this->login()) {
            header('Location:' . \BASEPATH . 'Front/Index');
            exit();
        }

        $billets = $this->billetManager->Delete_img($id);

        header('Location:' . \BASEPATH . 'Backedit/Update/' . $id);
        exit();
    }

    /**
     * Suppression d'un commentaire
     * @param  $id = identifiant du commentaire
     */
    public function Delete_com($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->login()) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $comments = $this->commentManager->Delete($id);
        header('Location:' . \BASEPATH . 'Back/Dashboard');
        exit();
    }

    /**
     * Suppression d'un utilisateur
     * @param  $id = identifiant de l'utilisateur
     */
    public function Delete_user($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->login()) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $users = $this->userManager->Delete($id);
        header('Location: ' . \BASEPATH . 'Back/ListUsers');
    }
}
