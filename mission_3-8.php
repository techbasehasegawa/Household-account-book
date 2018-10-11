<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$id = 2;
$sql = "delete from tbtest where id=$id";
$result = $pdo->query($sql);
?>