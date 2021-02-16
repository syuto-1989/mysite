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
//データ取得
$stmt = $dbh->query("SELECT * FROM `lyrics` ORDER BY `lyrics`.`album_id` ASC");


/* 配列作成 */
$album_ay = mkAlbumAy();

//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../common/php/header.php")?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        <div class="top-container ">
          <div class="ttl mincho">
              <h1>LYRICS of RADIOHEAD</h1>
              <p>曲を選択してボタンをクリックしてください。</p>
          </div>
					<div class="titleSearchWrap">
						<p>タイトルから検索する</p>
						<form id="titleSearch" action="./search.php" method="get">
							<input type="text" name="title" value="">
							<button type="submit">検索する</button>
						</form>
					</div>
					<div class="albumSearchWrap">
						<p>アルバムから検索する</p>
						<form id="albumSearch" action="./album.php" method="get">
							<select name="album" id="album">
								<?php
									foreach($album_ay as $key => $value){
										echo '<option value='.$key.'>'.$value.'</option>';
									}
								?>
							</select>
							<button type="submit">検索する</button>
						</form>
					</div>
            <div class="lyricSelect">
                <select id="id" name="id">
                    <?php
                        while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value='.$row['id'].'>'.$row['title'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="langSelect">
                <label><input type="radio" id="lyric_en" name="lyric_lang" value="en" checked/>英詞</label>
                <label><input type="radio" id="lyric_ja" name="lyric_lang" value="ja" />和訳</label>
            </div>
            <button id="ajax_show"><p>表示する</p></button>
        </div>
    </div>
    <div class="bgWrap">
        <div class="content-wrap">
                <div id="lyrics"></div>
        </div>
    </div>
</section>
<script src="./style/js/local.js"></script>



</main>
