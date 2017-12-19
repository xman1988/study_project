<?php
class Counter{
    public $db;

    function __construct($databaseobj){
        $this->db = $databaseobj;
}

    public function setHit(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $visit_time = time();
        $current_id = $this->db->link->insert_id;
        if ($ip){
            $sql = "INSERT INTO ip(ip) VALUES ('$ip')";
            $this->db->link->query($sql);
            $sql = "INSERT INTO hits(ip_id, visit_time) VALUES ($current_id, $visit_time)";
            $this->db->link->query($sql);
        }
        else {
            echo "Ваш ip не опознан!";
            return false;
        }
    }

    public function getCounterData() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_my = $_SERVER['SERVER_ADDR'];
        $sql = "SELECT COUNT(ip) FROM `hits`
    INNER JOIN `ip`
    ON `hits`.`ip_id` = `ip`.`id`";
        $result[]= $this->db->dbSelectToArray($this->db->link->query($sql));

        $sql = "SELECT COUNT(*) FROM ip WHERE ip = '$ip'";
        $result[]= $this->db->dbSelectToArray($this->db->link->query($sql));

        $sql = "SELECT COUNT(*) FROM ip WHERE ip = '$ip_my'";
        $result[]= $this->db->dbSelectToArray($this->db->link->query($sql));

        $sql = "SELECT COUNT(DISTINCT ip) FROM ip";
        $result[]= $this->db->dbSelectToArray($this->db->link->query($sql));

        $sql = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
        $result[]= $this->db->dbSelectToArray($this->db->link->query($sql));

        return $result;
    }
}
?>