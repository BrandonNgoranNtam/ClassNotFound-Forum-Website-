<section>
    <form action="index.php?action=ask" class="form-signin" method="post">
        <div class="text-center container col-4 sign">
            <h1 class="display-5">What is your question?</h1>
            <div id="message"><?php echo $notification ?></div>
            <p>Your question falls under which category?</p>
        </div>
        <div class="categoriesAll">
            <?php for ($i = 0; $i < count($arrayCategories); $i++) { ?>
                <div class="categories">
                    <input type="radio" value="<?php echo $arrayCategories[$i]->getCategoryId() ?>" name="category" id="radio<?php echo $i ?>" class="radio" <?php if(!empty($question) && $arrayCategories[$i]->getName()==$question->getCategory()) echo 'checked/>'; else echo '/>'; ?>
                    <label for="radio<?php echo $i ?>"><?php echo $arrayCategories[$i]->getName()?></label>
                </div>
            <?php } ?>

        </div>
        <div class="text-center container col-4">
            <br>
            <br>
            <input type="text" class="form-control" id="exampleInputName2" name="title" value="<?php echo $title ?>" placeholder="Title">
            <br>
            <textarea class="form-control" rows="3" name="subject" placeholder="Subject"><?php echo $subject ?></textarea>
            <br>
            <input class="btn btn-lg btn-primary btn-block" name="form-Askquestion" type="submit" value="Submit">
            <?php if(!empty($update) && !empty($question)){ ?>
                <input type="hidden" value="<?php echo $question->getQuestionId() ?>" name="update">
            <?php } ?>

        </div>
    </form>
</section>