<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.02.19
 * Time: 21:29
 */

function newsPage($itemId) {
    if (strlen($itemId)) {
        $content = getItemContent('news', $itemId);
        $vars['news_title'] = $content['news_title'];
        $vars['news_content'] = $content['news_content'];
        $vars['tpl'] = 'article';
    } else {
        $vars['newsfeed'] = getItemRow('news');
        $vars['test'] = 123;
    }

    return $vars;
}

function galleryPage($itemId) {
    if (strlen($itemId)) {
        $content = getItemContent('gallery', $itemId);
        $vars['pagetitle'] = 'Картинка ' . $content['name'];
        $vars['name'] = $content['name'];
        $vars['description'] = $content['description'];
        $vars['views'] = $content['views'];
        $vars['filesize'] = $content['filesize'];
        $vars['filepath'] = $content['filepath'];
        $vars['tpl'] = 'image';
    } else {
        if (isset($_POST['newfile'])) {
            addImage();
        }
        $vars['gallery'] = getItemRow('gallery');
        $vars['pagetitle'] = 'Галерея картинок';
    }

    return $vars;
}

function catalogPage($itemId) {
    if (strlen($itemId)) {
        if(isset($_POST['action'])) {
            doFeedbackAction($_POST['action']);
        }
        $vars = getProductContent($itemId) ?? 'нет опций';
        $vars['pagetitle'] = $vars['name'];
        $vars['productid'] = $itemId;
        $feedbacks = doFeedbackAction('read');
        $vars['feedback'] = $feedbacks ?? 'нет отзывов';
        $vars['tpl'] = 'product';
    } else {
        $vars['pagetitle'] = 'Каталог';
        $vars['products'] = getItemRow('products');
    }

    return $vars;
}

function calcsPage() {
    $vars['pagetitle'] = 'Калькуляторы';
    $vars['result1'] = '';
    $vars['result2'] = '';
    $formNumber = (int) ($_POST['calcForm'] ?? '0');
    $vars['result' . $formNumber] = calculateForm();

    return $vars;
}

function loginPage() {
    // если уже залогинен,
    // или авторизирован по кукам
    // то просто заполняем переменные и на главную
    // иначе пробуем авторизовать по логину и паролю
    if (!alreadyLoggedIn() && !checkAuthWithCookie()) {
        $vars["autherror"] = '';
        $vars["personmenu"] = 'login';
        $vars["pagename"] = 'login';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!authWithCredentials()) {
                $vars["autherror"] = 'Неправильный логин/пароль';
            } else {
                $vars["pagename"] = (adminLoggedIn() ? 'admin' : 'person');
                $vars["personmenu"] = (adminLoggedIn() ? 'admin' : 'person');
                header('Location: /person');
            }
        }
    }

    return $vars;
}

function logoutPage() {
    setcookie("id_user", "", time() - 3600 * 24 * 30 * 12, "/");
    setcookie("cookie_hash", "", time() - 3600 * 24 * 30 * 12, "/");
    unset($_SESSION["user"]);
    session_destroy();
    $vars["loginlink"] = 'login';
    $vars["pagename"] = 'index';
    $vars["logintext"] = 'Вход';
    header('Location: /');

    return $vars;
}

function personPage() {
    if (alreadyLoggedIn() || checkAuthWithCookie()) {
        $userInfo = getUserInfo();
        $vars['userlogin'] = $userInfo['user_login'];
        $vars['username'] = $userInfo['user_name'];
        $vars["pagename"] = 'person';
        $vars["personmenu"] = 'person';
        $vars["goodsbutton"] = '';
        $vars["userorders"] = getUserOrdersPage();
    }

    return $vars;
}

function adminPage() {
    if (alreadyLoggedIn() || checkAuthWithCookie()) {
        $userInfo = getUserInfo();
        $vars['userlogin'] = $userInfo['user_login'];
        $vars['username'] = $userInfo['user_name'];
        $vars["pagename"] = 'person';
        $vars["personmenu"] = 'admin';
        $vars["goodsbutton"] = renderPage('goods_button');
        $vars["userorders"] = '';
        $users = getAllUsers();
        foreach ($users as $user) {
            $vars["userorders"] .= getUserOrdersPage($user['id_user']);
        }

    }

    return $vars;
}

function goodsPage() {
    if (adminLoggedIn() || checkAuthWithCookie()) {
        $userInfo = getUserInfo();
        $vars['userlogin'] = $userInfo['user_login'];
        $vars['username'] = $userInfo['user_name'];
        $vars["pagename"] = 'goods';
        $vars["personmenu"] = 'admin';
        $vars["goods"] = '';
        $vars["goods"] = getAllGoods();
    } else {
        header('Location: /');
    }

    return $vars;
}

function getUserOrdersPage($userId = '') {
    $result = '';
    $orders = getUserOrders($userId);
    foreach ($orders as $order) {
        $products['goods'] = getOrderProducts($order['order_number']);
        foreach ($products['goods'] as &$good) {
            $good['cost'] = $good['product_price'] * $good['product_count'];
        }
        $products['ordernumber'] = $order['order_number'];
        $products['id'] = $order['id'];
        $products['status'] = $order['status'];
        $result .= renderPage('orderInfo',$products);
    }

    return $result;
}

function cartPage() {
    $vars['pagetitle'] = 'Корзина';
    $vars['ordercost'] = 0;
    $vars['getorder'] = [];
    $vars['goods'] = getGoods();
    if (is_array($vars['goods']) && !empty($vars['goods'])) {
        $vars['getorder'] = ['1']; // если есть товары, рисуем форму заказа
        foreach ($vars['goods'] as &$good) {
            $id = $good['id'];
            $good['count'] = $_SESSION['goods'][$id]['quantity'];
            $good['cost'] = $good['price'] * $good['count'];
            $vars['ordercost'] += $good['cost'];
        }
    }

    return $vars;
}

function getorderPage() {
    $result['order'] = false;
    if (isset($_POST['getorder'])) {
        $result = saveOrder();
    }
    $vars['newuser'] = '';
    $vars['olduser'] = '';
    $vars['error'] = '';
    if ($result['order']) {
        $vars['pagetitle'] = 'Заказ оформлен';
        $vars[$result['user']][0] = $result['userinfo'];
    } else {
        $vars['pagetitle'] = 'Заказ не оформлен';
        $vars['error'] = $result['error'];
    }

    return $vars;
}
