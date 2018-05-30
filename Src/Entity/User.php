<?php
namespace Src\Entity;

require_once('../App/Pattern/Hydrator.trait.php');
use App\Pattern\Hydrator;

class User
{
    private $_id_user;
    private $_username;
    private $_email;
    private $_password;
    private $_role;
    private $_create_at;

    public function __construct($data=[])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    use Hydrator;
    //SETTERS
    public function setUsername($_username)
    {
        if (!\is_string($_username) || empty($_username)) {
            throw new \Exception(Error::getError("Merci de remplir correctement le champ"), 1);
        } else {
            $this->_username = $_username;
        }
    }
    public function setEmail($_email)
    {
        if (!\is_string($_email) || empty($_email) and  filter_var($_email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception(Error::getError("Merci de saisir une adresse email valide"), 1);
        } else {
            $this->_email = $_email;
        }
    }
    public function setPassword($_password)
    {
        if (!\is_string($_password) || empty($_password)) {
            throw new \Exception(Error::getError("Merci de remplir correctement le champ"), 1);
        } else {
            $this->_password = $_password;
        }
    }
    public function setRole($_role)
    {
        if (!\is_string($_role) || empty($_role)) {
            throw new \Exception(Error::getError("Une erreur est survenue, merci de vérifier que vous avez sélectionner une option"), 1);
        } else {
            $this->_role = $_role;
        }
    }
    public function setCreate_at($_create_at)
    {
        $this->_create_at = $_create_at;
    }
    // GETTERS
    public function getId()
    {
        return $this->_id_user;
    }
    public function getUsername()
    {
        return $this->_username;
    }
    public function getMail()
    {
        return $this->_email;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    public function getRole()
    {
        return $this->_role;
    }
    public function getCreate_at()
    {
        return $this->_create_at;
    }
}
