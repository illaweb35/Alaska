<?php
namespace Src\Managers;

use App\Dbd;
use App\Alert;
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
        $request = $this->_pdo->prepare('SELECT * FROM T_users WHERE username=:username ');
        $request->execute([':username'=>\htmlspecialchars($_POST['username'])]);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        if ($request->rowCount()== 1) {
            $user = $request->fetch();
            if (\password_verify(\htmlspecialchars($_POST['password']), $user->getPassword())) {
                if (\session_status()== PHP_SESSION_NONE) {
                    \session_start();
                    session_name('Alaska_MonBlog');
                }
                $_SESSION = $userdata;
                $_SESSION['authenticated']= true;
                $_SESSION['token_encrypted']= \uniqid();
                $_SESSION['token']= Check::mixMdp($_SESSION['token_encrypted']);
                $_SESSION['name'] = $user->getUsername();
                //redirection vers le tableau de board
                header('Location:'.\BASEPATH.'Back/Dashboard');
                exit();
            }
        } else {
            Alert::getError($errorMsg = " Erreur, Mauvais couple d'identifiant!");
        }
    }
    public function Read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_users WHERE id_user = :id LIMIT 1");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        return $users = $request->fetch();
        $request->closeCursor();
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
        $username = $email = $password =  $role = $create_at = $modif_at="";
        $username = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        if (!\filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Alert::getError($errorMsg="Le format de l'adresse email est incorrecte.");
        }
        $password = Check::mixMdp(\htmlspecialchars($_POST['password']));
        $role = \htmlspecialchars($_POST['role']);
        $create_at = date(DATE_W3C);
        $modif_at = date(DATE_W3C);
        $request = $this->_pdo->query("SELECT* FROM T_users WHERE username = '$username' OR email='$email'");
        $userExist = $request->rowCount();
        if ($userExist == 1) {
            Alert::getError($errorMsg = "Nom d'utilisateur ou email deja utilisé");
        } else {
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_users (username, email, password, role, create_at) VALUES (:username, :email, :password, :role, NOW(),NOW())');
                $request->bindValue(':username', $username, \PDO::PARAM_STR) ;
                $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
                $request->bindValue(':password', $password, \PDO::PARAM_STR);
                $request->bindValue(':role', $role, \PDO::PARAM_STR);
                $users = $request->execute();
                $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
                $verifIsOk = $users;
                if (!$verifIsOk) {
                    return false;
                } else {
                    $request->closeCursor();
                    return $users;
                }
            } catch (PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    // Mise a jour utilisateurs
    public function Update($id)
    { // Define variable in use
        $username = $email = $password = $role = $modif_at = "";
        $username = \htmlspecialchars($_POST['username']);
        $email= \htmlspecialchars($_POST['email']);
        $role = \htmlspecialchars($_POST['role']);
        $modif_at = date(DATE_W3C);
        try {
            $request = $this->_pdo->prepare('UPDATE T_users SET username=:username,email=:email,role=:role, modif_at=NOW() WHERE id_user=:id');
            $request->bindValue(':id', (int)$id, \PDO::PARAM_INT);
            $request->bindValue(':username', $username, \PDO::PARAM_STR) ;
            $request->bindValue(':email', $email, \PDO::PARAM_STR) ;
            $request->bindValue(':role', $role, \PDO::PARAM_STR);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        } catch (PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    // Effacer un Billet
    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_users WHERE id_user = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        return true;
    }
}
