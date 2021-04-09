<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$msg = "";
require_once('../admin/lib/application/databaseconfig.php');

$newsTitle = $newsImage = $msg = $newsDescription = "";
$newsImageError = $imgError = $newsTitleError = $newsDescriptionError = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["news_title"])) {
        $newsTitleError = "Field required";
        $newsTitle = "";
    } else {
        $newsTitle = test_input($_POST["news_title"]);
        $newsTitleError = "";
    }

    if (empty($_POST["news_description"])) {
        $newsDescriptionError = "Field required";
        $newsDescription = "";
    } else {
        $newsDescription = test_input($_POST["news_description"]);
        $newsDescriptionError = "";
    }


    $newsImage = $_FILES['news_image']['name'];
    if (!empty($newsImage)) {
        $img_tmp = $_FILES['news_image']['tmp_name'];
        $ext = strtolower(pathinfo($newsImage, PATHINFO_EXTENSION));
        if ((in_array($ext, ['jpg', 'png', 'jpeg']) == true)) {
            $u_newsImage = md5(time() . $newsImage) . "." . $ext;
            $imgError = "";
            $newsImageError = "";
        } else {
            $imgError = "<p class = 'alert alert-danger '><b>ERROR!</b> Only jpg, png & jpeg files are allowed <button class='close' data-dismiss='alert'>&times;</button></p>";
            $newsImageError = "Field required";
            $u_newsImage = "";
        }
    } else {
        $newsImageError = "Field required";
        $u_newsImage = "";
    }

    
}

function get_all_news()
{
    global $servername;
    global $username;
    global $password;
    global $dbname;
    $conn = connect_database($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM news ORDER BY id DESC ";
        $result = $conn->query($sql);
        return $result;
    }
    $conn->close();
}

$all_news = get_all_news();


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
    <title>News-PUST</title>
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
            <div class="row" style="width: 100%; height: 750px;">
                <div class="tab-content" id="nav-tabContent">


                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>News</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="notice-board-wrap" id="allNotice" style="width: 100%; height: 600px;">
                                    <?php while ($news_data = $all_news->fetch_assoc()) : ?>
                                        <div class="notice-list row">
                                            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                                                <div class="post-date bg-skyblue"><?php echo  date('d', strtotime($news_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($news_data["time_stamp"])), 10)) . " " . date('Y', strtotime($news_data["time_stamp"])); ?></div>
                                                <div style="height:60px;width:60px; border-radius:5%; overflow:hidden"><img src="../admin/uploads/news/<?php echo $news_data['news_image']; ?>" alt="newsPhoto"></div>
                                                <h4 class="notice-title"><a href="#"><?php echo $news_data["news_title"]; ?></a></h4>
                                                <h6 class="notice-description"><a href="#"><?php echo $news_data["news_description"]; ?></a></h6>
                                                <div class="entry-meta"> by admin / <span><?php echo date('h:i:s a', strtotime($news_data["time_stamp"])); ?></span></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
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

</body>

</html>