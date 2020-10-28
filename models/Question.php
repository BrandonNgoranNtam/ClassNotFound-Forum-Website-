<?php
/**
 * Created by PhpStorm.
 * User: souli
 * Date: 19-03-19
 * Time: 14:05
 */

class Question
{
    private $_question_id;
    private $_userFirstName;
    private $_category;
    private $_title;
    private $_subject;
    private $_creation_date;
    private $_state;


    public function __construct($question_id, $userFirstName, $category, $title, $subject, $creation_date, $state)
    {
        $this->_question_id = $question_id;
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_creation_date = $creation_date;
        $this->_userFirstName = $userFirstName;
        $this->_state = $state;
        $this->_category = $category;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function getCreationDate()
    {
        return $this->_creation_date;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function getQuestionId()
    {
        return $this->_question_id;
    }

    public function getUserFirstName()
    {
        return htmlspecialchars($this->_userFirstName);
    }

    public function getCategory()
    {
        return $this->_category;
    }


}