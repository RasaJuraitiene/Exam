<?php

function validate_fields_match($filtered_input, &$form, $params)
{
    $match = true;

    foreach ($params as $field_id) {
        $ref_value = $ref_value ?? $filtered_input[$field_id];
        if ($ref_value != $filtered_input[$field_id]) {
            $match = false;
            break;
        }
    }

    if (!$match) {
        $form['fields'][$field_id]['error'] = 'Fields do not match!';
        return false;
    }

    return true;
}

function validate_not_empty($field_value, &$field)
{
    if (strlen($field_value) == 0) {
        $field['error'] = 'Field cannot be empty!';
    } else {
        return true;
    }
}

function validate_no_number($field_value, &$field)
{
    if (!preg_match('/^([^0-9]+)$/', $field_value)) {
        $field['error'] = 'No number please!';
    } else {
        return true;
    }
}