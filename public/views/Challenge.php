<?php
session_start();

require_once '../../admin/controllers/ChallengeController.php';
require_once '../../admin/models/Challenge.php';
require_once "../config/routes.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

$controller = new ChallengeController();
$challenges = $controller->GetAllChallenge();

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
    <link href="../css/challenge.css" rel="stylesheet">
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

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Challenges</h6>

                            </div>
                            <div class="card-body">
                                <?php

                                if ($_SESSION["role"] == 2) {
                                    echo "<a class='btn btn-primary' href='#' data-toggle='modal' data-target='#addChallenge'>New &nbsp <i class='far fa-plus-square'></i></a><br><br>";
                                }

                                ?>
                                <ul class="list-group">
                                    <li class='list-group-item' style="color: white; background-color: #4e73df">
                                        <div class='row'>
                                            <div class='col-sm-7'>Challenge name</div>
                                            <div class='col-2'>#</div>
                                        </div>
                                    </li>
                                    <?php

                                    if ($_SESSION["role"] == 2) {
                                        if (sizeof($challenges) == 0) {
                                            echo "<li class='list-group-item'>
                                                    No challenge available now
                                                </li>";
                                        } else {
                                            foreach ($challenges as $chal) {
                                                echo "<li class='list-group-item'>
                                                    <div class='row'>
                                                        <div class='col-sm-7'>{$chal->getChallengeName()}</div>
                                                        <div class='col-3'>
                                                            <a class='btn btn-success' href='DetailChallenge.php?chalid={$chal->getChallengeID()}'>Detail</a>
                                                            <a class='btn btn-danger delete-challenge' chalid='{$chal->getChallengeID()}' href='#' data-toggle='modal' data-target='#deleteAssignmentModal'>Delete</a>
                                                        </div>
                                                    </div>
                                                </li>";
                                            }
                                        }
                                    } else {
                                        if (sizeof($challenges) == 0) {
                                            echo "<li class='list-group-item'>
                                                    No challenge available now
                                                </li>";
                                        } else {
                                            foreach ($challenges as $chal) {
                                                echo "<li class='list-group-item'>
                                                    <div class='row'>
                                                        <div class='col-sm-7'>{$chal->getChallengeName()}</div>
                                                        <div class='col-2'>
                                                            <a class='btn btn-success' href='DetailChallenge.php?chalid={$chal->getChallengeID()}'>Detail</a>
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

    <!-- Create challenge modal-->
    <div class="modal fade" id="addChallenge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="../controllers/AddChallengeController.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Challenge name</label>
                            <input type="text" name="challengename" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Hint</label>
                            <textarea type="text" name="hint" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="customFile">Challenge file</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="customFile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- href='../controllers/DeleteChallengeController.php?chalid={$chal->getChallengeID()}' -->
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
                    All deleted can not be rolled back!
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="delete-challenge-forward" class="btn btn-danger" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/challenge.js"></script>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>