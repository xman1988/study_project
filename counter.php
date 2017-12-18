<?php
class Counter{

    public function setHit($db){
    $ip = $_SERVER['REMOTE_ADDR'];
    $visit_time = time();
    $current_id = $db->insert_id;
        if ($ip){
            $sql = "INSERT INTO ip(ip) VALUES ('$ip')";
            $db->dbInsert($sql);
            $sql = "INSERT INTO hits(ip_id, visit_time) VALUES ($current_id, $visit_time)";
            $db->dbInsert($sql);
        }
        else {
            echo "Ваш ip не опознан!";
            return false;
        }
    }

    public function getCounterData($db) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_my = $_SERVER['SERVER_ADDR'];
    $sql = "SELECT COUNT(ip) FROM `hits`
    INNER JOIN `ip`
    ON `hits`.`ip_id` = `ip`.`id`";
    $db->link->query($sql);
    $result[]= $db->dbSelectToArray($db->link->query);

    $sql = "SELECT COUNT(*) FROM ip WHERE ip = $ip";
    $db->link->query($sql);
    $result[]= $db->dbSelectToArray($db->link->query);

    $sql = "SELECT COUNT(*) FROM ip WHERE ip = $ip_my";
    $db->link->query($sql);
    $result[]= $db->dbSelectToArray($db->link->query);

    $sql = "SELECT COUNT(DISTINCT ip) FROM ip";
    $db->link->query($sql);
    $result[]= $db->dbSelectToArray($db->link->query);

    $sql = "SELECT DISTINCT ip, COUNT(*) FROM ip GROUP BY ip";
    $db->link->query($sql);
    $result[]= $db->dbSelectToArray($db->link->query);

    return $result;
    }
}
?>