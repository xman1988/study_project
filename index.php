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
//var_dump ($counter->getCounterData());



//if($counter->getCounterData()) {
//	$ShowStats = new stats();
//	$ShowStats->ShowStats();
//}
//else {
//	echo '<br>Ошибка приема данных из БД!';
//}
?>