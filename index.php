<?php
require_once "config.php";
function __autoload($name){
    require_once "$name.class.php";
}

$db = new DataBase($config);
//var_dump($db);
$counter = new Counter($db);
$counter->setHit();
$counter->getCounterData();
$result = $counter->getCounterData();
echo "<pre>";
var_dump($result = $counter->getCounterData());
echo "</pre>";
//$showStats = new Stats($result);
//$showStats ->show();

?>