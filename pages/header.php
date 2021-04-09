
<?php 
    if(isset($_POST['login'])){
    header('location:../pages/login/login.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSE-Dept</title>
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../dist/css/header.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="logo">
                <a class="navbar-logo1" href="#"><img src="../pages/logo/pust.png" alt=""></a>
                <a class="navbar-logo2" href="#"><img src="../pages/logo/cse1.png" alt=""></a>
            </div>

            <form class="register d-flex">
                <a name="login" href="../pages/login.php">Login/Register</a>
            </form>
        </div>
    </nav>



    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav" style="--bs-scroll-height: 100px;">
                    
                    <li class="nav-item">
                        <a class="nav-item active" aria-current="page" href="../pages/home.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                    </a>
                    <ul class="dropdown-menu" style="z-index: 99" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/welcome.php">Welcome to CSE (PUST)</a></li>
                        <li><a class="dropdown-item" href="../pages/history.php">History of CSE (PUST)</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Academic
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/programs.php">Programs</a></li>
                        <li><a class="dropdown-item" href="../pages/admission.php">Admission</a></li>
                        <li><a class="dropdown-item" href="../pages/curriculum.php">Curriculum</a></li>
                        <li><a class="dropdown-item" href="../pages/calender.php">Academic Calender</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        People
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/faculty.php">Faculty</a></li>
                        <li><a class="dropdown-item" href="../pages/staff.php">Staff</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Research
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/research.php">Research</a></li>
                        <li><a class="dropdown-item" href="../pages/publications.php">Publications</a></li>
                        <li><a class="dropdown-item" href="../pages/interest.php">Search|Research Interest</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Announcement
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/events.php">News & Events</a></li>
                        <li><a class="dropdown-item" href="../pages/honor.php">Honor Board</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>

                    <li class="nav-item">
                    <a class="nav-item" href="../pages/notice.php">Notice Board</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-item dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Research
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="../pages/gallery.php">Gallery</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>