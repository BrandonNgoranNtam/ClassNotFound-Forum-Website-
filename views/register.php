<form class="form-signin" action="index.php?action=register" method="POST">
    <div class="text-center container col-4 sign">
        <img class="mb-4" src="" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Welcome to ClassNotFound</h1>
        <div id="message"><?php echo $message ?></div>
        <input type="text" name="newFirstName" class="form-control" placeholder="First Name" required autofocus><br>
        <input type="text" name="newLastName" class="form-control" placeholder="Last Name" required autofocus><br>
        <input type="email" name="newEmail" class="form-control" placeholder="Email" required autofocus><br>
        <input type="password" name="newPassword" class="form-control" placeholder="Password" required>
        <br><br>
        <input class="btn btn-lg btn-primary btn-block" name="form-register" type="submit" value="Register"><br>
        <div class="checkbox mb-3">
            <label>
                <a>If you already have a account, log in here</a>
                <a href="index.php?action=login"> here</a>
            </label>
        </div>
    </div>
</form>