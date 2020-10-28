<?php



class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {

        try {
            $array= parse_ini_file('config/config.ini');
            $this->_db = new PDO($array['db_name'],$array['db_user'],$array['db_password']);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }


    public static function getInstancce()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }




///////////////////////////////////////////////////////////////////HOMEPAGE//////////////////////////////////////////////////////////////////////////////////////////

    //This is used for the scrolling menu containing the categories in the homepage
    public function select_all_categories()
    {
        $query = 'SELECT category_id, category_name FROM categories';
        $array = array();
        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowCount() != 0) {

            while ($row = $ps->fetch()) {
                $array[] = new Category($row->category_id, $row->category_name);
            }
        }
        return $array;
    }

    //Returns an array of questions based on what you searched
    public function searchQuestion($search)
    {
        $query = 'SELECT q.*,u.first_name,u.last_name,c.category_name FROM questions q, users u, categories c WHERE q.user_id = u.user_id AND q.category_id = c.category_id AND ((lower(title))OR (lower(subject)) LIKE :search) ORDER BY q.creation_date DESC';
        $array = array();
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":search", '%' . $search . '%');
        $ps->execute();
        if ($ps->rowCount() != 0) {
            while ($row = $ps->fetch()) {
                $array[] = new Question($row->question_id,$row->first_name, $row->category_name, $row->title, $row->subject, $row->creation_date, $row->state);
            }
        }
        return $array;
    }

    //Filter questions based on the selected category
    public function filterCategory($category)
    {
        $query = 'SELECT q.*,u.first_name,u.last_name,c.category_name FROM questions q, users u, categories c WHERE q.user_id = u.user_id AND q.category_id = c.category_id AND c.category_id = :category ';
        $array = array();
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":category", $category);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            while ($row = $ps->fetch()) {
                $array[] = new Question($row->question_id, $row->first_name, $row->category_name, $row->title, $row->subject, $row->creation_date, $row->state);
            }
        }
        return $array;
    }

    //This is used to show every ever asked on the homepage
    public function select_questions()
    {
        $table = array();
        $query = 'SELECT q.question_id,q.user_id,q.category_id,q.title,q.subject,q.creation_date,q.state,c.category_name,u.first_name,u.last_name FROM questions q,users u,categories c WHERE (q.user_id = u.user_id)AND(q.category_id = c.category_id) ORDER BY q.creation_date DESC ';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowCount() != 0) ;
        while ($row = $ps->fetch()) {
            $table[] = new Question($row->question_id, $row->first_name, $row->category_name, $row->title, $row->subject, $row->creation_date, $row->state);
        }
        return $table;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //////////////////////////////////////////////////////////////////// A QUESTION///////////////////////////////////////////////////////////////////


    //Adds a vote to a question
    public function add_vote($user_id, $answer_id,$state){
        $query = 'INSERT INTO `votes` (`vote_id`, `user_id`, `answer_id`, `state`) VALUES (NULL,'. $this->_db->quote($user_id) .','.$this->_db->quote($answer_id).','. $this->_db->quote($state).')';
        try{
            $this->_db->prepare($query)->execute();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    //Returns the addition of all negative or positive votes of a answer
    public function number_vote($answer_id,$state)
    {
        $query = 'SELECT COUNT(*) result FROM votes WHERE state='. $this->_db->quote($state) . 'AND answer_id= '.$this->_db->quote($answer_id);
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $var = $ps->fetch();
        return $var->result ;
    }
    //Returns a boolean to find out if the person has already voted for an answer
    public function has_a_vote($user_id, $answer_id){
        $query = 'SELECT * FROM votes WHERE user_id = '. $this->_db->quote($user_id) .' AND answer_id= '.$this->_db->quote($answer_id);
        $ps = $this->_db->prepare($query);
        $ps->execute();
        return $ps->rowCount() == 0;
    }

    //Return a table containing every answers to a particular question
    public function select_answers($question_id)
    {
        $table = array();
        $query = 'SELECT a.answer_id,a.user_id,a.subject,a.creation_date,a.right_answer,u.first_name,u.last_name FROM answers a, users u WHERE a.user_id = u.user_id AND question_id= ' . $this->_db->quote($question_id).' ORDER BY right_answer DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowCount() != 0) ;
        while ($row = $ps->fetch()) {
            $table[] = new Answer($row->answer_id, $row->first_name, $row->last_name, $row->subject, $row->creation_date, $row->right_answer);
        }
        return $table;
    }
    //This method adds an answer
    public function addAnswer($user_id, $question_id, $subject, $creation_date)
    {
        $query = 'INSERT INTO answers (`user_id`, `question_id`, `subject`, `creation_date`, `right_answer`) VALUE(:userId, :questionId, :subject, :creationDate,:rightAnswer)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":userId", $user_id);
        $ps->bindValue(":questionId", $question_id);
        $ps->bindValue(":subject", $subject);
        $ps->bindValue(":creationDate", $creation_date);
        $ps->bindValue(":rightAnswer", 0);
        return $ps->execute();
    }

    //This is used to see every registered member of the website
    public function select_members()
    {
        $array = array();
        $query = 'SELECT * FROM users';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            while ($row = $ps->fetch()) {
                $array[] = new User($row->user_id, $row->first_name, $row->last_name, $row->email, $row->password, $row->admin, $row->state, $row->image);
            }
        }
        return $array;
    }

    //Returns a question based on the ID
    public function get_question($question_id)
    {
        $query = 'SELECT q.question_id,q.user_id,q.category_id,q.title,q.subject,q.creation_date,q.state,c.category_name,u.first_name,u.last_name FROM questions q,users u,categories c WHERE (q.user_id = u.user_id)AND(q.category_id = c.category_id)AND question_id= ' . $this->_db->quote($question_id);

        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            $row = $ps->fetch();
            $question = new Question($row->question_id, $row->first_name, $row->category_name, $row->title, $row->subject, $row->creation_date, $row->state);
            return $question;
        }
        return 0;
    }
    //Select all the questions of a user
    public function select_my_question($user_id)
    {
        $table = array();
        $query = 'SELECT q.question_id,q.user_id,q.category_id,q.title,q.subject,q.creation_date,q.state,c.category_name,u.first_name,u.last_name FROM questions q,users u,categories c WHERE (q.user_id = u.user_id)AND(q.category_id = c.category_id) AND q.user_id=:user_id ORDER BY q.creation_date DESC ' ;
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':user_id',$user_id);
        $ps->execute();
        if ($ps->rowCount() != 0) ;
        while ($row = $ps->fetch()) {
            $table[] = new Question($row->question_id, $row->first_name, $row->category_name, $row->title, $row->subject, $row->creation_date, $row->state);
        }
        return $table;
    }

    //Used to update your own question
    public function update_question($category, $title, $subject, $question_id)
    {
        $query = 'UPDATE `questions` SET category_id =' . $this->_db->quote($category) . ',`title` =' . $this->_db->quote($title) . ' , `subject` =' . $this->_db->quote($subject) . ' WHERE `questions`.`question_id` = ' . $this->_db->quote($question_id);
        $this->_db->prepare($query)->execute();
    }


    //Used by an admin to delete a question
    public function delete_question($question_id){
        $query2 = 'DELETE FROM questions WHERE question_id = :questionID';
        $ps2 = $this->_db->prepare($query2);
        $ps2->bindValue(':questionID', $question_id);
        $ps2->execute();




    }




    /////////////////////////////////////////////////////////////////////// LOGIN AND REGISTER SECTION////////////////////////////////////////////////////////////////////////////
    public function add_newUser($newFirstName, $newLastName, $newEmail, $newPassword, $isAdmin, $state)
    {
        $query = 'INSERT INTO users (first_name,last_name,email,password,admin,state)VALUES(:firstName,:lastName,:email,:password,:isAdmin,:state)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":firstName", $newFirstName);
        $ps->bindValue(":lastName", $newLastName);
        $ps->bindValue(":email", $newEmail);
        $ps->bindValue(":password", $newPassword);
        $ps->bindValue(":isAdmin", $isAdmin);
        $ps->bindValue(":state", $state);
        return $ps->execute();

    }


    //Return True if an email hasn't been used yet
    public function isEmailValid($email)
    {
        $query = 'SELECT * FROM users WHERE email = :iEmail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        $ps->execute();
        $row = $ps->fetch();
        if ($ps->rowCount() != 0) {
            return false;
        }
        return true;
    }

    //Returns a User object based on the credentials. If the user doesn't exist, return false
    public function log_in_User($email, $password)
    {
        $query = 'SELECT * FROM users WHERE email = :iEmail AND password = :iPassword LIMIT 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        $ps->bindValue(":iPassword", $password);
        $ps->execute();
        $row = $ps->fetch();
        if ($ps->rowCount() != 0) {
            return new User($row->user_id, $row->first_name, $row->last_name, $row->email, $row->password, $row->admin, $row->state, $row->image);
        } else {
            return false;
        }

    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
////////////////////////////////////////////////////////////////////ADD A QUESTION//////////////////////////////////////////////////////////////////////////////////



    public function addQuestion($user_id, $category_id, $title, $subject, $creaton_date)
    {
        $query = 'INSERT INTO questions(`user_id`,`category_id`,`title`,`subject`,`creation_date`,`state`) VALUE (:userId, :categoryId, :title, :subject,:creationDate, :state)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":userId", $user_id);
        $ps->bindValue(":categoryId", $category_id);
        $ps->bindValue(":title", $title);
        $ps->bindValue(":subject", $subject);
        $ps->bindValue(":creationDate", $creaton_date);
        $ps->bindValue(":state", 'Open');
        $ps->execute();
    }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////ADMIN//////////////////////////////////////////////////////////////////////////
    public function searchMember($search)
    {
        $query = 'SELECT * FROM  users u WHERE (lower(first_name) LIKE :search) OR ((lower(last_name))LIKE :search) ';
        $array = array();
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":search", '%' . $search . '%');
        $ps->execute();
        if ($ps->rowCount() != 0) {
            while ($row = $ps->fetch()) {
                $array[] = new User($row->user_id, $row->first_name, $row->last_name, $row->email, $row->password, $row->admin, $row->state, $row->image);
            }
        }
        return $array;
    }

    public function setAdmin($email)
    {
        $query = 'UPDATE users SET admin = "1" WHERE email = :iEmail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        return $ps->execute();
    }

    public function undoAdmin($email)
    {
        $query = 'UPDATE users SET admin = "0" WHERE email = :iEmail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        return $ps->execute();
    }

    //Returns true if an account is Active
    public function getAccountState($email)
    {
        $query = 'SELECT * FROM users WHERE email = :iEmail AND state = "Active" limit 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }


    public function activateAccount($email)
    {
        $query = 'UPDATE users SET state = "Active" WHERE email = :iEmail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        return $ps->execute();
    }


    public function suspendAccount($email)
    {
        $query = 'UPDATE users SET state = "Suspended" WHERE email = :iEmail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        return $ps->execute();
    }


    public function setDuplicate($questionID)
    {
        $query = 'UPDATE questions SET state = "Duplicate" WHERE question_id = :questionID';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":questionID", $questionID);
        return $ps->execute();
    }

    public function undoDuplicate($questionID)
    {
        $query = 'UPDATE questions SET state = "Open" WHERE question_id = :questionID';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":questionID", $questionID);
        return $ps->execute();
    }

    //Returns true if a question is Open
    public function IsQuestionOpen($questionID){
        $query = 'SELECT * FROM questions WHERE question_id = :questionID and state = "Open"';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":questionID", $questionID);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            return true;
        } else {
            return false;
        }

    }


    public function undoRightAnswer($answerID){
        $query = 'Update answers set right_answer = 0 WHERE answer_id = :answerID';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":answerID",$answerID);
        return $ps->execute();
    }

    //Returns true if a question is Open or Solved
    public function getQuestionState($questionID)
    {
        $query = 'SELECT * FROM questions WHERE question_id = :questionID AND (state = "Open" OR state = "Solved")';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":questionID", $questionID);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }



    public function isAdmin($email)
    {
        $query = 'SELECT * FROM users WHERE email = :iEmail AND admin = 1 limit 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        $ps->execute();
        if ($ps->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }


    //Creates a user based on an existing email
    public function getUser($email)
    {
        $query = 'SELECT * FROM users WHERE email = :iEmail limit 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(":iEmail", $email);
        $ps->execute();
        $row = $ps->fetch();
        if ($ps->rowCount() != 0) {
            return new User($row->user_id, $row->first_name, $row->last_name, $row->email, $row->password, $row->admin, $row->state, $row->image);
        } else {
            return false;
        }
    }


    public function has_a_answer($user_id, $question_id,$answer_id){
        $query = 'SELECT answer_id FROM `answers` WHERE answer_id= '.$this->_db->quote($answer_id).' AND user_id= '.$this->_db->quote($user_id).' AND question_id= '.$this->_db->quote($question_id);
        $ps = $this->_db->prepare($query);
        try{
            $ps->execute();
            return $ps->rowCount() == 1;
        }catch (Exception $e){
            return false;
        }

    }




    //This method passes an answer as the correct answer that solved the question
    //If the action is not possible (the answer does not exist or other...) this method returns false otherwise it returns true
    public function set_right_answer($answer_id){
        $query = 'UPDATE `answers` SET `right_answer` = 1 WHERE `answer_id` = '.$this->_db->quote($answer_id);
        $ps = $this->_db->prepare($query);
        try{
            $ps->execute();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    //This method passes a question to resolved
    //If the action is not possible (the question does not exist or other...) this method returns false otherwise it returns true
    public function set_resolved_question($question_id, $user_id){
        $query = 'UPDATE `questions` SET `state` = "Solved" WHERE `question_id` = '.$this->_db->quote($question_id) . ' AND user_id= '. $this->_db->quote($user_id);
        $ps = $this->_db->prepare($query);
        try{
            $ps->execute();
            return true;
        }catch (Exception $e){
            return false;
        }

    }



}
