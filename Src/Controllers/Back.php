<?php
namespace Src\Controllers;

use Src\Managers\Users;
use App\Viewer;

class Back extends Main
{
    public function index()
    {
        if ($user_login->is_logged_in()!="") {
            $user_login->redirect('home');
        }
        if (isset($_POST['submit'])) {
            $email = trim($_POST['userEmail']);
            $upass = trim($_POST['userPass']);

            if ($user_login->login($email, $upass)) {
                $user_login->redirect('home');
            }
        }
        $user = $this->Users;
        $view = new Viewer('Backend/index', 'Mon Blog _ login');
        $view->generate(array('user' => $user));
    }
}
