<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
require_once('../admin/lib/application/databaseconfig.php');

if (isset($_GET["reg_id"])) {
    $conn = connect_database($servername, $username, $password, $dbname);

    $reg_id = $_GET["reg_id"];

    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE registration_id = '$reg_id'";
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
    <link rel="stylesheet" type="text/css" href="../admin/style.css">
    <!-- Fontawesome CSS -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    </link>
</head>

<body>
    <?php
    include('./topheader.php');
    include('./navbar.php');
    ?>

    <?php while ($st_data = $result->fetch_assoc()) : ?>
        <div class="container">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3 class="text-primary">About: <?php echo $st_data["first_name"] . " " . $st_data["last_name"]; ?></h3>
                        </div>
                    </div>
                    <div class="single-info-details">
                        <div class="item-img">
                            <img src="../admin/uploads/st_photo/<?php echo $st_data['profile_image'] ?>" alt="student">
                        </div>
                        <div class="item-content">
                            <div class="header-inline item-header">
                                <h3 class="text-dark-medium font-medium"><?php echo $st_data["first_name"] . " " . $st_data["last_name"]; ?></h3>
                            </div>
                            <div class="info-table table-responsive">
                                <table class="table text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["first_name"] . " " . $st_data["last_name"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["gender"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Birth:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["birth_date"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Religion:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["religion"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>E-mail:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["email"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Admission Date:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["time_stamp"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Year:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["year"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Session:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["session"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Roll:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["roll"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["phone"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Registration Id:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["registration_id"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Blood Group:</td>
                                            <td class="font-medium text-dark-medium"><?php echo $st_data["blood_group"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <?php
        include('./footer.php');
    ?>
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