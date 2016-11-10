<?php

namespace OLOG;

class HTML
{
    static public function a($url, $text, $classes_str = '')
    {
        return '<a class="' . Sanitize::sanitizeAttrValue($classes_str) . '" href="' . Sanitize::sanitizeUrl($url) . '">' . Sanitize::sanitizeTagContent($text) . '</a>';
    }

    public static function div($css_class, $id , $html) {
        if (is_callable($html)) {
            ob_start();
            $html();
            $html = ob_get_clean();
        }
        $class = $css_class ? 'class="' . Sanitize::sanitizeAttrValue($css_class) . '"' : '';
        $id = $id ? 'id="' . $id . '"' : '';
        return  '<div ' . $class . '  ' . $id . '>' . $html . '</div>';
    }
}