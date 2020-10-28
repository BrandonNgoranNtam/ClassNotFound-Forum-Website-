<?php


class RegisterController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }


    public function run()
    {
        $message = '';
        //A user wants to register
        if (!empty($_POST["form-register"])) {
            if (empty($_POST["newFirstName"] || empty($_POST["newLastName"]) || empty($_POST["newPassword"])) || empty($_POST["newEmail"])) {
                $message = "Please fill in all the fields";
            } else {
                if (preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/', $_POST["newFirstName"])) {
                    if (preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]+$/', $_POST["newLastName"])) {
                        $newFirstName = $_POST["newFirstName"];
                        $newLastName = $_POST["newLastName"];
                        $newEmail = $_POST["newEmail"];
                        $newPassword = $_POST["newPassword"];
                        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
                        $isAdmin = 0;
                        $state = 'Active';
                        if ($this->_db->isEmailValid($newEmail) == true) {
                            //A user must use an email address that hasn't been used yet
                            if ($this->_db->add_newUser($newFirstName, $newLastName, $newEmail, $hash, $isAdmin, $state)) {
                                $user = $this->_db->getUser($newEmail);
                                $_SESSION['authentification'] = 'ok';
                                $_SESSION['login'] = $newFirstName;
                                $_SESSION['admin'] = false;
                                $_SESSION['user'] =  serialize($user);
                                $logged = $_SESSION['login'];
                                header("Location: index.php?action=homepage");
                                die();
                            }

                        } else {
                            $message = 'This email already exists';
                        }
                    } else {
                        $message = 'Use a valid last name';
                    }
                } else {
                    $message = 'Use a valid first name';
                }
            }
        }

        require_once(VIEWS_PATH . 'register.php');
    }

}