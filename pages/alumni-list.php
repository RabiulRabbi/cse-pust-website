<?php

if (isset($_GET['session']) && isset($_GET['degree'])) {
    $session = $_GET['session'];
    $degree = $_GET['degree'];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pundra_cse_dept";
    require_once('../admin/lib/application/databaseconfig.php');

    $conn = connect_database($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM alumni_info WHERE (degree = '$degree' AND session = '$session') ORDER BY id DESC";
    $com_data = $conn->query($sql);

    // while ($alumni_data = $com_data->fetch_assoc()) {
    //     echo $alumni_data['last_name'];
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./logo/pust.png">

    <title>Alumni-PUST-Computer Science & Engineering</title>

    <link rel="stylesheet" href="../node_modules/bootstrap-5.0.0-beta2/css/bootstrap.min.css">
    <link href="../node_modules/fontawesome-free-5.15.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/home.css">
</head>

<body>
    <?php
    include('./topheader.php');
    include('./navbar.php');
    ?>
    <div class="super-container main-content-area full-width">
        <div class="container custom-notice">
            <h1 class="page-title text-center fw-bolder custom-notice">
                <span>Alumni List</span>
            </h1>
            <?php while ($alumni_data = $com_data->fetch_assoc()) : ?>
                <div class="row" style="width: 100%; height: 750px;">
                    <div class="col-12">
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                                <div class="col-8-xxxl col-12">
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                                <div class="item-title">
                                                    <div class="row container">
                                                        <div class="col-md-6">
                                                            <p><b>Degree:</b> <?php echo $alumni_data['degree']; ?></p>
                                                            <p><b>Session:</b><?php echo $alumni_data['session']; ?></p>
                                                        </div>
                                                        <div class="col-md-6 row">

                                                            <p><b>Passing Year:</b> <?php echo $alumni_data['year']; ?></p>
                                                            <p><b>Batch:</b> <?php echo $alumni_data['batch']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">


                                                <div class="notice-list row">
                                                    <div class="col-11">
                                                            <h6>
                                                                <a class="text-decoration-none" href="alumnidetails.php?reg_id=<?php echo $alumni_data["registration_id"]; ?>"><?php echo $alumni_data["first_name"] . " " . $alumni_data["last_name"]; ?></a>
                                                            </h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-1st" role="tabpanel" aria-labelledby="nav-1st-tab">
                                <div class="col-8-xxxl col-12">
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                                <div class="item-title">
                                                    <h3>Notice Board</h3>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="first-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-2nd" role="tabpanel" aria-labelledby="nav-2nd-tab">
                                <div class="col-8-xxxl col-12">
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                                <div class="item-title">
                                                    <h3>Notice Board</h3>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="second-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    include('./footer.php');
    ?>



    <script src="../node_modules/bootstrap-5.0.0-beta2/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../dist/js/home.js"></script>
    <script src="../dist/js/scroll.js"></script>

</body>

</html>