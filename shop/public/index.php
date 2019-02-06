<?php
require_once('../config/config.php');

$page_name = ($_GET['pagename'] ?? 'index');

$variables = prepareVariables($page_name);

echo renderPage('head', ['SITE_TITLE' => SITE_TITLE, 'SITEROOT' => 'localhost']);
echo renderPage('menu');
echo renderPage($page_name, $variables);
echo renderPage('footer', ['CURRENT_YEAR' => date('Y')]);
