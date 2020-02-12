<?php
require '../bootloader.php';

$form = new \App\Users\Views\RegisterForm();
$navigation = new \App\Views\Navigation();
$footer = new \App\Views\Footer();

function form_success($filtered_input, &$form)
{
    $user = new \App\Users\User($filtered_input);

    $model = new \App\Users\Model();
    $model->insert($user);

    $form['message'] = 'Registration successful! You can login!';
}

switch (get_form_action()) {
    case 'submit':
        $filtered_input = get_form_input($form->getData());
        $success = validate_form($filtered_input, $form->getData());
        break;

    default:
        $success = false;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/milligram.min.css">
    <link rel="stylesheet" href="media/css/style.css">
    <link rel="shortcut icon" href="media/css/fonts/favicon.ico" type="image/x-icon">
    <link rel="icon" href="media/css/fonts/favicon.ico" type="image/x-icon">
    <!--    <script defer src="media/js/app.js"></script>-->
</head>
<body>
<!-- Header -->
<header>
    <?php print $navigation->render(); ?>
</header>

<!-- Main Content -->
<main>
    <section class="wrapper">
        <div class="block">
            <?php if ($success): ?>
                <h1>Registration successful!</h1>
                <p>
                    You can login <a href="/login.php">here!</a>
                </p>
            <?php else: ?>
                <h1>Register:</h1>

                <!-- Register Form -->
                <?php print $form->render(); ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Footer -->
<footer>
    <?php print $footer->render(); ?>
</footer>
</body>
</html>
