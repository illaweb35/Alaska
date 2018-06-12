<?php
namespace Src\Managers;

use App\Dbd;
use App\Error;
use App\Check;

class userManager
{
    private $_pdo;
    public function __construct()
    {
        $this->_pdo = new Dbd;
    }
    // Connexion Admin
    public function Connexion()
    {
        $username = \htmlspecialchars($_POST['username']);
        $password = Check::mixMdp(\htmlspecialchars($_POST['password']));

        $request =$this->_pdo->prepare('SELECT * FROM T_users WHERE username=:username AND password=:password');
        $request->execute([':password'=> $password,':username'=>$username]);
        if (!$request->rowCount()==1) {
            session_start();
            session_name("Alaska_blog");
            $userData = $request->fetch();
            $_SESSION = $userData;
            $_SESSION['authenticated']= true;
            $_SESSION['token_uncrypted']= \uniqid();
            $_SESSION['token']= Check::mixMdp($_SESSION['token_uncrypted']);
            $_SESSION['name']= $username;
            header('Location:'.\BASEPATH.'Back/Dashboard');
            exit();
        } else {
            throw new \Exception(Error::getError('Mauvais couple d\'indentifiants'), 1);
        }
    }


    // afficher les utilisateurs avec ou sans id
    public function UserAll()
    {
        $request = $this->_pdo->query('SELECT * FROM T_users ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        $users = $request->fetchAll();
        $request->closeCursor();
        return $users;
    }
    // ajout d'un utilisateur
    public function Create()
    {
        $username = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        $password = Check::mixMdp(\htmlspecialchars($_POST['password']));
        $role = \htmlspecialchars($_POST['role']);
        $dateCrea = date(DATE_W3C);
        $request = $this->_pdo->query("SELECT* FROM T_users WHERE username = '$username' OR email='$email'");
        $userExist = $request->rowCount();
        if ($userExist == 1) {
            throw new \Exception(Error::getError("Nom d'utilisateur ou email deja utilisé"), 1);
        } else {
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_users (username, email, password, role, create_at) VALUES (:username, :email, :password, :role, NOW())');
                $request->bindValue(':username', $username, \PDO::PARAM_STR) ;
                $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
                $request->bindValue(':password', $password, \PDO::PARAM_STR);
                $request->bindValue(':role', $role, \PDO::PARAM_STR);
                $request->execute();
                $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
                $verifIsOk = $request->execute();
                if (!$verifIsOk) {
                    return false;
                } else {
                    return $_POST['id_user'];
                }
            } catch (PDOException $e) {
                throw new \Exception(Error::getError($e->getMessage()), 1);
            }
        }
    }

    // Mise a jour utilisateurs
    public function Update($id)
    {
        $name = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        $password= Check::mixMdp(\htmlspecialchars($_POST['password']));
        $role = \htmlspecialchars($_POST['role']);
        $dateCrea = date(DATE_W3C);
        try {
            $request = $this->_pdo->prepare('UPDATE T_users SET username=:username,email=:email,password=:password WHERE id_user=:id');
            $request->bindValue(':name', $name, \PDO::PARAM_STR) ;
            $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
            $request->bindValue(':password', $password, \PDO::PARAM_STR);
            $request->bindValue(':role', $role, \PDO::PARAM_STR);
            $request->bindValue(':dateCrea', $dateCrea);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        } catch (PDOException $e) {
            throw new \Exception(Error::getError($e->getMessage()), 1);
        }
    }

    // Effacer un Billet
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_users WHERE id = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        return true;
    }
}
