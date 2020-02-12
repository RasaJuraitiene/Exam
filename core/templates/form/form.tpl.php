<?php if (isset($data) && !empty($data)): ?>
    <div class='form-wrapper'>
        <form <?php print html_attr($data['attr'] ?? ['method' => 'POST']); ?>>

            <!--Start Field Generation-->
            <?php foreach ($data['fields'] as $field_id => $field): ?>
                <div class="field-wrapper">

                    <?php if (isset($field['label'])): ?>
                        <!--If the label is set - print fields inside label-->
                        <label>
                            <span class="label">
                                <?php print $field['label']; ?>
                            </span>
                        <?php endif; ?>

                        <!--fields to be printed-->
                        <?php if (in_array($field['type'], ['hidden', 'text', 'password', 'email', 'number'])): ?>
                            <?php require 'elements/input.tpl.php'; ?>
                        <?php elseif ($field['type'] === 'select'): ?>
                            <?php require 'elements/select.tpl.php'; ?>
                        <?php endif; ?> 

                        <?php if (isset($field['label'])): ?>
                        </label>
                    <?php endif; ?>

                    <?php if (isset($field['error'])): ?>
                        <div class="error-wrapper">
                            <span class="error">
                                <?php print $field['error']; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <!--Field Generator End-->

            <?php if (isset($data['message'])): ?>
                <div class="message-wrapper">
                    <?php print $data['message']; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($data['buttons']) && !empty($data['buttons'])): ?>
                <div class="button-wrapper">

                    <!--Generate all the buttons-->
                    <?php foreach ($data['buttons'] as $button_id => $button): ?>
                        <?php require 'elements/button.tpl.php'; ?>
                    <?php endforeach; ?>
                    <!--Button Generator End-->
                </div>
            <?php endif; ?>
        </form>
    </div>
<?php endif; ?>