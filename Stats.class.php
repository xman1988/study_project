<?php
class Stats{
    public $array;
    public $keyHosts;
    public $countHits;
    function __construct(array $result){
        $this->array = $result;
    }

     function show(){
        echo "
           <br>Количество всех хитов:  {$this->array[4]["COUNT(*)"]}
           <br>Количество хитов клиента:  {$this->array[1]["COUNT(*)"]}
           <br>Количество моих хитов:  {$this->array[2]["COUNT(*)"]}
           <br>Количество хостов:  {$this->array[3]["COUNT(DISTINCT ip)"]}
           <br><br>
           <table border='black' cellpadding='7' cellspacing='0' align='middle' align='center'>
               <tr>
                   <td colspan='4'>Хосты</td>
                   <td colspan='2'>Хиты</td>
               </tr>";

        foreach($this->array[4] as $this->keyHosts => $this->countHits) {
            echo "<tr>
                    <td colspan='4'>{$this->keyHosts}</td>
                  </tr>
                  </table>";
        }
     }
}
?>