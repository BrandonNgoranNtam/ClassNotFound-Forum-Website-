<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 13:57
 */

class QuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }


    public function run()
    {
        $notification = "";

        if (!empty($_SESSION['user']) && !empty($_GET['questionId'])) {//If it is connected
            $user=unserialize($_SESSION['user']);
            $logged=$_SESSION['login'];
            //If the question is resolved or opened $state will be a true otherwise if it is duplicate $state will be a false
            $state = $this->_db->getQuestionState($_GET['questionId']);

            if (isset($_POST['submit'])) {//If the reply form is completed
                if (!$state) {//$state is a false so the question is a duplicate
                    $notification = "This question has been set as a duplicate by an adminitrator. No action upon this question can be done.";
                } else {
                    if (!empty($_POST['subject'])) {//If the form has been sent and there is a content
                        $subject = $_POST['subject'];
                        date_default_timezone_set('Europe/London');
                        $this->_db->addAnswer(unserialize($_SESSION['user'])->getUserId(), $_GET['questionId'], $subject, date('Y-m-j h:i:s'));
                    } else {
                        $notification = "Please give an answer !";
                    }
                }
            }

            if (isset($_GET['like'])) { //If we want to add a like
                if (!$state) {//Check the status of the question if it is duplicate
                    $notification = "This question has been set as a duplicate by an adminitrator. No action upon this question can be done.";
                } else {
                    $answer_Id = $_GET['like'];
                    if ($this->_db->has_a_vote(unserialize($_SESSION['user'])->getUserId(), $answer_Id)) {
                        $this->_db->add_vote(unserialize($_SESSION['user'])->getUserId(), $answer_Id, '1');
                    } else {
                        $notification = 'You have already voted';
                    }
                }
            }

            if (isset($_GET['dislike'])) { //If we want to add a dislike
                if (!$state) {//Check the status of the question if it is duplicate
                    $notification = "This question has been set as a duplicate by an adminitrator. No action upon this question can be done.";
                } else {
                    $answer_Id = $_GET['dislike'];
                    if ($this->_db->has_a_vote(unserialize($_SESSION['user'])->getUserId(), $answer_Id)) {
                        $this->_db->add_vote(unserialize($_SESSION['user'])->getUserId(), $answer_Id, '0');
                    } else {
                        $notification = 'You have already voted';
                    }
                }
            }
        }else if (!empty($_GET['like']) || !empty($_GET['dislike'])) {//If it is not connected
            $notification = 'Please log in first !';

        }

        if(!empty($_GET['questionId'])) {//verification that questionId is present
            if (isset($_GET['rightAnswer']) ) {//If we want to solve a question

                $answer_Id = $_GET['rightAnswer'];
                $question_id = $_GET['questionId'];

                if ($this->_db->set_resolved_question($question_id, unserialize($_SESSION['user'])->getUserId())) {
                    $this->_db->set_right_answer($answer_Id);
                }

            }



                $question = $this->_db->get_question($_GET['questionId']);


            if ($this->_db->IsQuestionOpen($_GET['questionId'])) {
                $table_answers = array();
                $table_answers = $this->_db->select_answers($_GET['questionId']);
                $table_vote = array();
                foreach ($table_answers as $i => $answer) {
                    if ($answer->getRightAnswer() == 1) {
                        $this->_db->undoRightAnswer($answer->getAnswerId());
                    }
                }
            }
            $table_answers = array();
            $table_answers = $this->_db->select_answers($_GET['questionId']);
            $table_vote_positif = array();
            $table_vote_negatif = array();

            foreach ($table_answers as $i => $answer) {
                $table_vote_positif[] = $this->_db->number_vote($answer->getAnswerId(), 1);
                $table_vote_negatif[] = $this->_db->number_vote($answer->getAnswerId(), 0);
            }
        }
        require_once(VIEWS_PATH . 'question.php');
    }
}