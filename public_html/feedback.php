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
    <title>Reviews</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/milligram.min.css">
    <link rel="stylesheet" href="media/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body>
<header>
    <?php print $navigation->render(); ?>
</header>

<main>
    <section class="wrapper">
        <div class="block">
            <div id="reviews-table">
                <h3>Feedback:</h3>
                <table>
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Review Content</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                    Rows Are Dynamically Populated-->
                    </tbody>
                </table>
            </div>
        </div>

        <section class="wrapper">
            <?php if (App::$session->userLoggedIn()): ?>
                <div class="block">
                    <?php print $createForm->render(); ?>
                </div>
            <?php else: ?>
                <p>
                    Want to write a feedback? <a href="/register.php">Register!</a>
                </p>
            <?php endif; ?>
            <div id="card-container"></div>
        </section>
        <!-- Update Modal -->
        <div id="update-modal" class="modal">
            <div class="wrapper">
                <span class="close">&times;</span>
                <?php print $updateForm->render(); ?>
            </div>
        </div>
</main>
<!-- Footer -->
<footer>
    <?php print $footer->render(); ?>
</footer>

<script defer src="media/js/feedback.js"></script>
</body>
</html>
