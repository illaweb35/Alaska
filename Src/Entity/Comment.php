<?php
/**
* @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
*@copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
*
*@license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
*@link       https://illaweb.fr
*/
namespace Src\Entity;

require_once('../App/Pattern/Hydrator.trait.php');
use App\Pattern\Hydrator;
use app\Alert;

class Comment
{
    private $id_com;
    private $pseudo;
    private $content;
    private $create_at;
    private $modif_at;
    private $bil_id;
    private $moderate;
    /**
    * Initialisation  des données vers l'hydratation
    *@param  $data = est un tableau des données
    */
    public function __construct($date = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    /**
    * Utilisation de l'hydratation du trait Hydrator
    */
    use Hydrator;
    /**
    * Mise en place des SETTERS avec vérification de format de données
    */
    public function setPseudo($pseudo)
    {
        if (!is_string($pseudo) || empty($pseudo)) {
            Alert::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->pseudo = $pseudo;
        }
    }
    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            Alert::getError($errorMsg = 'Le champ ne doit pas être vide et ne contenir que des caractères');
        } else {
            $this->content = $content;
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
    public function setBil_Id($bil_id)
    {
        $this->bil_id = (int)$bil_id;
    }
    public function setModerate($moderate)
    {
        if (is_bool($moderate)) {
            $this->moderate = (int)$moderate;
        }
    }
    /**
    * Mise en place des GETTERS
    */
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
