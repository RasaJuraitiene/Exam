<?php

/**
 * Generates HTML attributes
 * @param array $attributes
 * @return string
 */
function html_attr($attributes) {
    $html_attr_arr = [];

    foreach ($attributes as $attribute_key => $attribute_value) {
        $html_attr_arr[] = strtr('@key="@value"', [
            '@key' => $attribute_key,
            '@value' => $attribute_value
        ]);
    }

    return implode(' ', $html_attr_arr);
}
