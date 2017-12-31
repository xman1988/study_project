<?php
class Counter{
    public $db;
    public $ip;

    function __construct($databaseObj){
        $this->db = $databaseObj;
    }

    public function setHit(){
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $visitTime = time();
        if ($this->ip){
            $sql = "INSERT INTO ip(ip) VALUES ('$this->ip')";
            $this->db->insert($sql);
            $currentId = $this->db->getCurrentId();
            $sql = "INSERT INTO hits(ip_id, visit_time) VALUES ($currentId, $visitTime)";
            $this->db->insert($sql);
        }
        else {
            echo "Ваш ip не опознан!";
            return false;
        }
    }

    public function getCounterData() {
        $this->ip;
        $ipServer = $_SERVER['SERVER_ADDR'];

        $sql = "SELECT COUNT(ip) 
                FROM hits INNER JOIN ip
                ON hits.`ip_id` = ip.`id`";
        // количество загрузок сайта (без ошибок в записях таблиц mySQL)
        // или количество строк с одинаковым id = ip_id в колонке ip, присутствующих в таблицах hits и ip.
        //echo "<br><br>" . $sql;
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        $sql = "SELECT COUNT(*) FROM ip WHERE ip = '$this->ip'";
        // количество загрузок сайта текущего клиента
        //echo "<br>".$sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        $sql = "SELECT COUNT(*) FROM ip WHERE ip = '$ipServer'";
        // количество загрузок сайта с сервера
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        $sql = "SELECT COUNT(DISTINCT ip) FROM ip";
        // количество различных ip - адресов
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        $sql = "SELECT DISTINCT ip FROM ip";
        // выбирает все различающиеся ip-адреса
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        $sql = "SELECT COUNT(*) FROM ip GROUP BY ip";
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        return $result;
    }
}
?>