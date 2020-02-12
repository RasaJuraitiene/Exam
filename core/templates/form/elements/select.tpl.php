<select <?php print html_attr(['name' => $field_id, 'type' => $field['type']] + ($field['extra']['attr'] ?? [])); ?>>
    <?php foreach ($field['options'] ?? [] as $option_id => $option): ?>
        <option value="<?php print $option_id; ?>"   <?php print ($field['value'] ?? null) === $option_id ? 'selected' : '' ?>>
            <?php print $option; ?>
        </option>
    <?php endforeach; ?>
</select>