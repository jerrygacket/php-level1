<?php

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

// строим галерею по файлам из произвольной папки
function getImages($imageDir) {
    if (!is_dir($imageDir)) {
        return 'Нет картинок';
    }

    // убираем файлы . и ..
    $files = array_diff(scandir($imageDir), ['.', '..']);

    $tpl = '';
    if (is_array($files) && !empty($files)) {
        foreach ($files as $imageFile) {
            $imagePath = $imageDir . DIRECTORY_SEPARATOR . $imageFile;
            if (!file_exists($imagePath)) { // если файл не доступен по полному пути то пропускаем
                continue;
            }
            $tpl .= '<div class="catalog-item">
                        <div class="catalog-img">
                            <a href="'.$imagePath.'" target="_blank"><img src="'.$imagePath.'" alt="Подушка декоративная большая" style="max-width: 100px;" class="product-img"></a>
                        </div>
                    </div>';
        }
    }
    return ($tpl === '' ? 'Нет картинок' : $tpl);
}