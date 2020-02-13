<?php

use App\App;

require '../../../bootloader.php';

$response = new \Core\Api\Response();

if (App::$session->userLoggedIn()) {

    $model = new \App\Reviews\Model();

    // fetch-as atsiunčia į šitą failą POST metodu duomenis (REQUEST)
    // tie duomenys tai yra formData
    //
    // Į formData buvom įtraukę drink'o id. Vadinasi POST'e indeksu id rasim
    // to drink'o id verte.
    //
    // Zinodami koks drinko eilutes id, galime su model'iu issitraukti
    // ta drinka. Bet get funkcija atiduoda ne "iskart" ta drinka
    // bet visada ideda ji i masyva. (nes funkcija pritaikyta atiduoti ir daugiau drinku
    // nei viena)
    // Todel pavadinam variabla ne drink, o drinks.
    $reviews = $model->get(['row_id' => intval($_POST['id'])]);

    if ($reviews) {
        $person = $reviews[0];
        $model->delete($person);

        $response->setData($person->getData());
    } else {
        $response->addError('Review doesn`t exist');
    }
} else {
    $response->addError('Authorization failed!');
}

$response->print();

