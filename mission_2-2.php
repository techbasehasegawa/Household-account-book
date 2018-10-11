<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>2-2</title>
</head>
 
<body>
<form action="mission_2-2.php" method="POST">  
       コメント:<input type="text" name="mission"> </br>
       名前:<input type="text" name="user"> </br>
          <input type="submit" value="送信">  
</form>  
<?php 
$file ="mission_2-1.txt"; 
$post = htmlspecialchars($_POST["mission"]);
echo $post;
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
?> 
<?php
$data = file_get_contents("mission_2-1.txt");
$data = explode( "\n", $data);
$cnt = count( $data );

for( $i=0;$i<$cnt;$i++ ){   
//echo $data[$i]."<br>"ここまでデータの取り出し
    for($j = 0 ; $j < 4 ; $j++){
    $elements =explode ("<>", $data[$i]);
    //で<>付きの表示消去
    echo $elements[$j]. " " ;
}
   echo "<br>";
}
?>

</body>
</html>