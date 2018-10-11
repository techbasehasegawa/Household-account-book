<?php
//3-1データベースへの接続
$dsn = "mysql:dbname=tt_175_99sv_coco_com;host=localhost";
$user = "tt-175.99sv-coco";
$password = "Kf5w3EhY";
$pdo = new PDO($dsn,$user,$password);

$sql = "SELECT * FROM member";
$results = $pdo -> query($sql);
foreach ($results as $row){
 //$rowの中にはテーブルのカラム名が入る
 echo $row["account"].",";
 echo $row["script"].",";
 echo $row["data_time"].",";
  echo $row["flag"].",";
 echo $row["passward"]."<br>";
 }

echo "<br>";

$sql = "SELECT * FROM pre_member";
$results = $pdo -> query($sql);
foreach ($results as $row){
 //$rowの中にはテーブルのカラム名が入る
 echo $row["id"].",";
 echo $row["urltoken"].",";
 echo $row["flag"].",";
 echo $row["data_time"]."<br>";
 }

?>
