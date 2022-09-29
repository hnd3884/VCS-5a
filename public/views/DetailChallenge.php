<?php
session_start();

require_once '../../admin/controllers/ChallengeController.php';
require_once '../../admin/models/Challenge.php';
require_once "../config/routes.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: " . ROUTE_LOGIN);
    exit;
}

$chalid = trim($_GET['chalid']);

$controller = new ChallengeController();
$challenge = $controller->GetChallengeById($chalid);

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <title>Class Manager</title>

    <link href='../lib/fontawesome/css/all.css'>
    <link href='../lib/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='../css/sidebar.css' rel='stylesheet'>
    <link href='../css/challenge.css' rel='stylesheet'>
    <script defer src='../lib/fontawesome/js/all.js'></script>
    <!--load all styles -->
</head>

<body>

    <div class='d-flex' id='wrapper'>

        <!-- Sidebar -->
        <?php include 'commons/Sidebar.php' ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id='page-content-wrapper'>

            <div id='content-wrapper' class='d-flex flex-column'>

                <!-- Main Content -->
                <div id='content'>

                    <!-- Topbar -->
                    <?php include 'commons/Navtop.php' ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class='container-fluid'>

                        <?php

                        if ($_SESSION["role"] == 2) {
                            echo "<div class='card shadow mb-4'>
                            <div class='card-header py-3'>
                                <h6 class='m-0 font-weight-bold'>CHALLENGE [ " . $challenge->getChallengeName() . " ]</h6>

                            </div>
                            <div class='card-body'>
                                <h4 class='text-success'>Hint <i class='fas fa-lightbulb'></i></h4>
                                <p>" . $challenge->getHint() . "</p>
                                <h4>All submits</h4>
                                <ul class='list-group'>
                                    <li class='list-group-item' style='color: white; background-color: #4e73df'>
                                        <div class='row'>
                                            <div class='col-3'>Time</div>
                                            <div class='col-sm-7'>Student</div>
                                            <div class='col-2'>Result</div>
                                        </div>
                                    </li>";

                            foreach ($challenge->getHistories() as $history) {

                                echo "<li class='list-group-item'>
                                        <div class='row'>
                                            <div class='col-3'>{$history->getSubmitDate()}</div>
                                            <div class='col-sm-7'>{$history->getStudentName()}</div>";

                                if ($history->getResult() == 1) {
                                    echo "<div class='col-2'><span class='text-success'>Correct</span></div>
                                    </div>
                                </li>";
                                } else {
                                    echo "<div class='col-2'><span class='text-danger'>Incorrect</span></div>
                                    </div>
                                </li>";
                                }
                            }

                            echo "</ul>
                            </div>
                        </div>";
                        } else {
                            echo "<div class='container' style='text-align: center; width: 700px;'>
                            <h5>Challenge</h5>
                            <h1 style='font-size: 55px;'>" . $challenge->getChallengeName() . "</h1>
                            <a type='text' class='btn btn-primary' href='#' data-toggle='modal' data-target='#showHint'>Show hint <i class='fas fa-lightbulb'></i></a>
                            
                            <form action='../controllers/AnswerController.php' method='POST' style='width:450px; margin-left: 110px'>
                                <hr>
                                <input type='text' name='chalid' value='" . $chalid . "' hidden>
                                <div class='form-group'>
                                    <input type='text' class='form-control' name='answer' placeholder='Type your answer' required>
                                </div>
                                <div class='form-group'>
                                    <button type='text' class='btn btn-primary'>Submit</button>
                                </div>
                            </form>";

                            if (!empty($_SESSION["correct"])) {

                                if ($_SESSION["correct"] == "true") {
                                    echo "<p class='text-success'>Congratulation, correct answer !</p>";
                                    echo "</div>";
                                    echo "<div class='container' style='width:75%'>
                                            <div class='card shadow mb-4'>
                                            <div class='card-header py-3'>
                                                <h6 class='m-0 font-weight-bold text-primary'>Your reward</h6>
                                            </div>
                                                <div class='card-body'>";
                                    
                                    $filePath = $_SERVER['DOCUMENT_ROOT'] . $challenge->getFilePath();
                                    $file = fopen($filePath, "r");

                                    while(!feof($file)){
                                        echo fgets($file). "<br/>";
                                    }

                                    fclose($file);

                                    echo    "</div></div></div>";
                                } else {
                                    echo "<p class='text-danger'>Incorrect answer !</p>";
                                }


                                unset($_SESSION["correct"]);
                            }
                        }

                        ?>

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
    <div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Ready to Leave?</h5>
                    <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>×</span>
                    </button>
                </div>
                <div class='modal-body'>Select 'Logout' below if you are ready to end your current session.</div>
                <div class='modal-footer'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                    <a class='btn btn-primary' href='../controllers/LogoutController.php'>Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Show hint modal-->
    <div class='modal fade' id='showHint' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <?php echo $challenge->getHint() ?>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src='../lib/jquery/jquery-3.5.1.min.js'></script>
    <script src='../lib/bootstrap/js/bootstrap.min.js'></script>
    <script src='../js/sidebar.js'></script>

    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
</body>

</html>