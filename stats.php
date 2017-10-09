<?php

$show1 = array_pop($counterData[0][0]);
$show2 = array_pop($counterData[1][0]);
$show3 = array_pop($counterData[2][0]);
$show4 = array_pop($counterData[3][0]);

echo "<br>Количество всех хитов: &nbsp".$show1.
     "<br>Количество хитов клиента: &nbsp".$show2.   
     "<br>Количество моих хитов: &nbsp".$show3.
     "<br>Количество хостов: &nbsp".$show4.   
	 "<br><br>
	<table border='black' cellpadding='7' cellspacing='0' align='middle' align='center'>
	   <tr>
	     <td colspan='4'>Хосты</td>
	     <td colspan='2'>Хиты</td>
	   </tr>
	   <tr>
	     <td colspan='4'>".$counterData[4][0]['ip']."</td>
	     <td colspan='2'>".$counterData[4][0]['COUNT(*)']."</td>
	   </tr>
	   <tr>
	     <td colspan='4'>".$counterData[4][1]['ip']."</td>
	     <td colspan='2'>".$counterData[4][1]['COUNT(*)']."</td>
	   </tr>
	   <tr>
	     <td colspan='4'>".$counterData[4][2]['ip']."</td>
	     <td colspan='2'>".$counterData[4][2]['COUNT(*)']."</td>
	   </tr>
	   <tr>
	     <td colspan='2'>".$counterData[4][3]['ip']."</td>
	     <td colspan='4'>".$counterData[4][3]['COUNT(*)']."</td>
	   </tr>
  	</table>";

?>