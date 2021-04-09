<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$data = "";
require_once('./lib/application/databaseconfig.php');

if (isset($_POST["update_news"])) {
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


    while ($news_data = $all_news->fetch_assoc()) {
        $post_time = date('d', strtotime($news_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($news_data["time_stamp"])), 10)) . " " . date('Y', strtotime($news_data["time_stamp"]));

        $data .= '<div class="notice-list row">
        <div class="col-11 shadow-lg bg-body rounded">
            <div class="post-date bg-skyblue">' . date('d', strtotime($news_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($news_data["time_stamp"])), 10)) . " " . date('Y', strtotime($news_data["time_stamp"])) . '</div>
            <div style="height:60px; width:60px;border-radius: 5px; overflow:hidden">
                <img  src="./uploads/news/' .$news_data["news_image"]. '" alt="">
            </div>
            <h6 class="notice-title"><a href="#">' . $news_data["news_title"] . '</a></h6>
            <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($news_data["time_stamp"])) . '</span></div>
        </div>
        <div class="col-1"><button onclick="delete_news(' . $news_data['id'] . ')" class="btn btn-danger">Delete</button></div>
    </div>';
    }


    echo $data;
}

if (isset($_POST["delete_news_id"])) {

    $conn = connect_database($servername, $username, $password, $dbname);
    $delete_news_id = $_POST["delete_news_id"];

    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "DELETE FROM news WHERE id=$delete_news_id ";
        $result = $conn->query($sql);
    }
    $conn->close();
}
