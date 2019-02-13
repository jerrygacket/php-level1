<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.02.19
 * Time: 20:23
 */

// блок функций авторизации
/**
 * валидация пользовательского куки
 * @return bool
 */
function checkAuthWithCookie()
{
    if (!isset($_COOKIE['id_user']) || !isset($_COOKIE['cookie_hash'])) {
        return false;
    }

    // получаем данные пользователя по id
    $user_id = sanitizeSQL($_COOKIE['id_user']);
    $sql = <<<SQL
SELECT
  id_user
  , user_name
  , user_password
FROM
  `shop_users`
WHERE
  id_user = $user_id
SQL;
    $user_data = getTableRow($sql);
    if (($user_data['user_password'] == $_COOKIE['cookie_hash'])
        && ($user_data['id_user'] == $_COOKIE['id_user'])
    ) {
        return true;
    }
    setcookie("id_user", "", time() - 3600 * 24 * 30 * 12, "/");
    setcookie("cookie_hash", "", time() - 3600 * 24 * 30 * 12, "/");

    return false;
}

/**
 * авторизация через логин и пароль
 */
function authWithCredentials()
{
    $username = $_POST['login'];
    $password = $_POST['password'];

    // получаем данные пользователя по логину
    $safeUserName = sanitizeSQL($username);
    $sql = <<<SQL
SELECT
  id_user
  ,user_name
  ,user_password
FROM
  shop_users
WHERE
  user_login = "$safeUserName"
SQL;
    $user_data = getTableRow($sql);

    // проверяем соответствие логина и пароля
    if ($user_data) {
        if (checkPassword($password, $user_data['user_password'])) {
            // если стояла галка, то запоминаем пользователя на сутки
            if (isset($_POST['rememberme']) && $_POST['rememberme'] == 'on') {
                setcookie("id_user", $user_data['id_user'], time() + 86400);
                setcookie("cookie_hash", $user_data['user_password'], time() + 86400);
            }
            // сохраним данные в сессию только если прошли проверку логи и пароль
            $_SESSION['user'] = $user_data;

            return true;
        }
    }

    return false;
}

function hashPassword($password)
{
    $salt = md5(uniqid(SALT2, true));
    $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    return crypt($password, '$2a$08$' . $salt);
}

/**
 * Сверяем введённый пароль и хэш
 * @param $password
 * @param $hash
 * @return bool
 */
function checkPassword($password, $hash) {
    return crypt($password, $hash) === $hash;
}

function alreadyLoggedIn() {
    return isset($_SESSION['user']);
}

function getUserInfo() {
    // получаем данные пользователя по id
    $user_id = sanitizeSQL($_SESSION['user']['id_user']);
    $sql = <<<SQL
SELECT
  user_name
  , user_login
FROM
  shop_users
WHERE
  id_user = $user_id
SQL;
    $result = getTableRow($sql);

    return $result;
}