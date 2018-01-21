<?php

/**
 * Class Stats Класс вывода результата выборки из БД на экран
 */
class Stats {

    /**
     * @var array $array Массив данных для вывода на экран
     */
    public $array;

    /**
     * Stats constructor. Принимает массив данных
     *
     * @param array $result Принимаемый массив данных для вывода на экран
     */
    public function __construct(array $result) {
        $this->array = $result;
    }

    /**
     * Метод выводит данные из массива на экран
     */
     public function show() {
        echo "
           <br>Количество всех проверенных хитов:  {$this->array[0]["allRightHits"]}
           <br>Количество хитов клиента:  {$this->array[1]["clientIp"]}
           <br>Количество хостов:  {$this->array[2]["hosts"]}
           <br>Количество всех непроверенных хитов:  {$this->array[3]["allHits"]}
           <br><br>
           <table border='black' cellpadding='7' cellspacing='0' align='middle' align='center'>
                   <tr>
                       <td >Хосты</td>
                       <td >Хиты</td>
                   </tr>";

        foreach ($this->array[4] as $keys) {
                echo "
                    <tr>
                       <td >". $keys['host'] ." </td>
                       <td >". $keys['hits'] ."</td>
                    </tr>";
        }
     }
}
?>
