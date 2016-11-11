<?php

namespace OLOG;

class HTML
{
	public static function tag($tag_name, $tag_attribute_arr = [], $html)
	{
		if ($tag_name == '') {
			return '';
		}

		if (is_callable($html)) {
			ob_start();
			$html();
			$html = ob_get_clean();
		}

		$tag_attributes = '';
		foreach ($tag_attribute_arr as $tag_attribute => $tag_attribute_str) {
			if ($tag_attribute_str == '') {
				continue;
			}
			$tag_attributes .= ' ' . Sanitize::sanitizeAttrValue($tag_attribute) . '="' . Sanitize::sanitizeAttrValue($tag_attribute_str) . '" ';
		}

		return '<' . Sanitize::sanitizeAttrValue($tag_name) . ' ' . $tag_attributes . '>' . $html . '</' . Sanitize::sanitizeAttrValue($tag_name) . '>';
	}

	static public function a($url, $text, $classes_str = '')
	{
		return self::tag('a', [
			'href' => Sanitize::sanitizeUrl($url),
			'class' => Sanitize::sanitizeAttrValue($classes_str)
		], $text);
	}

	public static function div($css_class, $id, $html)
	{
		if (is_callable($html)) {
			ob_start();
			$html();
			$html = ob_get_clean();
		}

		return self::tag('div', [
			'class' => $css_class,
			'id' => $id
		], $html);
	}
}