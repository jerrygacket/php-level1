<?php
$ds = DIRECTORY_SEPARATOR;

define('SITE_ROOT', '..' . $ds);
define('WWW_ROOT', SITE_ROOT . 'public');

define('DATA_DIR', SITE_ROOT . 'data');
define('LIB_DIR', SITE_ROOT . 'engine');
define('TPL_DIR', SITE_ROOT . 'templates');

define('GALLERY_DIR', WWW_ROOT . $ds . 'img');

define('SITE_TITLE', 'Эксклюзивные подушки');
define('SITE_URL', '/');

/* DB config */
define('HOST', 'localhost');
define('USER', 'maria');
define('PASS', 'maria');
define('DB', 'shop');

define('SALT2', 'awOIHO@EN@Oine q2enq2kbkb');

define('ADMIN_ID', 1);
define('ACTIONS', ['del'=>'удален', 'add'=>'добавлен']);
define('STATUSES', ['del'=>'отменен', 'add'=>'новый']);
define('ELEMENTS', ['order'=>'Заказ ', 'good'=>'Товар ']);

require_once(LIB_DIR . $ds . 'db.php');
require_once(LIB_DIR . $ds . 'functions.php');
require_once(LIB_DIR . $ds . 'calcFunc.php');
require_once(LIB_DIR . $ds . 'pageGenerators.php');
require_once(LIB_DIR . $ds . 'authFunc.php');
//require_once(LIB_DIR . $ds . 'logger.php');
require_once(LIB_DIR . $ds . 'cartFunc.php');