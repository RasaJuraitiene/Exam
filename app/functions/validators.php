<?php

function validate_login($filtered_input, &$form)
{
    $login_success = \App\App::$session->login(
        $filtered_input['email'],
        $filtered_input['password']
    );

    if (!$login_success) {
        $userModel = new \App\Users\Model();
        $users = $userModel->get(['email' => $filtered_input['email']]);
        if (!$users) {
            $form['fields']['email']['error'] = 'User with this email do not exist!';
            return false;
        } else {
            $form['fields']['password']['error'] = 'The password you entered is invalid!';
            $form['fields']['password']['value'] = '';
            return false;
        }
    }
    return true;
}

function validate_mail($field_value, &$field)
{
    $userModel = new \App\Users\Model();
    $users = $userModel->get(['email' => $field_value]);

    if ($users) {
        $field['error'] = 'User with this email already registered!';
        return false;
    }

    return true;
}

function validate_chars_length($field_input, &$field, $params)
{
    $l = strlen($field_input);

    if (isset($params['max'])) {
        if ($l > $params['max']) {
            $field['error'] = "Maximum possible characters exceeded (max: {$params['max']})";
            return false;
        }
    }

    return true;
}