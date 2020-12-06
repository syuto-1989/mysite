<?php
session_start();
require_once('../manage/config.php');

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

include("../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">
<script src="./style/js/local.js"></script>

<main>
<section id="top">
    <div class="content-wrap">
        <div class="top-container ">
          <div class="ttl mincho">
              <h1>コメント</h1>
          </div>
            <form action="/contact/" method="post">
							<!---
                <div class="flex">
                        <?php

                            //データ取得
                            $stmt = $dbh->query("SELECT * FROM `blog` ORDER BY `blog`.`create_date` ASC LIMIT 0 , 30");
                            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                              $id = $row['id'];
                              $date = str_replace(array('-', '-'), array('年', '月'), $row['date']) . '日';
															//$date = $row['create_date'];
                              $title = $row['title'];
                              $comment = $row['comment'];
															$user_id = $row['user_id'];
                              if(!empty($row['img'])){
                                  $image = '<div class="bg-img" style="background-image:url(../manage/blog/register/images/'.$row['img'].')"></div>';
                              } else{
                                  $image = '<div class="bg-img" style="background-image:url(../manage/blog/register/images/no-img.png)"></div>';
                              }
                              echo '<div class="event-block fade">
                                      <div class="img-box">'.$image.'</div>
                                      <div class="date">'.$date.'</div>
                                      <div class="event-txt">'.$title.'</div>
                                      <div class="price">'.$comment.'</div>
                                      <div class="link flex">
                                        <div class="detail">
                                          <a href="./detail/index.php?id='.$id.'">詳細</a>
                                        </div>
                                      </div>
                                    </div>';

                            }


                         ?>
                </div>
								--->
								<div id="all_show_result" class="flex"></div>
            </form>
        </div>
    </div>
</section>




</main>
