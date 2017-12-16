<?php
require_once 'dataBase.class.php' ;
require_once 'counter.class.php';
require_once 'stats.class.php';

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