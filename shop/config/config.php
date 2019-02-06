<?php
$ds = DIRECTORY_SEPARATOR;

define('SITE_ROOT', '..' . $ds);
define('WWW_ROOT', SITE_ROOT . 'public');

define('DATA_DIR', SITE_ROOT . 'data');
define('LIB_DIR', SITE_ROOT . 'engine');
define('TPL_DIR', SITE_ROOT . 'templates');

define('GALLERY_DIR', WWW_ROOT . $ds . 'img');

define('SITE_TITLE', 'Эксклюзивные подушки');

/* DB config */
define('HOST', 'localhost');
define('USER', 'maria');
define('PASS', 'maria');
define('DB', 'shop');

require_once(LIB_DIR . $ds . 'functions.php');
require_once(LIB_DIR . $ds . 'db.php');

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