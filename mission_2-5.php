<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>2-5</title>
</head>
<body>

<?php
//メタ情報(付帯情報)を記述する。(データの説明書きの部分)>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//定義
    $file ="mission_2-5.txt"; 
    $data = file("mission_2-5.txt");
    $cnt = count($data);
    $comment = $_POST["comment"]; 
    $user = $_POST["user"]; 
    $passward3 = $_POST["passward3"]; 
    $timestamp = time();
    $number = 1;
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line = count (file($file))+1;
    $compilation = $_POST["compilation"];

// カウントの数だけ繰り返す　($i++ = $i + 1 カウントアップ処理)
for( $i=0;$i<$cnt;$i++ ){
           
        //elements で$dataを分割する
        $elements = explode ("<>", $data[$i]);
        
            if($number <= $elements[0]){
                $number = $elements[0]+1;
			}
				   if($compilation != NULL && ($elements[4] == $_POST["passward3"])){
				    //$elements[0]が(投稿番号が)あれば隠しフォームへ行き、elements1,2,4を表示する
				    if ($elements[0] == $_POST["compilation"]){
				        $get_user = $elements[1];
				        $get_comment = $elements[2];
				        $get_passward1 = $elements[4];
				        }
	}
}
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
$file ="mission_2-5.txt";   
if (!(file_exists($file))){
    touch($file);
}

$post = htmlspecialchars($_POST["comment"]);

//txt.ファイルに書き込み    
    $comment = $_POST["comment"]; 
    $delete = $_POST["delete"];
    $compilation = $_POST["compilation"]; 
    $user = $_POST["user"];
    $passward1 = $_POST["passward1"];
    $timestamp = time();
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line = count (file($file))+1;
    $newdata = $line."<>".$comment."<>".$user."<>".$postedAt."<>".$passward1."<>"."\n"; 
    $fp = fopen($file, "a");
    
    if(($comment != NULL) && ($passward1 != NULL)&& !(is_numeric($_POST["hide"])) && !(is_numeric($delete)) && !(is_numeric($compilation))){
        fwrite($fp, $newdata);
        }
        fclose($fp);
    
    
//入力されたパスワードと書き込み時に保存したパスワードが一致すれば削除・編集ができる

        
//削除ボタンに対応させる(2-3と同様)>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$data = file("mission_2-5.txt");//一行ずつ指定
$cnt = count ($data);
    if( is_numeric($_POST["delete"])){   
        $fp= fopen("mission_2-5.txt","w");    //変数が数値または数値文字列かどうか調べる
        for( $i=0;$i<$cnt;$i++ ){    
            $elements = explode( "<>", $data[$i]);
            if ($elements[0]!=$_POST["delete"]){
            fwrite($fp, $data[$i]);
            }elseif($elements[4]!=$_POST["passward2"]){
            fwrite($fp, $data[$i]);
            }else{
                echo $_POST["delete"]."番のコメントを削除しました。<br>";
            }
        }
         fclose($fp);
         }
//編集ボタンに対応させる>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//隠しフォームに記入があったら
if (is_numeric($_POST["hide"])){
    $elements = file($file);
    $fp= fopen($file,"w");
        for( $i=0;$i<$cnt;$i++ ){
            $elements = explode( "<>", $data[$i]);
                       
                    //隠しフォームが投稿番号$elements[0]について
					if($_POST["hide"] == $elements[0]){
			           
			           //それぞれの値を編集する
						$elements[1] = $_POST["user"];
						$elements[2] = $_POST["comment"];
						$passward[4]= $_POST["passward"];
						
			            //$elements を書き換えても$dataは変わらないので新しい変数 $latest を用意する
						$latest = $elements[0]."<>".$elements[1]."<>".$elements[2]."<>".$elements[3]."<>".$elements[4]."<>"."\n";

						//それを上書きする
						fwrite($fp,$latest);
			            }else{ 
						fwrite($fp,$data[$i]);
					    }
		}
				fclose($fp);
				echo $_POST["hide"]."番を編集しました。<br>";
}

//ブラウザに表示する/////////////////////////////////////////////////////////////////////////////////////////////////////////////
$data = file("mission_2-5.txt");
$cnt = count ($data);

for( $i=0;$i<$cnt;$i++ ){   
    //echo $data[$i]."<br>"ここまでデータの取り出し
        //で<>付きの表示消去
        for($j = 0 ; $j < 4 ; $j++){
        $elements = explode( "<>", $data[$i]);
        echo $elements[$j]." ";
        }
        echo "<br>";
        }   
?>
</body>
</html>