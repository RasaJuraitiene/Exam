<?php

namespace App\Views;

use App\App;

class Footer extends \Core\View {

    public function render($template_path = ROOT . '/app/templates/footer.tpl.php') {
        return parent::render($template_path);
    }

}
