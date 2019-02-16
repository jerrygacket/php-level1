<?php

//Константы ошибок
define('ERROR_NOT_FOUND', 1);
define('ERROR_TEMPLATE_EMPTY', 2);

/*
* Обрабатывает указанный шаблон, подставляя нужные переменные
*/
function renderPage($pageName, $variables = [])
{
    $file = TPL_DIR . "/" . $pageName . ".tpl";

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
        $templateContent = pasteValues($variables, $pageName, $templateContent);
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

function prepareVariables($urlArray = []){
    $pageName = strtolower($urlArray[1] ?? 'index');
    $pageGenerator = $pageName . 'Page';
    $vars = [];
    if (is_callable($pageGenerator)) {
        $vars = $pageGenerator($urlArray[2] ?? '');
    }
    if (alreadyLoggedIn()) {
        $vars['loginlink'] = 'logout';
        $vars['logintext'] = 'Выход';
        $vars['personmenu'] = (adminLoggedIn() ? 'admin' : 'person');
    } else {
        $vars['loginlink'] = 'login';
        $vars['logintext'] = 'Вход';
        $vars['personmenu'] = 'login';
    }

    if (!isset($vars['pagename'])) {
        strlen($pageName) ? $vars['pagename'] = $pageName : $vars['pagename'] = 'index';
    }

    return $vars;
}

function getItemRow($tableName) { // собираем список (новостей, товаров. ккартинок и т.п.)
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

function getGoods() {
    if (isset($_SESSION['goods'])) {
        $goodsId = array_keys($_SESSION['goods']);
        array_walk($goodsId, 'sanitizeArray');
        $idRange = implode(',', $goodsId);
        $sql = <<<SQL
SELECT
  id
  , name 
  , imgsmall
  , intro
  , price
FROM
  products
WHERE
  id IN($idRange) 
SQL;
        $result = getAssocResult($sql);

        return $result;
    }

    return 'Корзина пуста';
}

function doGetAction() {
    $action = strtolower($_GET['action'] ?? '');
    $cartFunction = $action . 'Cart';
    if (is_callable($cartFunction)) {
        if ($cartFunction()) {
            $response = ['result' => 1, 'action' => $action, 'id' => $_GET['id_product']];
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
}

function doPostAction() {
    $action = strtolower($_POST['action'] ?? '');
    $id = (int) $_POST['id'];
    $postFunction = $action . ucwords(strtolower($_POST['element'] ?? ''));
    if (is_callable($postFunction)) {
        if ($postFunction(sanitizeSQL($id))) {
            $response = [
                'message' => ELEMENTS[strtolower($_POST['element'])] . ACTIONS[$action],
                'newstatus' => STATUSES[$action],
                'id' => $id,
            ];
        } else {
            $response = [
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
}

function delOrder($id) {
    $sql =<<<SQL
UPDATE orders SET
status='отменен'
WHERE id=$id
SQL;

    $response = executeQuery($sql);

    return $response;
}

function addOrder($id) {
    $sql =<<<SQL
UPDATE orders SET
status='новый'
WHERE id=$id
SQL;

    $response = executeQuery($sql);

    return $response;
}

function delGood($id) {
    $sql =<<<SQL
UPDATE products SET
status='удален'
WHERE id=$id
SQL;
    $response = executeQuery($sql);

    return $response;
}

// схематичная функция получения цены товара
// учитывается временная цена и распродажи
function getGoodPrice($goodId) {
    /* база данных с акциями saleprices:
    ид, название акции, тип скидки(%,+,-), размер скидки

    база данных временных скидок timeprices:
    ид, дата начала, дата окончания, тип скидки(%,+,-), размер скидки

    база данных с товарами с акциями salegoods:
    ид, ид товара, ид акции saleprice

    база данных с товарами со скидками timegoods:
    ид, ид товара, ид временной скидки timeprice
    */
    $goodPrice = <<<SQL
SELECT price 
FROM products
WHERE id=$goodId
SQL;
    $salePrices = <<<SQL
SELECT * 
FROM salegoods,timegoods
LEFT JOIN saleprices ON saleprices.id = salegoods.saleprice
LEFT JOIN timeprices ON timeprices.id = timegoods.saleprice
WHERE id=$goodId AND timeprices.StartDate <= now() AND timeprices.StopDate >= now()
SQL;
    foreach($salePrices as $salePrice) {
        switch ($salePrice['type']) {
            case '%':
                $goodPrice = $goodPrice - ($goodPrice * $salePrice['size']/100);
                break;
            case '+':
                $goodPrice = $goodPrice + $goodPrice;
                break;
            case '-':
                $goodPrice = $goodPrice - $goodPrice;
                break;
        }
    }

    return $goodPrice;
}