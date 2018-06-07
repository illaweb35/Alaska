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
    public function readAll($offset, $limit)
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_billets ORDER BY create_at DESC LIMIT :offset,:limit');
        $request->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $request->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        return $billets = $request->fetchAll();
        $request->closeCursor();
    }
    // lire un billet
    public function read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_billets WHERE id_bil = :id LIMIT 1");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\Billet');
        return $billets = $request->fetch();
        $request->closeCursor();
    }
    // Creation d'un billet
    public function create(array $data)
    {
        $request = $this->_pdo->prepare('INSERT INTO T_billets(title,author, content, create_at,modif_at, posted) VALUES (:title,:author,:content,:create_at,:modif_at,:posted)');
        $request->bindValue(':title', $title, \PDO::PARAM_STR);
        $request->bindValue(':author', $author, \PDO::PARAM_STR);
        $request->bindValue(':content', $content, \PDO::PARAM_STR);
        $request->bindValue(':create_at', $create_at);
        $request->bindValue(':modif_at', $modif_at);
        $request->bindvalue(':posted', $posted);
        return $request->execute($data);
        $request->closeCursor();
    }
    // Mise à jour de Billet
    public function update(array $data)
    {
        $request = $this->_pdo->prepare('UPDATE  T_billets SET title=:title,author=:author, content=:content,image=:image, create_at=:create_at,modif_at=NOW(), posted=:posted WHERE id=:id');
        $request->bindValue('id', (int) $id, \PDO::PARAM_INT);
        $request->bindValue(':title', $title, \PDO::PARAM_STR);
        $request->bindValue(':author', $author, \PDO::PARAM_STR);
        $request->bindValue(':content', $content, \PDO::PARAM_STR);
        $request->bindValue(':image', $image, \PDO::PARAM_STR);
        $request->bindValue(':create_at', $create_at);
        $request->bindValue(':modif_at', $modif_at);
        $request->bindvalue(':posted', $posted);
        return $request->execute($data);
        $request->closeCursor();
    }
    // Effacer un Billet
    public function delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_billets WHERE id_bil = :id LIMIT 1');
        $request->bindparam(':id', $id, \PDO::PARAM_INT);
        return $request->execute();
    }
    public function add_picture($tmp_name, $extension)
    {
        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image']['name'];
            $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
            $extension = strrchr($file, '.');
            if (!\in_array($extension, $extension)) {
                $errors['image'] = 'Cette image n\'est pas valide!';
            }
        }
        $id = $this->_pdo->lastInsertId();
        $i =['id' => $id, 'image' => $id.$extension];
        $request =$this->_pdo->prepare("UPDATE T_billets SET image = :image WHERE id= :id");
        $request->execute($i);
        \move_uploaded_file($tmp_name, \BASEPATH.'img/posts/'.$id.$extension);
    }
}
