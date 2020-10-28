<?php
/**
 * Created by PhpStorm.
 * User: souli
 * Date: 19-03-19
 * Time: 14:05
 */

class User
{
    private $_userId;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_password;
    private $_isAdmin;
    private $_state;
    private $_image;


    public function __construct($userId,$firstName, $lastName, $email, $password, $isAdmin, $state, $image)
    {
        $this->_userId= $userId;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_password = $password;
        $this->_isAdmin = $isAdmin;
        $this->_state = $state;
        $this->_image=$image;

    }

    public function getUserId(){
        return $this->_userId;
    }
    public function getFirstName()
    {
        return htmlspecialchars($this->_firstName);
    }

    public function getLastName()
    {
        return htmlspecialchars($this->_lastName);
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getisAdmin()
    {
        return $this->_isAdmin;
    }

    public function getState()
    {
        return $this->_state;
    }
    public function setState($newState){
        $this->_state = $newState;
    }
    public function setAdmin($change){
        $this->_isAdmin = $change;
    }
    public function getImage(){
        return $this->_image;
    }






}