<?php
class Сounter{
    public $ip;
    public $ip_my;

    public function setHit($db) {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $visit_time = time();
        $ip_id = $db->insert_id;
        if($this->ip) {
            $sqlInsert = "INSERT INTO ip(ip) VALUES ($this->ip)";
            $db->dbInsert($sqlInsert);
            $sqlInsert = "INSERT INTO hits(ip_id, visit_time) VALUES ($ip_id, $visit_time)";
            $db->dbInsert($sqlInsert);
        }
        else {
            echo "Ваш ip не опознан!";
            return false;
        }

    }

    public function getCounterData($db) {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->ip_my = $_SERVER['SERVER_ADDR'];
        $sqlSelect = "SELECT COUNT(ip) FROM `hits`
	    	    INNER JOIN `ip`
	    	    ON `hits`.`ip_id` = `ip`.`id`";
        $db->query($sqlSelect);
        $result[]= $db->dbSelectToArray($db->query);

        $sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip = $this->ip";
        $db->query($sqlSelect);
        $result[]= $db->dbSelectToArray($db->query);

        $sqlSelect = "SELECT COUNT(*) FROM ip WHERE ip= $this->ip_my";
        $db->query($sqlSelect);
        $result[]= $db->dbSelectToArray($db->query);

        $sqlSelect = "SELECT COUNT(DISTINCT ip) FROM ip";
        $db->query($sqlSelect);
        $result[]= $db->dbSelectToArray($db->query);

        $sqlSelect = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
        $db->query($sqlSelect);
        $result[]= $db->dbSelectToArray($db->query);

        return $result;
    }
}
?>