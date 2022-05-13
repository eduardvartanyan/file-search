<?php

// Функция ищет файл по имени в указанной папке
function findFile(string $searchFolder, string $searchName, array &$searchResult) : void
{

    foreach (scandir($searchFolder) as $item) {

        if (($item != '.') && ($item != '..')) {

            $path = $searchFolder . "\\" . $item;

            if (is_dir($path)) {

                findFile($path, $searchName, $searchResult);

            } else {

                if ($item == $searchName) {

                    $searchResult[] = $path;

                }

            }

        }

    }

}

$searchRoot = 'C:\xampp\htdocs\FileSearch';
$searchName = 'readme.txt';
$searchResult = [];

if (is_dir($searchRoot)) {

    findFile($searchRoot, $searchName, $searchResult);
    $searchResult = array_filter($searchResult, "filesize");

    if (count($searchResult) > 0) {

        echo 'Найдены следующие непустые файлы:' . PHP_EOL;

        foreach ($searchResult as $value) {

            echo $value . PHP_EOL;

        }

    } else {

        echo 'Поиск не дал результата.';

    }

} else {

    echo 'Для поиска задана неверная директория.';

}
