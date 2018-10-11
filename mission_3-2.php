<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$sql = "CREATE TABLE tbtest(id INT,name char(32),comment TEXT);";
$stmt = $pdo->query($sql);
?>