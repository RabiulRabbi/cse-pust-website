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

    if (!empty($newsTitle) && !empty($u_newsImage) && !empty($newsDescription)) {
        $conn = connect_database($servername, $username, $password, $dbname);

        if ($conn->connect_errno) {
            $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
        } else {

            $sql = "INSERT INTO news(news_title, news_image, news_description)VALUES('$newsTitle', '$u_newsImage','$newsDescription')";

            if ($conn->query($sql) === TRUE) {
                $msg = "<p class = 'alert alert-success '><b>SUCCESS!</b> Data Inserted Successfully <button class='close' data-dismiss='alert'>&times;</button></p>";
                $newsTitle = $newsImage = $newsDescription = "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();


            if ($u_newsImage) {
                move_uploaded_file($img_tmp, 'uploads/news/' . $u_newsImage);
            }
            $newsDescription = $u_newsImage = "";
        };
    } else {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Any required field Must Not Be Empty <button class='close' data-dismiss='alert'>&times;</button></p>";
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
                        <li>News</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard Content Start Here -->
                <div class="row">
                    <!-- Add Notice Area Start Here -->
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Create A News</h3>
                                    </div>
                                </div>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="new-added-form" enctype="multipart/form-data">
                                    <?php echo $msg ?>
                                    <div class="row">
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>News Title<span class="error">* <?php echo $newsTitleError ?></span></label>
                                            <input value="<?php echo $newsTitle; ?>" name="news_title" type="text" placeholder="" class="form-control">
                                        </div>

                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Upload News Image <span class="error">* <?php echo $newsImageError ?></span></label>
                                            <?php echo $imgError ?>
                                            <input name="news_image" type="file" class="form-control-file">
                                        </div>
                                        <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                            <label>News Description<span class="error">* <?php echo $newsDescriptionError ?></span></label>
                                            <textarea type="text" name="news_description" class="form-control" id="exampleFormControlTextarea1" rows="6"><?php echo $newsDescription; ?></textarea>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button name="submit" type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Add Notice Area End Here -->
                    <!-- All Notice Area Start Here -->
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>News</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="notice-board-wrap" id="all-news">
                                    <?php while ($news_data = $all_news->fetch_assoc()) : ?>
                                        <div class="notice-list row">
                                            <div class="col-11 shadow-lg bg-body rounded">
                                                <div class="post-date bg-skyblue"><?php echo  date('d', strtotime($news_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($news_data["time_stamp"])), 10)) . " " . date('Y', strtotime($news_data["time_stamp"])); ?></div>
                                                <div style="height:60px; width:60px;border-radius: 5px; overflow:hidden"><img src="./uploads/news/<?php echo $news_data["news_image"] ?>" alt="">
                                                </div>
                                                <h4 class="notice-title"><a href="#"><?php echo $news_data["news_title"]; ?></a></h4>
                                                <h6 class="notice-description"><a href="#"><?php echo $news_data["news_description"]; ?></a></h6>
                                                <div class="entry-meta"> by admin / <span><?php echo date('h:i:s a', strtotime($news_data["time_stamp"])); ?></span></div>
                                            </div>
                                            <div class="col-1"><button onclick="delete_news(<?php echo $news_data['id']; ?>)" class="btn btn-danger">Delete</button></div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- All Notice Area End Here -->
                </div>
                <!-- Dashboard Content End Here -->
                <!-- Social Media Start Here -->
                <?php
                include('socialmedia.php');
                ?>
                <!-- Social Media End Here -->

            </div>
        </div>
        <div id="txtHint"></div>

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
        <!-- Waypoints Js -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/main.js"></script>

        <script>
            function update_news() {
                const update = "update";
                $.ajax({
                    url: "news-process.php",
                    data: {
                        update_news: update
                    },
                    type: "POST",
                    success: function(data, status) {
                        $('#all-news').html(data);
                    }
                });
            }

            function delete_news(delete_news_id) {
                $.ajax({
                    url: "news-process.php",
                    data: {
                        delete_news_id: delete_news_id
                    },
                    type: "POST",
                    success: function(data, status) {
                        update_news();
                    }
                });
            }
        </script>

</body>

</html>