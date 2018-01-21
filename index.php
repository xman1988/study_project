<?php
require_once "config.php";

/**
 * Функция автозагрузки классов
 *
 * @param string $name Название вызываемого класса
 */
function __autoload($name) {
    require_once "$name.class.php";
}

/**
 * Записываем объект подключения к БД
 */
$db = new DataBase($config);
$counter = new Counter($db);

/**
 * Записываем IP клиента в БД
 */
$counter->setHit();

/**
 * Записываем требуемую информацию из БД в массив $result
 */
$result = $counter->getCounterData();
$showStats = new Stats($result);

/**
 * Выводим информацию из массива $result на экран
 */
$showStats ->show();

?>