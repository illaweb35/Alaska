<?php
namespace Src\Entity;

require_once('../App/Pattern/Hydrator.trait.php');
use App\Pattern\Hydrator;

class Comment
{
    private $id_com;
    private $pseudo;
    private $content;
    private $create_at;
    private $modif_at;
    private $bil_id;
    private $moderate;

    public function __construct($date = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    use Hydrator;

    //SETTERS

    public function setPseudo($pseudo)
    {
        if (!is_string($pseudo) || empty($pseudo)) {
            Error::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->pseudo = $pseudo;
        }
    }
    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            Error::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->content = $content;
        }
    }
    public function setCreate_at(DateTime $create_at)
    {
        if (is_string($create_at)) {
            $this->create_at = $create_at;
        }
    }
    public function setModif_at(DateTime $modif_at)
    {
        if (is_string($modif_at)) {
            $this->modif_at = $modif_at;
        }
    }
    public function setBil_Id($bil_id)
    {
        $this->bil_id = (int)$bil_id;
    }
    public function setModerate($moderate)
    {
        $this->moderate = (int)$moderate;
    }

    //GETTERS
    public function getId()
    {
        return $this->id_com;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getCreate_at()
    {
        return $this->create_at;
    }
    public function getModif_at()
    {
        return $this->modif_at;
    }
    public function getBil_id()
    {
        return $this->bil_id;
    }
    public function getModerate()
    {
        return $this->moderate;
    }
}
