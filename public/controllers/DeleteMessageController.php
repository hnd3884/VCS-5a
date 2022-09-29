<?php
require_once '../../admin/controllers/MessageController.php';
require_once "../config/routes.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $messId = $_GET["messid"];
    $userId = $_GET["userid"];

    $controller = new MessageController();
    $rs = $controller->DeleteMessage($messId);

    if ($rs) {
        header("location: " . ROUTE_DETAIL_USER . '?userid=' . $userId);
    } else {
    }
}
