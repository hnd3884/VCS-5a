<?php

require_once '../config/messages.php';
require_once "../config/routes.php";
require_once '../../admin/controllers/UserController.php';
require_once '../../admin/models/User.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST["userid"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $fullname = trim($_POST["fullname"]);
    $phonenumber = trim($_POST["phonenumber"]);
    $email = trim($_POST["email"]);
    $role = isset($_POST['isteacher']) && $_POST['isteacher'] ? 2 : 1;

    $user = new User();
    $user->setUserID($userid);
    $user->setUserName($username);
    $user->setPassword($password == "" ? "" : password_hash($password, PASSWORD_DEFAULT));
    $user->setFullName($fullname);
    $user->setEmail($email);
    $user->setPhoneNumber($phonenumber);
    $user->setRole($role);

    // controller
    $userController = new UserController();
    $rs = $userController->UpdateUser($user);

    if ($rs) {
	if($userid == $_SESSION["id"])
	{
	   $_SESSION["fullname"] = $fullname;
	}
        header("location: ".ROUTE_HOME);
    } else {
        $_SESSION["message"] = UPDATE_USER_FAILED;

        header("location: ".ROUTE_HOME."?userid={$userid}");
    }
}
