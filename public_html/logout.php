<?php

require '../bootloader.php';

\App\App::$session->logout();

header('Location: /index.php');