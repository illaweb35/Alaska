<?php
namespace Src\Managers;

class imageManager
{
    public function upload($index, $destination, $maxSize=false, $extension=false)
    {
        if (!isset($_FILES[$index]) or $_FILES[$index]['error'] > 0) {
            return false;
        }
        if ($maxsize !== false and $_FILES[$index]['size'] > $maxsize) {
            return false;
        }
        $ext = substr(\strrchr($_FILES[$index]['name'], '.'), 1);
        if ($extensions !== false and !in-array($ext,$extensions)) {
            return false;
        }
        return \move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
    }
}


$folder = \BASEPATH.'/img/posts/';
$file = basename($_FILES[$index]['name']);
$maxSize = 100000;
$size = filesize($_FILES[$index]['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$ext = strrchr($_FILES[$index]['name'], '.');
//Début des vérifications de sécurité...
if (!in_array($ext, $extensions)) {
    throw new \Exception(Error::getError('Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...'), 1);
    //Si l'extension n'est pas dans le tableau
}
if ($size>$mawSize) {
    throw new \Exception(Error::getError('Le fichier est trop gros...'), 1);
}
if (!isset(Error::getError())) { //S'il n'y a pas d'erreur, on upload
    //On formate le nom du fichier ici...
    $file = strtr(
         $file,
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
     );
    $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);
    if (move_uploaded_file($_FILES[$index]['tmp_name'], $folder. $file)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        echo 'Upload effectué avec succès !';
    } else { //Sinon (la fonction renvoie FALSE).
        echo 'Echec de l\'upload !';
    }
} else {
    echo $erreur;
}
