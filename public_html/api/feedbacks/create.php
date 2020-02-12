<?php

use App\App;

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
function form_success($filtered_input, $form)
{
    $response = new \Core\Api\Response();

    $review = new \App\Feedbacks\Feedback();

    $models = [
        'review' => new \App\Feedbacks\Model(),
        'user' => new \App\Users\Model()
    ];

    $user = \App\App::$session->getUser();

    $review->setUserId($user->getId());

    $review->setReview($filtered_input['review']);

    $review->setTimestamp(time());

    $models['review']->insert($review);

    $r_array = $review->getData();
//    $r_array = $user->getData();
//    unset($r_array['id']);

    $r_array['full_name'] = $user->getName() . ' ' . $user->getSurname();

    $r_array['timestamp'] = since($r_array['timestamp']);

    $sorted = [
        'id' => $r_array['id'],
        'review' => $r_array['review'],
        'full_name' => $r_array['full_name'],
        'timestamp' => $r_array['timestamp']
    ];

    $response->setData($sorted);

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
function form_fail($filtered_input, $form)
{
    $response = new \Core\Api\Response();

    foreach ($form['fields'] as $field_id => $field) {
        if (isset($field['error'])) {
            $response->addError($field['error'], $field_id);
        }
    }

    $response->print();
}

