<?php
function setHit() {
	if(!$_SERVER['REMOTE_ADDR']) {
    	echo "Ваш ip не опознан!";
    	return false;
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
    	$ip_int = ip2long($ip);
    	$visit_time = time();
    	$sqlInsert = "INSERT INTO hits(`ip`, `visit_time`) VALUES ($ip_int, $visit_time)";
    	databaseInsert($sqlInsert);
	}
}
function getCounterData() {
	global $link;
	$ip = $_SERVER['REMOTE_ADDR'];
    $ip_int = ip2long( $ip );
	$count = mysqli_query($link, "SELECT COUNT(*) as cnt FROM hits WHERE `ip`= $ip_int");
	function databaseSelectToArray($count) {
			if(!$count) {
			   databaseShowError();
			   return false;
			}
			else {
				$data = []; 
				while($fetchedData = mysqli_fetch_assoc($count)) {
				   $data[] = $fetchedData; 
				}
				return $data;
	        }
	        
	}
	return databaseSelectToArray($count);
} 
?>