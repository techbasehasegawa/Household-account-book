<?php
if(isset($_POST['comment'])){
	$comment = $_POST['comment'];
echo $comment;
}
?>
<!DOCTYPE html>
<html lang = "ja">
<meta charset="UTF-8">
<body>
<form action="mission_1-4.php" method ="post"> 
<input type="text"  value="コメント" name="comment">
<input type="submit" value="送信">
</form>

<?php
$post = htmlspecialchars($_POST["comment"]);
echo $post;
if ($post != NULL){
echo "ご入力ありがとうございます。<br/>";
echo date_default_timezone_set('asia/Tokyo');
echo date("Y/m/d H:i:s")."\n";
echo"に、";
echo $comment=$_POST['comment'];
echo"を受け付けました。";
}
?>
</body>
</html>
