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
use App\Alert;

class User
{
    private $id_user;
    private $username;
    private $email;
    private $password;
    private $role;
    private $create_at;
    private $modif_at;

    public function __construct($data=[])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    use Hydrator;
    //SETTERS
    public function setUsername($username)
    {
        if (!\is_string($username) || empty($username)) {
            Alert::getError("Merci de remplir correctement le champ");
        } else {
            $this->username = $username;
        }
    }
    public function setEmail($email)
    {
        if (!\is_string($email) || empty($email) and  filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Alert::getError("Merci de saisir une adresse email valide");
        } else {
            $this->email = $email;
        }
    }
    public function setPassword($password)
    {
        if (!\is_string($password) || empty($password)) {
            Alert::getError("Merci de remplir correctement le champ");
        } else {
            $this->password = $password;
        }
    }
    public function setRole($role)
    {
        if (!\is_string($role) || empty($role)) {
            Alert::getError("Une erreur est survenue, merci de vérifier que vous avez sélectionner une option");
        } else {
            $this->role = $role;
        }
    }
    public function setDateCrea(DateTime $create_at)
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
    // GETTERS
    public function getId()
    {
        return $this->id_user;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getCreate_at()
    {
        return $this->create_at;
    }
    public function getModif_at()
    {
        return $this->modif_at;
    }
}
