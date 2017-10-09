<?php
function setHit() {
	if(!$_SERVER['REMOTE_ADDR']) {
    	echo "Ваш ip не опознан!";
    	return false;
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
    	//$ip_int = ip2long($ip);
    	$visit_time = time();
    	$sqlInsert = "INSERT INTO ip(ip) VALUES ('$ip')";
    	databaseInsert($sqlInsert);
	}
}
function getCounterData() {
	global $link;
	$ip = $_SERVER['REMOTE_ADDR'];
	$ip_my = $_SERVER['SERVER_ADDR'];
    $ip_int = ip2long($ip);
    $my_ip_int = ip2long($ip_my);

    function databaseSelectToArray($result) {
		if(!$result) {
		   databaseShowError();
		   return false;
		}
		else {
			while($fetchedData = mysqli_fetch_assoc($result)) {
			   $data[] = $fetchedData; 
			}
			return $data;
        }       
	}

    $sql = "SELECT COUNT(ip) FROM hits";
    $query = mysqli_query($link, $sql);
    $result[]= databaseSelectToArray($query);

    $sql = "SELECT COUNT(*) FROM hits WHERE ip= $ip_int";
	$query = mysqli_query($link, $sql);
	$result[]= databaseSelectToArray($query);

    $sql = "SELECT COUNT(*) FROM hits WHERE ip= $my_ip_int";
	$query = mysqli_query($link, $sql);
	$result[]= databaseSelectToArray($query);

	$sql = "SELECT COUNT(DISTINCT ip) FROM hits";
	$query = mysqli_query($link, $sql);
	$result[]= databaseSelectToArray($query);

	$sql = "SELECT DISTINCT ip, COUNT(*) FROM hits GROUP BY ip";
	$query = mysqli_query($link, $sql);
	$result[]= databaseSelectToArray($query);

	//var_dump($result);
	return $result;
} 
?>