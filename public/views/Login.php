<?php
session_start();
require_once "../config/routes.php";
include '../config/fbconfig.php';

if (isset($_SESSION["loggedin"])) {
    header("location: " . ROUTE_HOME);
    exit;
}

$facebook_helper = $facebook->getRedirectLoginHelper();
$facebook_login_url = $facebook_helper->getLoginUrl('https://classroom5a.hoangnd.com/');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="../lib/fontawesome/css/all.css">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/login.css" rel="stylesheet">
    <script defer src="../lib/fontawesome/js/all.js"></script>
    <title>LOGIN</title>
</head>

<body class="bg-gradient-primary">

    <div class="banner">
        <div class="form-login">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <p class="text-danger"><?php
                                    if (!empty($_SESSION["message"])) {
                                        echo $_SESSION["message"];
                                        unset($_SESSION["message"]);
                                    }
                                    ?></p>
            <form action="../controllers/LoginController.php" method="POST">

                <div class="form-group">
                    <label>User name</label>
                    <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Enter User Name..." required>
                </div>
                <div class="form-group" style='margin-bottom:45px'>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password..." required>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>

            </form>
            <p class="text-center" style="margin-top: 5px; margin-bottom: 5px;">or</p>
            <?php

            if (isset($facebook_login_url)) {
                echo "<a class='btn btn-primary btn-user btn-block' href='{$facebook_login_url}'>
                        <i style='font-size: 16px;'' class='fab fa-facebook-square'></i>&nbsp; Login with facebook
                    </a>";
            }

            ?>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>