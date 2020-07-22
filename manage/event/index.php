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
$mysqli = new mysqli('mysql145.phy.lolipop.lan', 'LAA1126384', 'sitositosito111', 'LAA1126384-syutoito');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

//データ取得
$sql = "SELECT * FROM `AFC_ticket` ORDER BY `AFC_ticket`.`date` ASC LIMIT 0 , 30";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}

//配列作成
$ticket_ay = array();
while ($row = $rst->fetch_assoc()) {
$row['date'] = str_replace('-',  '/', $row['date']);
$ticket_ay[] = $row['date'] .' '. $row['event'] .' ¥'.$row['price'];
}


/* 配列作成 */
$year_ay = mkYearAy();
$month_ay = mkMonthAy();
$day_ay = mkDayAy();


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
            <form action="#pan" method="post">
                <div class="tb-scroll">
                    <table border="1">
                        <tr>
                            <th class="bold">日時</th>
                            <th class="bold">公演</th>
                            <th class="bold">チケット代</th>
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
                                        <td class="bold">'.$row['date'].'</td>
                                        <td><div>'.$row['event'].'</div><div class="img-box">'.$image.'</div></td>
                                        <td>¥'.$row['price'].'</td>
                                        <td><a href="'.$edit.'">編集</a>'.$delete.'</td>
                                    </tr>';
                            }
                         ?>
                    </table>
                </div>
            </form>
            <div class="btn">
                <a href="register/index.php">新規登録</a>
            </div>
            <div class="logout">
                <h1><?php echo $msg; ?></h1>
                <?php echo $link; ?>
            </div>
        </div>
    </div>
</section>




</main>
