<?php
class DataBase {

    protected $link;
    public $data;

    function __construct($config) {
        if($config){
            $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        }
        else{
            $errorMessage = "Не переданы настройки подключения к БД";
            $this->dbShowError($errorMessage);
        }
    }

    public function select($sql){
        if($sql){
            $result = $this->link->query($sql);
            if($result === false){
                $errorMessage = "Select не выполнен";
                $this->dbShowError($errorMessage);
            }
            return $result;
        }
        else{
            $errorMessage = "Не передан запрос к БД";
            $this->dbShowError($errorMessage);
        }
    }

    public function insert($sql){
        if($sql){
            $result = $this->link->query($sql);
            if($result === false){
                $errorMessage = "Insert не выполнен";
                $this->dbShowError($errorMessage);
            }
        }
        else{
            $errorMessage = "Не передан запрос к БД";
            $this->dbShowError($errorMessage);
        }
    }

    public function update($sql){
        if($sql){
            $result = $this->link->query($sql);
            if($result === false){
                $errorMessage = "Update не выполнен";
                $this->dbShowError($errorMessage);
            }
        }
        else{
            $errorMessage = "Не передан запрос к БД";
            $this->dbShowError($errorMessage);
        }
    }

    public function getCurrentId() {
        $id = $this->link->insert_id;
        return $id;
    }

    public function dbSelectToArray(mysqli_result $resultFromDB){
        if ($resultFromDB){
            while ($rowFetchedData = $resultFromDB->fetch_assoc()) {
                $this->data = [];
                $this->data = $rowFetchedData;
            }
            return $this->data;
        }
        else {
            $errorMessage = "Не пришел ответ из БД";
            $this->dbShowError($errorMessage);
        }
    }

    public function dbSelectToSimpleArray(mysqli_result $resultFromDB){
        $rowFetchedData = $resultFromDB->fetch_assoc();
        return $rowFetchedData;
    }

    public function dbShowError($errorMessage) {
        echo $errorMessage."</br>". $this->link->error . "<br />";
        die;
    }

}
?>