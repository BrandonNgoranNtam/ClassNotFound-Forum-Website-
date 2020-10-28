<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 13:52
 */

class AdminController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }


    public function run()
    {
        $arrayOfUsers = array();
        $resultAdmin = null;
        $adminMessage = '';


        //This searchbar is used to search for members in the system
        if (!empty($_POST['UserSearchbar'])) {
            $arrayOfUsers = $this->_db->searchMember($_POST['UserSearchbar']);
        } else {

            if (isset($_POST['suspension'])) {
                //An admin wants to change the state of a user
                $user = $this->_db->getUser($_POST['suspension']);

                //Checks if the user that the admin wants to suspend isn't the admin himself
                if (unserialize($_SESSION['user'])->getEmail() == $_POST['suspension']) {
                    $adminMessage = "You can't take any actions on yourself";
                } else {
                    //The admin and the user are different people

                    //Actual Suspension or Activation of the account
                    if ($this->_db->getAccountState($_POST['suspension']) == true) {
                        // Active becomes Suspended
                        $this->_db->suspendAccount($_POST['suspension']);
                        $adminMessage = $user->getFirstName() . " " . $user->getLastName() . "'s account has been suspended";
                    } else {
                        //Suspended becomes Active
                        $this->_db->activateAccount($_POST['suspension']);
                        $adminMessage = $user->getFirstName() . " " . $user->getLastName() . "'s account is now active";

                    }
                }
            }
            //An admin wants to change admin rights of a user
            if (isset($_POST['becomeAdmin'])) {
                $user = $this->_db->getUser($_POST['becomeAdmin']);

                //Checks if the user that the admin wants to suspend isn't the admin himself
                if (unserialize($_SESSION['user'])->getEmail() == $_POST['becomeAdmin']) {
                    $adminMessage = "You can't take any actions on yourself";
                } else {
                    //The admin and the user are different people

                    // Taking or Giving Administration Rights
                    if ($this->_db->isAdmin($_POST['becomeAdmin']) == false) {
                        //Becomes an admin
                        $this->_db->setAdmin($_POST['becomeAdmin']);
                        $adminMessage = $user->getFirstName() . " " . $user->getLastName() . " is now an administrator";
                    } else {
                        //No longer an admin
                        $this->_db->undoAdmin($_POST['becomeAdmin']);
                        $adminMessage = $user->getFirstName() . " " . $user->getLastName() . " is no longer an administrator";

                    }
                }
            }

            //Displays all the members
            $arrayOfUsers = $this->_db->select_members();
        }

        //Must be an admin to have access this view
        if ($_SESSION["admin"] == false) {
            header('Location: index.php?action=login');
            die();
        } else {

            require_once(VIEWS_PATH . 'admin.php');

        }

    }
}