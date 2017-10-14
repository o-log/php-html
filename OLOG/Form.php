<?php

namespace OLOG;

class Form
{
    const FIELD_NAME_OPERATION_CODE = '_OPERATION_CODE';

    public static function op($operation_code)
    {
        return '<input type="hidden" name="' . self::FIELD_NAME_OPERATION_CODE . '" value="' . HTML::attr($operation_code) . '">';
    }

    public static function match(string $operation_code, callable $callback_arr, string $field = self::FIELD_NAME_OPERATION_CODE)
    {
        // Messages::POST not used to minimize dependencies
        if (isset($_POST[$field])) {
            if ($_POST[$field] == $operation_code) {
                call_user_func($callback_arr);
            }
        }
    }
}