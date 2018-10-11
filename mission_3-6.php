<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$sql = "SELECT * FROM tbtest";
$results = $pdo -> query($sql);
foreach ($results as $row){
 //$rowの中にはテーブルのカラム名が入る
 echo $row["id"].",";
 echo $row["name"].",";
 echo $row["comment"]."<br>";
 }
?>