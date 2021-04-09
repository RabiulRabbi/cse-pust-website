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
        $phone = "";
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
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <!-- Date picket CSS -->
    <link rel="stylesheet" href="assets/css/datepicker.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
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
                        <li>Admit new student</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard Content Start Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Students</h3>
                            </div>
                        </div>
                        <hr>
                        <?php
                        echo $msg;
                        echo $emailExistError;
                        ?>
                        <form id="tr_registration" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="new-added-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>First Name <span class="error">* <?php echo $firstnameError ?></span></label>
                                    <input name="firstname" type="text" placeholder="" class="form-control" value="<?php echo $firstname ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Last Name <span class="error">* <?php echo $lastnameError ?></span></label>
                                    <input name="lastname" type="text" placeholder="" class="form-control" value="<?php echo $lastname ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Gender <span class="error">* <?php echo $genderError ?></span></label>
                                    <select class="select2" name="gender">
                                        <option value="">Please Select Gender *</option>
                                        <option value="male" <?php if ($gender === "male") {
                                                                    echo "selected";
                                                                } ?>>Male</option>
                                        <option value="female" <?php if ($gender === "female") {
                                                                    echo "selected";
                                                                } ?>>Female</option>
                                        <option value="others" <?php if ($gender === 'others') {
                                                                    echo "selected";
                                                                } ?>>Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Of Birth <span class="error">* <?php echo $birthdateError ?></span></label>
                                    <input name="birthdate" type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker" data-position='bottom right' value="<?php echo $birthdate; ?>">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Blood Group <span class="error">* <?php echo $bloodgroupError ?></span></label>
                                    <select name="bloodgroup" class="select2">
                                        <option value="">Please Select Group *</option>
                                        <option value="A+" <?php if ($bloodgroup === "A+") {
                                                                echo "selected";
                                                            } ?>>A+</option>
                                        <option value="A-" <?php if ($bloodgroup === "A-") {
                                                                echo "selected";
                                                            } ?>>A-</option>
                                        <option value="B+" <?php if ($bloodgroup === "B+") {
                                                                echo "selected";
                                                            } ?>>B+</option>
                                        <option value="B-" <?php if ($bloodgroup === "B-") {
                                                                echo "selected";
                                                            } ?>>B-</option>
                                        <option value="O+" <?php if ($bloodgroup === "O+") {
                                                                echo "selected";
                                                            } ?>>O+</option>
                                        <option value="O-" <?php if ($bloodgroup === "O-") {
                                                                echo "selected";
                                                            } ?>>O-</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Religion <span class="error">* <?php echo $religionError ?></span></label>
                                    <select name="religion" class="select2">
                                        <option value="">Please Select Religion *</option>
                                        <option value="islam" <?php if ($religion === "islam") {
                                                                    echo "selected";
                                                                } ?>>Islam</option>
                                        <option value="hindu" <?php if ($religion === "hindu") {
                                                                    echo "selected";
                                                                } ?>>Hindu</option>
                                        <option value="christian" <?php if ($religion === "christian") {
                                                                        echo "selected";
                                                                    } ?>>Christian</option>
                                        <option value="boddish" <?php if ($religion === "boddish") {
                                                                    echo "selected";
                                                                } ?>>Buddish</option>
                                        <option value="others" <?php if ($religion === "others") {
                                                                    echo "selected";
                                                                } ?>>Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>E-Mail <span class="error">* <?php echo $emailError ?></span></label>
                                    <input name="email" type="email" placeholder="" class="form-control" value="<?php echo $email; ?>">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Phone <span class="error">* <?php echo $phoneError ?></span></label>
                                    <input name="phone" type="text" placeholder="" class="form-control" value="<?php echo $phone; ?>">
                                </div>
                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">Upload Teacher Photo <span class="error">* <?php echo $profileimageError ?></span></label>
                                    <?php echo $imgError ?>
                                    <input name="profileimage" type="file" class="form-control-file" value="raihan.jpg">
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button name="submit" type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                <!-- Dashboard Content End Here -->
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
        <!-- Select 2 Js -->
        <script src="assets/js/select2.min.js"></script>
        <!-- Date Picker Js -->
        <script src="assets/js/datepicker.min.js"></script>
        <!-- Waypoints Js -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/main.js"></script>

</body>

</html>