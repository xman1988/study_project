<?php
require_once 'db.php' ;
require_once 'counter.php';
require_once 'stats.php';

$db = new dataBase();
$counter = new counter();
$counter->setHit($db);
$counter->getCounterData(); 

if($counter->getCounterData()) {
	$showStats = new stats();
	$showStats->showStats();
}
else {
	echo '<br>Ошибка приема данных из БД!';
	mysqli::close();

}

?>