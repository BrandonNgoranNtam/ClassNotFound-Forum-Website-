<section>

    <br>
    <br>
   <div class="jumbotron">
        <div class="container">
            <h1 class="display-5"><?php if(!empty($question)){ echo $question->getTitle() ?></h1><br>
            <p><?php echo $question->getSubject() ?>
            <br>
            <div class="alert alert-<?php if($question->getState() == "Open") {echo "warning";}elseif($question->getState()=="Solved"){echo "success";}else{echo "danger";} ?>" role="alert">
                <p>State : <?php echo $question->getState()?> </p>
            </div>
        </div>
    </div>


    <div class="container">
        <?php if(!empty($notification)){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $notification ?><a class="alert-link"></a>
            </div>
        <?php } ?>
        <div class="row">
            <?php if(!empty($table_answers)){ ?>
                <form action="index.php" class="container row" type="GET">
                <?php foreach ($table_answers as $i => $answer) { ?>
                    <?php if($answer->getRightAnswer()) echo "<div class=\"alert alert alert-success col-md-12\" role=\"alert\">" ?>
                    <div class="col-md-8 space">
                        <?php  if($table_answers[$i]->getRightAnswer()==true){?>
                        <h2>The Right Answer</h2>
                        <?php }else{?>
                        <h2>Answer n°<?php  if($table_answers[0]->getRightAnswer()==false) echo $i+1; else echo $i ?></h2>
                        <?php }?>
                        <p><?php echo $answer->getSubject() ?></p>
                        <p id="postedBy">Posted by <?php echo $answer->getUserFirstName()?> <?php echo $answer->getUserLastName()?> <!--on <?php echo $answer->getCreationDate()?>--></p>
                        <hr>
                    </div>
                     <h6 class="like"><span class="badge badge-primary like"><a href="index.php?action=question&questionId=<?php echo $question->getQuestionId()?>&like=<?php echo $answer->getAnswerId() ?>"><img src="views/images/like.jpg" title="like" alt="like" height="25" width="32" ></a>&nbsp&nbsp&nbsp<?php echo $table_vote_positif[$i] ?></span></h6>
                    &nbsp
                    <h6 class="dislike"><span class="badge badge-danger dislike"> <?php echo $table_vote_negatif[$i] ?>&nbsp&nbsp&nbsp<a href="index.php?action=question&questionId=<?php echo $question->getQuestionId()?>&dislike=<?php echo $answer->getAnswerId() ?>"><img src="views/images/dislike.jpg" title="dislike" alt="dislike" height="25" width="32" ></a></span></h6>



                    <?php if($answer->getRightAnswer())  echo "</div>"; ?>
                    <?php if($question->getState() == "Open"&& !empty($user) && $question->getUserFirstName() == $user->getFirstName()){ ?>
                        <button type="submit" value="<?php echo $answer->getAnswerId() ?>" name="rightAnswer" class="btn btn-outline-info button">Right Answer</button>
                <?php } }  ?>
                    <input type="hidden" name="questionId" value="<?php echo $question->getQuestionId()?>">
                    <input type="hidden" name="action" value="question">
                </form>
            <?php }else{ ?>
            <div class="col-md-8 space">
                <h2>This question doesn't have answers yet</h2>
            </div>
            <?php }?>



        </div>
        <div>

        <br>
        <br>
        <br>
            <?php if(isset($logged)){ ?>

            <form class="col-md-12" action="index.php?action=question&questionId=<?php echo $question->getQuestionId() ?>" method="POST">
            <label for="exampleFormControlTextarea1">Your answer </label>
            <textarea name="subject" class="form-control" rows="3"></textarea>
            <br>
                <button type="submit" class="btn btn-primary btn-lg btn-block col-md-4" value="Answer" name="submit">Submit</button>
            </form>
              <?php } } ?>

        </div>
    </div>

</section>