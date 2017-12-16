<?php
require_once 'config.php';

class dataBase{
    private $link;

    function __construct($config){
        $this->link = mysqli_connect($config["host"], $config["user"], $config["pass"], $config["database"]);
        if(!$this->link) {
            return false;
        }
        return $this->link;
    }

    public function dbInsert($sqlInsert) {
        $result = $mysqli->query($sqlInsert);
        if(!$result) {
            printf("Сообщение об ошибке: %s\n". $mysqli->error);
            return false;
        }
    }

    public function dbShowError() {
        echo "Ошибка! Невозможно подключиться к базе данных: ".PHP_EOL;
    }

    public function dbSelectToArray($result) {
        if(!$result) {
           $this->databaseShowError();
           return false;
        }
        else {
            while($fetchedData = mysqli_fetch_assoc($result)) {
               $data[] = $fetchedData; 
            }
            return $data;
        }       
    }
}
?>