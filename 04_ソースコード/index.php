<?php
$errors = [];
if($_POST){
    $id = null;
    $name = $_POST["name"];
    $contents = $_POST["contents"];
    if(null === $name){
        $errors[] .= "名前を入力してください";
    }
    if(null === $contents){
        $errors[] .= "投稿内容を入力してください";
    }
    if(!$errors){
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        //DB接続情報を設定します。
        
            $pdo = new PDO('mysql:host=mysql210.phy.lolipop.lan;dbname=LAA1418127-sample;charset=utf8','LAA1418127','aiueo');
           
        
        //ここで「DB接続NG」だった場合、接続情報に誤りがあります。
        
        //SQLを実行。
        $regist = $pdo->prepare("INSERT INTO post(id, name, contents, created_at) VALUES (:id,:name,:contents,:created_at)");
        $regist->bindParam(":id", $id);
        $regist->bindParam(":name", $name);
        $regist->bindParam(":contents", $contents);
        $regist->bindParam(":created_at", $created_at);
        $regist->execute();
        //ここで「登録失敗」だった場合、SQL文に誤りがあります。
        
    }
}

//DB接続情報を設定します。
$pdo = new PDO('mysql:host=mysql210.phy.lolipop.lan;dbname=LAA1418127-sample;charset=utf8','LAA1418127','aiueo');
//ここで「DB接続NG」だった場合、接続情報に誤りがあります。

//SQLを実行。
$regist = $pdo->prepare("SELECT * FROM post order by created_at DESC limit 30");
$regist->execute();
//ここで「登録失敗」だった場合、SQL文に誤りがあります。

?>


<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta charset="UTF-8">
<title>掲示板サイト</title>
<style>
	p{
		color:red;
 	 	text-align: center;
		}
        h1 {
			color:red;
            		text-align: center;
            }
        h2{
		color:red;
            background-color: yellow;
		text-align: center;
        }
	.oppai{
		background-color: black;
		color:red;
		text-align: center;
	}
	body{
		background-image: url("black.jpg");
}
    </style>
</head>


<body>

<h1>掲示板サイト</h1>


<section>
<p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
  <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
</svg></p>
    <h2>新規投稿</h2>
    <div id="error"><?php foreach($errors as $error){echo $error.'<br>';}?></div>
    <form action="index.php" method="post">
        <p>名前<br><input type="text" name="name" value=""><br><br>
        投稿内容<br><textarea name="contents" value="" cols="50" rows="10"></textarea><br>
        <button type="submit">投稿</button></p>
    </form>
</section>

<section>

	<h2>投稿内容一覧</h2>



		<?php foreach($regist as $loop):?>
			<div><?php
			echo "<div class=oppai>";
			echo "No:";
			 echo $loop['id'];
			echo "</div>";
			?></div>
			<div><?php
			echo "<div class=oppai>";
			echo "名前:";
			 echo $loop['name'];
			echo "</div>";
			?></div>
			<div><?php 
			echo "<div class=oppai>";
			echo "投稿内容：";
			echo $loop['contents'];
			echo "</div>";
			?></div>
			<div><?php
			echo "<div class=oppai>";
			echo "投稿時間：";
			 echo $loop['created_at'];
			echo "</div>";
			?></div>
			<div class="oppai">------------------------------------------</div>
		<?php endforeach;?>

	
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>