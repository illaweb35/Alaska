<?php

/**
 * @author    jm Holland <jm.holland@illaweb.fr>
 * @copyright  (c) 2018, illaweb. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://www.illaweb.fr
 */

namespace app;


/**
 *Classe de connexion à la base de données
 * Utilisation des constances de la classe config pour les paramètres de connexion
 * puis utilisation de la résolution de portée pour l'instanciation de la connexion pdo au contructeur parent.
 */
class Dbd extends \PDO
{
    public function __construct()
    {
        $db_base = \DB_NAME;
        $db_host = \DB_HOST;
        $db_user = \DB_USER;
        $db_pass = \DB_PASS;
        $dsn = ('mysql:host=' . $db_host . ';dbname=' . $db_base . ';charset=utf8');
        try {
            parent::__construct($dsn, $db_user, $db_pass);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
