<?php

require_once "../config/routes.php";
require_once '../../admin/controllers/AssignmentController.php';

session_start();

if ($_SESSION["role"] == 1) {
    header("location: " . ROUTE_ACCESSDENIED);
} else {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . ROUTE_ASSIGNMENTS_FILE;
    $filePath = uniqid() . "_" . basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $filePath;

    $filePath = ROUTE_ASSIGNMENTS_FILE . $filePath;
    $fileName = basename($_FILES["file"]["name"]);

    $uploadOk = 1;

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $description = trim($_POST["description"]);
            $dueto = trim($_POST["dueto"]);

            $assignmentController = new AssignmentController();
            $rs = $assignmentController->AddAssignment($description, $filePath, $dueto, $fileName);

            if ($rs) {
                header("location: " . ROUTE_ASSIGNMENTS);
            } else {
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
	    echo $target_file." ".$fileName." ".$filePath;
        }
    }
}
