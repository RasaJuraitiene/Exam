<?php


namespace App\Feedbacks\Views;

class ApiForm extends \Core\Views\Form
{

    public function __construct($data = [])
    {
        $this->data = [
            'fields' => [
                'review' => [
                    'extra' => [
                        'validators' => [
                            'validate_not_empty',
                            'validate_chars_length' => [
                                'max' => 500
                            ]
                        ]
                    ]
                ],
            ],
            'callbacks' => [
                'success' => 'form_success',
                'fail' => 'form_fail',
            ]
        ];
    }
}