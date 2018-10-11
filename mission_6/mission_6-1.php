<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>6-1</title>
</head>
<body>

<?php
//メタ情報(付帯情報)を記述する。(データの説明書きの部分)>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

//定義
    $file ="mission_6-1.txt";   
    $data = file("mission_6-1.txt");
    $cnt = count($data);
    $price = $_POST["price"]; 
    $itemname = ($_POST["itemname"]); 
    $timestamp = time();
    $number = 1;
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line = count (file($file))+1;

// カウントの数だけ繰り返す　($i++ = $i + 1 カウントアップ処理)
    for( $i=0;$i<$cnt;$i++ ){
           
        //elements で$dataを分割する
        $elements = explode ("<>", $data[$i]);
        
            if($number <= $elements[0]){
                $number = $elements[0]+1;
			}
				   
				    //$elements[0]が(投稿番号が)あれば隠しフォームへ行き、elements1,2を表示する
				    if ($elements[0] == $_POST["compilation"]){
				        $get_itemname = $elements[1];
				        $get_price = $elements[2];
				        }
	}

?>
<h2>支出</h2>
<!--formタグで送信先を定義する--> 
<form action="mission_6-1.php" method="POST">  
       
       <!--phpでは1つ先の画面までしか送信したデータを残せない。2つ以上にしたい時に隠しフォームを使う--> 
       商品名:<input type="text" name="itemname" value=<?php echo $get_itemname; ?>></br>
       価格:<input type="text" name="price" value=<?php echo $get_price; ?>>

                  <!--編集用の箱作る--> 
        <input type="hidden" name="hide" value=<?php echo $_POST["compilation"]; ?>>
                 <!--"hidden"をtext↑の所に入れる(確認の時はテキストに戻した方がわかりやすい)--> 
                 <input type="submit" value="送信"></br>
                 
        削除:<input type="text" name="delete">
                  <input type="submit" value="送信"></br> 
                    
        編集:<input type="text" name="compilation">
                 <input type="submit" value="送信"></br>   
</form> 
 
<?php
$file ="mission_6-1.txt";   
if (!(file_exists($file))){
    touch($file);
}

$post = htmlspecialchars($_POST["price"]);

//txt.ファイルに書き込み    
    $price = $_POST["price"]; 
    $delete = $_POST["delete"];
    $compilation = $_POST["compilation"]; 
    $itemname = $_POST["itemname"];
    $timestamp = time();
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line = count (file($file))+1;
    $newdata = $line."<>".$itemname."<>".$price."<>".$postedAt. "\n"; 
    $fp = fopen($file, "a");
    
    if(($price != NULL) && !(is_numeric($_POST["hide"])) && !(is_numeric($delete)) && !(is_numeric($compilation))){
        fwrite($fp, $newdata);
        }
        fclose($fp);
        
