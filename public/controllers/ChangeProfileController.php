<?php

require_once '../config/messages.php';
require_once "../config/routes.php";
require_once '../../admin/controllers/UserController.php';
require_once '../../admin/models/User.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST["userid"]);
    $password = trim($_POST["password"]);
    $email = trim($_POST["email"]);
    $phonenumber = trim($_POST["phonenumber"]);

    // controller
    $userController = new UserController();
    if($password !== ""){
	$password = password_hash($password, PASSWORD_DEFAULT);
    } 

    $rs = $userController->ChangeProfile($userid, $password, $email, $phonenumber);

    if ($rs) {
        header("location: ".ROUTE_PROFILE);
    } else {
        $_SESSION["message"] = UPDATE_USER_FAILED;

        header("location: ".ROUTE_PROFILE);
    }
}
