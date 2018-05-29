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
    public function runQuery($sql)
    {
        $request = $this->_pdo->prepare($sql);
        return $request;
    }

    public function lasdID()
    {
        $request = $this->_pdo->lastInsertId();
        return $request;
    }

    public function register($uname, $email, $upass, $code)
    {
        try {
            $password = md5($upass);
            $request = $this->_pdo->prepare("INSERT INTO T_users(userName,userEmail,userPass,tokenCode)
            VALUES(:user_name, :user_mail, :user_pass, :active_code)");
            $request->bindparam(":user_name", $uname);
            $request->bindparam(":user_mail", $email);
            $request->bindparam(":user_pass", $password);
            $request->bindparam(":active_code", $code);
            $request->execute();
            return $request;
        } catch (\PDOException $e) {
            throw new \Exception(Error::getErroR($e->getMessage()), 1);
        }
    }

    public function login($email, $upass)
    {
        try {
            $request = $this->_pdo->prepare("SELECT * FROM T_users WHERE userEmail=:email_id");
            $request->execute(array(":email_id"=>$email));
            $userRow=$request->fetch(\PDO::FETCH_ASSOC);
            if ($request->rowCount() == 1) {
                if ($userRow['userStatus']=="Y") {
                    if ($userRow['userPass']==md5($upass)) {
                        $_SESSION['userSession'] = $userRow['userID'];
                        return true;
                    } else {
                        throw new \Exception(Error::getErroR("Mauvais couple d'indentifiants"), 1);
                        exit;
                    }
                } else {
                    throw new \Exception(Error::getErroR("Ce compte n'est pas activé, Accédez à votre boîte de réception d'email et activez-le"), 1);
                    exit;
                }
            } else {
                throw new \Exception(Error::getErroR("Mauvais couple d'indentifiants"), 1);
                exit;
            }
        } catch (\PDOException $e) {
            throw new \Exception(Error::getError($e->getMessage()), 1);
        }
    }


    public function is_logged_in()
    {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        $_SESSION['userSession'] = false;
    }

    public function send_mail($email, $message, $subject)
    {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username="your_gmail_id_here@gmail.com";
        $mail->Password="your_gmail_password_here";
        $mail->SetFrom('your_gmail_id_here@gmail.com', 'Coding Cage');
        $mail->AddReplyTo("your_gmail_id_here@gmail.com", "Coding Cage");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
