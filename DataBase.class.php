<?php

/**
 * Class DataBase класс работы с БД
 *
 */
class DataBase {

    /**
     * @var mysqli Свойство соединения с БД
     */
    protected $link;

    /**
     * @var array Массив, обработанных данных из БД
     */
    public $data;

    /**
     * DataBase constructor Устанавливает соединение с БД
     *
     * @param $config array Настройки соединения
     */
    function __construct($config) {
        if($config) {
            $this->link = new mysqli($config["host"], $config["user"], $config["pass"], $config["database"]);
        }
        else {
            $errorMessage = "Не переданы настройки подключения к БД";
            $this->dbShowError($errorMessage);
        }
    }

    /**
     * Метод выборки данных из БД
     *
     * @param string $sql Запрос на выборку данных из БД
     * @return bool|mysqli_result В случае успеха возвращает объект mysqli_result, в случае неудачи - false, либо NULL
     */
    public function select($sql) {
        if ($sql) {
            $result = $this->link->query($sql);
            if (is_object($result)) {
                return $result;
            }
            else {
                echo "В запросе <br>".$sql."<br> вернулся: ";
                var_dump($result);
                $errorMessage = "Select не выполнен";
                $this->dbShowError($errorMessage);
            }
        }
        else {
            $errorMessage = "Ошибка - Текст запроса не передан!";
            $this->dbShowError($errorMessage);
        }
    }

    /**
     * Метод вставки данных в БД
     * В случае неудачи вызывает метод dbShowError()
     *
     * @param string $sql Запрос на вставку данных в БД
     */
    public function insert($sql) {
        if ($sql) {
            $result = $this->link->query($sql);
            if (!$result) {
                echo "В запросе <br>".$sql."<br> вернулся: ";// Почему возвращает null, когда должен в случае неудачи возвращать false?
                var_dump($result);
                $errorMessage = "Insert не выполнен";
                $this->dbShowError($errorMessage);
            }
        }
        else {
            $errorMessage = "Ошибка - Текст запроса не передан!";
            $this->dbShowError($errorMessage);
        }
    }

    /**
     * Метод возвращет id последней вставленной записи в БД
     *
     * @return mixed $id Возвращает id последней вставленной записи в БД
     */
    public function getCurrentId() {
        $id = $this->link->insert_id;
        return $id;
    }

    /**
     * Метод обрабатывает и записывает объект от БД в массив
     *
     * @param mysqli_result $resultFromDB Объект от БД, состоящий из массива данных
     * @return array Массив с результатом от БД
     */
    public function dbSelectToArray(mysqli_result $resultFromDB) {
        $this->data = [];
        while ($rowFetchedData = $resultFromDB->fetch_assoc()) {
            $this->data[] = $rowFetchedData;
        }

        return $this->data;
    }

    /**
     * Метод обрабатывает и записывает объект от БД, состоящий из 1 строки в переменную
     *
     * @param mysqli_result $resultFromDB Объект от БД, состоящий из 1 строки
     * @return variable Переменная с результатом от БД, состоящим из 1 строки
     */
    public function dbSelectToSimpleArray(mysqli_result $resultFromDB) {
        $rowFetchedData = $resultFromDB->fetch_assoc();
        return $rowFetchedData;
    }

    /**
     * Метод выводит на экран текст ошибки
     *
     * @param string $errorMessage принимает текст ошибки
     */
    public function dbShowError($errorMessage) {
        echo $errorMessage."</br>". $this->link->error . "<br />";
        die;
    }
}
?>