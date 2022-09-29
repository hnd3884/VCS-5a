<?php

require_once "../config/routes.php";
require_once '../../admin/controllers/ChallengeController.php';
require_once '../../admin/controllers/HistoryController.php';

session_start();

$studentid=$_SESSION["id"];
$chalid = trim($_POST["chalid"]);
$answer = trim($_POST["answer"]);

$controller = new ChallengeController();
$historyController = new HistoryController();
$rs = $controller->CheckAnswer($chalid, $answer);

if ($rs === 1) {

    $historyController->AddHistory($studentid, true, date("Y-m-d H:i:s"), $chalid);

    $_SESSION["correct"] = "true";
    header("location: " . ROUTE_DETAIL_CHALLENGE . "?chalid=" . $chalid);
} else {
    $historyController->AddHistory($studentid, false, date("Y-m-d H:i"), $chalid);

    $_SESSION["correct"] = "false";
    header("location: " . ROUTE_DETAIL_CHALLENGE . "?chalid=" . $chalid);
}
