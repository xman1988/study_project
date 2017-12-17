<?php


class dataBase{  // с большой буквы
    protected $_link; //почему начинается с "_"
    public $result;
    public $fetchedData;
    public $data;

    function __construct() {
        require_once 'config.php'; //подключение конфига должно быть не в классе БД, а в индексном файле, например. А в класс БД должна передаваться переменная $config
        $this->_link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        if(!$this->_link){
            echo "Не удалось подключиться к БД" . $this->_link->error;
            return false;
        }
        return $this->_link;
    }

    public function dbInsert($sqlInsert) {
        $this->link->query($sqlInsert); //в конструкторе "_link", а здесь "link"
        if(!$this->result) { //сработает, ибо result нигде не задан
           echo("Сообщение об ошибке: %s\n". $this->link->error); //можно использовать show error
            return false;
        }
    }

    public function dbShowError() {
        echo "Ошибка! Невозможно подключиться к базе данных: ". mysqli::error; // так нельзя. $this->_link->error
    }

    public function dbSelectToArray($result) {
        if(!$result) {
           $this->dbShowError();
           return false;
        }
        else {
            while($this->fetchedData = mysqli_fetch_assoc($result)) { //не имеет смысла использовать fetchData Как свойство. Это обычная переменная. mysqli_fetch_assoc нужно использовать в объектном стиле
               $this->data[] = $this->fetchedData;  //$this->data нужно "обнулять" в начале метода: $this->data = [], иначе туда будет записываться все подряд из всех запросов.
            }
            return $this->data;
        }       
    }
}
?>