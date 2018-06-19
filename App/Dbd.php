<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace App;

/**
*Classe de connexion à la base de données
* Utilisation des constances de la classe config pour les parametres de connexion
*/
class Dbd extends \PDO
{
    public function __construct()
    {
        $db_base = \DB_NAME;
        $db_host = \DB_HOST;
        $db_user = \DB_USER;
        $db_pass =\DB_PASS;
        $dsn = ('mysql:host='.$db_host.';dbname='.$db_base.';charset=utf8');

        parent::__construct($dsn, $db_user, $db_pass);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
