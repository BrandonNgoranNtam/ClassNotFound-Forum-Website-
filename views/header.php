<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>ClassNotFound</title>
    <meta charset="utf-8">
    <meta name="description" content="Brandon And Soulaimane's PHP Project">
    <meta name="keywords" content="PHP, ClassNotFound, Computer Science, Project">
    <meta name="author" content="Brandon Ngoran Ntam And Soulaimane Benaicha">
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo VIEWS_PATH ?>/css/Style.css">
</head>
<body>

<header>
    <!--This is our navigation bar-->
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">

              <a  class=" navbar-brand" href="index.php?action=home" ><img src="views\images\Home.png" height="40" width="120" ></a>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto ">

                <!--Home button-->
                <li class="nav-item <?php if ($header == 'home') {
                    echo "active";
                } ?>">
                    <a class="nav-link" href="index.php?action=home">Home <span class="sr-only">(current)</span></a>
                </li>

                <!--Ask A Question button-->
                <li class="nav-item <?php if ($header == "ask") echo "active"; ?>">
                    <a class="nav-link" href="index.php?action=ask">Ask A Question</a>
                </li>

                <!--If you aren't logged, this is the Log In button. If logged, this is the Log Out button-->
                <li class="nav-item <?php if ($header == "login") echo "active"; ?>">
                    <?php if (empty($login_session)) { ?>
                        <a class="nav-link" href="index.php?action=login">Log In</a>
                    <?php } else { ?>
                        <a class="nav-link" href="index.php?action=logout">Log Out</a>
                    <?php } ?>
                </li>

                <!--If you aren't logged, this is the Register button. If logged, this is the My Questions button-->
                <li class="nav-item <?php if ($header == "register" || $header == "member") echo "active"; ?>">
                    <?php if (empty($login_session)) { ?>
                        <a class="nav-link" href="index.php?action=register">Register</a>
                    <?php } else { ?>
                        <a class="nav-link" href="index.php?action=member">My Questions</a>
                    <?php } ?>
                </li>

                <!--The Administration button is only visible if the user is an admin -->
                <li class="nav-item <?php if ($header == "admin") echo "active"; ?>">
                    <?php if (!empty($login_session) && !empty($admin)){ ?>
                        <a class="nav-link" href="index.php?action=admin">Administration</a>
                    <?php } ?>
                </li>

            </ul>

            <!--Friendly Greeting-->
            <div id="Welcome">
                <?php if (!empty($login_session)) { ?>
                    <p>Welcome <?php echo $login_session; ?></p>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>
