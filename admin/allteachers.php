<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$msg = "";

require_once('./lib/application/databaseconfig.php');

// Registration form data collect & validation check

$firstname = $lastname = $gender =  $birthdate = $bloodgroup = $religion = $email = $phone = $profileimage = $u_profileimage = "";

$firstnameError = $lastnameError = $genderError =  $birthdateError = $bloodgroupError = $religionError = $emailError =   $phoneError = $profileimageError = $imgError = $emailExistError ="";

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


    if (!empty($firstname) && !empty($lastname) && !empty($gender) && !empty($birthdate) && !empty($bloodgroup) && !empty($religion) && !empty($email) && !empty($phone) && !empty($u_profileimage)) {

        $conn = connect_database($servername, $username, $password, $dbname);

        if ($conn->connect_errno) {
            $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
        } else {
            // echo "Database connected successfuffy";

            // Email Check in Database While admin Resister...
            function emailCheck($email)
            {
                global $conn;
                $sql = "SELECT * FROM tr_info WHERE email = '$email'";
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

            if (empty($emailExistError)) {


                $sql = "INSERT INTO tr_info(first_name, last_name, gender, birth_date,blood_group, religion, email,phone, profile_image )VALUES('$firstname', '$lastname', '$gender', '$birthdateformate','$bloodgroup','$religion','$email','$phone','$u_profileimage')";

                if ($conn->query($sql) === TRUE) {
                    $msg = "<p class = 'alert alert-success '><b>SUCCESS!</b> Data Inserted Successfully <button class='close' data-dismiss='alert'>&times;</button></p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();


                if ($u_profileimage) {
                    move_uploaded_file($profileimage_tmp, 'uploads/tr_photo/' . $u_profileimage);
                }

                $firstname = $lastname = $gender =  $birthdate = $roll = $bloodgroup = $religion = $email = $phone = $profileimage = $u_profileimage = "";

                $firstnameError = $lastnameError = $genderError =  $birthdateError = $bloodgroupError = $religionError = $emailError = $phoneError = $profileimageError = $imgError = $emailExistError = $rollExistError = $regExistError = "";
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
    <title>Admin</title>
    <!-- Fontwosome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    </link>
    <!--Flaticon -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Fontawesome CSS -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    </link>
    </link>
</head>

<body>
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php
        include('header.php');
        ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php
            include('sidebar.php');
            ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>All teachers</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Student Table Area Start Here -->
                <?php
                include('allteacherstable.php');
                ?>
                <!-- Student Table Area End Here -->
                <!-- Social Media Start Here -->
                <?php
                include('socialmedia.php');
                ?>
                <!-- Social Media End Here -->

            </div>
        </div>

        <!-- jquery-->
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <!-- proper js -->
        <script src="assets/js/popper.min.js"></script>
        <!-- Counterup Js -->
        <script src="assets/js/jquery.counterup.min.js"></script>
        <!-- Bootstrap js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Moment Js -->
        <script src="assets/js/moment.min.js"></script>
        <!-- Chart Js -->
        <script src="assets/js/Chart.min.js"></script>
        <!-- Waypoints Js -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <!-- Data Table Js -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/main.js"></script>
        <script>
            function update_teacher_table_data() {
                const update_teacher_table = "update";
                $.ajax({
                    url: "teacher-process.php",
                    data: {
                        update_teacher_table: update_teacher_table
                    },
                    type: "POST",
                    success: function(data, status) {
                        $('#teacherData').html(data);

                    }

                });
            }

            function delete_teacher(teacher_id) {
                $.ajax({
                    url: "teacher-process.php",
                    data: {
                        delete_student_id: student_id
                    },
                    type: "POST",
                    success: function(data, status) {
                        update_teacher_table_data();
                    }
                });
            }
        </script>

</body>

</html>