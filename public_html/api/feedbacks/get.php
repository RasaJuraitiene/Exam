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
        $user = $models['user']->getById($r_array['id']);

        $r_array['name'] = $user->getName();

        $r_array['timestamp'] = since($r_array['timestamp']);

        $sorted = [
            'id' => $r_array['id'],
            'name' => $r_array['name'],
            'review' => $r_array['review'],
            'timestamp' => $r_array['timestamp']
        ];

        $response->addData($sorted);
    }
} else {
    $response->addError('Could not pull data from database!');
}

$response->print();