//削除ボタンに対応させる(2-3と同様)>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$data = file("mission_6-1.txt");//一行ずつ指定
$cnt = count ($data);
    if( is_numeric($_POST["delete"])){   
        $fp= fopen("mission_6-1.txt","w");    //変数が数値または数値文字列かどうか調べる
        for( $i=0;$i<$cnt;$i++ ){    
            $elements = explode( "<>", $data[$i]);
            if ($elements[0]!=$_POST["delete"]){
            fwrite($fp, $data[$i]);
            }
        }
         fclose($fp);
         echo $_POST["delete"]."番の項目を削除しました。<br>";
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
						$elements[1] = $_POST["itemname"];
						$elements[2] = $_POST["price"];
						
			            //$elements を書き換えても$dataは変わらないので新しい変数 $latest を用意する
						$latest = $elements[0]."<>".$elements[1]."<>".$elements[2]."<>".$postedAt;

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
$data = file("mission_6-1.txt");
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
//価格配列の中身を全部足す///////////////////////////////////////////////////////////////////////////////////////
$num = 0;
for ($i = 0; $i < $cnt; $i++) {
           //elements で$dataを分割する
        $elements = explode ("<>", $data[$i]);
        
            if($number <= $elements[0]){
                $number = $elements[0]+1;
			}
				   
				    //$elements[0]が(投稿番号が)あれば隠しフォームへ行き、elements1,2を表示する
				    if ($elements[0] == $_POST["compilation"]){
				        $get_itemname = $elements[1];
				        $get_price = $elements[2];
				        }

    $num += $elements[2];
    }
echo "支出合計は" . $num . "です。<br>";
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
?>
<h2>収入</h2>
<!--formタグで送信先を定義する--> 
<form action="mission_6-1.php" method="POST">  
       
       <!--phpでは1つ先の画面までしか送信したデータを残せない。2つ以上にしたい時に隠しフォームを使う--> 
       金額:<input type="text" name="income" value=<?php echo $get_income; ?>>
                 <input type="submit" value="送信"></br>
                 
        削除:<input type="text" name="delete2">
                  <input type="submit" value="送信"></br> 
                    
 </form> 
<?php
$file2 ="mission_6-2.txt";   
if (!(file_exists($file2))){
    touch($file2);
}

$post = htmlspecialchars($_POST["income"]);

//txt.ファイルに書き込み    
    $income = $_POST["income"]; 
    $delete2 = $_POST["delete2"];
    $timestamp= time();
    $postedAt = date("Y-m-d H:i:s",$timestamp); 
    $line2 = count (file($file2))+1;
    $newdata2 = $line2."<>".$income."<>".$postedAt. "\n"; 
    $fp2 = fopen($file2, "a");
    
    if(($income != NULL) && !(is_numeric($_POST["hide"])) && !(is_numeric($delete2))){
        fwrite($fp2, $newdata2);
        }
        fclose($fp2);
        
//削除ボタンに対応させる(2-3と同様)>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$data2 = file("mission_6-2.txt");//一行ずつ指定
$cnt2 = count ($data2);
    if( is_numeric($_POST["delete2"])){   
        $fp2= fopen("mission_6-2.txt","w");    //変数が数値または数値文字列かどうか調べる
        for( $i2=0;$i2<$cnt2;$i2++ ){    
            $elements2 = explode( "<>", $data2[$i2]);
            if ($elements2[0]!=$_POST["delete2"]){
            fwrite($fp2, $data2[$i2]);
            }
        }
         fclose($fp2);
         echo $_POST["delete2"]."番のコメントを削除しました。<br>";
         }
//編集ボタンに対応させる>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//隠しフォームに記入があったら
if (is_numeric($_POST["hide"])){
    $elements2 = file($file2);
    $fp2= fopen($file2,"w");
        for( $i2=0;$i2<$cnt2;$i2++ ){
            $elements2 = explode( "<>", $data2[$i2]);
            				            
                    //隠しフォームが投稿番号$elements[0]について
					if($_POST["hide"] == $elements2[0]){
			           
			           //それぞれの値を編集する
						$elements2[1] = $_POST["iincome"];
						
			            //$elements を書き換えても$dataは変わらないので新しい変数 $latest を用意する
						$latest2 = $elements2[0]."<>".$elements2[1]."<>".$postedAt;

						//それを上書きする
						fwrite($fp2,$latest2);
			            }else{ 
						fwrite($fp2,$data[$i2]);
					    }
		}
				fclose($fp2);
				echo $_POST["hide"]."番を編集しました。<br>";
}

//ブラウザに表示する/////////////////////////////////////////////////////////////////////////////////////////////////////////////
$data2 = file("mission_6-2.txt");
$cnt2 = count ($data2);

for( $i2=0;$i2<$cnt2;$i2++ ){   
    //echo $data2[$i2]."<br>"ここまでデータの取り出し
        //で<>付きの表示消去
        for($j2 = 0 ; $j2 < 4 ; $j2++){
        $elements2 = explode( "<>", $data2[$i2]);
        echo $elements2[$j2]." ";
        }
        echo "<br>";
        }  
//価格配列の中身を全部足す///////////////////////////////////////////////////////////////////////////////////////
$num2 = 0;
for ($i2 = 0; $i2 < $cnt2; $i2++) {
           //elements で$dataを分割する
        $elements2 = explode ("<>", $data2[$i2]);
        
            if($number2 <= $elements2[0]){
                $number2 = $elements2[0]+1;
			}
				   
				    //$elements[0]が(投稿番号が)あれば隠しフォームへ行き、elements1,2を表示する
				    if ($elements2[0] == $_POST["compilation2"]){
				        $get_income = $elements2[1];
				       				        }

    $num2 += $elements2[1];
    }
echo "収入合計は" . $num2 . "です。<br>";
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
?>
<h2>残高</h2>
<?php
$balance = $num2 - $num;
echo "残高は".$balance."円です。";

if($balance >= 0){
echo  "黒字だから大丈夫だけど気をつけて";
}else{
    echo "もうやばい、セーブして";
}
?>
</body>
</html>