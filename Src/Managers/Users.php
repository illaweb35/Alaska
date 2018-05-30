<?php
namespace Src\Managers;

use App\Dbd;

class Users
{
    private $_pdo;
    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    public function connexion($username, $password)
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
            throw new \Exception(Error::getError("Error Accès non autorisé"), 1);
        }
        if (strlen($username)<= 0 or strlen($password)<= 0) {
            throw new \Exception(Error::getError("Vous devez entrer un non d'utilisateur et un mot de passe valide"), 1);
        }
        $request = $this->_pdo->prepare('SELECT * FROM T_users WHERE username=:username AND password=:password ');
        $request->bindValue(':username', $username, \PDO::PARAM_STR);
        $request->bindValue(':password', $password, \PDO::PARAM_STR);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        if ($request->rowCount() == 1) {
            if (session_status() == PHP_SESSION_NONE) {
                \session_start();
            }
            $userData = $request->Fetch();
            $user = ['id_user'=> $userData->getId()];
            $_SESSION['user'] = $user;
            $_SESSION['authenticated'] = true;
            $_SESSION['token_uncrypted']= \uniqid();
            $_SESSION['token']= $this->mixMdp($_SESSION['token_uncrypted']);
            header('Location:'.BASEPATH.'Back/onBoard/');
        } else {
            throw new \Exception(Error::getError("Mauvais couple d'identifiant"), 1);
        }
    }
    // haschage du mot de passe
    public function mixMdp($p)
    {
        return  \password_hash("AlaskaBlog", PASSWORD_DEFAULT);
    }
    // afficher les utilisateurs avec ou sans id
    public function userAll($id = null)
    {
        if ($id == null) {
            $request = $this->_pdo->prepare('SELECT * FROM T_users');
        } else {
            $request = $this->_pdo->prepare('SELECT * FROM T_users WHERE id_user = :id');
            $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        }
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        if ($users = $request->fetchAll()) {
            return $users;
        }
        return null;
    }
    // ajout d'un utilisateur
    public function createUser()
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
            throw new \Exception(Error::getError("Error Accès non autorisé"), 1);
        }
        $user =new User();
        $username = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        $password = LoginManager::mixMdp(\htmlspecialchars($_POST['password']));
        $role = \htmlspecialchars($_POST['role']);
        $dateCrea = date(DATE_W3C);
        $request = $this->_pdo->query("SELECT* FROM T_users WHERE username = '$username' OR email='$email'");
        $userExist = $request->rowCount();
        if ($userExist == 1) {
            throw new \Exception(Error::getError("Nom d'utilisateur ou email deja utilisé"), 1);
        } else {
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_users (username, email, password, role, dateCrea) VALUES (:name, :email, :password, :role, :dateCrea)');
                $request->bindValue(':name', $username, \PDO::PARAM_STR) ;
                $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
                $request->bindValue(':password', $password, \PDO::PARAM_STR);
                $request->bindValue(':role', $role, \PDO::PARAM_STR);
                $request->bindValue(':dateCrea', $dateCrea);
                $request->execute();
                $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
                return $user;
            } catch (PDOException $e) {
                throw new \Exception(Error::getError($e->getMessage()), 1);
            }
        }
    }

    // Mise a jour utilisateurs
    public function update($id)
    {
        $name = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        $password= mixMdp(\htmlspecialchars($_POST['password']));
        $role = \htmlspecialchars($_POST['role']);
        $dateCrea = date(DATE_W3C);
        try {
            $sql =('UPDATE T_users SET username=:username,email=:email,password=:password WHERE id_user=:id');
            $request = $this->_pdo->prepare($sql);
            $request->bindValue(':name', $name, \PDO::PARAM_STR) ;
            $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
            $request->bindValue(':password', $password, \PDO::PARAM_STR);
            $request->bindValue(':role', $role, \PDO::PARAM_STR);
            $request->bindValue(':dateCrea', $dateCrea);
            return $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        } catch (PDOException $e) {
            throw new \Exception(Error::getError($e->getMessage()), 1);
        }
    }
}