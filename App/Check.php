<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace App;

class Check
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
