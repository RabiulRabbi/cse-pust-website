<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "pundra_cse_dept";
// require_once('./lib/application/databaseconfig.php');

// $conn = connect_database($servername, $username, $password, $dbname);

// $sql = "SELECT * FROM st_info ORDER BY id DESC";
// $com_data = $conn->query($sql);
// 
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link href="../node_modules/fontawesome-free-5.15.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/home.css">
</head>

<body>
    <?php
    include('./topheader.php');
    include('./navbar.php');
    ?>

    <div class="container mt-5 mb-5">
        <h1 class="text-center custom-notice">Alumni</h1>
        <div class="tab-content bg-dark p-3" id="pills-tabContent">
            <ul class="nav nav-pills mb-3 bg-secondary" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button onclick="bscAlumni()" class="nav-link active" id="pills-bsc-tab" data-bs-toggle="pill" data-bs-target="#pills-bsc" type="button" role="tab" aria-controls="pills-bsc" aria-selected="true">BSc Hons.</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button onclick="msAlumni()" class="nav-link" id="pills-ms-tab" data-bs-toggle="pill" data-bs-target="#pills-ms" type="button" role="tab" aria-controls="pills-ms" aria-selected="false">MS</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button onclick="phdAlumni()" class="nav-link" id="pills-phd-tab" data-bs-toggle="pill" data-bs-target="#pills-phd" type="button" role="tab" aria-controls="pills-phd" aria-selected="false">PhD</button>
                </li>
            </ul>

            <!-- bsc alumni -->
            <div class="tab-pane fade show active bg-white p-3" id="pills-bsc" role="tabpanel" aria-labelledby="pills-bsc-tab">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col pointer">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2013-14&degree=Bsc" class="text-decoration-none ">
                                <img src="./alumni-cover-photo/alumni cover-1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2013-14</h5>
                                    <p class="card-text">Passing Year: 2017</p>
                                    <p>Batch: 01</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2014-15&degree=Bsc" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2014-15</h5>
                                    <p class="card-text">Passing Year: 2018</p>
                                    <p>Batch: 02</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2015-16&degree=Bsc" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-3.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2015-16</h5>
                                    <p class="card-text">Passing Year: 2019</p>
                                    <p>Batch: 03</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2016-17&degree=Bsc" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-4.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2016-17</h5>
                                    <p class="card-text">Passing Year: 2020</p>
                                    <p>Batch: 04</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ms alumni -->
            <div class="tab-pane fade" id="pills-ms" role="tabpanel" aria-labelledby="pills-ms-tab">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col pointer">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2013-14&degree=MS" class="text-decoration-none ">
                                <img src="./alumni-cover-photo/alumni cover-1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2013-14</h5>
                                    <p class="card-text">Passing Year: 2017</p>
                                    <p>Batch: 01</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2014-15&degree=MS" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2014-15</h5>
                                    <p class="card-text">Passing Year: 2018</p>
                                    <p>Batch: 02</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2015-16&degree=MS" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-3.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2015-16</h5>
                                    <p class="card-text">Passing Year: 2019</p>
                                    <p>Batch: 03</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2016-17&degree=MS" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-4.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2016-17</h5>
                                    <p class="card-text">Passing Year: 2020</p>
                                    <p>Batch: 04</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- phd alumni -->
            <div class="tab-pane fade" id="pills-phd" role="tabpanel" aria-labelledby="pills-phd-tab">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col pointer">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2013-14&degree=PhD" class="text-decoration-none ">
                                <img src="./alumni-cover-photo/alumni cover-1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2013-14</h5>
                                    <p class="card-text">Passing Year: 2017</p>
                                    <p>Batch: 01</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2014-15&degree=PhD" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2014-15</h5>
                                    <p class="card-text">Passing Year: 2018</p>
                                    <p>Batch: 02</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2015-16&degree=PhD" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-3.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2015-16</h5>
                                    <p class="card-text">Passing Year: 2019</p>
                                    <p>Batch: 03</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="./alumni-list.php?session=2016-17&degree=PhD" class="text-decoration-none">
                                <img src="./alumni-cover-photo/alumni cover-4.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Session: 2016-17</h5>
                                    <p class="card-text">Passing Year: 2020</p>
                                    <p>Batch: 04</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('./footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../dist/js/home.js"></script>
    <script src="../dist/js/scroll.js"></script>

</body>

</html>