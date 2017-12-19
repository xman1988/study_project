<?php
class DataBase {

    protected $link;
    public $data =[];


    function __construct($config) {
        $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if (!$this->link){
            $this->dbShowError();
        }
    }


    public function getQuery($sql){
        if($sql){
            $result = $this->link->query($sql);
            return $result;
        }
        else{
            echo "Ошибка! Не принят запрос sql: </br>". $this->link->error . "<br />";
        }
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
            echo "<br>Ошибка метода dbSelectToArray! Не вернулся результирующий массив данных из БД:". $this->link->error . "<br />";
             return false;
        }
            return $this->data;

    }


}
?>