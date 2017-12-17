<?php
class counter extends dataBase{ //Имена классов с большой буквы
	//Счетчик и БД совершенно разные сущности, их нельзя наследовать друг от друга
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
		$this->visit_time = time(); //не имеет смысла создавать свойства объекта, если значение используется в рамках одного метода, лучше использовать обычную переменную
		$this->ip_id = $this->link->insert_id; //ты еще ничего не вставил в базу, а уже ID получаешь
		if($this->ip) { //пробел после If
	    	$this->sqlInsert = "INSERT INTO ip(ip) VALUES ($this->ip)";
	    	$db->dbInsert($this->sqlInsert);
	    	$this->sqlInsert = "INSERT INTO hits(ip_id, visit_time) VALUES ($this->ip_id, $this->visit_time)"; //$this->ip_id будет 0
	    	$db->dbInsert($this->sqlInsert);
		}
		else {
			echo "Ваш ip не опознан!";
		    return false;	
		}
		
	}

	public function getCounterData() {
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->ip_my = $_SERVER['SERVER_ADDR'];
	    $this->sqlSelect = "SELECT COUNT(ip) FROM `hits`
	    	    INNER JOIN `ip`
	    	    ON `hits`.`ip_id` = `ip`.`id`";
	    $this->link->query($this->sqlSelect); //у класса должен быть конструктор, в который нужно передать объект БД. Внутри конструктора объект присвоить свойству db, а потом в методах обращаться к нему через $this->db->query(...)
	    $this->result[]= dbSelectToArray($this->link->query); //dbSelectToArray - это не функция, а метод dataBase

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip = $this->ip";
	    $this->link->query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->link->query);

	    $this->sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip= $this->ip_my";
	    $this->link->query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->link->query);

		$this->sqlSelect = "SELECT COUNT(DISTINCT ip) FROM ip";
	    $this->link->query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->link->query);

		$this->sqlSelect = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
	    $this->link->query($this->sqlSelect);
	    $this->result[]= dbSelectToArray($this->link->query);

		return $this->result;
	} 
}
?>