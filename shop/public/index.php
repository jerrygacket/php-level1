<?php
require_once('../config/config.php');

session_start();

if (isset($_GET['action'])) {
    doGetAction();
    exit;
}

if (isset($_POST['action'])) {
    doPostAction();
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