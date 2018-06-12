<?php
namespace Src\Controllers;

use App\Viewer;

class Backedit extends Main
{
    // création d'un Billet
    public function Create()
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
        }
        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            if (!isset(
            $_POST['title'],
            $_POST['author'],
            $_POST['content'],
            $_POST['posted'])) {
                $data = [
              'title'=> \htmlspecialchars($_POST['title']),
              'author'=> \htmlspecialchars($_POST['author']),
              'content'=>($_POST['content']),
              'image'=>\htmlspecialchars($_POST['image']),
              'posted'=> \htmlspecialchars($_POST['posted'])];
                $billets = $this->billetManager->Create($data);
                if ($billets !== false) {
                    header('Location:'.\BASEPATH.'Back/Dashboard');
                    exit();
                }
            }
        }
        $view = new Viewer('Back/Write', "Alaska _ Ecriture d'un billet");
        $view->createFile(['billets'=>$billets]);
    }
    // Update du billet
    public function Update($id)
    {
        if (!isset($_SESSION['authenticated'])and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            if (!isset(
            $_POST['title'],
            $_POST['author'],
            $_POST['content'],
            $_POST['posted'])) {
                $data = [
              'title'=> \htmlspecialchars($_POST['title']),
              'author'=> \htmlspecialchars($_POST['author']),
              'content'=>($_POST['content']),
              'posted'=> \htmlspecialchars($_POST['posted'])];
            
                $billets = $this->billetManager->Update($data);
                if ($billets !== false) {
                    header('Location:'.\BASEPATH.'Back/Post'.$billet->getId());
                    exit();
                }
            }
        }
        $billets = $this->billetManager->Read($id);
        $view = new Viewer('Back/Edit', " Alaska _ Modification d'un billet");
        $view->createFile(['billets'=>$billets]);
    }

    public function EditUser()
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }
    }
    public function Delete($id)
    {
        if (!isset($_SESSION['authenticated']) and !$this->isLogged()) {
            header('Location:'.\BASEPATH.'Front/Index');
            exit();
        }
        $billets = $this->billetManager->Delete($id);
    }
}
