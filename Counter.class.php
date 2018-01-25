<?php
/**
 * Class Counter Класс работы с IP клиента, его записи и обработки
 *
 */
class Counter {

    /**
     * @var DataBase object $db Принимает значение $databaseObj
     */
    public $db;

    /**
     * @var string $ip Принимает значение ip клиента
     */
    public $ip;

    /**
     * Counter constructor.
     * @param DataBase $databaseObj Принимает экземпляр класса DataBase с объектом класса mysqli подключения к БД
     */
    function __construct($databaseObj) {
        $this->db = $databaseObj;
    }

    /**
     * Метод берет IP клиента, записывает время посещения, записывает IP в БД.
     * Берет id  вставленного IP и вставляет его и время посещения в БД.
     *
     * @return bool Возвращает булево значение, в зависимости от успеха вставки sql запроса
     */
    public function setHit() {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $visitTime = time();
        if ($this->ip) {
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

    /**
     * Метод выполняет запрос к БД, получает результат, фетчит его, записывает результат в массив.
     * @return array $result Возвращает массив с результатами запросов
     */
    public function getCounterData() {
        /**
         * $queryResult записывает количество загрузок сайта (без ошибок в записях таблиц mySQL)
         * или количество строк с одинаковым id = ip_id в колонке ip, присутствующих в таблицах hits и ip.
         */
        $sql = "SELECT COUNT(ip) AS allRightHits
                FROM hits INNER JOIN ip
                ON hits.`ip_id` = ip.`id`";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        /**
         * $queryResult количество загрузок сайта текущего клиента
         */
        $sql = "SELECT COUNT(*) AS clientIp FROM ip WHERE ip = '$this->ip'";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        /**
         * $queryResult записывает количество различных ip - адресов
         */
        $sql = "SELECT COUNT(DISTINCT ip) AS hosts FROM ip";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        /**
         * $queryResult записывает количество всех хитов
         */
        $sql = "SELECT COUNT(*) AS allHits FROM ip";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToSimpleArray($queryResult);

        /**
         * выбирает все различающиеся ip-адреса
         */
        $sql = "SELECT DISTINCT ip AS host, COUNT(ip) AS hits FROM ip GROUP BY ip";
        $queryResult = $this->db->select($sql);
        $result[]= $this->db->dbSelectToArray($queryResult);

        return $result;
    }
}
?>