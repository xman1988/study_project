<?php


class dataBase{
    protected $link;
    public $result;
    public $fetchedData;
    public $data;

    function dbConnect($config) {
        $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if(!$this->link) {
        printf("Не удалось подключиться: %s\n", $this->link->connect_error);
        return false;
        }
        return $this->link;
    }

    public function dbInsert($sqlInsert) {
        $this->link->query($sqlInsert);
        if(!$this->result) {
           echo("Сообщение об ошибке: %s\n". $this->link->error);
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