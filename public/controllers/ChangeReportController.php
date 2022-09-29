<?php

require_once "../config/routes.php";
require_once '../../admin/controllers/ReportController.php';

session_start();

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
        $reportid = trim($_POST["reportid"]);
        $assignid = trim($_POST["assignid"]);

        echo $reportid." ".$assignid;

        $assignmentController = new ReportController();
        $rs = $assignmentController->ChangeReport($reportid, $filePath, $fileName);

        if ($rs) {
            header("location: " . ROUTE_DETAIL_ASSIGNMENT . "?assignid=" . $assignid);
        } else {
            echo "error";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
