<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

/*
* Обрабатывает указанный шаблон, подставляя нужные переменные
*/
function renderPage($page_name, $variables = [])
{
    $file = TPL_DIR . "/" . $page_name . ".tpl";

    if (!is_file($file)) {
      	echo 'Template file "' . $file . '" not found';
      	exit(ERROR_NOT_FOUND);
    }

    if (filesize($file) === 0) {
      	echo 'Template file "' . $file . '" is empty';
      	exit(ERROR_TEMPLATE_EMPTY);
    }

    // если переменных для подстановки не указано, просто
    // возвращаем шаблон как есть
    $templateContent = file_get_contents($file);
    if (!empty($variables)) {
        // заполняем значениями
        $templateContent = pasteValues($variables, $page_name, $templateContent);
    }

    return $templateContent;
}

function pasteValues($variables, $page_name, $templateContent){
    foreach ($variables as $key => $value) {
        if (isset($value)) {
            // собираем ключи
            $p_key = '{{' . strtoupper($key) . '}}';

            if(is_array($value)){
                // замена массивом
                $result = "";
                foreach ($value as $value_key => $item){
                    $itemTemplateContent = file_get_contents(TPL_DIR . "/" . $page_name ."_".$key."_item.tpl");

                    foreach($item as $item_key => $item_value){
                        $i_key = '{{' . strtoupper($item_key) . '}}';

                        $itemTemplateContent = str_replace($i_key, $item_value, $itemTemplateContent);
                    }

                    $result .= $itemTemplateContent;
                }
            }
            else
                $result = $value;

            $templateContent = str_replace($p_key, $result, $templateContent);
        }
    }

    return $templateContent;
}

function prepareVariables($page_name){
    $vars = [];
    switch ($page_name){
        case "news":
            $vars["newsfeed"] = getRow('news');
            $vars["test"] = 123;
            break;
        case "newspage":
            $content = getItemContent('news', $_GET['id_news']);
            $vars["news_title"] = $content["news_title"];
            $vars["news_content"] = $content["news_content"];
            break;
        case "gallery":
            if (isset($_POST['newfile'])) {
                print_r(addImage());
            }
            $vars["gallery"] = getRow('gallery');
            $vars["pagetitle"] = 'Галерея картинок';
            break;
        case "image":
            $content = getItemContent('gallery', $_GET['image_id']);
            $vars["pagetitle"] = 'Картинка ' . $content['name'];
            $vars["name"] = $content['name'];
            $vars["description"] = $content['description'];
            $vars["views"] = $content['views'];
            $vars["filesize"] = $content['filesize'];
            $vars["filepath"] = $content['filepath'];
            break;
        case "calcs":
            $vars["pagetitle"] = 'Калькуляторы';
            $vars["result1"] = '';
            $vars["result2"] = '';
            $formNumber = (int) ($_POST['calcForm'] ?? '0');
            $vars['result' . $formNumber] = calculateForm();
            break;
        case "catalog":
            $vars["pagetitle"] = 'Каталог';
            $vars["products"] = getRow('products');
            break;
        case "product":
            if(isset($_POST['action'])) {
                doFeedbackAction($_POST['action']);
            }
            $vars = getProductContent($_GET['productid']) ?? 'нет опций';
            $vars["pagetitle"] = $vars['name'];
            $vars["productid"] = $_GET['productid'];
            $feedbacks = doFeedbackAction('read');
            $vars["feedback"] = $feedbacks ?? 'нет отзывов';
            break;
    }
    return $vars;
}

function getRow($tableName) { // собираем список (новостей, товаров. ккартинок и т.п.)
    switch ($tableName) {
        case 'news':
            $sql = "SELECT id_news, news_title, news_preview FROM news";
            break;
        case 'gallery':
            $sql = 'SELECT id,filepath,name,views FROM gallery ORDER BY views DESC';
            break;
        case 'products':
            $sql = "SELECT * FROM products ORDER BY views DESC";
            break;
    }

    return getAssocResult($sql);
}

function getItemContent($tableName, $itemId) { // собираем отельный элемент (картинка, новость)
    $itemId = (int)$itemId;

    $sql = 'SELECT * FROM ' . $tableName . ' WHERE id = '.$itemId;
    $response = getAssocResult($sql);

    $result = [];
    if(isset($response[0])) {
        $result = $response[0];

        if (isset($result['views'])) {
            $result['views']++;
            $sql = 'UPDATE ' . $tableName . ' SET views = views + 1 WHERE id = '.$itemId;
            executeQuery($sql);
        }

    }

    return $result;
}

function getProductContent($itemId) { // собираем товар. здесь идет джоин с таблицами опций
    $itemId = (int) $itemId;

    $sql = <<<SQL
SELECT products.name,imgbig,img,intro,products.description,size,views,fabric.name as fabric,paint.name as paint FROM products 
LEFT JOIN fabric ON fabric.id = products.fabricid
LEFT JOIN paint ON paint.id = products.paintid
WHERE products.id = "$itemId"
SQL;

    $response = getAssocResult($sql);

    $result = [];
    if(isset($response[0])) {
        $result = $response[0];

        if (isset($result['views'])) {
            $result['views']++;
            $sql = 'UPDATE products SET views = views + 1 WHERE id = '.$itemId;
            executeQuery($sql);
        }
    }
    return $result;
}

function doFeedbackAction(string $action) { // crud для фидбэков
    switch ($action) {
        case 'create':
            $sql = 'INSERT INTO feedbacks (productid, header, comment, username, date, updated)'
                .'VALUES ('
                .'\''.sanitizeSQL($_POST['productid']).'\',' // вдруг кто-то поправит html или URI перед отправкой
                .'\''.sanitizeSQL($_POST['header']).'\','
                .'\''.sanitizeSQL($_POST['comment']).'\','
                .'\''.sanitizeSQL($_POST['username']).'\','
                .'\''.date('Y-m-d').'\','
                .'\''.date('Y-m-d').'\')';
            break;
        case 'read':
            if (isset($_GET['productid'])) {
                $sql = 'SELECT * FROM feedbacks WHERE deleted=0 AND productid = '.$_GET['productid'];
            } else {
                $sql = 'SELECT * FROM feedbacks WHERE deleted=0';
            }
            break;
        case 'update':
            $sql = 'UPDATE feedbacks SET '
                .'header=\''.sanitizeSQL($_POST['header']).'\','
                .'comment=\''.sanitizeSQL($_POST['comment']).'\','
                .'updated=\''.date('Y-m-d').'\''
                .' WHERE id='.$_POST['feedbackid'];
            break;
        case 'delete':
            print_r($_POST);
            $sql = 'UPDATE feedbacks SET '
                .'deleted=\'1\','
                .'updated=\''.date('Y-m-d').'\''
                .' WHERE id='.$_POST['feedbackid'];
            break;
        default:
            return false;
    }

    return getAssocResult($sql);
}

function addImage(){
    $sql = 'INSERT INTO gallery (filepath, filesize, name, views, description) VALUES (\''
        .'http://localhost/img/'.basename($_FILES['userfile']['name'])
        .'\', \''
        .$_FILES['userfile']['size']
        .'\', \''
        .$_POST['name']
        .'\', \'0\', \''
        .$_POST['description']
        .'\')';
    $response = executeQuery($sql);

    if ($response) {
        $response = fileUpload();
    }

    return $response;
}

function fileUpload() {
    $uploadfile = GALLERY_DIR . DIRECTORY_SEPARATOR . basename($_FILES['userfile']['name']);

    return move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
}

