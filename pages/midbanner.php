<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pundra_cse_dept";
$msg = "";
require_once('../admin/lib/application/databaseconfig.php');

$conn = connect_database($servername, $username, $password, $dbname);
$data = "";
if ($conn->connect_errno) {
    $msg = "<p class = 'alert alert-danger '><b>ERROR!</b> Database connection error occured <button class='close' data-dismiss='alert'>&times;</button></p>";
} else {
    $sql = "SELECT * FROM notice ORDER BY id DESC LIMIT 10";
    $all_notice = $conn->query($sql);
}
$conn->close();
?>
<section class="midbanner">
    <div class="container">
        <div class="row padding-top">
            <div class="col-md-9 text-center">
                <h3 class="pundra row" style="display: inline-block;">DEPT. OF COMPUTER SCIENCE & ENGINEERING <br><span class="text-pust">PUST</span> </h3>

                <p class="pundra-text">
                    <b>About the Department:</b> <br>
                    The Bachelor of Science (B.Sc.) in Computer Science and Engineering (CSE) program is a program of 157-credits, 48 (forty-eight)-month study in a period of 12 semesters. The diploma engineers will get waiver in some courses on the basis of their previous academic records. A student must take normal load of 3 to 4 courses with associated practical courses in a semester, if he/she intends to complete the program within 4 years. The maximum time for completion of the program is 6 (six) years. <br><br>

                    <b>Eligibility of students for admission in CSE program: The students must fulfill the following requirements: </b><br>
                    Applicants must have passed SSC and HSC (or equivalent) examination from Science group with minimum 2nd division in both the examinations or five subjects in O-level and three major subjects (Math, Physics and Chemistry) in A-level education are required. The students who have completed SSC and HSC under GPA system will have to have a minimum CGPA of 2.5. The O- and A-level students must have an average grade of B. <br><br>

                    <b>For Diploma students:</b> <br>
                    Waiver of courses to be given following the guide line of UGC. Those having diploma engineering in Electrical/Electronics/Computer/Power/Mechanical/Telecommunication are also eligible for admission with waivers in some courses as per decision of the departmental equivalence committee. Courses may be exempted only from GED group. Courses from Basic sciences, Mathematics and any engineering course will not be exempted. The total exempted credits must not be more than 13.5 credits.
                </p>
            </div>
            <div class="col-md-3">
                <h2 class="d-flex latest justify-content-center">Latest Notices</h2>
                <marquee class="marquee-notice" behavior="scroll" direction="up" onmouseover="this.stop()" onmouseout="this.start()">
                    <div class="latest-notice">
                        <ul>
                            <?php while ($notice_data = $all_notice->fetch_assoc()) : ?>
                                <div class="notice-list row">
                                    <div class="col-11 shadow-lg p-2 mb-2 bg-body rounded">
                                        <div class="post-date">
                                            <h6 class="post-date bg-skyblue">
                                                <?php echo  date('d', strtotime($notice_data["time_stamp"])) . " " . date('F', mktime(0, 0, 0, date('m', strtotime($notice_data["time_stamp"])), 10)) . " " . date('Y', strtotime($notice_data["time_stamp"])); ?>
                                            </h6>
                                        </div>
                                        <h6 onclick="notice_display('<?php echo $notice_data['notice_pdf']; ?>')" class="notice-title"><a href="./notice.php"><?php echo $notice_data["notice_title"]; ?></a></h6>
                                        <div class="entry-meta"> by admin / <span><?php echo date('h:i:s a', strtotime($notice_data["time_stamp"])); ?></span></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </marquee>
            </div>
        </div>
    </div>
</section>

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
</script>