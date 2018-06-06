<?php
namespace Src\Controllers;

use Src\Managers\billetManager;
use Src\Managers\commentManager;
use Src\Managers\userManager;
use Src\Managers\imageManager;
use App\Viewer;

class Main
{
    private $_id;
    protected $billetManager;
    protected $commentManager;
    protected $userManager;
    protected $imageManager;

    public function __construct()
    {
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
        $this->_id = (int)(!empty($_GET['id']) ? $_GET['id']: 0);
        $this->billetManager= new billetManager();
        $this->commentManager = new commentManager();
        $this->userManager = new userManager();
        $this->imageMnager = new imageManager();
    }
    // vérifie si la session existe
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
    // Page de connexion a la partie Admin
    public function Login()
    {
        if (!$this->isLogged()) {
            header('Location;'.BASEPATH.'/Front/Home');
        }
        if (isset($_POST['username'],$_POST['password'])) {
            $this->userManager->connexion($_POST['username'], $_POST['password']);
        }
        if (isset($_SESSION['id'])) {
            header('Location:'.BASEPATH.'Back/Dasboard');
        }
        $_SESSION['is_logged'] = 1;
        $user = $this->userManager;
        $view = new Viewer('Back/index', 'Mon Blog _ login');
        $view->createFile(['user' => $user]);
    }

    // inscription
    public function Signup()
    {
        if (!$this->isLogged()) {
            exit();
        }
        if (isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['role'])) {
            $user = $this->userManager->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
        }
        $view = new Viewer('Back/signup', 'Ajouter un utilisateur');
        $view->createFile(array('user'=>$user));
        header('Location: '.\BASEPATH.'Back/Dashboard');
    }
    // Déconnection de la partie Admin
    public function Logout()
    {
        if (!empty($_SESSION)) {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }
        header('Location: '.\BASEPATH.'Back/index');
        exit;
    }
}
