<?php
$configPath = dirname(__DIR__) . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'config.php';

require_once($configPath);

$pageName = ($_GET['pageName'] ?? '');

$title = SITE_TITLE;
$brandName = 'BrandName';

require_once('html/head.html');
require_once('html/menu.html');

$htmlFileName = 'html/' . $pageName . '.html';
if ($pageName != '') {
	if (file_exists($htmlFileName)) {

		switch ($pageName) {
			case 'catalog':
				$pageTitle = 'Каталог';
				break;
			case 'gallery':
				$pageTitle = 'Галерея';
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
