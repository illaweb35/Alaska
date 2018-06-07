<?php
namespace Src\Controllers;

use App\Viewer;

class Backedit extends Main
{
    // création d'un Billet
    public function create()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            if (isset(
            $_POST['title'],
            $_POST['author'],
            $_POST['content'],
            $_POST['posted'])) {
                $data = [
              'title'=> \htmlspecialchars($_POST['title']),
              'author'=> \htmlspecialchars($_POST['author']),
              'content'=> \htmlspecialchars($_POST['content']),
              'create_at'=> date('d M Y H:i:s'),
              'modif_at'=> date('d M Y H:i:s'),
              'posted'=> \htmlspecialchars($_POST['posted'])];
                $billet = $this->billetManager->create($data);
                if ($billet !== false) {
                    header('Location:'.\BASEPATH.'Back/Dashboard');
                    exit();
                }
            }
        }
        $view = new Viewer('Back/write', " Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }
    // Update du billet
    public function modif($id)
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
        }
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            $billet = $this->billetManager->read();
            if ($billet !== false) {
                header('Location:'.\BASEPATH.'Back/Dashboard');
                exit();
            }
        }
        $view = new Viewer('Back/write', " Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }

    public function editUser()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
            exit();
        }
    }
    public function delete($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/index');
            exit();
        }
        $comments = $this->commentManager->delete($id);
        $billets = $this->billetManager->delete($id);
        $users = $this->userManager->delete($id);
    }
}
