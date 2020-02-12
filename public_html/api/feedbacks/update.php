<?php

use \App\App;

require '../../../bootloader.php';

// Check user authorization
if (!App::$session->userLoggedIn()) {
    $response = new \Core\Api\Response();
    $response->addError('You are not authorized!');
    $response->print();
}

// Filter received data
$form = (new \App\Feedbacks\Views\ApiForm())->getData();
$filtered_input = get_form_input($form);
validate_form($filtered_input, $form);

/**
 * If request passes validation
 * this function is automatically
 * called
 *
 * @param type $filtered_input
 * @param type $form
 */
function form_success($filtered_input, &$form) {
    $response = new \Core\Api\Response();
    $models = [
        'review' => new \App\Feedbacks\Model(),
        'user' => new \App\Users\Model()
    ];

    $conditions = [
        'row_id' => intval($_POST['id'])
    ];

    //gauname areju su $feedbacks objektais (siuo atveju viena objekta arejuje pagal paduota id

//    $user = $models['user']->getById($r_array['user_id']);
    $reviews = $models['review']->get($conditions);
    if (!$reviews) {
        $response->addError('Feedback doesn`t exist!');
    } else {
        $review = $reviews[0];

        //idedame i data holderi naujas vertes, kurias ivede useris
        //ir kurios atejo is javascripto
        $review->setReview($filtered_input['review']);
        $review->setRating($filtered_input['rating']);

        //vertes, kurias idejome auksciau i data holderi updatinam
        //ir duombazeje FileDB ka daro $drinksModel->update($drink) metodas
        $models['review']->update($review);

        $r_array = $review->getData();
//        unset($r_array['id']);
        $user = $models['user']->getById($r_array['user_id']);

        $r_array['full_name'] = $user->getName() . ' ' . $user->getSurname();

        $r_array['timestamp'] = since($r_array['timestamp']);
        $sorted = [
            'id' => $r_array['id'],
            'review' => $r_array['review'],
            'rating' => $r_array['rating'],
            'full_name' => $r_array['full_name'],
            'timestamp' => $r_array['timestamp']
        ];

        $response->setData($sorted);

    }

    $response->print();
}

/**
 * If request fails validation
 * this function is automatically
 * called
 *
 * @param type $filtered_input
 * @param type $form
 */
function form_fail($filtered_input, &$form) {
    $response = new \Core\Api\Response();

    foreach ($form['fields'] as $field_id => $field) {
        if (isset($field['error'])) {
            $response->addError($field['error'], $field_id);
        }
    }

    $response->print();
}