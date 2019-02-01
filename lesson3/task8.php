<?php

function selectK($city) {
	if (mb_strpos($city,'К') === 0) {
		return $city;
	}
}

$kladr = [
	'Московская область' => [
		'Москва',
		'Зеленоград',
		'Клин',
	],
	'Ленинградская область' => [
		'Санкт-Петербург',
		'Всеволожск',
		'Павловск',
		'Кронштадт',
	],
	'Рязанская область' => [
		'Рязань',
		'Ряжск',
		'Кораблино',
		'Скопин',
		'Красные Починки'
	],
];

foreach ($kladr as $key=>$value) {
	echo $key.':'.PHP_EOL;
	$filtered = array_filter($value, 'selectK');
	echo implode(', ',$filtered).PHP_EOL;
}
