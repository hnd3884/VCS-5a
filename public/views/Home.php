<?php

session_start();
require_once("../config/routes.php");
include '../config/fbconfig.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

echo $_SESSION["id"];

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
    <link href="../css/home.css" rel="stylesheet">
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
                    <div class="container-fluid">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Users</h6>
                                <span class="text-danger">
                                    <?php
                                    if (!empty($_SESSION["message"])) {
                                        echo $_SESSION["message"];
                                        unset($_SESSION["message"]);
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <?php

                                if ($_SESSION["role"] == 2) {
                                    echo "<a class='btn btn-primary' href='#' data-toggle='modal' data-target='#addNewUser'>New &nbsp<i class='far fa-plus-square'></i></a><br><br>";
                                }

                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>User name</th>
                                                <th>Full name</th>
                                                <th>Email </th>
                                                <th>Phone number</th>
                                                <th>Role</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            require_once '../../admin/controllers/UserController.php';
                                            require_once '../../admin/models/User.php';

                                            $controller = new UserController();
                                            $userList = $controller->GetAllUsers();

                                            if ($_SESSION["role"] == 1) {
                                                foreach ($userList as $user) {
                                                    $role = $user->getRole() == 1 ? "Student" : "<span class='text-success'>Teacher</span>";
                                                    echo "<tr>
                                                            <td>{$user->getUserName()}</td>
                                                            <td>{$user->getFullName()}</td>
                                                            <td>{$user->getEmail()}</td>
                                                            <td>{$user->getPhoneNumber()}</td>
                                                            <td>{$role}</td>
                                                            <td><a class='btn btn-success' href='DetailUser.php?userid={$user->getUserID()}'>detail</a></td>
                                                        </tr>";
                                                }
                                            } else {
                                                foreach ($userList as $user) {
                                                    $role = $user->getRole() == 1 ? "Student" : "<span class='text-success'>Teacher</span>";
                                                    echo "<tr userid='{$user->getUserID()}'>
                                                            <td field='username'>{$user->getUserName()}</td>
                                                            <td field='fullname'>{$user->getFullName()}</td>
                                                            <td field='email'>{$user->getEmail()}</td>
                                                            <td field='phonenumber'>{$user->getPhoneNumber()}</td>
                                                            <td field='role'>{$role}</td>
                                                            <td>
                                                                <a class='btn btn-success' href='DetailUser.php?userid={$user->getUserID()}'>detail</a>&nbsp
                                                                <a class='edit-user btn btn-primary' userid='{$user->getUserID()}' data-toggle='modal' data-target='#editUser' href='#'>edit</a>&nbsp
                                                                <a class='delete-user btn btn-danger' fullname='{$user->getFullName()}' userid='{$user->getUserID()}' data-toggle='modal' data-target='#deleteModal' href='#'>delete</a>
                                                            </td>        
                                                        </tr>";
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Delete <span class="text-danger" id="delete-modal-fullname"></span>?</p>
                    All action delete can not roll back!
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="delete-user-forward" class="btn btn-primary" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Modal-->
    <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="../controllers/AddUserController.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input name="fullname" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Phone number</label>
                            <input name="phonenumber" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Username</label>
                            <input name="username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Repeat password</label>
                            <input name="repeatpassword" type="password" class="form-control" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input name="isteacher" class="form-check-input" type="checkbox"> Is Teacher
                            </label>
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

    <!-- Edit Modal-->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="../controllers/EditUserController.php" method="POST">
                    <input name="userid" type="text" class="form-control" id="edit-userid" hidden>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input name="fullname" type="text" class="form-control" id="edit-fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Email</label>
                            <input name="email" type="email" class="form-control" id="edit-email" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Phone number</label>
                            <input name="phonenumber" type="text" class="form-control" id="edit-phonenumber" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Username</label>
                            <input name="username" type="text" class="form-control" id="edit-username" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">New password</label>
                            <input name="password" type="password" class="form-control" id="edit-password" placeholder="Leave it empty if do not want to change">
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input name="isteacher" class="form-check-input" type="checkbox" id="edit-isteacher"> Is Teacher
                            </label>
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
    <script src="../js/home.js"></script>

</body>

</html>