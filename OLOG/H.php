<?php

namespace OLOG;

class H
{
    static public function form($content, string $action, string $method = 'post', array $classes_arr = [], array $attrs_arr = []){
        if (is_callable($content)) {
            ob_start();
            $content();
            $content_html = ob_get_clean();
        } else {
            $content_html = $content;
        }

        $attrs_arr['class'] = implode(' ', $classes_arr);
        $attrs_arr['action'] = $action;
        $attrs_arr['method'] = $method;

        self::tag('form', $content_html, $attrs_arr);
    }

    static public function input(string $name, string $value, string $type = 'text', array $classes_arr = [], array $attrs_arr = [])
    {
        $attrs_arr['name'] = $name;
        $attrs_arr['value'] = $value;
        $attrs_arr['type'] = $type;
        $attrs_arr['class'] = implode(' ', $classes_arr);

        self::tag('input', '', $attrs_arr);
    }

    static public function tag($tag_name, $content, $tag_attribute_arr = [])
    {
        if ($tag_name == '') {
            return;
        }

        if (is_callable($content)) {
            ob_start();
            $content();
            $content = ob_get_clean();
        }

        $tag_attributes = '';
        foreach ($tag_attribute_arr as $tag_attribute => $tag_attribute_str) {
            $tag_attributes .= ' ' . self::attr($tag_attribute) . '="' . self::attr($tag_attribute_str) . '" ';
        }

        echo '<' . self::attr($tag_name) . ' ' . $tag_attributes . '>' . $content . '</' . self::attr($tag_name) . '>';
    }

    static public function a($url, $text, array $classes_arr = [])
    {
        self::tag('a', $text, [
            'href' => self::url($url),
            'class' => implode(' ', $classes_arr)
        ]);
    }

    static public function h2($text, $classes_arr = [])
    {
        self::tag('h2', $text, [
            'class' => implode(' ', $classes_arr)
        ]);
    }

    static public function div($content_html_or_callable, array $classes_arr = [], $id = '')
    {
        if (is_callable($content_html_or_callable)) {
            ob_start();
            $content_html_or_callable();
            $content_html = ob_get_clean();
        } else {
            $content_html = $content_html_or_callable;
        }

        self::tag('div', $content_html, [
            'class' => implode(' ', $classes_arr),
            'id' => $id
        ]);
    }

    static public function content($value)
    {
        $value = htmlspecialchars($value);
        //$value = preg_replace('@\R@mu', '<br>', $value); // использовать white-space: pre-wrap для вывода строк с переносами внутри
        return $value;
    }
    static public function url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    static public function attr($value)
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5);
    }

}