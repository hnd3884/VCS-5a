<?php

require_once '../config/messages.php';
require_once "../config/routes.php";
require_once '../../admin/controllers/MessageController.php';
require_once '../../admin/models/Message.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = trim($_POST["message"]);
    $receiveid = trim($_POST["receiveid"]);
    $sendid = $_SESSION["id"];
    $createdate = date("Y-m-d H:i:s");
    // echo $createdate;

    $messageController = new MessageController();
    $rs = $messageController->SendMessage($message, $createdate, $sendid, $receiveid);

    if ($rs) {

        $_SESSION["message"] = SEND_SUCCESS;

        header("location: " . ROUTE_DETAIL_USER . "?userid={$receiveid}");
    } else {
        
    }
}
