<?php

class DataBase {
    public $link;
    public $result;
    public $data;

    function __construct($config) {
        $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if (!$this->link){
            echo "Не удалось подключиться к БД" . $this->link->error;
            return false;
        }
        return $this->link;
    }

    public function dbInsert($sqlInsert) {
        $this->link->query($sqlInsert);
        if (!$this->link->query($sqlInsert)) {
           echo("Сообщение об ошибке:". $this->link->error);
            return false;
        }
    }

    public function dbShowError() {
        echo "Ошибка! Невозможно подключиться к базе данных: ". $this->link->error;
    }

    public function dbSelectToArray($db,$counter) {
        $this->data = [];
        if (!$counter) {
           $this->dbShowError();
           return false;
        }
        else {
            while ($fetchedData = $db->link->query->fetch_assoc($counter->getCounterData)) {
               $this->data[] = $fetchedData;
            }
            return $this->data;
        }       
    }
}
?>