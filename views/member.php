<div class="text-center container col-4 sign">
    <!--Your Questions -->
    <img class="mb-4" src="" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal"><?php echo $user->getFirstName() ?>  <?php echo $user->getLastName() ?>
        's Questions</h1>
    <br><br>
</div>
<?php if (!empty($tableQuestion)) { ?>
    <?php foreach ($tableQuestion as $i => $question) { ?>
        <div class="list-group col-md-12 container">
            <div class="row sec">
                <a href="index.php?action=question&questionId=<?php echo $question->getQuestionId() ?>"
                   class="list-group-item col-md-8 list-group-item-action list-group-item-<?php if ($question->getState() == 'Open') echo 'warning'; elseif ($question->getState() == 'Solved') echo 'success'; else echo 'danger'; ?>">
                    <p class="title"><?php echo $question->getTitle() ?></p>
                    <p><?php echo $question->getSubject() ?></p>
                    <a href="index.php?action=ask&questionId=<?php echo $question->getQuestionId() ?>">
                        <img src="views/images/Update.jpg" alt="update" height="60" width="75">
                    </a>
                </a>
            </div>
        </div>
        </br>

    <?php }
} else { ?>
    <div class="text-center container col-4 sign">
        <p>You haven't asked any questions yet. Don't be shy !</p>
    </div>
<?php } ?>































