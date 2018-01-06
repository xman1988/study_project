<?php
class Stats{
    public $array;
    function __construct(array $result){
        $this->array = $result;
    }

     function show(){
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

        foreach($this->array[4] as $inArray ) {
            foreach($inArray as $key=>$value) {
                echo "
                    <tr>
                       <td >" .$inArray['host'] . "</td>
                       <td >" .$inArray['hits'] . "</td>
                    </tr>";
            }
        }
     }
}
?>