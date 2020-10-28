<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 19/03/2019
 * Time: 13:54
 */

class HomepageController
{
    private $_db;
    public function __construct($db){
        $this->_db = $db;
    }


    public function run(){

        if(!empty($_SESSION['login'])){
            $logged=$_SESSION['login'];
            $admin=$_SESSION['admin'];
        }

        $tableQuestion = array();
        $arrayCategories = array();
        $notification = '';
        $arrayCategories = $this->_db->select_all_categories();
        if(isset($_POST['duplicate'])){
            //An admin wants to duplicate a question or undo a duplicated question
            $state = $this->_db->getQuestionState($_POST['duplicate']);
            if($state==true){
                //Duplicate
                $this->_db->setDuplicate($_POST['duplicate']);
            }else{
                //Undo duplicate
                $this->_db->undoDuplicate($_POST['duplicate']);
            }
        }
        if(isset($_POST['deleteQuestion'])){
            //Deleting a question
            $this->_db->delete_question($_POST['deleteQuestion'],unserialize($_SESSION['user'])->getUserId());

        }

        if(isset($_POST['filterQuestions'])){
            //Filter with a category
            $selectedCategory = $_POST['Category'];
            $tableQuestion = $this->_db->filterCategory($selectedCategory);
        }elseif (!empty($_POST["searchbar"])){
            // Search via the search bar
            $tableQuestion = $this->_db->searchQuestion($_POST["searchbar"]);
        }else{
            $tableQuestion = $this->_db->select_questions();
        }



        require_once (VIEWS_PATH . 'homepage.php');
    }
}
?>