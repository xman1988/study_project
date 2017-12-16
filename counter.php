<?php
class counter{
	public $ip;
	public $visit_time;
	public $sqlInsert;
	public $ip_id;
	public $sqlSelect;

	public function setHit($db) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$ip_my = $_SERVER['SERVER_ADDR'];
		$visit_time = time();
		$ip_id = $mysqli->insert_id;
		if($ip) {
	    	$this->sqlInsert = "INSERT INTO ip(ip) VALUES ($ip)";
	    	$db->dbInsert($this->sqlInsert);
	    	$this->sqlInsert = "INSERT INTO hits(ip_id, visit_time) VALUES ($ip_id, $visit_time)";
	    	$db->dbInsert($this->sqlInsert);
		}
		echo "Ваш ip не опознан!";
	    return false;
	}

	public function getCounterData() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$ip_my = $_SERVER['SERVER_ADDR'];
		$ip_id = $mysqli->insert_id;
	    $this->sqlSelect = "SELECT COUNT(ip) FROM `hits`
	    	    INNER JOIN `ip`
	    	    ON `hits`.`ip_id` = `ip`.`id`";
	    $query = mysqli::query($this->sqlSelect);
	    $result[]= dbSelectToArray($query);

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip = $ip";
	    $query = mysqli::query($this->sqlSelect);
	    $result[]= dbSelectToArray($query);

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip= $ip_my";
	    $query = mysqli::query($this->sqlSelect);
	    $result[]= dbSelectToArray($query);

		$this->sqlSelect = "SELECT COUNT(DISTINCT ip) FROM ip";
	    $query = mysqli::query($this->sqlSelect);
	    $result[]= dbSelectToArray($query);

		$this->sqlSelect = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
	    $query = mysqli::query($this->sqlSelect);
	    $result[]= dbSelectToArray($query);

		return $result;
	} 
}
?>