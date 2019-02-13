<?php
require_once('../config/config.php');

session_start();

if (isset($_GET['action'])) {
    $action = strtolower($_GET['action'] ?? '');
    $cartFunction = $action . 'Cart';
    if (is_callable($cartFunction)) {
        if ($cartFunction()) {
//            $response = ['result' => 1, 'data' => print_r($_SESSION,true)];
            $response = ['result' => 1];
        } else {
            $response = [
                'result' => 0,
                'errorMessage' => 'ошибка работы с сессионными куками'
            ];
        }
    } else {
        $response = [
            'result' => 0,
            'errorMessage' => 'нет такой функции ' . $action
        ];
    }
    echo json_encode($response);
    exit;
}

$urlArray = explode('/', $_SERVER['REQUEST_URI']);

$variables = prepareVariables($urlArray);
$variables['SITEROOT'] = 'http://shop';

$pageContent = renderPage('head', ['SITE_TITLE' => SITE_TITLE, 'SITE_URL' => SITE_URL]);
$pageContent .= renderPage('menu',[
    'SITEROOT' => 'http://shop',
    'personmenu' => $variables['personmenu'],
    'loginlink' => $variables['loginlink'],
    'logintext' => $variables['logintext'],
    'personmenu' => $variables['personmenu'],
]);
$pageContent .= renderPage('header',[
    'PAGETITLE' => $variables['pagetitle'] ?? 'Магазин эксклюзивных подушек',
    'PAGEDESCRIPTION' => 'Приветственный текст Lorem ipsum',
]);
$pageContent .= renderPage($variables['tpl'] ?? $variables['pagename'], $variables);
$pageContent .= renderPage('footer', ['CURRENT_YEAR' => date('Y')]);

echo $pageContent;