<?php
namespace Src\Managers;

use App\Dbd;

class billetManager
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo =  new Dbd;
    }
    // Lire tous les billets
    public function readAll($debut = -1, $limite = -1)
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_billets ORDER BY create_at DESC');
        if ($debut != -1 || $limite != -1) {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        $billets = $request->fetchAll();
        $request->closeCursor();
        return $billets;
    }
    // lire un billet
    public function read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_billets WHERE id_bil = :id");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        if ($billets = $request->fetch()) {
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
            $content = $_POST['content'];
            $image = "test";
            $create_at = date(DATE_W3C);
            $modif_at = date(DATE_W3C);
            $posted = $_POST['posted'];
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_billets(title,author, content,image, create_at,modif_at, posted) VALUES (:title,:author,:content,:image,:create_at,:modif_at,:posted)');
                $request->bindValue(':title', $title, \PDO::PARAM_STR);
                $request->bindValue(':author', $author, \PDO::PARAM_STR);
                $request->bindValue(':content', $content, \PDO::PARAM_STR);
                $request->bindValue(':image', $image, \PDO::PARAM_STR);
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
    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $title = \htmlspecialchars($_POST['title']);
            $author = \htmlspecialchars($_POST['author']);
            $content = $_POST['content'];
            $image = "test";
            $create_at = date(DATE_W3C);
            $modif_at = date(DATE_W3C);
            $posted = $_POST['posted'];
            try {
                $request = $this->_pdo->prepare('UPDATE  T_billets SET title=:title,author=:author, content=:content,image=:image, create_at=:create_at,modif_at=NOW(), posted=:posted WHERE id=:id');
                $request->bindValue('id', (int) $id, \PDO::PARAM_INT);
                $request->bindValue(':title', $title, \PDO::PARAM_STR);
                $request->bindValue(':author', $author, \PDO::PARAM_STR);
                $request->bindValue(':content', $content, \PDO::PARAM_STR);
                $request->bindValue(':image', $image, \PDO::PARAM_STR);
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
    // Effacer un Billet
    public function delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_billets WHERE id_bil = :id');
        $request->bindparam(':id', $id);
        $request->execute();
        return true;
    }
}