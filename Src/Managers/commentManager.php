<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace Src\Managers;

use App\Dbd;
use App\Alert;
use App\Verif;

/**
*Classe Manager des commentaires qui regroupes les fonctions pour la gestion des commentaires.
*@param $_pdo = nouvelle instance de la classe Dbd base de données
*/
class commentManager
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    /**
    * Fonction de lecture de tous ls commentaires
    */
    public function ReadAll()
    {
        $request = $this->_pdo->query('SELECT * FROM T_comments ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    /**
    * Fonction de lecture des commentaires qui ont moderate = à 1 donc signaler pour l'admin
    */
    public function ReadModerate()
    {
        $request = $this->_pdo->query('SELECT * FROM T_comments WHERE moderate = 1 ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comments = $request->fetchAll();
        $request->closeCursor();
        return $comments;
    }
    /**
    *Fonction de lecture d'un commentaire avec ou sans id
    *@param  $id = identifiant du commentaire
    */
    public function Read($id = null)// id à null si non disponible
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
    /**
    *Fonction de création ou insertion de commentaire dans le base de données
    */
    public function Create()
    {
        $pseudo = $content = $art_id = $create_at ="";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
            if (empty($_POST['pseudo'])) {
                Alert::getError($errorMsg='Merci d\'entrer un pseudo');
            } else {
                $pseudo = Verif::filterName($_POST['pseudo']);
                if ($pseudo == false) {
                    Alert::getError($errorMsg='Ton pseudo comporte des caractères interdits, tels des accents, des symboles, etc...');
                    exit();
                }
            }
            if (empty($_POST['content'])) {
                Alert::getError($errorMsg ='Vous devez entrez une ligne de texte au minimum!');
            } else {
                $content = Verif::filterString($_POST['content']);
                if (empty($_POST['content'])) {
                    Alert::getError($errorMsg='Votre commentaire ne peut-être vide !');
                }
            }
            $art_id = Verif::filterInt($_POST['bil_id']);
            $create_at = date(DATE_W3C);
            try {
                $sql = ('INSERT INTO T_comments(pseudo, content, create_at, bil_id) VALUES (:pseudo,:content,:create_at,:bil_id)');
                $request = $this->_pdo->prepare($sql);
                $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR) ;
                $request->bindValue(':content', $content, \PDO::PARAM_STR) ;
                $request->bindValue(':bil_id', $art_id, \PDO::PARAM_INT);
                $request->bindValue(':create_at', $create_at, \PDO::PARAM_STR);
                $verifIsOk = $request->execute();
                $request->closeCursor();
                if (!$verifIsOk) {
                    return false;
                } else {
                    return $_POST['bil_id'];
                }
            } catch (PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }
    /**
    * Fonction de modération verification sur létat de 'moderate' dans la base de données puis si l'etat est non signaler le passe en signaler et inversement
    *@param  $id = identifiant du commentaire
    */
    public function Moderate($id)
    {
        $sql=('SELECT moderate, bil_id FROM T_comments WHERE id_com=:id LIMIT 1');
        $request = $this->_pdo->prepare($sql);
        $request->bindValue(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Comment');
        $comment = $request->fetch();
        if ($comment->getModerate() == 1) {
            $sql = ('UPDATE T_comments SET moderate = 0, modif_at=NOW() WHERE id_com=:id');
        } else {
            $sql = ('UPDATE T_comments SET moderate = 1, modif_at=NOW() WHERE id_com=:id');
        }
        $request = $this->_pdo->prepare($sql);
        $request->bindValue(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        return $comment->getBil_id();
    }
    /**
    * Fonction d'effacement du commentaire
    *@param  $id = identifiant du commentaire
    */
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_comments WHERE id_com = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        return $request->execute();
    }
}
