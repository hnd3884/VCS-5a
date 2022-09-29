<?php

require_once "../config/routes.php";
require_once '../../admin/controllers/ChallengeController.php';

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    $chalid = trim($_GET["chalid"]);

    $controller = new ChallengeController();
    $rs = $controller->DeleteChallenge($chalid);

    if ($rs) {
        header("location: " . ROUTE_CHALLENGE);
    } else {
        
    }
}
