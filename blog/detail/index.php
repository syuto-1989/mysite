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
                            $stmt = $dbh->prepare("SELECT * FROM `blog` WHERE id = :id");
														$stmt->bindValue(':id', $_GET['id']);
														$stmt->execute();
                            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
															$id = $row['id'];
                              $date = str_replace(array('-', '-'), array('年', '月'), $row['date']) . '日';
															//$date = $row['create_date'];
                              $title = $row['title'];
                              $comment = $row['comment'];
															$user_id = $row['user_id'];
                              if(!empty($row['img'])){
																	$image = '<img src="../../manage/blog/register/images/'.$row['img'].'">';
                              } else{
																	$image = '<img src="../../manage/blog/register/images/no-img.png">';
                              }
                              echo '<div class="event-block fade">
                                      <div class="img-box">'.$image.'</div>
                                      <div class="date">'.$date.'</div>
                                      <div class="event-txt">'.$title.'</div>
                                      <div class="price">'.$comment.'</div>
                                      <div class="link flex">
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
