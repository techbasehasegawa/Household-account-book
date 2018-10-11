<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$sql ="SHOW CREATE TABLE tbtest";
$result = $pdo->query($sql);
foreach ($result as $row){
	print_r($row);
}
echo "<hr>";
?>