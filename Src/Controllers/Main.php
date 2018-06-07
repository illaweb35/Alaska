<?php
namespace Src\Controllers;

use Src\Managers\billetManager;
use Src\Managers\commentManager;
use Src\Managers\userManager;

use App\Viewer;

class Main
{
    private $_id;
    protected $billetManager;
    protected $commentManager;
    protected $userManager;

    //Constructeur des managers
    public function __construct()
    {
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
        $this->_id = (int)(!empty($_GET['id']) ? $_GET['id']: 0);
        $this->billetManager= new billetManager();
        $this->commentManager = new commentManager();
        $this->userManager = new userManager();
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
            header('Location:'.BASEPATH.'Back/Dashboard');
        }
        $_SESSION['is_logged'] = 1;
        $user = $this->userManager;
        $view = new Viewer('Back/index', 'Mon Blog _ login');
        $view->createFile(['user' => $user]);
    }
    // Inscription utilisateur
    public function Signup()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }

        if (isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['role'])) {
            if ($_SERVER['REQUEST_METHOD']=== 'post') {
                $user = $this->userManager->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
            }
        }
        $view = new Viewer('Back/signup', 'Ajouter un utilisateur');
        $view->createFile(array('user'=>$user));
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
