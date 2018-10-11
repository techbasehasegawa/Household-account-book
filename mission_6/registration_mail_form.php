<?php
session_start();

$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$sql = "CREATE TABLE pre_member (id INT ,urltoken VARCHAR(128) ,script VARCHAR(50) ,data_time DATETIME ,flag TINYINT(1)  DEFAULT 0);"; 
$stmt = $pdo->query($sql);
?>
 
<!DOCTYPE html>
<html>
<head>
<title>メール登録画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>メール登録画面</h1>
 
<form action="registration_mail_check.php" method="post">
 
<p>メールアドレス：<input type="text" name="mail" size="50"></p>
 
<input type="hidden" name="token" value="<?=$token?>">
<input type="submit" value="登録する">
 
</form>
 
</body>
</html>