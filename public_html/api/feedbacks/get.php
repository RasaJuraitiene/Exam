<?php

require '../../../bootloader.php';

$response = new \Core\Api\Response();


$models = [
    'review' => new \App\Feedbacks\Model(),
    'user' => new \App\Users\Model()
];

$conditions = $_POST ?? [];

$reviews = $models['review']->get($conditions);
if ($reviews !== false) {
    foreach ($reviews as $review) {

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

        $response->addData($sorted);
    }
} else {
    $response->addError('Could not pull data from database!');
}

$response->print();
