<?php
namespace Src\Entity;

require_once('../App/Pattern/Hydrator.trait.php');
use App\Pattern\Hydrator;

class Billet
{
    private $id;
    private $title;
    private $author;
    private $content;
    private $image;
    private $create_at;
    private $modif_at;
    private $posted;

    public function __construct($data =[])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    use Hydrator;
    //SETTERS
    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            Error::gestionError('Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->author = $author;
        }
    }
    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            Error::gestionError('Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->title = $title;
        }
    }
    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            Error::gestionError('Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->content = $content;
        }
    }
    public function setImage($image)
    {
        if (is_string($image)) {
            $this->image = $image;
        }
    }
    public function setCreate_at(DateTime $create_at)
    {
        $this->create_at = $create_at;
    }
    public function setModif_at(DateTime $modif_at)
    {
        $this->modif_at = $modif_at;
    }
    public function setPosted($posted)
    {
        if (is_bool($posted)) {
            $this->posted = $posted;
        }
    }
    // GETTERS
    public function getId()
    {
        return $this->id;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCreate_at()
    {
        return $this->create_at;
    }
    public function getModif_at()
    {
        return $this->Modif_at;
    }
    public function getPosted()
    {
        return $this->posted;
    }
}
