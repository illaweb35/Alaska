<?php
namespace Src\Managers;

use App\Dbd;

class Billets
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    // Lire tous les billets
    public function readAll($debut = -1, $limite = -1)
    {
        $sql =('SELECT * FROM T_billets ORDER BY create_at DESC');
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $request = $this->_pdo->query($sql);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        $billets = $request->fetchAll();
        $request->closeCursor();
        return $billets;
    }
    // lire un billet
    public function read($id)
    {
        $sql = ('SELECT * FROM T_billets WHER id = :id');
        $request = $this->_pdo->query($sql);
        $request->binValue(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFecthMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        if ($billet = $request->fetch()) {
            $request->closeCursor();
            return $billets;
        }
        return null;
    }
    // Creation d'un billet
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $title = \htmlspecialchars($_POST['title']);
            $author = \htmlspecialchars($_POST['author']);
            $content = \htmlspecialchars($_POST['content']);
            $image = \htmlspecialchars($_POST['image']);
            $create_at = date(DATE_W3C);
            $modif_at = date(DATE_W3C);
            $posted = 0;
            try {
                $sql = 'INSERT INTO T_billets(title,author, content,image, create_at,modif_at, posted) VALUES (:title,:author,:content,:image,:create_at,:modif_at,:posted)';
                $request = $this->_pdo->prepare($sql);
                $request->bindValue(':title', $title, \PDO::PARAM_STR);
                $request->bindValue(':author', $author, \PDO::PARAM_STR);
                $request->bindValue(':content', $content, \PDO::PARAM_STR);
                $request->binValue(':image', $image, \PDO::PARAM_STR);
                $request->bindValue(':create_at', $create_at);
                $request->bindValue(':modif_at', $modif_at);
                $request->bindvalue(':posted', $posted);
                $verif_is_ok = $request->execute();
                $request->closeCursor();
                if (!$verif_is_ok) {
                    return false;
                } else {
                    return $_POST['id'];
                }
            } catch (PDOException $e) {
                Error::getError($e->getMessage());
            }
        }
    }
    // Mise à jour de Billet
    public function update()
    {
    }
    // Effacer un Billet
    public function delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_billets WHERE id = :id');
        $request->bindparam(':id', $id);
        $request->execute();
        return true;
    }
}
