<?php
session_start();
extract($_SESSION);

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
$count = '';
while ($row = $rst->fetch_assoc()) {
$row['date'] = str_replace('-',  '/', $row['date']);
$ticket_ay[] = $row['date'] .' '. $row['event'] .' ¥'.$row['price'];
if($row['id'] == $reserve){
  $count = $row['count'];
}
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

		<?php

            /*送信処理*/

            //$mailto = "ito@cyberbrain.co.jp";
            //$mailto = "akutagawa.fanclub@gmail.com";
            $mailto = $mail;
            $mailto2 = $mail;
            //件名
            $subject = "【チケット予約】お問い合わせがありました";

            //件名
            $subject2 = "【チケット予約】お問い合わせありがとうございました";
            $reserve_ticket = getReserveEvent($ticket_ay, $reserve_ticket);


            $mbody = "
====================================

お問い合わせ

====================================


■お客様情報

お名前:$name

メールアドレス:$mail

予約公演:$reserve_ticket

予約枚数:$sheets

お問い合わせ内容:
$inquiry

----------------------------------";


            $mbody2 = "
====================================

お問い合わせありがとうございました

====================================

このメールは自動で返信されております。
以下の内容で送信しましたので
ご確認ください。

後ほど担当より追ってご連絡をいたします。


■お客様情報

お名前:$name

メールアドレス:$mail

予約公演:$reserve_ticket

予約枚数:$sheets

お問い合わせ内容:
$inquiry

******************************************

******************************************";

            $header = "From:<". $mail .">";
            $header2 = "From:<". $mailto .">";

			mb_language("Japanese");
			mb_internal_encoding("UTF-8");
      if ($count >= $sheets){
        $count_diff = $count - $sheets;
        $sql = "UPDATE AFC_ticket SET count = '$count_diff' WHERE id = $reserve";
        $res = $mysqli->query($sql);
        if (!$res) {
            echo 'system error.';
            exit(1);
        }

        $mysqli->close();
  			if((mb_send_mail($mailto, $subject, $mbody, $header))&&(mb_send_mail($mailto2, $subject2, $mbody2, $header2))){
  				echo "メールを送信しました";
  			} else {
  				echo "メールの送信に失敗しました";
  			}
      } else {
        echo "在庫枚数が足りません";
      }
		?>

        <a href="/contact/index.php">戻る</a>


    </div>
</section>




</main>
