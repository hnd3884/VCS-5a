<?php
session_start();

require_once '../../admin/controllers/UserController.php';
require_once '../../admin/models/User.php';
require_once "../config/routes.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_SESSION["id"];
    $controller = new UserController();
    $rs = $controller->GetUserById($userId);
}

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
    <link href="../css/detailuser.css" rel="stylesheet">
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
                                <span class="m-0 font-weight-bold">Profile</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <img style="width: 100%;" src="../assets/images/user_icon.png" alt="" class="img-rounded img-responsive" />
                                    </div>
                                    <div class="col">
                                        <blockquote>
                                            <h1><?php echo $rs->getFullName() ?></h1> <small><cite title="Source Title">
                                                    <?php

                                                    if ($rs->getRole() == 2) {
                                                        echo "Teacher";
                                                    } else {
                                                        echo "Student";
                                                    }

                                                    ?>
                                                    <i class="glyphicon glyphicon-map-marker"></i>
                                                </cite></small>
                                        </blockquote>
                                        <p>
                                            <i class="fas fa-envelope-open-text"></i> <?php echo $rs->getEmail() ?>
                                            <br /> <i class="fas fa-phone-square"></i> <?php echo $rs->getPhoneNumber() ?>
                                        </p>
                                        <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#changeProfileModal">Change profile</a>
                                    </div>
                                </div>
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

    <!-- Change profile Modal-->
    <div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Change profile <?php echo $rs->getFullName() ?></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="../controllers/ChangeProfileController.php" method="POST">
                    <input type="text" name="userid" value="<?php echo $rs->getUserID() ?>" hidden>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">New password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Leave it empty if do not want to change password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" name="email" value="<?php echo $rs->getEmail() ?>" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone number</label>
                            <input type="text" name="phonenumber" value="<?php echo $rs->getPhoneNumber() ?>" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/sidebar.js"></script>

</body>

</html>