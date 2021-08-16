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

$error_ay = array();
if (isset($_POST["reg"])) {

	if ($skills == "") {
		$error_ay["skills"] = "<span class='console'>選択してください</span>";
	}

	if ($level == "") {
		$error_ay["level"] = "<span class='console'>選択してください</span>";
	}

	if (empty($error_ay)) {
		//$_SESSIONに$_POSTの値を入れる
        $_SESSION['skills'] = $skills;
        $_SESSION['level'] = $level;
				$_SESSION['skill_level'] = $skill_level;
        $_SESSION['category'] = $category;

      if(empty($id)){
        //新規の場合
		  header("location:./register.php");
        } else {
        //編集の場合
          header("location:./register.php?id=$id");
        }
	}
}



//データ取得
if(!empty($id)){
    //編集の場合
    $sql = "SELECT * FROM `skills` WHERE id = $id ORDER BY `skills`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
        echo 'system error.' . $mysqli->error;
        exit(1);
    }
    while ($row = $rst->fetch_assoc()) {
        $skills = $row['skills'];
        $level = $row['level'];
				$skill_level = $row['skill_level'];
        $category = $row['category'];
    }
}else{
    //新規の場合
    $sql = "SELECT * FROM `skills` ORDER BY `skills`.`create_date` ASC LIMIT 0 , 30";
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

$skills_category =  "SELECT * FROM `skills_category`";
$skills_category_rst = $mysqli->query($skills_category);
if (!$skills_category_rst) {
echo 'system error.' . $mysqli->error;
exit(1);
}
$category_ay = [];
while ($row = $skills_category_rst->fetch_assoc()) {
	$category_ay[$row['id']] = $row['name'];
}

$select_category_ay = getOptionHtml($category_ay, $category ,$init="選択してください");


//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        <form action="#pan" method="post" enctype="multipart/form-data">
            <div class="input">
                <p>スキル</p>
                <input type="text" name="skills" size="50" value="<?= $skills ?>" /><br /><?= $error_ay["skills"] ?>
            </div>
            <div class="input">
                <p>経験</p>
                <input type="text" name="level" size="50" value="<?= $level ?>" /><br /><?= $error_ay["level"] ?>
            </div>
						<div class="input">
                <p>スキルレベル</p>
                <input type="text" name="skill_level" size="50" value="<?= $skill_level ?>" /><br /><?= $error_ay["skill_level"] ?>
            </div>
						<div class="input">
								<p>カテゴリー</p>
								<select name="category">
									<?php echo $select_category_ay; ?>
								</select>
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
