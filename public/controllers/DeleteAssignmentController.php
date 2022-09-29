<?php
require_once '../../admin/controllers/AssignmentController.php';
require_once "../config/routes.php";

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $assignid = $_GET["assignid"];

        $controller = new AssignmentController();
        $rs = $controller->DeleteAssignment($assignid);
        
        if ($rs) {
            header("location: " . ROUTE_ASSIGNMENTS);
        } else {
        }
    }
}