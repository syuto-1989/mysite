<?php
session_start();
$_SESSION = $_POST;

if ($_SESSION != "") {
	extract($_SESSION);
}


//extract($_SESSION);


if (isset($_POST["send"])) {
    //var_dump($_SESSION);
    //exit();


	$error_ay = array();

	if ($name == "") {
		$error_ay["name"] = "<span class='console'>入力してください</span>";
	}

	if ($mail == "") {
		$error_ay["mail"] = "<span class='console'>入力してください</span>";
	}
    
    if(preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail)){
        $mail = $mail;
    } else {
            $error_ay["mail_check"] = "<span class='console'>半角英数で入力してください</span>";
    }

	if ($sheets == "") {
		$error_ay["sheets"] = "<span class='console'>入力してください</span>";
	}
    
    if(preg_match('/^[0-9]+$/', $sheets)){
        $sheets = $sheets;
    } else {
            $error_ay["sheets_check"] = "<span class='console'>半角数字で入力してください</span>";
    }

	//if ($inquiry == "") {
		//$error_ay["inquiry"] = "<span class='console'>入力してください</span>";
	//}


	if (empty($error_ay)) {
		//確認画面処理
        $_SESSION = $_POST;
		header("location:./confirmation.php");
	}



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

//var_dump($ticket_ay);
//exit();
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
        <div class="ttl mincho">
            <h1>CONTACT</h1>
            <p>チケット予約は以下を入力の上ご送信ください。</p>
        </div>
        
        <form action="#pan" method="post">
            <div class="flex">
                <p>名前：</p>
                <input type="text" name="name" size="" value="<?= $name ?>" /><br /><?= $error_ay["name"] ?>
            </div>
            <div class="flex">
                <p>メールアドレス：</p>
                <input type="text" name="mail" size="" value="<?= $mail ?>" /><br /><?= $error_ay["mail"] ?><?= $error_ay["mail_check"] ?>
            </div>
            <div class="flex">
                <p>予約公演：</p>
                <select name="reserve_ticket">
                    <?php
                        print getOptionHtml($ticket_ay,$reserve_ticket,"選択してください");
                    ?>
                </select>
            </div>
            <div class="flex sheets">
                <p>予約枚数：</p>
                <input type="text" name="sheets" size="" value="<?= $sheets ?>" /><span>枚</span><br /><?= $error_ay["sheets"] ?><?= $error_ay["sheets_check"] ?>
            </div>
            <div class="flex">
                <p>備考：</p>
                <textarea name="inquiry" cols="50" rows="5"><?= $inquiry ?></textarea><br /><?= $error_ay["inquiry"] ?>
            </div>
 
            <input name="send" type="submit" value="送信" />
        </form>
    </div>
</section>




</main>

