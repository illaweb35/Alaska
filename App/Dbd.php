<?php
namespace App;

class Dbd extends \PDO
{
    public function __construct()
    {
        $db_base = \DB_NAME;
        $db_host = \DB_HOST;
        $db_user = \DB_USER;
        $db_pass =\DB_PASS;
        $dsn = 'mysql:host='.$db_host.';dbname='.$db_base.';charset=utf8';

        parent::__construct($dsn, $db_user, $db_pass);
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
