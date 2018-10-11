<meta charset="utf-8" />
<?php
//3-1データベースへの接続
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$pdo = new PDO($dsn,$user,$password);


//3-2データベース内にテーブルを作成する
$sql = "CREATE TABLE mission_4(id INT,name char(32),comment TEXT);";
$stmt = $pdo->query($sql);

$name=$_POST["name"]=$row [1];
$comment=$_POST["comment"]=$row [2];
$passward=$_POST["passward"]=$row [3];
?>
<!--formタグで送信先を定義する--> 
<form action="mission_2-5.php" method="POST">  
       
       <!--phpでは1つ先の画面までしか送信したデータを残せない。2つ以上にしたい時に隠しフォームを使う--> 
       名前:<input type="text" name="user" value=<?php echo $get_user; ?>>
       コメント:<input type="text" name="comment" value=<?php echo $get_comment; ?>>
       パスワード:<input type="text" name="passward1" value=<?php echo $get_passward1; ?>>
                  <!--編集用の箱作る--> 
        <input type="hidden" name="hide" value=<?php echo $_POST["compilation"]; ?>>
                 <!--"hidden"をtext↑の所に入れる(確認の時はテキストに戻した方がわかりやすい)--> 
                 <input type="submit" value="送信"></br>
                 
        削除:<input type="text" name="delete">
        パスワード:<input type="text" name="passward2" >
                  <input type="submit" value="削除"></br>           
        編集:<input type="text" name="compilation">
        パスワード:<input type="text" name="passward3" >
                 <input type="submit" value="編集"></br>
          
</form> 
<?php
//3-3テーブル一覧を表示するコマンドを使って作成が出来たか確認する
$sql="CREATE TABLEmission_4(id INT,user char(32),comment TEXT,datetime char(20),passward char(10));";
$result = $pdo -> query ($sql);
foreach ((array)$result as $row){
	echo $row [0];
	echo $row [1];
	echo $row [2];
	echo $row [3];
	echo "<br>";
}
echo "<hr>";


//3-4テーブルの中身を確認するコマンドを使って、意図した内容のテーブルが作成されているか確認する
$sql="CREATE TABLEmission_4(id INT,name char(32),comment TEXT,datetime char(20),passward char(10));";
$result = $pdo->query($sql);
foreach ((array)$result as $row){
	print_r($row[0]);
}
echo "<hr>";


//3-5作成ができたらinsertを行って、データを入力する
$sql = $pdo -> prepare("INSERT INTO mission_4 (id,name, comment) VALUES ('1',:name, :comment)");
$sql -> bindParam(":name", $name, PDO::PARAM_STR);
$sql -> bindParam(":comment", $comment, PDO::PARAM_STR);
$sql -> bindParam(":passward", $passward, PDO::PARAM_STR);
$name = "ディズニー";
$comment = "ランドに行きたい";

//3-6入力したデータをselectによって表示する
$sql = "SELECT * FROM mission_4";
$results = $pdo -> query($sql);
foreach ($results as $row){
 //$rowの中にはテーブルのカラム名が入る
 echo $row["id"].",";
 echo $row["name"].",";
 echo $row["comment"].",";
 echo $row["passward"]."<br>";
 }

//3-7入力したデータをupdateによって編集する
$id = 1;
$nm = "ディズニー";
$kome = "シーに行きたい"; 
$sql = "update mission_4 set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);

//3-8入力したデータをdeleteによって削除する
$id = 2;
$sql = "delete from mission_4 where id=$id";
$result = $pdo->query($sql);

?>
