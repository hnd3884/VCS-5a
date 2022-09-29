<!-- PHP -->
<?php
require_once '../config/messages.php';
require_once "../config/routes.php";
require_once '../../admin/controllers/UserController.php';
require_once '../../admin/models/User.php';
?>
<?php
$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        $user = new User();
        $user->setUserName($username);
        $user->setPassword($password);

        // controller
        $userController = new UserController();

        $rs = $userController->CheckUser($user);
        if ($rs instanceof User) {
            session_start();

            $_SESSION["id"] = $rs->getUserID();
            $_SESSION["loggedin"] = true;
            $_SESSION["fullname"] = $rs->getFullName();
            $_SESSION["role"] = $rs->getRole();

            header("location: ".ROUTE_HOME);
        } else {
            session_start();

            $_SESSION["message"] = LOGIN_FAILED_NOTFOUND;

            header("location: ".ROUTE_LOGIN);
        }
    }
}
?>