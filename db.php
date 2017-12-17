<?php


class dataBase{
    protected $_link;
    public $result;
    public $fetchedData;
    public $data;

    function __construct() {
        require_once 'config.php';
        $this->_link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if(!$this->_link){
            echo "Не удалось подключиться к БД" . $this->_link->error;
            return false;
        }
        return $this->_link;
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