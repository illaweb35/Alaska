<?php
namespace Src\Managers;

class imageManager
{
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
