
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$msg = "";
require_once('../admin/lib/application/databaseconfig.php');

$noticeTitle = $noticePdf = $msg = "";
$noticePdfError = $imgError = $noticeTitleError = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["notice_title"])) {
        $noticeTitleError = "Field required";
        $noticeTitle = "";
    } else {
        $noticeTitle = test_input($_POST["notice_title"]);
        $noticeTitleError = "";
    }

    $noticePdf = $_FILES['notice_pdf']['name'];
    if (!empty($noticePdf)) {
        $pdf_tmp = $_FILES['notice_pdf']['tmp_name'];
        $ext = strtolower(pathinfo($noticePdf, PATHINFO_EXTENSION));
        if ((in_array($ext, ['pdf']) == true)) {
            $u_noticePdf = md5(time() . $noticePdf) . "." . $ext;
            $imgError = "";
            $noticePdfError = "";
        } else {
            $imgError = "<p class = 'alert alert-danger '><b>ERROR!</b> Only pdf file is allowed <button class='close' data-dismiss='alert'>&times;</button></p>";
            $noticePdfError = "Field required";
            $u_noticePdf = "";
        }
    } else {
        $noticePdfError = "Field required";
        $u_noticePdf = "";
    }

    if (!empty($noticeTitle) && !empty($u_noticePdf)) {
        $conn = connect_database($servername, $username, $password, $dbname);

        if ($conn->connect_errno) {
            $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
        } else {

            $sql = "INSERT INTO notice(notice_title, notice_pdf)VALUES('$noticeTitle', '$u_noticePdf')";

            if ($conn->query($sql) === TRUE) {
                $msg = "<p class = 'alert alert-success '><b>SUCCESS!</b> Data Inserted Successfully <button class='close' data-dismiss='alert'>&times;</button></p>";
                $noticeTitle = $noticePdf = $msg = "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();


            if ($u_noticePdf) {
                move_uploaded_file($pdf_tmp, 'uploads/notice/' . $u_noticePdf);
            }
            $noticeTitle = $u_noticePdf = "";
        };
    } else {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Any required field Must Not Be Empty <button class='close' data-dismiss='alert'>&times;</button></p>";
    }
}

function get_all_notice()
{
    global $servername;
    global $username;
    global $password;
    global $dbname;
    $conn = connect_database($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'all' ORDER BY id DESC";
        $result = $conn->query($sql);
        return $result;
    }
    $conn->close();
}

$all_notice = get_all_notice();


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice-Board-PUST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="../node_modules/fontawesome-free-5.15.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/home.css">


    <!-- Fontwosome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Flaticon -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/fonts/flaticon.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/main.css">
    <!-- custom CSS -->
    <link rel="stylesheet" type="text/css" href="../dist/css/notice.css">
    <!-- Fontawesome CSS -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
</head>

