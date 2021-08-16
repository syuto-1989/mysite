<?php
session_start();
//ini_set('display_errors', 1);

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

if ($_POST != "") {
	extract($_POST);
}


//ログイン済みの場合
if (isset($_SESSION['email'])) {
  $msg = 'ようこそ' .  h($_SESSION['email']) . "さん<br>";
  $link = "<a href='/manage/logout.php'>ログアウトはこちら。</a>";
} else {
  header("location:/manage/index.php");
  exit;
}

//DB接続
$dsn = "mysql:host=mysql145.phy.lolipop.lan; dbname=LAA1126384-syutoito; charset=utf8mb4";
$username = "LAA1126384";
$password = "sitositosito111";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

    $sql = "SELECT * FROM `AFC_ticket` ORDER BY `AFC_ticket`.`date` ASC LIMIT 0 , 30";
    $stmt = $dbh->query($sql);





function getOptionHtml($master_data_ay, $value,$init="")
{
	//0と空を区別するため===で判別するが、文字列と数値が混在するため
	//valueの値を文字列に統一する
	$value = (string)$value;
	$html = '';
	if(!empty($init)){
		$html .= "<option value=''>". $init ."</option>";
	}else{
		$html .= "<option value=''>--</option>";
	}
	foreach ($master_data_ay as $key => $val) {
		$key = (string)$key;
		//print $val;
		$selected = '';
		if ($value === $key) {
			$selected = ' selected';
		}
		$html .= "<option value='$key'$selected>$val</option>";
	}
	return $html;
}

//年の配列の場合は$valと一致したらselectedになる
function getOptionHtmlForYear($master_data_ay, $value,$init="")
{
	//0と空を区別するため===で判別するが、文字列と数値が混在するため
	//valueの値を文字列に統一する
	$value = (string)$value;
	$html = '';
	if(!empty($init)){
		$html .= "<option value=''>". $init ."</option>";
	}else{
		$html .= "<option value=''>--</option>";
	}
	foreach ($master_data_ay as $key => $val) {
		$key = (string)$key;
		//print $val;
		$selected = '';
		if ($value === $val) {
			$selected = ' selected';
		}
		$html .= "<option value='$key'$selected>$val</option>";
	}
	return $html;
}


//年配列
function mkYearAy(){
$year_ay = array();
$year_ay[0] = date("Y");
for($i=1;$i<10;$i++){
    $year_count = $i.' year';
    $year_ay[$i] = date("Y", strtotime($year_count));;
}
    return $year_ay;
}

//月配列
function mkMonthAy(){
	$month_ay = array();

	for($i=1;$i<13;$i++){
		$month_ay[$i] = $i;
	}

	return $month_ay;
}

//日配列
function mkDayAy(){
	$day_ay = array();

	for($i=1;$i<32;$i++){
		$day_ay[$i] = $i;
	}

	return $day_ay;
}

/* 配列作成 */
$year_ay = mkYearAy();
$month_ay = mkMonthAy();
$day_ay = mkDayAy();

//var_dump($ticket_ay);
//exit();
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
        
            <form method="post" enctype="multipart/form-data">
                <h1>画像アップロード</h1>
                <?php
                foreach ($stmt as $row) {
                    if(!empty($row['img'])){
                      // データベースのフィールド名で出力
                      echo '<img src="./images/'.$row['img'].'" width="300" height="300">';
                    } else {
                      echo '<img src="./images/no-img.png" width="300" height="300">';
                    }
                }

                ?>

            </form>
        

        <div class="logout">
                <h1><?php echo $msg; ?></h1>
                <?php echo $link; ?>
        </div>
    </div>
</section>




</main>

