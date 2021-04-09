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
require_once('./lib/application/databaseconfig.php');

if (isset($_GET["id"])) {
    $conn = connect_database($servername, $username, $password, $dbname);

    $id = $_GET["id"];

    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM tr_info WHERE id = '$id'";
        $result = $conn->query($sql);
    }
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
                        <li>Student details</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard Content Start Here -->
                <!-- Student Details Area Start Here -->
                <?php while ($tr_data = $result->fetch_assoc()) : ?>
                    <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>About: <?php echo $tr_data["first_name"] . " " . $tr_data["last_name"]; ?></h3>
                                </div>
                            </div>
                            <div class="single-info-details">
                                <div class="item-img">
                                    <img src="./uploads/tr_photo/<?php echo $tr_data["profile_image"] ?>" alt="teacher">
                                </div>
                                <div class="item-content">
                                    <div class="header-inline item-header">
                                        <h3 class="text-dark-medium font-medium"><?php echo $tr_data["first_name"] . " " . $tr_data["last_name"]; ?></h3>
                                    </div>
                                    <div class="info-table table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["first_name"] . " " . $tr_data["last_name"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["gender"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date Of Birth:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["birth_date"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Religion:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["religion"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>E-mail:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["email"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["time_stamp"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["phone"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Blood Group:</td>
                                                    <td class="font-medium text-dark-medium"><?php echo $tr_data["blood_group"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- Student Details Area End Here -->
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
        <!-- Waypoints Js -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/main.js"></script>

</body>

</html>