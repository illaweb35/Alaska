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
    //Lire tous les commentaires
    public function readAll()
    {
        $request = $this->_pdo->query('SELECT * FROM T_comments ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }

    // lire un commentaire non signalé
    public function read($id = null)
    {
        if (!isset($_SESSION['id'])) {
            $request = $this->_pdo->prepare('SELECT * FROM T_comments WHERE bil_id = :id AND moderate = 0');
            $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        } elseif ($id == null) {// si pas d'id
            $request = $this->_pdo->prepare('SELECT * FROM T_comments');
        } else { //sinon avec id
            $request = $this->_pdo->prepare('SELECT * FROM T_comments WHERE bil_id = :id');
            $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        }
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    // Creation d'un commentaire
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $content = htmlspecialchars($_POST['content']);
            $bil_id = htmlspecialchars($_POST['bil_id']);
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_comments(pseudo, content, create_at, bil_id) VALUES (:pseudo,:content,NOW(),:bil_id)');
                $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR) ;
                $request->bindValue(':content', $content, \PDO::PARAM_STR) ;
                $request->bindValue(':bil_id', $bil_id, \PDO::PARAM_INT);
                $verifIsOk = $request->execute();
                $request->closeCursor();
                if (!$verifIsOk) {
                    return false;
                } else {
                    return $_POST['bil_id'];
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
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
                $request = $this->_pdo->prepare('UPDATE  T_comments SET pseudo=:pseudo, content=:content, modif_at=:modif_at, bil_id=:bil_id WHERE id=:id');
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
