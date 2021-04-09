<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$msg = "";
require_once('../admin/lib/application/databaseconfig.php');

if (isset($_POST["update_all_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'all' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_first_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'first' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}


if (isset($_POST["update_second_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'second' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_third_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'third' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_fourth_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'fourth' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_ms_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'ms' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_phd_year"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM notice WHERE category = 'phd' ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($notice_data = $result->fetch_assoc()) {
            $notice_pdf = strval($notice_data['notice_pdf']);
            $data .= '<div class="notice-list row">
            <div class="col-11">
                <div class="post-date bg-skyblue">' . date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])) . '</div>
                <h6  onclick="notice_display(' . '\'' . $notice_data['notice_pdf'] . '\'' . ')" class="notice-title"><a href="#">' . $notice_data["notice_title"] . '</a></h6>
                <div class="entry-meta"> by admin / <span>' . date('h:i:s a', strtotime($notice_data["time_stamp"])) . '</span></div>
            </div>
        </div>';
        }
    }
    $conn->close();
    echo $data;
}






if (isset($_POST["update_first_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE (( session = '2018-19' OR session = '2017-18' ) AND  year = 'first') ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                    </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}


if (isset($_POST["update_second_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE year = 'second' ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                    </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_third_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE year = 'third' ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                    </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_fourth_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE year = 'fourth' ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                     </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_ms_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE year = 'ms' ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                     </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}

if (isset($_POST["update_phd_year_student"])) {
    $conn = connect_database($servername, $username, $password, $dbname);
    $data = "";
    if ($conn->connect_errno) {
        $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
    } else {
        $sql = "SELECT * FROM st_info WHERE year = 'phd' ORDER BY id DESC";
        $com_data = $conn->query($sql);

        while ($st_data = $com_data->fetch_assoc()) {
            $data .= '<tr>
            <td>' . $st_data["roll"] . '</td>
            <td class="text-center">
                <div style="height:30px;width:30px; border-radius:50%; overflow:hidden"><img src="../admin/uploads/st_photo/' . $st_data['profile_image'] . '" alt="student"></div>
            </td>
            <td>' . $st_data["first_name"] . " " . $st_data["last_name"] . '</td>
            <td>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <!-- <span class="flaticon-more-button-of-three-dots"></span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="studentdetails.php?reg_id=' . $st_data['registration_id'] . '"><i class="fa fa-user text-dark-pastel-green"></i>View Profile</a>
                    </div>
                </div>
            </td>
         </tr>';
        }
    }
    $conn->close();
    echo $data;
}
