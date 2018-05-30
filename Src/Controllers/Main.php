<?php
namespace Src\Controllers;

use Src\Managers\Billets;
use Src\Managers\Comments;
use Src\Managers\Users;
use App\Viewer;

class Main
{
    private $_id;

    public function __construct()
    {
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
        $this->_id = (int)(!empty($_GET['id']) ? $_GET['id']: 0);
        $this->Billets = new Billets();
        $this->Comments = new Comments();
        $this->Users = new Users();
    }
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
    public function login()
    {
        if ($this->isLogged()) {
            header('Location;'.BASEPATH.'/Front/Home');
        }
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $this->Users->connexion($_POST['username'], $_POST['password']);
        }
        if (isset($_SESSION['id'])) {
            header('Location:'.BASEPATH.'Back/Dasboard/');
        }
        $_SESSION['is_logged'] = 1;
        $user = $this->Users;
        $view = new Viewer('Back/index', 'Mon Blog _ login');
        $view->createFile(['user' => $user]);
    }
    public function logout()
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
