<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.02.19
 * Time: 17:29
 */

// получаем вложенный список рекурсивно
// хедером для вложенного списка будет пункт из верхнего списка
function getUlist($listHeader,$items) {
    echo '<li>'.$listHeader.'</li>'.PHP_EOL;
    echo '<ul>'.PHP_EOL;
    foreach ($items as $key => $item) {
        if (is_array($item)) {
            getUlist($key, $item);
        } else {
            echo '<li>'.$key.': '.$item.'</li>'.PHP_EOL;
        }
    }
    echo '</ul>'.PHP_EOL;
}