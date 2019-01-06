<?php
declare(strict_types=1);

/**
 * @author Oleg Loginov <olognv@gmail.com>
 */

namespace OLOG;

class Form
{
    const FIELD_NAME_OPERATION_CODE = '_OPERATION_CODE';

    static public function form($content, string $action, string $method = 'post', array $classes_arr = [], array $attrs_arr = []){
        if (ClosureService::is_closure($content)) {
            ob_start();
            $content();
            $content_html = ob_get_clean();
        } else {
            $content_html = $content;
        }

        if (!empty($classes_arr)){
            $classes_str = implode(' ', $classes_arr);
            $attrs_arr['class'] = $classes_str;
        }

        $attrs_arr['action'] = $action;
        $attrs_arr['method'] = $method;

        echo HTML::tag('form', $attrs_arr, $content_html);
    }

    static public function input(string $name, string $value, string $type = 'text', array $classes_arr = [], array $attrs_arr = [])
    {
        $attrs_arr['name'] = $name;
        $attrs_arr['value'] = $value;
        $attrs_arr['type'] = $type;

        if (!empty($classes_arr)){
            $classes_str = implode(' ', $classes_arr);
            $attrs_arr['class'] = $classes_str;
        }

        echo HTML::tag('input', $attrs_arr, '');
    }

    static public function op($operation_code)
    {
        return '<input type="hidden" name="' . self::FIELD_NAME_OPERATION_CODE . '" value="' . HTML::attr($operation_code) . '">';
    }

    static public function match(string $operation_code, callable $callback, string $field = self::FIELD_NAME_OPERATION_CODE)
    {
        // Messages::POST not used to minimize dependencies
        if (isset($_POST[$field])) {
            if ($_POST[$field] == $operation_code) {
                call_user_func($callback);
            }
        }
    }
}
