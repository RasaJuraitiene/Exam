<?php


namespace App\Feedbacks\Views;


class BaseForm extends \Core\Views\Form
{
    public function __construct($data = [])
    {
        $this->data = [
            'fields' => [
                'review' => [
                    'label' => 'Write a review:',
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