<form class="form-signin" method="post">
    <div class="text-center container col-4 sign">
        <div id="message"><?php echo $message ?></div>
        <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
        <!--Login -->
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Email" required autofocus><br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
        <br><br>
        <input class="btn btn-lg btn-primary btn-block" name="form-login" type="submit" value="Log In"><br>
        <div class="checkbox mb-3">
            <label>
                <a>If you don't have a account register</a>
                <a href="index.php?action=register"> here</a>
            </label>
        </div>
    </div>
</form>