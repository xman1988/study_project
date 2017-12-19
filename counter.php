<?php
class Counter{
    public $db;
    public $sql;

    function __construct($databaseobj){
        $this->db = $databaseobj;
    }

    public function setHit(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $visit_time = time();
        $current_id = $this->db->insert_id;
        if ($ip){
            $this->sql = "INSERT INTO ip(ip) VALUES ('$ip')";
            $this->db->getQuery($this->sql);
            $this->sql = "INSERT INTO hits(ip_id, visit_time) VALUES ($current_id, $visit_time)";
            $this->db->getQuery($this->sql);
        }
        else {
            echo "Ваш ip не опознан!";
            return false;
        }
    }

    public function getCounterData() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_my = $_SERVER['SERVER_ADDR'];
        $this->sql = "SELECT COUNT(ip) FROM `hits`
    INNER JOIN `ip`
    ON `hits`.`ip_id` = `ip`.`id`";
        echo "<br><br>" . $this->sql;
        $result[]= $this->db->dbSelectToArray($this->db->getQuery($this->sql));

        $this->sql = "SELECT COUNT(*) FROM ip WHERE ip = '$ip'";
        echo "<br>".$this->sql."<br>";
        $result[]= $this->db->dbSelectToArray($this->db->getQuery($this->sql));

        $this->sql = "SELECT COUNT(*) FROM ip WHERE ip = '$ip_my'";
        echo $this->sql."<br>";
        $result[]= $this->db->dbSelectToArray($this->db->getQuery($this->sql));

        $this->sql = "SELECT COUNT(DISTINCT ip) FROM ip";
        echo $this->sql."<br>";
        $result[]= $this->db->dbSelectToArray($this->db->getQuery($this->sql));

        $this->sql = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
        echo $this->sql."<br>";
        $result[]= $this->db->dbSelectToArray($this->db->getQuery($this->sql));

        return $result;
    }
}
?>