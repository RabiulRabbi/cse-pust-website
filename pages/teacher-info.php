<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
require_once('../admin/lib/application/databaseconfig.php');

$conn = connect_database($servername, $username, $password, $dbname);

$sql = "SELECT * FROM st_info WHERE ( session = '2018-19' OR session = '2017-18' ) ORDER BY id DESC";
$com_data = $conn->query($sql);     ?>

<?php

// Registration form data collect & validation check

$firstname = $lastname = $gender =  $birthdate = $roll = $bloodgroup = $religion = $email = $session = $year = $registrationid = $phone = $profileimage = $u_profileimage = "";

$firstnameError = $lastnameError = $genderError =  $birthdateError = $rollError = $bloodgroupError = $religionError = $emailError = $sessionError = $yearError = $registrationidError = $phoneError = $profileimageError = $imgError = $emailExistError = $rollExistError = $regExistError = "";

if (isset($_POST["submit"])) {

    if (empty($_POST["firstname"])) {
        $firstnameError = "Field required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $firstnameError = "Invalid input";
            $firstname = "";
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameError = "Field required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lastnameError = "Invalid input";
            $lastname = "";
        }
    }

    if (empty($_POST["gender"])) {
        $genderError = "Field required";
        $gender = "";
    } else {
        $gender = $_POST["gender"];
    }

    if (empty($_POST["birthdate"])) {
        $birthdateError = "Field required";
        $birthdate = "";
    } else {
        $birthdate = $_POST["birthdate"];
        $birthdateformate = date("Y-m-d", strtotime($birthdate));
    }

    if (empty($_POST["roll"])) {
        $rollError = "Field required";
    } else {
        $roll = test_input($_POST["roll"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $roll)) {
            $rollError = "Invalid roll";
            $roll = "";
        }
    }

    if (empty($_POST["bloodgroup"])) {
        $bloodgroupError = "Field required";
        $bloodgroup = "";
    } else {
        $bloodgroup = $_POST["bloodgroup"];
    }

    if (empty($_POST["religion"])) {
        $religionError = "Field required";
        $registrationid = "";
    } else {
        $religion = $_POST["religion"];
    }

    if (empty($_POST["email"])) {
        $emailError = "Field required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid input";
            $email = "";
        }
    }

    if (empty($_POST["session"])) {
        $sessionError = "Field required";
        $session = "";
    } else {
        $session = $_POST["session"];
    }

    if (empty($_POST["year"])) {
        $yearError = "Field required";
        $year = "";
    } else {
        $year = $_POST["year"];
    }

    if (empty($_POST["registrationid"])) {
        $registrationidError = "Field required";
    } else {
        $registrationid = test_input($_POST["registrationid"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $registrationid)) {
            $registrationidError = "Invalid input";
            $registrationid = "";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneError = "Field required";
    } else {
        $phone = test_input($_POST["phone"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $phone)) {
            $phoneError = "Invalid input";
            $phone = "";
        }
    }

    $profileimage = $_FILES['profileimage']['name'];
    if (!empty($profileimage)) {
        $profileimage_tmp = $_FILES['profileimage']['tmp_name'];
        $ext = strtolower(pathinfo($profileimage, PATHINFO_EXTENSION));
        if ((in_array($ext, ['jpg', 'jpeg', 'png']) == true)) {
            $u_profileimage = md5(time() . $profileimage) . "." . $ext;
            $imgError = "";
            $profileimageError = "";
        } else {
            $imgError = "<p class = 'alert alert-danger '><b>ERROR!</b> Only jpeg, jpg or png file are allowed <button class='close' data-dismiss='alert'>&times;</button></p>";
            $profileimageError = "Field required";
            $u_profileimage = "";
        }
    } else {
        $profileimageError = "Field required";
        $u_profileimage = "";
    }


    //End form data validation//


    if (!empty($firstname) && !empty($lastname) && !empty($gender) && !empty($birthdate) && !empty($roll) && !empty($bloodgroup) && !empty($religion) && !empty($email) && !empty($session) &&  !empty($year) && !empty($registrationid) && !empty($phone) && !empty($u_profileimage)) {

        $conn = connect_database($servername, $username, $password, $dbname);

        if ($conn->connect_errno) {
            $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
        } else {
            // echo "Database connected successfuffy";

            // Email Check in Database While admin Resister...
            function emailCheck($email)
            {
                global $conn;
                $sql = "SELECT * FROM st_info WHERE email = '$email'";
                $com_data = $conn->query($sql);
                $num_rows = $com_data->num_rows;

                if ($num_rows > 0) {
                    return false;
                } else {
                    return true;
                }
            }


            // Roll No check while add student info...
            function checkRoll($roll)
            {
                global $conn;
                $sql = "SELECT * FROM st_info WHERE roll = '$roll'";
                $com_data = $conn->query($sql);
                $num_rows = $com_data->num_rows;

                if ($num_rows > 0) {
                    return false;
                } else {
                    return true;
                }
            }

            // Roll No check while add student info...
            function checkReg($registrationid)
            {
                global $conn;
                $sql = "SELECT * FROM st_info WHERE registration_id = '$registrationid'";
                $com_data = $conn->query($sql);
                $num_rows = $com_data->num_rows;

                if ($num_rows > 0) {
                    return false;
                } else {
                    return true;
                }
            }

            if (emailCheck($email) == false) {
                $emailExistError = "<p class = 'alert alert-danger '><b>ERROR!</b> Email already exist in database, enter new one <button class='close' data-dismiss='alert'>&times;</button></p>";
            } else {
                $emailExistError = "";
            }

            if (checkRoll($roll) == false) {
                $rollExistError = "<p class = 'alert alert-danger '><b>ERROR!</b> Roll already exist in database, enter new one <button class='close' data-dismiss='alert'>&times;</button></p>";
            } else {
                $rollExistError = "";
            }

            if (checkReg($registrationid) == false) {
                $regExistError = "<p class = 'alert alert-danger '><b>ERROR!</b> Registration id already exist in database, enter new one<button class='close' data-dismiss='alert'>&times;</button></p>";
            } else {
                $regExistError = "";
            }

            if (empty($emailExistError) && empty($rollExistError) && empty($regExistError)) {


                $sql = "INSERT INTO st_info(first_name, last_name, gender, birth_date, roll, blood_group, religion, email, session, year, registration_id, phone, profile_image )VALUES('$firstname', '$lastname', '$gender', '$birthdateformate', '$roll','$bloodgroup','$religion','$email','$session','$year','$registrationid','$phone','$u_profileimage')";

                if ($conn->query($sql) === TRUE) {
                    $msg = "<p class = 'alert alert-success '><b>SUCCESS!</b> Data Inserted Successfully <button class='close' data-dismiss='alert'>&times;</button></p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();


                if ($u_profileimage) {
                    move_uploaded_file($profileimage_tmp, 'uploads/st_photo/' . $u_profileimage);
                }

                $firstname = $lastname = $gender =  $birthdate = $roll = $bloodgroup = $religion = $email = $session = $year = $registrationid = $phone = $profileimage = $u_profileimage = "";

                $firstnameError = $lastnameError = $genderError =  $birthdateError = $rollError = $bloodgroupError = $religionError = $emailError = $sessionError = $yearError = $registrationidError = $phoneError = $profileimageError = $imgError = $emailExistError = $rollExistError = $regExistError = "";
            }
        }
    } else {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Any required field Must Not Be Empty <button class='close' data-dismiss='alert'>&times;</button></p>";
    }
}

// Validate input data

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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link href="../node_modules/fontawesome-free-5.15.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/home.css">


    <!--Flaticon -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/fonts/flaticon.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/main.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/jquery.dataTables.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" type="text/css" href="../dist/css/student-info.css">
    <!-- Fontawesome CSS -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    </link>
</head>

<body>
    <?php
    include('../pages/topheader.php');
    include('../pages/navbar.php');
    ?>


    <div class="super-container main-content-area full-width">
        <div class="container custom-notice">
            <h1 class="page-title text-center fw-bolder custom-notice">
                <span>Student's Information</span>
            </h1>
            <nav class="">
                <div class="nav nav-tabs bg-secondary" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">All Students</button>
                    <button onclick="firstYearStudent()" class="nav-link" id="nav-1st-tab" data-bs-toggle="tab" data-bs-target="#nav-1st" type="button" role="tab" aria-controls="nav-1st" aria-selected="false">1st year</button>
                    <button onclick="secondYearStudent()" class="nav-link" id="nav-2nd-tab" data-bs-toggle="tab" data-bs-target="#nav-2nd" type="button" role="tab" aria-controls="nav-2nd" aria-selected="false">2nd year</button>
                    <button onclick="thirdYearStudent()" class="nav-link" id="nav-3rd-tab" data-bs-toggle="tab" data-bs-target="#nav-3rd" type="button" role="tab" aria-controls="nav-3rd" aria-selected="false">3rd year</button>
                    <button onclick="fourthYearStudent()" class="nav-link" id="nav-4th-tab" data-bs-toggle="tab" data-bs-target="#nav-4th" type="button" role="tab" aria-controls="nav-4th" aria-selected="false">4th year</button>
                    <button onclick="msYearStudent()" class="nav-link" id="nav-ms-tab" data-bs-toggle="tab" data-bs-target="#nav-ms" type="button" role="tab" aria-controls="nav-ms" aria-selected="false">MS</button>
                    <button onclick="phdYearStudent()" class="nav-link" id="nav-phd-tab" data-bs-toggle="tab" data-bs-target="#nav-phd" type="button" role="tab" aria-controls="nav-phd" aria-selected="false">MPhil/PhD</button>
                </div>
            </nav>
            <div class="container">
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentData">
                                            <?php while ($st_data = $com_data->fetch_assoc()) : ?>
                                                <tr>
                                                    <td><?php echo $st_data['roll'] ?></td>
                                                    <td class="text-center">
                                                        <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/<?php echo $st_data['profile_image']; ?>" alt="student"></div>
                                                    </td>
                                                    <td><?php echo $st_data["first_name"] . " " . $st_data["last_name"]; ?></td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="studentdetails.php?reg_id=<?php echo $st_data['registration_id']; ?>"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-1st" role="tabpanel" aria-labelledby="nav-1st-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="first-year">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-2nd" role="tabpanel" aria-labelledby="nav-2nd-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="second-year">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-3rd" role="tabpanel" aria-labelledby="nav-3rd-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="third-year">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-4th" role="tabpanel" aria-labelledby="nav-4th-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="fourth-year">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-ms" role="tabpanel" aria-labelledby="nav-ms-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="ms-year">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-phd" role="tabpanel" aria-labelledby="nav-phd-tab">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Students Data</h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Roll</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="phd-year">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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

    <!-- jquery-->
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
    <!-- Data Table Js -->
    <script src="../admin/assets/js/jquery.dataTables.min.js"></script>
    <!-- Custom Js -->
    <script src="../admin/assets/js/main.js"></script>
</body>

</html>
<script>
        // function notice_display(notice_pdf) {
        //     const update_notice_display = "update";
        //     $.ajax({
        //         url: "process.php",
        //         data: {
        //             update_notice_display: update_notice_display
        //         },
        //         type: "POST",
        //         success: function(data, status) {
        //             $('#notice-display').html(`<iframe id="notice" src="../admin/uploads/notice/${notice_pdf}" style="width: 100%; height: 650px;" frameborder="0"></iframe>`);

        //         }

        //     });
        // }

        function firstYearStudent() {
            const update_first_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_first_year_student: update_first_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#first-year').html(data);
                }

            });
        }

        function secondYearStudent() {
            const update_second_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_second_year_student: update_second_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#second-year').html(data);
                }

            });
        }

        function thirdYearStudent() {
            const update_third_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_third_year_student: update_third_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#third-year').html(data);
                }

            });
        }

        function fourthYearStudent() {
            const update_fourth_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_fourth_year_student: update_fourth_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#fourth-year').html(data);
                }

            });
        }

        function msYearStudent() {
            const update_ms_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_ms_year_student: update_ms_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#ms-year').html(data);
                }

            });
        }

        function phdYearStudent() {
            const update_phd_year_student = "update";
            $.ajax({
                url: "process.php",
                data: {
                    update_phd_year_student: update_phd_year_student
                },
                type: "POST",
                success: function(data, status) {
                    $('#phd-year').html(data);
                }

            });
        }
    </script>