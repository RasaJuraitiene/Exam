<button <?php print html_attr(['name' => 'action', 'value' => $button_id] + ($button['extra']['attr'] ?? [])); ?>>
        <?php print $button['title'] ?? ''; ?>
</button>