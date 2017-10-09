<?php
function databaseConnect($config) {
	global $link;
	$link = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['database']);
    if(!$link) {
        return false;
    }
}
function databaseInsert($sqlInsert) {
	global $link;
	$result = mysqli_query($link, $sqlInsert);
    if(!$result) {
    	printf("Сообщение об ошибке: %s\n", mysqli_error($link));
    	return false;
    }
}
function databaseShowError() {
    global $link;
	echo "Ошибка! Невозможно подключиться к базе данных: ".PHP_EOL;
	echo "Номер ошибки:".mysqli_error($link).PHP_EOL;
}
?>