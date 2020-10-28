<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 13:53
 */

class LogoutController
{

    public function __construct(){

    }


    public function run(){
        //Self-explanatory logging out
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        die();

    }
}