<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 01/04/2019
 * Time: 11:02
 */

class AskAQuestionController
{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run()
    {

        $arrayCategories = array();
        $arrayCategories = $this->_db->select_all_categories();
        $notification = "";
        $title = "";
        $subject = "";


        if (!empty($_POST['form-Askquestion']) && !empty($_SESSION['user'])) {
            // A member wants to ask a question
            if (!empty($_POST['title']) && !empty($_POST['subject']) && !empty($_POST['category'])) {
                $title = $_POST['title'];
                $subject = $_POST['subject'];
                $category_id = $_POST['category'];
                if (!empty($_POST['update'])) {
                    // A member wants to modify a previously asked question
                    $this->_db->update_question($category_id, $title, $subject, $_POST['update']);
                } else {
                    // The member asks a new question
                    $this->_db->addQuestion(unserialize($_SESSION['user'])->getUserId(), $category_id, $title, $subject, date('Y-m-d H:i:s'));
                    header('Location: index.php?action=home');
                    die();
                }
            }else{
                $notification='Please fill in all the fields ';
            }
        }

        if (!empty($_POST['form-Askquestion']) && empty($_SESSION['user'])) {
            //The user isn't logged in
            $notification = "You are not logged in";
        }
        if (!empty($_GET['questionId'])) {
            $question = $this->_db->get_question($_GET['questionId']);
            if(!empty($question)){
                if (unserialize($_SESSION['user'])->getFirstName() == $question->getUserFirstName()) {
                    $title = $question->getTitle();
                    $subject = $question->getSubject();
                    $update = true;
                } else {
                    $_GET['questionId'] = "";
                }
            }
        }





        require_once (VIEWS_PATH.'askAQuestion.php');
    }
}