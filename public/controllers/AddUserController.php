<?php

require_once '../config/messages.php';
require_once "../config/routes.php";
require_once '../../admin/controllers/UserController.php';
require_once '../../admin/models/User.php';
require_once '../../admin/utilities/UserUtility.php';

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);

        // controller
        $userController = new UserController();

        $userDB = $userController->GetUserByUserName($username);

        if($userDB == 1){
            $_SESSION["message"] = REGISTER_USERNAME_EXIST;
    
            header("location: ".ROUTE_HOME);
            exit();
        }

        $password = trim($_POST["password"]);
        $repeatpassword = trim($_POST["repeatpassword"]);
        $fullname = trim($_POST["fullname"]);
        $phonenumber = trim($_POST["phonenumber"]);
        $email = trim($_POST["email"]);
        $role = isset($_POST['isteacher']) && $_POST['isteacher']  ? 2 : 1;
    
        if ($password !== $repeatpassword) {
    
            $_SESSION["message"] = REGISTER_REPEAT_PASSWORD_ERROR;
            header("location: ".ROUTE_HOME);

        } else if(UserUtility::CheckPhone($phonenumber) == false){

            $_SESSION["message"] = REGISTER_PHONE_FORMAT_ERROR;
            header("location: ".ROUTE_HOME);

        } else {

            $user = new User();
            $user->setUserName($username);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->setFullName($fullname);
            $user->setPhoneNumber($phonenumber);
            $user->setEmail($email);
            $user->setRole($role);
    
            $rs = $userController->Register($user);
    
            if ($rs) {
                header("location: ".ROUTE_HOME);
            } else {
                session_start();
    
                $_SESSION["message"] = SERVER_ERROR;
    
                header("location: ".ROUTE_HOME);
            }
            
        }
    }
}
