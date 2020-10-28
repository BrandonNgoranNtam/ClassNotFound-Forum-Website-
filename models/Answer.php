<?php
/**
 * Created by PhpStorm.
 * User: souli
 * Date: 19-03-19
 * Time: 14:05
 */

class Answer
{
    private $_answer_id;
    private $_userFirstName;
    private $_userLastName;
    private $_subject;
    private $_creation_date;
    private $_right_answer;


    public function __construct($answer_id,$userFirstName,$userLastName,$subject, $creation_date, $right_answer){
        $this->_answer_id=$answer_id;
        $this->_userFirstName = $userFirstName;
        $this->_subject = $subject;
        $this->_creation_date = $creation_date;
        $this->_right_answer = $right_answer;
        $this->_userLastName = $userLastName;
    }
    public function getAnswerId(){
        return $this->_answer_id;
    }
    public function getSubject(){
        return $this->_subject;
    }
    public function getCreationDate(){
        return $this->_creation_date;
    }
    public function getRightAnswer(){
        return $this->_right_answer;
    }
    public function getUserFirstName(){
        return htmlspecialchars($this->_userFirstName);
    }
    public function getUserLastName(){
        return htmlspecialchars($this->_userLastName);
    }


}