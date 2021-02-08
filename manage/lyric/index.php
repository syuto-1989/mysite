<?php
session_start();
require_once('../config.php');


if ($_SESSION != "") {
	extract($_SESSION);
}

//ログイン済みの場合
if (isset($_SESSION['email'])) {
  $msg = 'ようこそ' .  h($_SESSION['email']) . "さん<br>";
  $link = "<a href='/manage/logout.php'>ログアウトはこちら。</a>";
} else {
  header("location:/manage/index.php");
  exit;
}


//削除の場合
if (isset($_POST["delete"])) {

		//確認画面処理
        $_SESSION["delete"] = $_POST["delete"];
		header("location:./delete.php");

}

//DB接続
$mysqli = new mysqli('', '', '', '');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

//データ取得
$sql = "SELECT * FROM `lyrics` ORDER BY `lyrics`.`create_date` ASC LIMIT 0 , 30";
//$sql = "SELECT * FROM `blog` LEFT OUTER JOIN `userData` ON `blog`.`user_id` = `userData`.`email` ORDER BY `blog`.`create_date` ASC LIMIT 0 , 30";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}






//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        <div class="top-container ">
					<div class="ttl mincho">
							<h1>歌詞一覧</h1>
					</div>
            <form action="#pan" method="post">
                <div class="tb-scroll">
                    <table border="1">
                        <tr>
                            <th class="bold">投稿日時</th>
                            <th class="bold">タイトル</th>
                            <th></th>
                        </tr>
                        <?php
                            $rst = $mysqli->query($sql);
                            if (!$rst) {
                                echo 'system error.' . $mysqli->error;
                                exit(1);
                            }

                            while ($row = $rst->fetch_assoc()) {
                                $edit = './register/index.php?id='.$row['id'];
                                $delete = '<button name="delete" type="submit" value="'.$row['id'].'" />削除</button>';
                                if(!empty($row['img'])){
                                    $image = '<img src="./register/images/'.$row['img'].'" width="100" height="100">';
                                } else{
                                    $image = '';
                                }
                                echo '<tr>
                                        <td class="bold">'.$row['create_date'].'</td>
                                        <td><div>'.$row['title'].'</div></td>
                                        <td><a href="'.$edit.'">編集</a>'.$delete.'</td>
                                    </tr>';
                            }
                         ?>
                    </table>
                </div>
            </form>
						<div class="flex">
	            <div class="btn">
	                <a href="register/index.php">新規登録</a>
	            </div>
							<div class="btn">
	                <a href="/lyrics" target="_blank">LYRICS of RADIOHEAD</a>
	            </div>
					</div>
            <div class="logout">
                <h1><?php echo $msg; ?></h1>
                <?php echo $link; ?>
            </div>
        </div>
    </div>
</section>




</main>
