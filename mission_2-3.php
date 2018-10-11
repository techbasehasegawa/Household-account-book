<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>2-3</title>
</head>
<body>
<form action="mission_2-3.php" method="POST">  
       コメント:<input type="text" name="mission"> </br>
       名前:<input type="text" name="user"> </br>
        削除対象番号:<input type="text" name="delete"> </br>
          <input type="submit" value="送信">  
</form>  
<?php 
$file ="mission_2-3.txt"; 
 if( !file_exists($file) ){
    touch( $file);
}
$post = htmlspecialchars($_POST["mission"]);
if ($post != NULL){    
    $comment = ($_POST["mission"]); 
    $user = ($_POST["user"]); 
    $timestamp = time();
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line = count (file($file))+1;
    $newdata = $line."<>".$comment."<>".$user."<>".$postedAt. "\n"; 
    $fp = fopen($file, "a");
    fwrite($fp, $newdata);
    fclose($fp);
}

$arr = file("mission_2-3.txt");//一行ずつ指定
$cnt = count ($arr);
if( is_numeric($_POST["delete"])){   
$fp= fopen("mission_2-3.txt","w");    //変数が数値または数値文字列かどうか調べる
for( $i=0;$i<$cnt;$i++ ){    
$data = explode( "<>", $arr[$i]);
    if ($data[0]!=$_POST["delete"]){
        fwrite($fp, $arr[$i]);
           }
     }
 fclose($fp); 
 echo $_POST["delete"]."番のコメントを削除しました。<br>";
 }
$data = file_get_contents("mission_2-3.txt");
$data = explode( "\n", $data);
$cnt = count( $data );

for( $i=0;$i<$cnt;$i++ ){   
//echo $data[$i]."<br>"ここまでデータの取り出し
    for($j = 0 ; $j < 4 ; $j++){
    $elements =explode ("<>", $data[$i]);
    echo $elements[$j]." ";
    //で<>付きの表示消去
}
   echo "<br>";
}   

?>  
</body>
</html>