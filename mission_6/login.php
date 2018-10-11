<!DOCTYPE html>
<html>
<head>
<title>ログイン画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>ログイン画面</h1>
 <form action="login.php" method="post">
<p>アカウント名 :<input type = "text" name = "account" > </p>
<p>パスワード：<input type = "text" name = "password" ></p>
 <input type="button" value="戻る" onClick="history.back()">
<input type="submit" value="ログイン">
</form>
 </body>
</html>
<?php

$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);
$sql = 'SELECT * FROM member';
	
	$results = $pdo -> query($sql);
	$pass = $_POST["password"];
	$account = $_POST["account"];
	if($pass && $account){
		echo $pass.$account;
		foreach ($results as $row){
			echo $row['id'].',';
			echo $row['mail'].',';
			echo $row['password'].',';
			echo $row['account'].',';
			echo $row['flag'].'<br>';
			if(($account == $row['account']) && ($pass == $row['password'])){
			echo "eeee";
			header("Location: http://tt-175.99sv-coco.com/mission_6/mission_6-1.php");//header()は（）内に記述したページに飛ばすことができる
			exit();
			}
		}
	}
?>