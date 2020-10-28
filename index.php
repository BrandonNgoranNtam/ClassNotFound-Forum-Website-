<?php
session_start();
# Global variables
define('VIEWS_PATH','views/');
date_default_timezone_set("Europe/Brussels");

#Common header

if (empty($_GET['action'])) {
    $_GET['action'] = 'homepage';
}
if(isset($_SESSION['login'])){
    $login_session = $_SESSION['login'];
}
if(!empty($_SESSION['admin'])){
    $admin = $_SESSION["admin"];
}


switch ($_GET['action']){
    case "ask":
        $header = 'ask';
        break;
    case "login":
        $header = 'login';
        break;
    case "register":
        $header = 'register';
        break;
    case "member":
        $header = 'member';
        break;
    case "admin":
        $header = 'admin';
        break;
    default:
        $header = 'home';
        break;
}
require_once(VIEWS_PATH.'header.php');

# A way to automate the linking of classes
function loadClass($class) {
    require_once('models/' . $class . '.php');
}
spl_autoload_register('loadClass');

#instance of the database to give
require_once ('models/Db.php');
$db = Db::getInstancce();

if (empty($_GET['action'])) {
    $_GET['action'] = 'homepage';
}

switch ($_GET['action']){
    case "admin":
        require_once ('controllers/AdminController.php');
        $controller = new AdminController($db);
        break;
    case "ask":
        require_once ('controllers/AskAQuestionController.php');
        $controller = new AskAQuestionController($db);
        break;
    case "question":
        require_once ('controllers/QuestionController.php');
        $controller = new QuestionController($db);
        break;
    case "member":
        require_once ('controllers/MemberController.php');
        $controller = new MemberController($db);
        break;
    case "register":
        require_once ('controllers/RegisterController.php');
        $controller = new RegisterController($db);
        break;
    case "login":
        require_once ('controllers/LoginController.php');
        $controller = new LoginController($db);
        break;
    case "logout":
        require_once ('controllers/LogoutController.php');
        $controller = new LogoutController();
        break;
    default : #The default controller that sends the default view : homepage.php
        require_once('controllers/HomepageController.php');
        $controller = new HomepageController($db);
        break;
}

$controller->run();

#Common footer
require_once(VIEWS_PATH.'footer.php');

?>