<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace Src\Controllers;

use Src\Managers\billetManager;
use Src\Managers\commentManager;
use Src\Managers\userManager;
use app\Viewer;

/**
 * class Main instancie les classes controllers et vérifie la connection et l'inscription sur le site ainsi que la déconnexion.
 * @param  $_id = l'identifiant des Entities.
 * @param  $billetManager = instance de la classse Billet Manager
 * @param $commentManager = instance de la classe Comment Manager
 * @param  $userManager = instance de la calsse User Manager
 */
class Main
{
    private $_id;
    protected $billetManager;
    protected $commentManager;
    protected $userManager;

    /**
     * Instanciation des classes et de la session et mise verification de l'identifiant
     */
    public function __construct()
    {
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
        $this->_id = (int)(!empty($_GET['id']) ? $_GET['id'] : 0);
        $this->billetManager = new billetManager();
        $this->commentManager = new commentManager();
        $this->userManager = new userManager();
    }

    /**
     * Page de connexion a la partie Admin
     */
    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST) && isset($_POST)) {
            $user = $this->userManager->Connexion();
        }
        if (isset($_SESSION['id'])) {
            header('Location:' . BASEPATH . 'Back/Dashboard');
        }
        $user = null;
        $view = new Viewer('Back/Login', 'Alaska _ login');
        $view->createFile(['user' => $user]);
    }

    /**
     * Inscription utilisateur
     */
    public function Signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $user = $this->userManager->Create();
            if ($user !== false) {
                header('Location:' . \BASEPATH . 'Back/Login');
                exit();
            }
        }
        $user = null;
        $view = new Viewer('Back/Signup', 'Alaska _ Ajouter un utilisateur');
        $view->createFile(array('user' => $user));
    }

    /**
     * Déconnection de la partie Admin
     */
    public function Logout()
    {
        if (!empty($_SESSION)) {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }
        header('Location: ' . \BASEPATH . 'Back/Index');
        exit;
    }
}
