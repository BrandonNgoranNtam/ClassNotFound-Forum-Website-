<section>
    <div class="text-center container  ">
        <h1 class="h3 mb-3 font-weight-normal">Welcome Admin </h1>
        <p>This is a list of every registred member of ClassNotFound. As an administrator, you have a certain control
            over these accounts.</p>
        <p>With great power comes great responsibility</p>
        <p id="message2"><?php echo $adminMessage ?></p>
        <form action=index.php?action=admin method="post">
            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow red">
                <input class="form-control mr-sm-2" type="text" name="UserSearchbar" placeholder="Search for a name"
                       aria-label="Search">
                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
            </div>
        </form>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Administrator</th>
                <th>Account State</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($arrayOfUsers); $i++) { ?>
                <tr>
                    <td><?php echo $arrayOfUsers[$i]->getFirstName() ?></td>
                    <td><?php echo $arrayOfUsers[$i]->getLastName() ?></td>
                    <td><?php echo $arrayOfUsers[$i]->getEmail() ?></td>
                    <td><?php if ($arrayOfUsers[$i]->getIsAdmin() == 1) {
                            echo 'Yes';
                        } else {
                            echo 'No';
                        } ?></td>
                    <td><?php echo $arrayOfUsers[$i]->getState() ?></td>
                    <td>
                        <form action=index.php?action=admin method="post">
                            <button type="submit" name="suspension" value="<?php echo $arrayOfUsers[$i]->getEmail() ?>">
                                <img src="views/images/39-512.png" alt="Suspension button" width="20px">
                            </button>
                            <button type="submit" name="becomeAdmin"
                                    value="<?php echo $arrayOfUsers[$i]->getEmail() ?>">
                                <img src="views/images/admin_add_user_edit_delete-512.png" alt="Admin button"
                                     width="20px">
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>