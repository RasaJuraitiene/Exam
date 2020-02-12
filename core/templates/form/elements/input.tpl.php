<input <?php print html_attr(['name' => $field_id, 'type' => $field['type'], 'value' => $field['value'] ?? ''] + ($field['extra']['attr'] ?? [])); ?>>
