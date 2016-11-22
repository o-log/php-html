<?php

namespace OLOG;

class MagnificPopup
{
	public static function button($create_form_element_id, $button_classes = 'btn btn-primary btn-sm', $button_contents_html = '<span class="glyphicon glyphicon-plus"></span>')
	{
		$html = '';

		static $_magnific_popup_scripts_on_page = false;

		if (!$_magnific_popup_scripts_on_page) {
			$html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">';
			$html .= '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>';
			$_magnific_popup_scripts_on_page = true;
		}

		$html .= HTML::tag('a', [
			'href' => '#' . $create_form_element_id,
			'class' => 'open-' . $create_form_element_id . ' ' . $button_classes
		], $button_contents_html);

		ob_start(); ?>
		<script>
			$(function () {
				$(".open-<?= $create_form_element_id ?>").magnificPopup({type: "inline", midClick: true});
			});
		</script>
		<?php
		$html .= ob_get_clean();

		return $html;
	}

	public static function popupHtml($create_form_element_id, $create_form_html)
	{
		$html = HTML::tag('div', [
			'id' => $create_form_element_id,
			'class' => 'mfp-hide',
			'style' => 'position: relative;width: auto;max-width: 700px;margin: 20px auto;padding: 50px 20px 30px 20px;background-color: #ffffff;'
		], $create_form_html);

		return $html;
	}
}