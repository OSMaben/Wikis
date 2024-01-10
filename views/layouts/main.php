<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Articles </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">

</head>

<body>

<header id="header" class="header fixed-top bg-white">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">

            <span>Wiki Wiki</span>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">// Home</a></li>
                <li><a class="nav-link scrollto" href="#about">// About</a></li>
                <li><a class="nav-link scrollto" href="#team">// Writers</a></li>
                <li><a href="blog.html">// Articles</a></li>
                <li><a class="nav-link scrollto" href="#contact">// Contact</a></li>
                <?php
                    if(!isset($_SESSION['role']))
                    {
                        echo "<li><a href='/register' class='getstarted scrollto' style='background: #4154f1;'>Register</a></li>
                                    <li><a href='/login'  class='btn btn-success text-white getstarted' >login</a>
                            </li>";
                    }
                    else
                    {
                        if($_SESSION['role'] == 'Reader'){
                            echo "
                                <div class='dropdown'>
                                       <button class='btn btn-primary mx-4' style='font-family: Nunito, sans-serif; box-shadow: 0px 5px 30px rgba(65, 84, 241, 0.4)'>
                                         // profile
                                      </button>
                                      <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='#'>Profil</a></li>
                                        <li><a class='dropdown-item' href='/addArticle'>Add Articles</a></li>
                                        <li><a class='dropdown-item' href='/logout'>Log Out</a></li>
                                      </ul>
                                    </div>
                            ";
                        }
                        else
                        {
                            echo "!Reader";
                        }
                    }

                ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
<main id="main">

{{content}}

<main>
<footer id="footer" class="footer">

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="">oussama ben mazzi</a>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="../../assets/vendor/aos/aos.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/98nra4kzq0jkue4x6e4z8dkpwyupcgiw50plzo96uz3khn3g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="../../assets/js/main.js"></script>

</body>

</html>