<?php

require_once '../vendor/autoload.php';

use OLOG\Form;

echo \OLOG\HTML::a('/', 'Home');

echo \OLOG\HTML::div('class', '', 'div');

echo \OLOG\HTML::tag(
	'div', [
		'class' => 'class-test',
		'id' => 'id_test'
	],
	function () {
		echo 'text';
	});

echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>';

$create_form_element_id = 'collapse_' . rand(1, 999999);

Form::form(function(){
    Form::input('test', 'bla');
    Form::input('', 'submit', 'submit');
}, '/');

echo \OLOG\MagnificPopup::button($create_form_element_id, '', 'открыть попап');

echo \OLOG\MagnificPopup::popupHtml(
	$create_form_element_id,
	'test content'
);