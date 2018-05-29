<?php
namespace Src\Controllers;

use Src\Managers\Billets;
use Src\Managers\Comments;
use Src\Managers\Users;

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
}
