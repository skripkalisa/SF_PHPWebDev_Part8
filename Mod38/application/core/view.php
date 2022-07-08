<?php
class View
{
    public function generate($content_view, $template_view, $data = null)
    {
        include LAYOUT . $template_view;
    }
}
