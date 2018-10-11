<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>1-5</title>
</head>
 
<body>
<?php
  if(isset($_POST['comment']) ) {
    $comment = htmlspecialchars($_POST['comment']);
    echo $comment;
  }
?>
 
<form action="mission_1-5.php" method="POST">
  <input type="text" value="コメント" name="comment" />
  <input type="submit" value="送信"　/>
</form>
 
<?php
  if(strcmp($comment , "完成！") == 0 ) {
    echo "おめでとう！";
  }else {
    echo "ご入力ありがとうございます <br/>" , date("Y/m/d H:i:s") , "に、" , $comment , "を受け付けました。";
  }
?>
 
 <?php
  if($comment != NULL) {
    $filename = 'mission_1-5_hasegawa.txt';
    $fp = fopen($filename , 'w');
    fwrite($fp , $comment);
    fclose($fp);
  }
 ?>
</body>
</html>