<?php
session_start();

if ($_SESSION != "") {
	extract($_SESSION);
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

function getReserveEvent($master_data_ay, $value)
{
	//0と空を区別するため===で判別するが、文字列と数値が混在するため
	//valueの値を文字列に統一する
	$value = (string)$value;     
    $html = '';
	if($value != ''){
        foreach ($master_data_ay as $key => $val) {
            $key = (string)$key;
            //print $val;
            if ($value === $key) {
                $html = $val;
            }
        }
    }
	return $html;
    //print $html;
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

$year = getReserveEvent($year_ay, $year);
$create_date = date('Y-m-d H:i:s');
if(mb_strlen($month) == 1){
    $month = '0' .$month;
}
if(mb_strlen($day) == 1){
    $month = '0' .$day;
}
$date = $year. '-' .$month. '-' .$day;


// INSERT
$sql = "INSERT INTO AFC_ticket (
	date, event, price, create_date
) VALUES (
	'$date', '$event', '$price', '$create_date'
)";
$res = $mysqli->query($sql);
if (!$res) {
    echo 'system error.';
    exit(1);
}

$mysqli->close();
header("location:./index.php");

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
        <h2>問合せ内容</h2>    

        <form action="./mailto.php" method="post">

            <table border="1">
                <tr>
                    <td>名前</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td><?php echo $mail; ?></td>
                </tr>
                <tr>
                    <td>予約公演</td>
                    <td><?php print getReserveEvent($ticket_ay, $reserve_ticket); ?></td>
                </tr>
                <tr>
                    <td>問い合わせ内容</td>
                    <td><?php echo $inquiry; ?></td>
                </tr>
            </table>

            <input type="submit" value="送信" />
        </form>
    </div>
</section>




</main>

