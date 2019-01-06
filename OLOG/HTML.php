<?php
declare(strict_types=1);

/**
 * @author Oleg Loginov <olognv@gmail.com>
 */

namespace OLOG;

class HTML
{
	public static function tag($tag_name, $tag_attribute_arr = [], $html = '')
	{
		if ($tag_name == '') {
			return '';
		}

		if (ClosureService::is_closure($html)) {
			ob_start();
			$html();
			$html = ob_get_clean();
		}

		$tag_attributes = '';
		foreach ($tag_attribute_arr as $tag_attribute => $tag_attribute_str) {
			$tag_attributes .= ' ' . self::attr($tag_attribute) . '="' . self::attr($tag_attribute_str) . '" ';
		}

		return '<' . self::attr($tag_name) . ' ' . $tag_attributes . '>' . $html . '</' . self::attr($tag_name) . '>';
	}

	public static function echoTag($tag_name, $tag_attribute_arr = [], $html = '')
	{
		echo self::tag($tag_name, $tag_attribute_arr, $html);
	}

	public static function a($url, $text, $classes_str = '')
	{
		return self::tag('a', [
			'href' => self::url($url),
			'class' => self::attr($classes_str)
		], $text);
	}

	public static function div($css_class, $id, $html_or_closure)
	{
		if (ClosureService::is_closure($html_or_closure)) {
			ob_start();
			$html_or_closure();
			$html_or_closure = ob_get_clean();
		}

		return self::tag('div', [
			'class' => $css_class,
			'id' => $id
		], $html_or_closure);
	}

    static public function content($value)
    {
        $value = htmlspecialchars((string) $value);
        //$value = preg_replace('@\R@mu', '<br>', $value); // использовать white-space: pre-wrap для вывода строк с переносами внутри
        return $value;
    }
    static public function url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    static public function attr($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5);
    }

}
