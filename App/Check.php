<?php
namespace App;

abstract class Check
{
    public static function verifSession()
    {
        if (\session_status()== PHP_SESSION_NONE) {
            \session_start();
        }
        if (!isset($_SESSION['token']) && self::mixMdp($_SESSION['token_uncrypted']) == $_SESSION['token']) {
            header('Location:'.\BASEPATH.'Main/Login');
            exit();
        }
    }
    // haschage du mot de passe
    public static function mixMdp($p)
    {
        return \password_hash($p, PASSWORD_DEFAULT);
    }
}
