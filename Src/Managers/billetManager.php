<?php
namespace Src\Managers;

use App\Dbd;
use App\Alert;

class billetManager
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo =  new Dbd;
    }
    public function readAll()
    {
        if (isset($_SESSION['authenticated'])) {
            $request = $this->_pdo->prepare('SELECT * FROM T_billets  ORDER BY create_at DESC ');
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
            return $billets = $request->fetchAll();
            $request->closeCursor();
        }
    }
    // Lire tous les billets
    public function ReadFront($offset, $limit)
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_billets  WHERE posted = 1 ORDER BY create_at ASC LIMIT :offset,:limit');
        $request->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $request->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        return $billets = $request->fetchAll();
        $request->closeCursor();
    }
    // lire un billet
    public function Read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_billets WHERE id_bil = :id LIMIT 1");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        return $billets = $request->fetch();
        $request->closeCursor();
    }
    // Creation d'un billet
    public function Create()
    {
        $title = \htmlspecialchars($_POST['title']);
        $author = \htmlspecialchars($_POST['author']);
        $content = $_POST['content'];
        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        $create_at = date(DATE_W3C);
        $modif_at = date(DATE_W3C);
        $posted = \htmlspecialchars($_POST['posted']);

        try {
            $upload_dir = \BASEPATH.'img/posts/';// Dossier des images chargées
            $imgExt = \strtolower(\pathinfo($imgFile, PATHINFO_EXTENSION));
            $valid_extensions= array('jpeg', 'jpg', 'png', 'gif');
            $image = rand(1000, 1000000).".".$imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 500000) {
                    \move_uploaded_file($tmp_dir, "$upload_dir/$image");
                } else {
                    throw new \Exception(Alert::getError($errorMsg = 'Le fichier image est trop gros!'), 1);
                }
            } else {
                throw new \Exception(Alert::getError($errorMsg = 'Erreur: Extensions de fichiers autorisée, (jpeg,jpg,png,gif)'), 1);
            }
            $request = $this->_pdo->prepare('INSERT INTO T_billets (title, author, content, image, create_at, modif_at, posted)
            VALUES (:title, :author, :content, :image, NOW(), NOW(), :posted)');
            $request->bindValue(':title', $title, \PDO::PARAM_STR);
            $request->bindValue(':author', $author, \PDO::PARAM_STR);
            $request->bindValue(':content', $content, \PDO::PARAM_STR);
            $request->bindValue(':image', $image, \PDO::PARAM_STR);
            $request->bindvalue(':posted', $posted, \PDO::PARAM_BOOL);
            $verifIsOk = $request->execute();
            if (!$verifIsOk) {
                return false;
            } else {
                return $_POST['id_bil'];
            }
        } catch (Exception $e) {
            throw new \Exception(Alert::getError($errorMsg = "Une erreur est survenue, l'enregistrement n'a pu aboutir"), 1);
        }
        $request->closeCursor();
    }
    // Mise à jour de Billet
    public function Update($id)
    {
        $title = $author = $content = $image = $modif_at = $posted = '';
        $title = \htmlspecialchars($_POST['title']);
        $author = \htmlspecialchars($_POST['author']);
        $content = $_POST['content'];
        $modif_at = date(DATE_W3C);
        $posted = (isset($_POST['posted']))? \htmlspecialchars($_POST['posted']):"0";
        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];

        if ($imgFile) {
            $upload_dir = 'user_images/'; // upload directory
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $image = rand(1000, 1000000).".".$imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 5000000) {
                    unlink($upload_dir.$edit_row['image']);
                    move_uploaded_file($tmp_dir, $upload_dir.$image);
                } else {
                    throw new \Exception(Alert::getError($errorMsg = 'Le fichier image est trop gros!'), 1);
                }
            } else {
                throw new \Exception(Alert::getError($errorMsg = 'Erreur: Extensionsde fichiers autorisée, (jpeg,jpg,png,gif)'), 1);
            }
        } else {
            // Si pas d'image sélectionné on garde l'ancienne
        }
        
        try {
            $request = $this->_pdo->prepare('UPDATE  T_billets SET title=:title, author=:author, content=:content,image=:image, modif_at=NOW(), posted=:posted WHERE id_bil=:id');
            $request->bindValue(':id', $id, \PDO::PARAM_INT);
            $request->bindValue(':title', $title, \PDO::PARAM_STR);
            $request->bindValue(':author', $author, \PDO::PARAM_STR);
            $request->bindValue(':content', $content, \PDO::PARAM_STR);
            $request->bindValue(':image', $image, \PDO::PARAM_STR);
            $request->bindvalue(':posted', $posted, \PDO::PARAM_BOOL);
            $billets = $request->execute();
            $verifIsOk = $billets;
            if (!$verifIsOk) {
                return false;
            } else {
                return $billets;
            }
        } catch (Exception $e) {
            throw new \Exception(Alert::getError($errorMsg = "Une erreur est survenue, l'enregistrement n'a pu aboutir"), 1);
        }
        $request->closeCursor();
    }
    // Effacer un Billet
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_billets WHERE id_bil = :id LIMIT 1');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        return $request->execute();
    }
}
