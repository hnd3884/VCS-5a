<?php
session_start();

require_once '../../admin/controllers/AssignmentController.php';
require_once '../../admin/models/Assignment.php';
require_once "../config/routes.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}


$controller = new AssignmentController();
$assignList = $controller->GetAllAssignments();

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
                                <h6 class="m-0 font-weight-bold">List Assignments</h6>
                            </div>
                            <div class="card-body">
                                <?php

                                if ($_SESSION["role"] == 2) {
                                    echo "<a href='AddAssignment.php' class='btn btn-primary'>New &nbsp<i class='far fa-plus-square'></i></a><br/></br/>";
                                }

                                ?>
                                <ul class="list-group">
                                    <li class='list-group-item' style="background-color: #4e73df;color: white;">
                                        <div class="row">
                                            <div class='col-3'>Due to</div>
                                            <div class='col-sm-6'>Description</div>
                                            <div class='col-3'>#</div>
                                        </div>
                                    </li>
                                    <?php

                                    if ($_SESSION["role"] == 2) {
                                        if (sizeof($assignList) == 0) {
                                            echo "<li class='list-group-item'>
                                                    No challenge available now
                                                </li>";
                                        } else {
                                            foreach ($assignList as $assign) {
                                                echo "<li class='list-group-item'>
                                                        <div class='row'>
                                                            <div class='col-3'>{$assign->getDueTo()}</div>
                                                            <div class='col-sm-6'>{$assign->getDescription()}</div>
                                                            <div class='col-3'>
                                                                <a class='btn btn-success' href='DetailAssignment.php?assignid={$assign->getAssignmentID()}'>Detail</a>
                                                                <a class='btn btn-danger delete-assignment' assignid='{$assign->getAssignmentID()}' href='#' data-toggle='modal' data-target='#deleteAssignmentModal'>Delete</a>
                                                            </div>
                                                        </div>
                                                    </li>";
                                            }
                                        }
                                    } else {
                                        if (sizeof($assignList) == 0) {
                                            echo "<li class='list-group-item'>
                                                    No assignment available now
                                                </li>";
                                        } else {
                                            foreach ($assignList as $assign) {
                                                echo "<li class='list-group-item'>
                                                        <div class='row'>
                                                            <div class='col-3'>{$assign->getDueTo()}</div>
                                                            <div class='col-sm-6'>{$assign->getDescription()}</div>
                                                            <div class='col-3'>
                                                                <a class='btn btn-success' href='DetailAssignment.php?assignid={$assign->getAssignmentID()}'>Detail</a>
                                                            </div>
                                                        </div>
                                                    </li>";
                                            }
                                        }
                                    }

                                    ?>
                                </ul>
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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    All submits from students will be deleted as well!
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="delete-assignment-forward" class="btn btn-primary" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/home.js"></script>

</body>

</html>