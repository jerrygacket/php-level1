<?php

// замена пробелов на подчеркивание
function underLine($str) {
	$words = explode(' ',$str);
	return implode('_',$words);
}

// транслитерация
function translit($str,$vocabulary) {
	$result = '';
	/* *
	*  согласно документации 
	* If delimiter is an empty string (""), explode() will return FALSE.
	* поэтому следующий код даст Warning:
	* $tmp = explode('',$str);
	* */
	// разбиваем строку на символы. строка мультибайтовая.
	$charArray = preg_split('//u', $str,-1, PREG_SPLIT_NO_EMPTY);

	foreach ($charArray as $value) {
		$result .= (array_key_exists($value,$vocabulary) ? $vocabulary[$value] : $value);
	}
	
	if (mb_strtoupper($str) === $str) {
		$result = strtoupper($result);
	}
	
	return $result;
}

$vocabulary = [
	'а' => 'a', 'А' => 'A',
	'б' => 'b', 'Б' => 'B',
	'в' => 'v', 'В' => 'V',
	'г' => 'g', 'Г' => 'G',
	'д' => 'd', 'Д' => 'D',
	'е' => 'e', 'Е' => 'E',
	'ё' => 'e', 'Ё' => 'E',
	'ж' => 'zh', 'Ж' => 'Zh',
	'з' => 'z', 'З' => 'Z',
	'и' => 'i', 'И' => 'I',
	'й' => 'y', 'Й' => 'Y',
	'к' => 'k', 'К' => 'K',
	'л' => 'l', 'Л' => 'L',
	'м' => 'm', 'М' => 'M',
	'н' => 'n', 'Н' => 'N',
	'о' => 'o', 'О' => 'O',
	'п' => 'p', 'П' => 'P',
	'р' => 'r', 'Р' => 'R',
	'с' => 's', 'С' => 'S',
	'т' => 't', 'Т' => 'T',
	'у' => 'u', 'У' => 'U',
	'ф' => 'f', 'Ф' => 'F',
	'х' => 'h', 'Х' => 'H',
	'ц' => 'ts', 'Ц' => 'Ts',
	'ч' => 'ch', 'Ч' => 'Ch',
	'ш' => 'sh', 'Ш' => 'Sh',
	'щ' => 'shch', 'Щ' => 'Shch',
	'ъ' => '\'', 'Ъ' => '\'',// может быть вся строка UPPER_CASE
	'ы' => 'y', 'Ы' => 'Y',
	'ь' => '', 'Ь' => '', // может быть вся строка UPPER_CASE
	'э' => 'e', 'Э' => 'E',
	'ю' => 'yu', 'Ю' => 'Yu',
	'я' => 'ya', 'Я' => 'Ya',
];

$inputString = 'Широкая электрификация южных губерний даст мощный толчок подъёму сельского хозяйства';
echo translit(underLine($inputString), $vocabulary).PHP_EOL;
