<?php

namespace Core\Views;

class Form extends \Core\View {  
    
    public function render($template_path = ROOT . '/core/templates/form/form.tpl.php') {
        return parent::render($template_path);
    }

}
