<?php

namespace App\Users\Views;

class RegisterForm extends \Core\Views\Form
{

    public function __construct($data = [])
    {
        $this->data = [
            'attr' => [
                'id' => 'register-form',
                'method' => 'POST',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'extra' => [
                        'validators' => [
                            'validate_not_empty',
                            'validate_no_number',
                            'validate_chars_length' => [
                                'max' => 40
                            ]
                        ]
                    ],
                ],
                'surname' => [
                    'label' => 'Surname',
                    'type' => 'text',
                    'extra' => [
                        'validators' => [
                            'validate_not_empty',
                            'validate_no_number',
                            'validate_chars_length' => [
                                'max' => 40
                            ]
                        ]
                    ],
                ],
                'email' => [
                    'label' => 'Email',
                    'type' => 'email',
                    'extra' => [
                        'validators' => [
                            'validate_not_empty',
                            'validate_mail'
                        ]
                    ],
                ],
                'phone' => [
                    'label' => 'Phone number',
                    'type' => 'text',
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'extra' => [
                        'validators' => [
                            'validate_not_empty'
                        ]
                    ],
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Register',
                ],
            ],
            'validators' => [
                'validate_fields_match' => [
                    'password',
                ]
            ],
            'callbacks' => [
                'success' => 'form_success',
            ],
        ];
    }

}