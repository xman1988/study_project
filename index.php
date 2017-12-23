<?php
require_once "config.php";
require_once 'db.php' ;
require_once 'counter.php';
require_once 'stats.php';

$db = new DataBase($config);
//var_dump($db);
$counter = new Counter($db);
$counter->setHit();
$counter->getCounterData();
$result = $counter->getCounterData();
//var_dump($result = $counter->getCounterData());
$showStats = new Stats($result);
$showStats ->show();

?>