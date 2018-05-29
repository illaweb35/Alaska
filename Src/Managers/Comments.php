<?php
namespace Src\Managers;

use App\Dbd;

class Comments
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    // Lire tous les commentaires
    public function readAll()
    {
        $sql =('SELECT * FROM T_comments ORDER BY create_at DESC');
        $request = $this->_pdo->query($sql);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    // lire un commentaires
    public function read($id)
    {
        $sql = ("SELECT * FROM T_comments WHERE bil_id = :id");
        $request = $this->_pdo->prepare($sql);
        $request->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        if ($comments = $request->fetch()) {
            $request->closeCursor();
            return $Comments;
        }
        return null;
    }
    // Creation d'un commentaire
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $pseudo = \htmlspecialchars($_POST['pseudo']);
            $content = \htmlspecialchars($_POST['content']);
            $bil_id =\htmlspecialchars($_POST['bil_id']);
            $create_at = date(DATE_W3C);
            try {
                $sql = 'INSERT INTO T_comments(pseudo, content, create_at, bil_id) VALUES (:pseudo,:content,:create_at,:bil_id)';
                $request = $this->_pdo->prepare($sql);
                $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR) ;
                $request->bindValue(':content', $content, \PDO::PARAM_STR) ;
                $request->bindValue(':bil_id', $bil_id, \PDO::PARAM_INT);
                $request->bindValue(':create_at', $create_at);
                $verif_is_ok = $request->execute();
                $request->closeCursor();
                if (!$verif_is_ok) {
                    return false;
                } else {
                    return $_POST['bil_id'];
                }
            } catch (PDOException $e) {
                throw new \Exception(Error::getError($e->getMessage()), 1);
            }
        }
    }
    // Mise à jour de Billet
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $pseudo = \htmlspecialchars($_POST['pseudo']);
            $content = \htmlspecialchars($_POST['content']);
            $bil_id =\htmlspecialchars($_POST['bil_id']);
            $modif_at = date(DATE_W3C);
            try {
                $sql = 'UPDATE  T_comments SET pseudo=:pseudo, content=:content, modif_at=:modif_at, bil_id=:bil_id WHERE id=:id';
                $request = $this->_pdo->prepare($sql);
                $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR) ;
                $request->bindValue(':content', $content, \PDO::PARAM_STR) ;
                $request->bindValue(':modif_at', $modif_at);
                $request->bindValue(':bil_id', $bil_id, \PDO::PARAM_INT);
                $request->bindValue(':id', $id, \PDO::PARAM_INT);
                $verif_is_ok = $request->execute();
                $request->closeCursor();
                if (!$verif_is_ok) {
                    return false;
                } else {
                    return $_POST['bil_id'];
                }
            } catch (PDOException $e) {
                Error::getError($e->getMessage());
            }
        }
    }
    // Effacer un Billet
    public function delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_comments WHERE id_com = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        return true;
    }
}
