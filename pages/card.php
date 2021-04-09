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
      $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 6";
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<div class="card-section">
   <div class="container">
      <div class="card-header">
         <h3 class="mt-3 pb-3 mb-4">
            Recent News & Events
         </h3>
      </div>
      <div class="row">
         <?php while ($news_data = $all_news->fetch_assoc()) : ?>
            <div class="col-md-4">
               <div class="card">
                  <img class="card-img-top" <img src=" ../admin/uploads/news/<?php echo $news_data["news_image"]; ?>"" alt=" Card image cap">
                  <div class="card-body">
                     <h5 class="card-title border-bottom pb-3"><?php echo $news_data["news_title"]; ?><a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                     <p class="card-text"><?php echo $news_data["news_description"]; ?></p>
                     <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
                  </div>
               </div>
            </div>
         <?php endwhile; ?>
         <!--          
         <div class="col-md-4">
            <div class="card">
               <img class="card-img-top" src="./images/bg-1.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title border-bottom pb-3">Card title <a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card bg-light">
               <img class="card-img-top" src="./images/bg-1.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title border-bottom pb-3">Card title <a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="card">
               <img class="card-img-top" src="./images/bg-1.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title border-bottom pb-3">Card title <a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card">
               <img class="card-img-top" src="./images/bg-1.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title border-bottom pb-3">Card title <a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card bg-light">
               <img class="card-img-top" src="./images/bg-1.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title border-bottom pb-3">Card title <a href="#" class="float-right btn btn-sm btn-info d-inline-flex share"><i class="fas fa-share-alt"></i></a></h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-sm float-right">Read more <i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div> -->
      </div>
      <div class="card-see d-flex justify-content-end">
         <span><a href="./news.php">See all news...</a></span>
      </div>
      <hr>
   </div>
</div>