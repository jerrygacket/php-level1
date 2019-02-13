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
