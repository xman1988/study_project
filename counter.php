<?php
class counter{
	public $ip;
	public $visit_time;
	public $sqlInsert;
	public $ip_id;
	public $sqlSelect;
	public $ip_my;
	public $query;
	public $result;

	public function setHit($db) {
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->visit_time = time();
		$this->ip_id = mysqli::$insert_id;
		if($this->ip) {
	    	$this->sqlInsert = "INSERT INTO ip(ip) VALUES ($this->ip)";
	    	$db->dbInsert($this->sqlInsert);
	    	$this->sqlInsert = "INSERT INTO hits(ip_id, visit_time) VALUES ($this->ip_id, $this->visit_time)";
	    	$db->dbInsert($this->sqlInsert);
		}
		echo "Ваш ip не опознан!";
	    return false;
	}

	public function getCounterData() {
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->ip_my = $_SERVER['SERVER_ADDR'];
	    $this->sqlSelect = "SELECT COUNT(ip) FROM `hits`
	    	    INNER JOIN `ip`
	    	    ON `hits`.`ip_id` = `ip`.`id`";
	    $this->query = mysqli::query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->query);

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip = $this->ip";
	    $this->query = mysqli::query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->query);

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip= $this->ip_my";
	    $this->query = mysqli::query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->query);

		$this->sqlSelect = "SELECT COUNT(DISTINCT ip) FROM ip";
	    $this->query = mysqli::query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->query);

		$this->sqlSelect = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
	    $this->query = mysqli::query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->query);

		return $this->result;
	} 
}
?>