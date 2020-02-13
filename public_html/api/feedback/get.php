<?php

require '../../../bootloader.php';

$response = new \Core\Api\Response();

$models = [
    'feedback' => new \App\Feedbacks\Model(),
    'user' => new \App\Users\Model()
];

$conditions = $_POST ?? [];

$feedbacks = $models['feedback']->get($conditions);
if ($feedbacks !== false) {
    foreach ($feedbacks as $feedback) {

        $r_array = $feedback->getData();

        $user = $models['user']->getById($r_array['user_id']);

        $r_array['name'] = $user->getName();

        $r_array['timestamp'] = date('Y/d/m H:i:s', $r_array['timestamp']);

        $sorted = [
            'user_id' => $r_array['user_id'],
            'id' => $r_array['id'],
            'name' => $r_array['name'],
            'feedback' => $r_array['feedback'],
            'timestamp' => $r_array['timestamp']
        ];

        $response->addData($sorted);
    }
} else {
    $response->addError('Could not pull data from database!');
}

$response->print();