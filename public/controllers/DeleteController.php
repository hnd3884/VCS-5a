<?php
require_once '../../admin/controllers/UserController.php';
require_once "../config/routes.php";

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $userId = $_GET["userid"];

        $controller = new UserController();
        $rs = $controller->DeleteUser($userId);
        
        if ($rs) {
            header("location: " . ROUTE_HOME);
        } else {
            echo $userId;
        }
    }
}
