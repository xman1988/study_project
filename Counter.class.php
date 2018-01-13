<?php
/**
 * Класс работы с IP клиента и их обработки
 * Выполняет прием IP клиента, записывает его в БД, делает запрос к БД
 *
 * @return array $result Возвращает массив с данными из БД, соответствующими запросу(ам)
 * @param DataBase $databaseObj Принимает экземпляр класса DataBase с объектом класса mysqli подключения к БД
 * $db object Значение $databaseObj
 *
 */
class Counter{
    public $db;
    public $ip;

    function __construct($databaseObj){
        $this->db = $databaseObj;
    }

    public function setHit(){
        /**
         * Метод принимает IP клиента, записывает время посещения, записывает IP в БД.
         * Получает id  вставленного IP и вставляет его и время посещения в БД.
         *
         * $ip string  Значение IP клиента
         * $visitTime integer Значение времени входа клиента
         * $sql string SQL-запрос к БД
         * $currentId integer id только что вставленного IP клиента в БД
         *
         *
         *
         */
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
        $sql = "SELECT COUNT(ip) AS allRightHits
                FROM hits INNER JOIN ip
                ON hits.`ip_id` = ip.`id`";
        // количество загрузок сайта (без ошибок в записях таблиц mySQL)
        // или количество строк с одинаковым id = ip_id в колонке ip, присутствующих в таблицах hits и ip.
        //echo "<br><br>" . $sql;
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        $sql = "SELECT COUNT(*) AS clientIp FROM ip WHERE ip = '$this->ip'"; // количество загрузок сайта текущего клиента
        //echo "<br>".$sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        //SELECT COUNT(ip) FROM ip GROUP BY ip
        $sql = "SELECT COUNT(DISTINCT ip) AS hosts FROM ip"; // количество различных ip - адресов
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);


        $sql = "SELECT COUNT(*) AS allHits FROM ip"; // количество всех хитов
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        $sql = "SELECT DISTINCT ip AS host, COUNT(ip) AS hits FROM ip GROUP BY ip";// выбирает все различающиеся ip-адреса
        //echo $this->sql."<br>";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);


        return $result;
    }
}
?>