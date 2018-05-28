<?php
namespace Src\Managers;

class Billets
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Dbd::getDbd();
    }
    // Lire tous les articles
    public function readAll($debut = -1, $limite = -1)
    {
        $sql =('SELECT * FROM T_billets ORDER BY create_at DESC');
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $request = $this->pdo->query($sql);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        $billets = $request->fetchAll();
        $request->closeCursor();
        return $billets;
    }
}
