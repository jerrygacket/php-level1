<?php

// получаем вложенный список рекурсивно
// хедером для вложенного списка будет пункт из верхнего списка
function getUlist($listHeader,$items) {
	echo '<li>'.$listHeader.'</li>'.PHP_EOL;
	echo '<ul>'.PHP_EOL;
	foreach ($items as $key => $item) {
		if (is_array($item)) {
			getUlist($key, $item);
		} else {
			echo '<li>'.$key.': '.$item.'</li>'.PHP_EOL;
		}
	}
	echo '</ul>'.PHP_EOL;
}

$pageName = ($_GET['pageName'] ?? '');

$title = 'Эксклюзивные подушки';
$brandName = 'BrandName';
$props = [
	'Имя' => 'Продукт1',
	'Вес' => '5 кг',
	'Выбор цвета' => [
		'Цвет1' => 'Синий',
		'Цвет2' => 'Красный',
		'Непонятный' => ['R' => '159', 'G' => '35', 'B' => '75'],
	],
	'Длина' => '100 см',
	'Выбор цвета еще раз' => [
		'Цвет1' => 'Синий',
		'Цвет2' => 'Красный',
	],
	'Доставка' => '500 рублей',
];

require_once('html/head.html');
require_once('html/menu.html');

$htmlFileName = 'html/' . $pageName . '.html';
if ($pageName != '') {
	if (file_exists($htmlFileName)) {
		
		switch ($pageName) {
			case 'catalog': 
				$pageTitle = 'Каталог';
				break;
			case 'product': 
				$pageTitle = 'Подушка';
				break;
			case 'contacts': 
				$pageTitle = 'Контакты';
				break;
		}
		
		require_once($htmlFileName);
	} else {
		$pageTitle = '404: Страница не найдена';
		require_once('html/404.html');
	}
} else {
	$pageTitle = 'Главная';
	require_once('html/main.html');
}

require_once('html/footer.html');
