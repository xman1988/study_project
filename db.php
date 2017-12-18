<?php
class DataBase {
    
    public $link;
    public $data =[];
    function __construct($config) {
        $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if (!$this->link){
            $this->dbShowError();
            return false;
        }
        return $this->link;
    }

    public function dbShowError() {
        echo "Ошибка! Невозможно подключиться к базе данных:</br>". $this->link->error . "<br />";
    }

    public function dbSelectToArray($resultFromDB){
        if ($resultFromDB) {
            while ($rowFetchedData = $resultFromDB->fetch_assoc()) {
                $this->data = $rowFetchedData;
            }
        }
        else {
            echo "Ошибка метода dbSelectToArray! Не передан результирующий массив данных их БД:</br>". $this->link->error . "<br />";
             return false;
        }
            return $this->data;

    }
}
?>