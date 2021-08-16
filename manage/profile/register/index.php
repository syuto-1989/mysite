<?php
session_start();
require_once('../../config.php');
/*
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}
*/

if ($_POST != "") {
	extract($_POST);
}
//編集の場合はパラメータにidがつく
$id = $_GET['id'];

//ログイン済みの場合
if (isset($_SESSION['email'])) {
  $msg = 'ようこそ' .  h($_SESSION['email']) . "さん<br>";
  $link = "<a href='/manage/logout.php'>ログアウトはこちら。</a>";
  $user_id = $_SESSION['email'];
} else {
  header("location:/manage/index.php");
  exit;
}

//DB接続
$mysqli = new mysqli('mysql145.phy.lolipop.lan', 'LAA1126384', 'sitositosito111', 'LAA1126384-syutoito');
//$mysqli = new mysqli('localhost', 'root', 'sitositosito111', 'syutoito_test');

if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

if (isset($_POST["reg"])) {

		//$_SESSIONに$_POSTの値を入れる
        $_SESSION['texts'] = $texts;
        $_SESSION['birth'] = $birth;
				$_SESSION['age'] = $age;

      if(empty($id)){
        //新規の場合
		  header("location:./register.php");
        } else {
        //編集の場合
          header("location:./register.php?id=$id");
        }
}



//データ取得
if(!empty($id)){
    //編集の場合
    $sql = "SELECT * FROM `profiles` WHERE id = $id ORDER BY `profiles`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
        echo 'system error.' . $mysqli->error;
        exit(1);
    }
    while ($row = $rst->fetch_assoc()) {
        $texts = $row['texts'];
        $birth = $row['birth'];
				$age = $row['age'];
    }
}else{
    //新規の場合
    $sql = "SELECT * FROM `profiles` ORDER BY `profiles`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
    }
}




/* 配列作成 */
$year_ay = mkYearAy();
$month_ay = mkMonthAy();
$day_ay = mkDayAy();


include("../../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        <form action="#pan" method="post" enctype="multipart/form-data">
            <div class="input">
                <p>自己紹介</p>
                <textarea name="texts" size="50" value="<?= $texts ?>" /><?= $texts ?></textarea>
            </div>
            <div class="input">
                <p>誕生日</p>
                <input type="text" name="birth" size="50" value="<?= $birth ?>" /><br />
            </div>
						<div class="input">
                <p>年齢</p>
                <input type="text" name="age" size="50" value="<?= $age ?>" /><br />
            </div>
            <div class="btn">
                <input name="reg" type="submit" value="送信" />
            </div>
        </form>
        <div class="logout">
                <h1><?php echo $msg; ?></h1>
                <?php echo $link; ?>
        </div>
    </div>
</section>




</main>