<body>
    <?php
    include('../pages/topheader.php');
    include('../pages/navbar.php');
    ?>
    <div class="super-container main-content-area full-width">
        <div class="container custom-notice">
            <h1 class="page-title text-center fw-bolder custom-notice">
                <span>Notice Board</span>
            </h1>
            <nav class="">
                <div onclick="allYear()" class="nav nav-tabs bg-secondary" id="nav-tab" role="tablist">

                    <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">Notice for All</button>

                    <button onclick="firstYear()" class="nav-link" id="nav-1st-tab" data-bs-toggle="tab" data-bs-target="#nav-1st" type="button" role="tab" aria-controls="nav-1st" aria-selected="false">1st year</button>

                    <button onclick="secondYear()" class="nav-link" id="nav-2nd-tab" data-bs-toggle="tab" data-bs-target="#nav-2nd" type="button" role="tab" aria-controls="nav-2nd" aria-selected="false">2nd year</button>

                    <button onclick="thirdYear()" class="nav-link" id="nav-3rd-tab" data-bs-toggle="tab" data-bs-target="#nav-3rd" type="button" role="tab" aria-controls="nav-3rd" aria-selected="false">3rd year</button>

                    <button onclick="fourthYear()" class="nav-link" id="nav-4th-tab" data-bs-toggle="tab" data-bs-target="#nav-4th" type="button" role="tab" aria-controls="nav-4th" aria-selected="false">4th year</button>

                    <button onclick="msYear()" class="nav-link" id="nav-ms-tab" data-bs-toggle="tab" data-bs-target="#nav-ms" type="button" role="tab" aria-controls="nav-ms" aria-selected="false">MS</button>

                    <button onclick="phdYear()" class="nav-link" id="nav-phd-tab" data-bs-toggle="tab" data-bs-target="#nav-phd" type="button" role="tab" aria-controls="nav-phd" aria-selected="false">MPhil/PhD</button>
                </div>
            </nav>
            <div class="row" style="width: 100%; height: 750px;">
                <div class="col-6">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                            <div class="col-8-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Notice Board</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">

                                            <?php while ($notice_data = $all_notice->fetch_assoc()) : ?>
                                                <div class="notice-list row">
                                                    <div class="col-11">
                                                        <div class="post-date bg-skyblue"><?php echo  date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])); ?></div>
                                                        <h6 onclick="notice_display('<?php echo $notice_data['notice_pdf']; ?>')" class="notice-title"><a href="#"><?php echo $notice_data["notice_title"]; ?></a></h6>
                                                        <div class="entry-meta"> by admin / <span><?php echo date('h:i:s a', strtotime($notice_data["time_stamp"])); ?></span></div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>

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


                        <div class="tab-pane fade" id="nav-3rd" role="tabpanel" aria-labelledby="nav-3rd-tab">
                            <div class="col-8-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Notice Board</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="third-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-4th" role="tabpanel" aria-labelledby="nav-4th-tab">
                            <div class="col-8-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Notice Board</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="fourth-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-ms" role="tabpanel" aria-labelledby="nav-ms-tab">
                            <div class="col-8-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Notice Board</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="ms-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-phd" role="tabpanel" aria-labelledby="nav-phd-tab">
                            <div class="col-8-xxxl col-12">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Notice Board</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="phd-year" class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div id="notice-display">

                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php
    include('../pages/footer.php');
    ?>


    <!-- Bootstrap Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../dist/js/home.js"></script>
    <script src="../dist/js/scroll.js"></script>


    <script src="../admin/assets/js/jquery-3.3.1.min.js"></script>
    <!-- proper js -->
    <script src="../admin/assets/js/popper.min.js"></script>
    <!-- Counterup Js -->
    <script src="../admin/assets/js/jquery.counterup.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../admin/assets/js/bootstrap.min.js"></script>
    <!-- Moment Js -->
    <script src="../admin/assets/js/moment.min.js"></script>
    <!-- Chart Js -->
    <script src="../admin/assets/js/Chart.min.js"></script>
    <!-- Waypoints Js -->
    <script src="../admin/assets/js/jquery.waypoints.min.js"></script>
    <!-- Custom Js -->
    <script src="../admin/assets/js/main.js"></script>

    <script>
        function notice_display(notice_pdf) {
            const update_notice_display = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_notice_display: update_notice_display
                },
                type: "POST",
                success: function(data, status) {
                    $('#notice-display').html(`<iframe id="notice" src="../admin/uploads/notice/${notice_pdf}" style="width: 100%; height: 650px;" frameborder="0"></iframe>`);

                }

            });
        }
        function allYear() {
            const update_all_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_all_year: update_all_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#all-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }
        function firstYear() {
            const update_first_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_first_year: update_first_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#first-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }

        function secondYear() {
            const update_second_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_second_year: update_second_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#second-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }

        function thirdYear() {
            const update_third_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_third_year: update_third_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#third-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }

        function fourthYear() {
            const update_fourth_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_fourth_year: update_fourth_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#fourth-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }

        function msYear() {
            const update_ms_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_ms_year: update_ms_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#ms-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }

        function phdYear() {
            const update_phd_year = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_phd_year: update_phd_year
                },
                type: "POST",
                success: function(data, status) {
                    $('#phd-year').html(data);
                    $('#notice-display').html("");
                }

            });
        }
    </script>
</body>

</html>