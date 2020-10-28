<section role="main" class="container">
    <!--This is the searchbar-->
    <form action=index.php?action=home method="post">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow red">
            <input class="form-control mr-sm-2" type="text" name="searchbar" placeholder="Search" aria-label="Search">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
        </div>
    </form>
    <!--This is the Category Filter -->
    <form class="form-inline my-2 my-lg-0" action=index.php?action=home method="post">
        <div class="input-group">
            <select class="custom-select" name="Category">
                <?php for ($i = 0; $i < count($arrayCategories); $i++) { ?>
                    <option value="<?php echo $i + 1 ?>"> <?php echo $arrayCategories[$i]->getName() ?></option>
                <?php } ?>
            </select>
            <div class="input-group-append">
                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="filterQuestions" value="Filter">
            </div>
        </div>
    </form>
    <!--The list of every question sorted by the most recent time -->
    <form action=index.php?action=home method="post">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Recent questions</h6>
            <?php if (!empty($tableQuestion)) { ?>
                <?php foreach ($tableQuestion as $i => $question) { ?>
                    <div class="media text-muted pt-3">
                        <a alt="" class="mr-2 rounded"></a>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray mr-2 rounded">
                            <strong class="d-block text-gray-dark"><a id="question" href="index.php?action=question&questionId=<?php echo $question->getQuestionId() ?>"><?php echo $question->getTitle() ?></a></strong>
                            <a id="subject" class="subject"><?php echo $question->getSubject() ?></a>
                            <br>
                            State : <?php if ($question->getState() == "Open") { ?>
                                <span id="open"><?php echo $question->getState() ?></span>
                            <?php } else if ($question->getState() == "Solved") { ?>
                                <span id="solved"><?php echo $question->getState() ?></span>
                            <?php } else { ?>
                                <span id="duplicate"><?php echo $question->getState() ?></span>
                            <?php } ?>
                            <br>
                            Posted on <?php echo $question->getCreationDate() ?> by <?php echo $question->getUserFirstName() ?>
                            <br>
                        </p>

                        <!--Duplicate and delete button that is only seen by admins-->
                        <?php if (isset($logged)&& $admin==true) { ?>
                        <button <?php if ($question->getState() == "Duplicate") {?> class="btn btn-outline-success btn-rounded waves-effect" type="submit" name="duplicate" value="<?php echo $question->getQuestionId() ?>"> <?php }else{?>
                            <button class="btn btn-outline-danger btn-rounded waves-effect" type="submit" name="duplicate" value="<?php echo $question->getQuestionId() ?>"><?php }?>   <?php if ($question->getState() == "Open"||$question->getState() == "Solved") {?> Set as Duplicate<?php }else{?>Undo Duplicate<?php }?></button>
                            <button type="submit" name="deleteQuestion" value="<?php echo $tableQuestion[$i]->getQuestionId()?>">
                                <img src="views/images/627249-delete3-512.png" alt="Suspension button" width="20px">
                            </button>

                        <?php }?>
                    </div>
                <?php }
            } ?>

        </div>
    </form>


</section>