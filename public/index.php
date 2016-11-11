<?php

require_once '../vendor/autoload.php';

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

