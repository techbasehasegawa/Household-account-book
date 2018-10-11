<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$id = 1;
$nm = "ディズニー";
$kome = "シーに行きたい"; //好きな名前、好きな言葉は自分で決めること
$sql = "update tbtest set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);
?>