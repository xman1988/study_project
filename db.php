<?php
require_once 'config.php';

class dataBase{
    private $link;
    public $result;
    public $fetchedData;
    public $data;

    function __construct($config) {
        $this->link = mysqli_connect($config["host"], $config["user"], $config["pass"], $config["database"]);
        if(!$this->link) {
            return false;
        }
        return $this->link;
    }

    public function dbInsert($sqlInsert) {
        $this->result = mysqli::query($sqlInsert);
        if(!$this->result) {
            printf("Сообщение об ошибке: %s\n". mysqli::error);
            return false;
        }
    }

    public function dbShowError() {
        echo "Ошибка! Невозможно подключиться к базе данных: ". mysqli::error;
    }

    public function dbSelectToArray($result) {
        if(!$result) {
           $this->dbShowError();
           return false;
        }
        else {
            while($this->fetchedData = mysqli_fetch_assoc($result)) {
               $this->data[] = $this->fetchedData; 
            }
            return $this->data;
        }       
    }
}
?>