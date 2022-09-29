<?php

require_once "../config/routes.php";
require_once '../../admin/controllers/ChallengeController.php';

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . ROUTE_CHALLENGE_FILE;
    $folder = uniqid();
    mkdir($target_dir . $folder);
    $filePath = $folder . "/" . basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $filePath;

    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $challengename = trim($_POST["challengename"]);
            $hint = trim($_POST["hint"]);

            $challengeController = new ChallengeController();
            $rs = $challengeController->AddChallenge($challengename, $hint, $folder);

            if ($rs) {
                header("location: " . ROUTE_CHALLENGE);
            } else {
                
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
