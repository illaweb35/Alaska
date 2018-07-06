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
* Class Manager des billets qui regroupe l'ensemble des fonctions concernant la gestion des billets
*@param  $_pdo  = nouvelle instance de la classe Dbd base de données
*/
class billetManager
{
    protected $_pdo;

    public function __construct()
    {
        $this->_pdo =  new Dbd;
    }
    /**
    * Fonction pour lire tous les billets si connecté en admin
    */
    public function ReadAll()
    {
        if (isset($_SESSION['authenticated'])) {
            $request = $this->_pdo->prepare('SELECT * FROM T_billets  ORDER BY create_at DESC ');
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
            return $billets = $request->fetchAll();
            $request->closeCursor();
        }
    }
    /**
    * Lecture des billets pour la partie front du site
    *@param  $offset = détermine la position de départ dans la base de donnée
    *@param  $limit = détermine le nombre de billet à afficher
    */
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
    /**
    * Lecture d'un billet en fonction de l'identifiant
    *@param  $id = identifiant du billet à afficher
    */
    public function Read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_billets WHERE id_bil = :id LIMIT 1");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        return $billets = $request->fetch();
        $request->closeCursor();
    }
    /**
    *Création ou insertion dans la base de données du billet
    */
    public function Create()
    {
        $title = $author = $content = $imgFile = $tmp_dir = $imgSize = $create_at = $modif_at = $posted ="";
        if (empty($_POST['title'])) {
            Alert::getError($errorMsg ='Merci de rentrer un titre valide');
        } else {
            $title = Verif::filterName($_POST['title']);
            if ($title == false) {
                Alert::getError($errorMsg ='Merci de rentrer un titre valide.');
            }
        }
        if (empty($_POST['author'])) {
            Alert::getError($errorMsg = 'Merci d\'entrez un nom d\'auteur');
        } else {
            $author = Verif::filterName($_POST['author']);
            if ($author == false) {
                Alert::getError($errorMsg ='Merci d\'entrez un non d\'auteur valide.');
            }
        }
        if (empty($_POST['content'])) {
            Alert::getError($errorMsg ='Vous devez entrez une ligne de texte au minimum!');
        } else {
            $content = Verif::filterString($_POST['content']);
        }
        $imgFile = Verif::filterName($_FILES['image']['name']);
        $tmp_dir = Verif::filterString($_FILES['image']['tmp_name']);
        $imgSize = Verif::filterInt($_FILES['image']['size']);
        $create_at = date(DATE_W3C);
        $modif_at = date(DATE_W3C);
        if (isset($_POST['posted'])) {
            $posted = (Verif::filterBool($_POST['posted'])!== null)? 1:0;
        }
        // Insertion de l'image en upload avec enregistrement du nom dans la base et déplacement de l'image dans un dossier sur le site
        try {
            if (!$_FILES['image']['size'] == 0) {
                if (isset($_FILES['image'])&& !empty($_FILES)) {
                    $upload_dir = $_SERVER['DOCUMENT_ROOT'].\BASEPATH.'img/posts/';
                    $imgExt = \strtolower(\pathinfo($imgFile, PATHINFO_EXTENSION));
                    $valid_extensions= array('jpeg', 'jpg', 'png', 'gif');
                    $image = rand(1000, 1000000).".".$imgExt;
                    if (in_array($imgExt, $valid_extensions)) {
                        if ($imgSize < 5*MB) {
                            \move_uploaded_file($tmp_dir, $upload_dir.$image);
                        } else {
                            Alert::getError($errorMsg = 'Le fichier image est trop gros!');
                        }
                    } else {
                        Alert::getError($errorMsg = 'Erreur: Extensions de fichiers autorisée, (jpeg,jpg,png,gif)');
                    }
                }
                // insertion en base de données sans image
                $request = $this->_pdo->prepare('INSERT INTO T_billets (title, author, content, image, create_at, modif_at, posted) VALUES(:title, :author, :content, :image, NOW(), NOW(), :posted)');
                $request->bindValue(':image', $image, \PDO::PARAM_STR);
                $request->bindValue(':title', $title, \PDO::PARAM_STR);
                $request->bindValue(':author', $author, \PDO::PARAM_STR);
                $request->bindValue(':content', $content, \PDO::PARAM_STR);
                $request->bindvalue(':posted', $posted, \PDO::PARAM_BOOL);
            } else {
                //Insertion des infos en base de données avec image.
                $request = $this->_pdo->prepare('INSERT INTO T_billets (title, author, content, create_at, modif_at, posted)
              VALUES (:title, :author, :content, NOW(), NOW(), :posted)');
                $request->bindValue(':title', $title, \PDO::PARAM_STR);
                $request->bindValue(':author', $author, \PDO::PARAM_STR);
                $request->bindValue(':content', $content, \PDO::PARAM_STR);
                $request->bindvalue(':posted', $posted, \PDO::PARAM_BOOL);
            }

            $verifIsOk = $request->execute();
            if (!$verifIsOk) {
                return false;
            } else {
                return $_POST['id_bil'];
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
        $request->closeCursor();
    }
    /**
    *Mise a jour des infos du billet suivant son identifiant en base de données
    *@param  $id = identifiant du billet
    */
    public function Update($id)
    {
        $title = $author = $content = $imgFile = $tmp_dir = $imgSize = $create_at = $modif_at = $posted ="";
        if (empty($_POST['title'])) {
            Alert::getError($errorMsg ='Merci de donner un titre');
        } else {
            $title = Verif::filterName($_POST['title']);
            if ($title ==false) {
                Alert::getError($errorMsg ="Merci de rentrer un titre valide.");
            }
        }
        if (empty($_POST['author'])) {
            Alert::getError($errorMsg = 'Merci d\'entrez un nom d\'auteur');
        } else {
            $author = Verif::filterName($_POST['author']);
            if ($author == false) {
                Alert::getError($errorMsg ='Merci d\'entrez un non d\'auteur valide.');
            }
        }
        if (empty($_POST['content'])) {
            Alert::getError($errorMsg ='Vous devez entrez une ligne de texte au minimum!');
        } else {
            $content = Verif::filterString($_POST['content']);
        }
        $imgFile = Verif::filterName($_FILES['image']['name']);
        $tmp_dir = Verif::filterString($_FILES['image']['tmp_name']);
        $imgSize = Verif::filterInt($_FILES['image']['size']);
        $create_at = date(DATE_W3C);
        $modif_at = date(DATE_W3C);
        $posted = Verif::filterBool($_POST['posted']);
        if ($imgFile) {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'].\BASEPATH.'img/posts/';
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $image = rand(1000, 1000000).".".$imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 5*MB) {
                    unlink($upload_dir.$edit_row['image']);
                    move_uploaded_file($tmp_dir, $upload_dir.$image);
                } else {
                    Alert::getError($errorMsg = 'Le fichier image est trop gros!');
                }
            } else {
                Alert::getError($errorMsg = 'Erreur: Extensions de fichiers autorisée, (jpeg,jpg,png,gif)');
            }
        } else {
            // Si pas d'image sélectionné on garde l'ancienne
            $edit_row = $this->read($id);
            $image = $edit_row->getImage();
        }
        try {
            $request = $this->_pdo->prepare('UPDATE T_billets SET title=:title, author=:author, content=:content,image=:image, modif_at=NOW(), posted=:posted WHERE id_bil=:id');
            $request->bindValue(':id', $id, \PDO::PARAM_INT);
            $request->bindValue(':title', $title, \PDO::PARAM_STR);
            $request->bindValue(':author', $author, \PDO::PARAM_STR);
            $request->bindValue(':content', $content, \PDO::PARAM_STR);
            $request->bindValue(':image', $image, \PDO::PARAM_STR);
            $request->bindvalue(':posted', $posted, \PDO::PARAM_BOOL);
            $billets = $request->execute();
            if (!$billets) {
                return false;
            } else {
                $request->closeCursor();
                return $billets;
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    /**
    * Effacement d'un enregistrement suivant son identifiant
    *@param  $id = identifiant du billet
    */
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_billets WHERE id_bil=:id LIMIT 1');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        $billet = $request->fetch();
        $image = $billet['image'];
        unlink($_SERVER['DOCUMENT_ROOT'].\BASEPATH.'img/posts/'.$image);
        $request = $this->_pdo->prepare('DELETE FROM T_billets WHERE id_bil = :id LIMIT 1');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        return $request->execute();
    }
    /**
    * effacement image post
    *@param  $id = identifiant du billet
    */
    public function Delete_img($id)
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_billets WHERE id_bil=:id LIMIT 1');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        $billet = $request->fetch();
        $image = $billet['image'];
        unlink($_SERVER['DOCUMENT_ROOT'].\BASEPATH.'img/posts/'.$image);
        $unset="";
        $request = $this->_pdo->prepare('UPDATE  T_billets SET image=:image WHERE id_bil = :id LIMIT 1');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->bindParam(':image', $unset, \PDO::PARAM_STR);
        return $request->execute();
    }
}
