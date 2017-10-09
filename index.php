<?php
require_once 'config.php';
require_once 'db.php' ;
require_once 'counter.php';
databaseConnect($config);
setHit();
$counterData = getCounterData(); 
if($counterData) {
	require_once "stats.php";
}
else {
	echo '<br>Ошибка приема данных из БД!';
	mysqli_close($link);

}
?>