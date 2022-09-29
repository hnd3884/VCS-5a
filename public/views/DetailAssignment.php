<?php
session_start();

require_once '../../admin/controllers/AssignmentController.php';
require_once '../../admin/models/Assignment.php';
require_once "../config/routes.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

$assignId = $_GET["assignid"];

$controller = new AssignmentController();
$assign = $controller->GetAssignmentById($assignId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Class Manager</title>

    <link href="../lib/fontawesome/css/all.css">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sidebar.css" rel="stylesheet">
    <link href="../css/assignments.css" rel="stylesheet">
    <script defer src="../lib/fontawesome/js/all.js"></script>
    <!--load all styles -->
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php include 'commons/Sidebar.php' ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include 'commons/Navtop.php' ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Assignment [ <?php echo $assign->getDescription() ?> ]</h6>
                            </div>
                            <div class="card-body">
                                <span>File: <?php echo "<a href='" . $assign->getFilePath() . "' download='" . $assign->getFileName() . "'>" . $assign->getFileName() . "</a>" ?></span>
                                <span style="float: right;" class="text-danger">Due to: <?php echo $assign->getDueTo() ?></span>
                                <?php
                                if ($_SESSION["role"] == 2) {
                                    require_once '../../admin/controllers/ReportController.php';
                                    require_once '../../admin/models/Report.php';

                                    $controller = new ReportController();
                                    $list = $controller->GetAllReports($assignId);

                                    echo "<div>
                                            <a href='#' data-toggle='modal' data-target='#changeFileModal' class='btn btn-primary'>Change file</a><br /></br />
                                        </div>
                                        <ul class='list-group'>
                                            <li class='list-group-item' style='background-color: #4e73df;color: white;'>
                                                <div class='row'>
                                                    <div class='col-3'>Time submit</div>
                                                    <div class='col-sm-6'>File</div>
                                                    <div class='col-3'>Student</div>
                                                </div>
                                            </li>";

                                    if (sizeof($list) == 0) {
                                        echo "<li class='list-group-item'>
                                                        No submit now
                                                    </li>";
                                    } else {
                                        foreach ($list as $rp) {
                                            echo "<li class='list-group-item'>
                                                <div class='row'>
                                                    <div class='col-3'>{$rp->getCreateDate()}</div>
                                                    <div class='col-sm-6'><a href='{$rp->getFilePath()}' download>{$rp->getFileName()}</a></div>
                                                    <div class='col-3'>{$rp->getStudentName()}</div>
                                                </div>
                                            </li>";
                                        }
                                    }

                                    echo "</ul>";
                                } else {
                                    require_once '../../admin/controllers/ReportController.php';
                                    require_once '../../admin/models/Report.php';

                                    $controller = new ReportController();
                                    $report = $controller->GetReportOfStudent($assignId, $_SESSION["id"]);

                                    if ($report instanceof Report) {
                                        echo "<p>
                                                Turned-in file: <a href='" . $report->getFilePath() . "' download='" . $report->getFileName() . "'>" . $report->getFileName() . "</a>
                                                <span style='float: right;' class='text-success'><i class='fas fa-clipboard-check'></i> Turned in </span><br><br>
                                                <a href='#' data-toggle='modal' data-target='#changeTurnInModal' class='btn btn-primary'>Change turn-in file</a>
                                            </p>";

                                        echo "<div class='modal fade' id='changeTurnInModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <form action='../controllers/ChangeReportController.php' method='POST' enctype='multipart/form-data'>
                                                    <input type='text' name='reportid' value='" . $report->getReportID() . "' hidden/>
                                                    <input type='text' name='assignid' value='" . $assignId . "' hidden/>
                                                    <div class='modal-body'>
                                                        <div class='form-group'>
                                                            <label for='customFile'>New File</label>
                                                            <div class='custom-file'>
                                                                <input type='file' name='file' class='custom-file-input' id='customFile' required>
                                                                <label class='custom-file-label' for='customFile'>Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                                                        <button class='btn btn-primary' href='#'>Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";
                                    } else {
                                        echo "<br/><br/>
                                        <form action='../controllers/TurnInController.php' method='POST' enctype='multipart/form-data'>
                                            <input type='text' value='{$assignId}' name='assignid' hidden/>
                                            <div class='form-group'>
                                                <label for='customFile'>Turn in</label>
                                                <div class='custom-file'>
                                                    <input type='file' name='file' class='custom-file-input' id='customFile' required>
                                                    <label class='custom-file-label' for='customFile'>Choose file</label>
                                                </div>
                                            </div>
                                            <button class='btn btn-primary' type='submit'>Turn in</button>
                                        </form>";
                                    }
                                }

                                ?>

                            </div>
                        </div>
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../controllers/LogoutController.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- change assignment Modal-->
    <div class="modal fade" id="changeFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="../controllers/ChangeAssignmentController.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="assignid" value="<?php echo $assignId ?>" hidden />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customFile">New File</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" href="#">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/detailassignment.js"></script>

</body>

</html>