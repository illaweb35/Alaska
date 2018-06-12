<?php
namespace Src\Managers;

use App\Dbd;

class commentManager
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    //Lire tous les commentaires
    public function ReadAll()
    {
        $request = $this->_pdo->query('SELECT * FROM T_comments ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    public function ReadModerate()
    {
        $request = $this->_pdo->query('SELECT * FROM T_comments WHERE moderate = 1 ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    // lire un commentaire non signalé
    public function Read($id = null)
    {
        if (!isset($_SESSION['id'])) {
            $request = $this->_pdo->prepare('SELECT * FROM T_comments WHERE bil_id = :id AND moderate = 0 ORDER BY create_at DESC');
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
    public function Create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $content = htmlspecialchars($_POST['content']);
            $art_id = htmlspecialchars($_POST['bil_id']);
            $create_at = date(DATE_W3C);
            try {
                $sql = 'INSERT INTO T_comments(pseudo, content, create_at, bil_id) VALUES (:pseudo,:content,:create_at,:bil_id)';
                $request = $this->_pdo->prepare($sql);
                $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR) ;
                $request->bindValue(':content', $content, \PDO::PARAM_STR) ;
                $request->bindValue(':bil_id', $art_id, \PDO::PARAM_INT);
                $request->bindValue(':create_at', $create_at);
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

    // Mise à jour de Commentaires
    public function Update(array $data)
    {
        $sql= ('UPDATE  T_comments SET pseudo=:pseudo, content=:content, modif_at=NOW(), moderate=:moderate WHERE id_com=:id');
        $request = $this->_pdo->prepare($sql);
        $request->bindValue(':pseudo', $data['pseudo'], \PDO::PARAM_STR) ;
        $request->bindValue(':content', $data['content'], \PDO::PARAM_STR) ;
        $request->bindValue('moderate', $data['moderate'], \PDO::PARAM_INT);
        $request->bindValue(':id', $id, \PDO::PARAM_INT);
        return $request->execute($data);
        $request->closeCursor();
    }
    public function Moderate($id)
    {
        $sql=('SELECT moderate FROM T_comments WHERE id_com=:id LIMIT 1');
        $request = $this->_pdo->prepare($sql);
        $request->bindValue(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        $verif_moderate = $request->fetch();
        if ($verif_moderate === 0) {
            $sql = ('UPDATE T_comments SET moderate=1, modif_at=NOW() WHERE id_com=:id');
            $request = $this->_pdo->prepare($sql);
            $request->bindValue(':id', $id, \PDO::PARAM_INT);
        } else {
            $sql = ('UPDATE T_comments SET moderate=0, modif_at=NOW() WHERE id_com=:id');
            $request = $this->_pdo->prepare($sql);
            $request->bindValue(':id', $id, \PDO::PARAM_INT);
        }

        return $request->execute();
        $request->closeCursor();
    }

    // Effacer un Billet
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_comments WHERE id_com = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        return $request->execute();
    }
}
