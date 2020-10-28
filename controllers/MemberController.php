<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 14:27
 */

class MemberController
{
    private $_db;
    public function __construct($db)
    {
        $this->_db=$db;
    }
    public function run(){
        //You only get access to this view if you are a logged in member
        if (empty($_SESSION['user'])) {
            header('Location: index.php?action=login');
            die();
        }else{
            $user= unserialize($_SESSION['user']);
        }


        $tableQuestion = array();


        //View my questions
        $tableQuestion = $this->_db->select_my_question(unserialize($_SESSION['user'])->getUserId());




        require_once (VIEWS_PATH.'member.php');
    }

}