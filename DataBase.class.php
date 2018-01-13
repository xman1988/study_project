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
            if(is_object($result)){
                return $result;
            }
            else{
                echo "В запросе <br>".$sql."<br> вернулся: ";
                var_dump($result);
                $errorMessage = "Select не выполнен";
                $this->dbShowError($errorMessage);

            }
        }
        else{
            $errorMessage = "Ошибка - Текст запроса не передан!";
            $this->dbShowError($errorMessage);
        }
    }

    public function insert($sql){
        if($sql){
            $result = $this->link->query($sql);
            if(!$result){
                echo "В запросе <br>".$sql."<br> вернулся: ";// Почему возвращает null, когда должен в случае неудачи возвращать false?
                var_dump($result);
                $errorMessage = "Insert не выполнен";
                $this->dbShowError($errorMessage);
            }
        }
        else{
            $errorMessage = "Ошибка - Текст запроса не передан!";
            $this->dbShowError($errorMessage);
        }
    }

    public function getCurrentId() {
        $id = $this->link->insert_id;
        return $id;
    }

    public function dbSelectToArray(mysqli_result $resultFromDB){
        $this->data = [];
        while ($rowFetchedData = $resultFromDB->fetch_assoc()) {
            $this->data[] = $rowFetchedData;
        }

        return $this->data;
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