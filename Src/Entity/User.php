<?php
namespace Src\Entity;

require_once('../App/Pattern/Hydrator.trait.php');
use App\Pattern\Hydrator;
use App\Error;

class User
{
    private $id_user;
    private $username;
    private $email;
    private $password;
    private $role;
    private $create_at;

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
            throw new \Exception(Error::getError("Merci de remplir correctement le champ"), 1);
        } else {
            $this->username = $username;
        }
    }
    public function setEmail($email)
    {
        if (!\is_string($email) || empty($email) and  filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception(Error::getError("Merci de saisir une adresse email valide"), 1);
        } else {
            $this->email = $email;
        }
    }
    public function setPassword($password)
    {
        if (!\is_string($password) || empty($password)) {
            throw new \Exception(Error::getError("Merci de remplir correctement le champ"), 1);
        } else {
            $this->password = $password;
        }
    }
    public function setRole($role)
    {
        if (!\is_string($role) || empty($role)) {
            throw new \Exception(Error::getError("Une erreur est survenue, merci de vérifier que vous avez sélectionner une option"), 1);
        } else {
            $this->role = $role;
        }
    }
    public function setCreate_at($create_at)
    {
        $this->create_at = $create_at;
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
    public function getMail()
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
}
