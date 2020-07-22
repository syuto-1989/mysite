<?php
session_start();
require_once('../../manage/config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}


//DB接続
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}


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
        <div class="top-container ">
          <div class="ttl mincho">
              <h1>EVENT</h1>
              <p>チケット予約は予約ボタンをクリックしてください。</p>
          </div>
            <form action="/contact/" method="post">
                <div class="flex">
                        <?php

                            //データ取得
                            $stmt = $dbh->prepare("SELECT * FROM `AFC_ticket` WHERE id = :id");
			    $stmt->bindValue(':id', $_GET['id']);
			    $stmt->execute();
                            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                              $id = $row['id'];
                              $date = str_replace(array('-', '-'), array('年', '月'), $row['date']) . '日';
                              $event = $row['event'];
                              $price = $row['price'];
                              if(!empty($row['img'])){
				$image = '<img src="../../manage/event/register/images/'.$row['img'].'">';
                              } else{
				$image = '<img src="../../manage/event/register/images/no-img.png">';
                              }
                              echo '<div class="event-block">
                                      <div class="img-box">'.$image.'</div>
                                      <div class="date">'.$date.'</div>
                                      <div class="event-txt">'.$event.'</div>
                                      <div class="price">¥'.$price.'（+1drink）</div>
                                      <div class="link flex">
                                        <div class="reserve">
                                          <button name="reserve" type="submit" value="'.$id.'" />予約</button>
                                        </div>
                                        <div class="detail">
                                          <a href="../">一覧へ戻る</a>
                                        </div>
                                      </div>
                                    </div>';

                            }


                         ?>
                </div>
            </form>
        </div>
    </div>
</section>




</main>
