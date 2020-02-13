<?php
require '../bootloader.php';

use App\App;

$createForm = new \App\Feedbacks\Views\CreateForm();
$updateForm = new \App\Feedbacks\Views\UpdateForm();
$navigation = new \App\Views\Navigation();
$footer = new \App\Views\Footer();

//if (!App::$session->userLoggedIn()) {
//    header('Location: /login.php');
//}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/milligram.min.css">
    <link rel="stylesheet" href="media/css/style.css">
    <link rel="shortcut icon" href="media/css/fonts/favicon.ico" type="image/x-icon">
</head>
<body>
<header>
    <?php print $navigation->render(); ?>
</header>

<main>

    <div class="banner"><h1 class="banner-text">LUXURY TAXI</h1>
        <h1 class="banner-text"> 24/7</h1></div>
    <section class="wrapper">
        <div class="container">
            <div class="card">
                <img class="card-img" src="media/images/executive-cars_2.jpg">
                <h5 class="service-name">BUSINESS TAXIS</h5>
                <p>Corporate Business Travel with our Luxury Driven Private Taxi Hire.
                    Getting you to your business meeting or corporate event in style, comfort and on time.</P>
            </div>
            <div class="card">
                <img class="card-img" src="media/images/executive-cars_2.jpg">
                <h5 class="service-name">SPECIAL EVENT TAXI</h5>
                <p>Private Vehicle Hire for Special Events, Sporting fixture, Concerts,
                    Theatre and West End Show. Choose our private luxury Taxi to make it a extra special event or
                    occasion.</p>
            </div>
            <div class="card">
                <img class="card-img" src="media/images/executive-cars_2.jpg">
                <h5 class="service-name">PRIVATE AIRPORT TAXIS</h5>
                <p>Airport Taxi Transfer Service take the hassles out of air travel and hire a private car / taxi
                    transfer service to get you to and from Airports.</p>
            </div>
        </div>
    </section>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.2196022783737!2d25.33569661534215!3d54.72335198029064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2sSaul%C4%97tekio%20al.%2015%2C%20Vilnius%2010221!5e0!3m2!1sen!2slt!4v1581541389453!5m2!1sen!2slt"
                width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>

</main>

<!-- Footer -->
<footer>
    <?php print $footer->render(); ?>
</footer>

<!--<script defer src="media/js/app.js"></script>-->
</body>
</html>

