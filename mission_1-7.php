<?php
header('Content-Type: text/html; charset=UTF-8');
?>
 <?php
 $file_name = "mission_1-6_hasegawa.txt";
 $ret_array = file ($file_name);
 for ($i = 0; $i < count ($ret_array); ++$i){
 	echo ($ret_array[$i]. "<br/>\n");
 }
 ?>