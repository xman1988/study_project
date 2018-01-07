<?php
require_once "config.php";

function __autoload($name){
    require_once "$name.class.php";
}

$db = new DataBase($config);
$counter = new Counter($db);
$counter->setHit();
$result =$counter->getCounterData();
$counter->setHit();
$showStats = new Stats($result);
$showStats ->show();

?>