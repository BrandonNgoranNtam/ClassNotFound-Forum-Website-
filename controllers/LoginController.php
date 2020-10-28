<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 13:53
 */

class LoginController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }


    public function run()
    {

        $_SESSION['admin'] = false;
        $admin=false;
        $message = '';
        $check = '';
        if (isset($_POST['form-login'])) {
            //A user wants to log in
            if (!empty($_POST['inputEmail'] && !empty($_POST['inputPassword']))) {
                $email = $_POST['inputEmail'];
                $password = $_POST['inputPassword'];

                //Checks to see if this user exists in the system
                if ($this->_db->getUser($email) != false) {
                    $passwordToBeChecked = $this->_db->getUser($email)->getPassword();
                    if (password_verify($password, $passwordToBeChecked)) {

                        //Checks the state of the account
                        if ($this->_db->getAccountState($email) == false) {
                            $message = 'This account has been suspended !';
                        } else {
                            $user = $this->_db->getUser($email);

                            //Is the member an admin?
                            if ($this->_db->isAdmin($email) == true) {
                                $_SESSION['admin'] = true;
                                $admin=$_SESSION['admin'];

                            }
                            // Log in successful
                            $_SESSION['authentification'] = 'ok';
                            $_SESSION['login'] = $user->getFirstName();
                            $logged = $_SESSION['login'];
                            $_SESSION['user']= serialize($user);
                            header("Location: index.php?action=homepage");
                            die();

                        }
                    } else {
                        $message = 'The password you\'ve entered is incorrect';
                    }

                } else {
                    $message = 'This email you entered doesn\'t match any account.';
                }
            }

        }

            #The view
            require_once(VIEWS_PATH . 'login.php');

    }
}

