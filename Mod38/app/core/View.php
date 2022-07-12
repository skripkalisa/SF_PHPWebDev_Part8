<?php

namespace App\core;

class View
{
    public function generate($content_view, $template_view = null, $data = null)
    {
        if ($template_view) {
            include_once LAYOUT.$template_view;
        }
    }
}
