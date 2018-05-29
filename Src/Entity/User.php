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
    private $_status;
    private $_token;

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
    public function setStatus($_status)
    {
        if (!\is_string($_status) || empty($_status)) {
            throw new \Exception(Error::getError("Une erreur est survenue, merci de vérifier que vous avez sélectionner une option"), 1);
        } else {
            $this->_status = $_status;
        }
    }
    public function setToken($_token)
    {
        $this->_token = $_token;
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
    public function getStatus()
    {
        return $this->_status;
    }
    public function getToken()
    {
        return $this->_token;
    }
}
