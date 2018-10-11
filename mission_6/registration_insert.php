<?php
session_start();
  
//データベース接続
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);

$sql = "CREATE TABLE member (id INT ,account VARCHAR(50),script VARCHAR(50) ,password VARCHAR(128) ,flag TINYINT(1)  DEFAULT 1);";
$stmt = $pdo->query($sql);
 
//エラーメッセージの初期化
$errors = array();

$mail = $_SESSION['mail'];
$account = $_SESSION['account'];
 
//パスワードのハッシュ化
$password_hash = $_SESSION['password'];
 
//ここでデータベースに登録する
try{
	//例外処理を投げる（スロー）ようにする
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//トランザクション開始
	$pdo->beginTransaction();
	
	//memberテーブルに本登録する
	$statement = $pdo->prepare("INSERT INTO member (account,script,password) VALUES (:account,:script,:password_hash)");
	//プレースホルダへ実際の値を設定する
	$statement->bindValue(':account', $account, PDO::PARAM_STR);
	$statement->bindValue(':script', $script, PDO::PARAM_STR);
	$statement->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
	$statement->execute();
		
	//pre_memberのflagを1にする
	$statement = $pdo->prepare("UPDATE pre_member SET flag=1 WHERE script=(:script)");
	//プレースホルダへ実際の値を設定する
	$statement->bindValue(':script', $script, PDO::PARAM_STR);
	$statement->execute();
	
	// トランザクション完了（コミット）
	$pdo->commit();
		
	//データベース接続切断
	$pdo = null;
	
	//セッション変数を全て解除
	$_SESSION = array();
	
	//セッションクッキーの削除・sessionidとの関係を探れ。つまりはじめのsesssionidを名前でやる
	if (isset($_COOKIE["PHPSESSID"])) {
    		setcookie("PHPSESSID", '', time() - 1800, '/');
	}
	
 	//セッションを破棄する
 	session_destroy();
 	
 	/*
 	登録完了のメールを送信
 	*/
	
}catch (PDOException $e){
	//トランザクション取り消し（ロールバック）
	$pdo->rollBack();
	$errors['error'] = "もう一度やりなおして下さい。";
	print('Error:'.$e->getMessage());
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
<title>会員登録完了画面</title>
<meta charset="utf-8">
</head>
<body>
 
<?php if (count($errors) === 0): ?>
<h1>会員登録完了画面</h1>
 
<p>登録完了いたしました。ログイン画面からどうぞ。</p>
<p><a href="http://tt-175.99sv-coco.com/mission_6/login.php">ログイン画面</a></p>
 
<?php elseif(count($errors) > 0): ?>
 
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>
 
<?php endif; ?>
 
</body>
</html>