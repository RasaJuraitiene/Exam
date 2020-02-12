<?php


namespace App\Feedbacks\Views;


class BaseForm extends \Core\Views\Form
{

    public function __construct($data = [])
    {
        $this->data = [
            'fields' => [
                'name' => [
                    'label' => 'User Name',
                    'type' => 'text',
                ],
                'review' => [
                    'label' => 'Feedback',
                    'type' => 'text',
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Submit',
                ],
            ]
        ];
    }

}
