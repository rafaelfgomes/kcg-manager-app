<?php

namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Response;

class IndexWebController {
    public function __invoke()
    {
        ob_start(function() {
            return getHtmlTemplate();
        });

        return new Response(ob_get_flush());
    }
}
