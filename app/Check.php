<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace app;

/**
 *Classe Check pour verification de la session avec token de comparaison .
 */
class Check
{
    public static function verifSession()
    {
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
        if (!isset($_SESSION['token']) && self::mixMdp($_SESSION['token_uncrypted']) == $_SESSION['token']) {
            header('Location:' . \BASEPATH . 'Main/Login');
            exit();
        }
    }

    /**
     *Fonction de cryptage pour mot de pass ou token
     * @param  $pass = au password.
     */
    public static function mixMdp($p)
    {
        return \password_hash($p, PASSWORD_DEFAULT);
    }
}
