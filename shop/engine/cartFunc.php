<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.02.19
 * Time: 0:05
 */

function addCart() {
    if (!isset($_SESSION['goods'])) {
        $_SESSION['goods'] = [];
    }
    $goodId = (int) $_GET['id_product'];
    if (in_array($goodId,$_SESSION['goods'])) {
        $_SESSION['goods'][$goodId]['quantity'] += (int) sanitizeSQL($_GET['quantity']);
        return '1';
    }

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
  id = $goodId 
SQL;
    $result = getTableRow($sql);

    if (is_array($result)) {
        $_SESSION['goods'][$goodId] = $result;
        $_SESSION['goods'][$goodId]['quantity'] = (int) $_GET['quantity'];
        return '1';
    }
    return '0';
}

function delCart() {
    $goodId = (int) $_GET['id_product'];

    if (array_key_exists($goodId,$_SESSION['goods'])) {
        unset($_SESSION['goods'][$goodId]);
        return '1';
    }
    return '0';
}

function clrCart() {
    if (array_key_exists('goods',$_SESSION)) {
        unset($_SESSION['goods']);
        return '1';
    }
    return '0';
}

function saveOrder() {
    $result = [];
    $result['order'] = false;

    if (!array_key_exists('goods',$_SESSION)
        || empty($_SESSION['goods'])
    ) {
        $result['error'] = 'Нет товаров в корзине';
        return $result;
    }

    if (alreadyLoggedIn()) {
        $userInfo = getUserInfo();
    } else {
        $userInfo = getUserByLogin($_POST['login']);
        if (empty($userInfo)) {
            $result['user'] = 'newuser';
            $userInfo = saveNewUser();
        } else {
            $result['error'] = 'Такой пользователь существует. Залогинтесь.';
            return $result;
        }
    }
    $orderNumber = (int)time();
    $od = date('Y-m-d');
    $uid = $userInfo['id_user'];
    $sql = 'INSERT INTO orders (order_number, user_id, order_date) VALUES ('.$orderNumber.','.$uid.','.$od.')';
    $response = executeQuery(sanitizeSQL($sql));
    if (!$response) {
        $result['error'] = 'Ошибка создания заказа';
        return $result;
    }
    // далее вообще-то нужно брать ид созданного заказа, а не использовать номер
    foreach ($_SESSION['goods'] as $goodId => $good) {
        $q = $good['quantity'];
        $p = $good['price'];
        $sql = 'INSERT INTO order_products (order_number, product_id, product_count, product_price) VALUES ('.$orderNumber.','.$goodId.','.$q.','.$p.')';
        $response = executeQuery(sanitizeSQL($sql));
        if (!$response) {
            $result['error'] = 'Ошибка добавления товара к заказу';
            return $result;
        }
    }
    $result['order'] = true;
    $result['userinfo'] = $userInfo;
    clrCart();

    return $result;
}

function getFullUserOrders($userId = '') {
    $user_id = empty($userId) ? sanitizeSQL($_SESSION['user']['id_user']) : $userId;
    $sql = <<<SQL
SELECT
  *
FROM
  orders
LEFT JOIN order_products ON order_products.order_number = orders.order_number
LEFT JOIN products ON products.id = order_products.product_id
WHERE
  user_id = $user_id
SQL;
    $result = getAssocResult($sql);

    return $result;
}

function getUserOrders($userId = '') {
    $user_id = empty($userId) ? sanitizeSQL($_SESSION['user']['id_user']) : $userId;
    $sql = <<<SQL
SELECT
  *
FROM
  orders
WHERE
  user_id = $user_id
SQL;
    $result = getAssocResult($sql);

    return $result;
}

function getOrderProducts($orderId) {
    $orderId = sanitizeSQL($orderId);
    $sql = <<<SQL
SELECT
  *
FROM
  order_products
LEFT JOIN products ON products.id = order_products.product_id
WHERE
  order_number = $orderId
SQL;
    $result = getAssocResult($sql);

    return $result;
}

function getProductInfo($productId) {
    $productId = sanitizeSQL($productId);
    $sql = <<<SQL
SELECT
  *
FROM
  products
WHERE
  id = $productId
SQL;
    $result = getAssocResult($sql);

    return $result;
}

function getAllGoods() {
    $sql = <<<SQL
SELECT
  *
FROM
  products
SQL;
    $result = getAssocResult($sql);

    return $result;
}