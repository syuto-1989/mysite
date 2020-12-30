<?php
//ini_set('display_errors', 1);
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
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}


$error_ay = array();
if (isset($_POST["reg"])) {

	if ($title == "") {
		$error_ay["title"] = "<span class='console'>入力してください</span>";
	}

	if ($lyric == "") {
		$error_ay["lyric"] = "<span class='console'>入力してください</span>";
	}
    
    if ($album_id == "") {
		$error_ay["album_id"] = "<span class='console'>選択してください</span>";
	}

  if(!empty($id)){
      //編集の場合
      $sql = "SELECT * FROM `lyrics` WHERE id = $id";
      $rst = $mysqli->query($sql);
      if (!$rst) {
          echo 'system error.' . $mysqli->error;
          exit(1);
      }
  }
	if (empty($error_ay)) {
		//$_SESSIONに$_POSTの値を入れる
        $_SESSION['title'] = $title;
        $_SESSION['lyric'] = $lyric;
        $_SESSION['lyric_ja'] = $lyric_ja;
        $_SESSION['album_id'] = $album_id;
        $_SESSION['movie_id'] = $movie_id;

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
    $sql = "SELECT * FROM `lyrics` WHERE id = $id ORDER BY `lyrics`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
        echo 'system error.' . $mysqli->error;
        exit(1);
    }
    while ($row = $rst->fetch_assoc()) {
        $title = $row['title'];
        $lyric = $row['lyric'];
        $lyric_ja = $row['lyric_ja'];
        $album_id = $row['album_id'];
        $movie_id = $row['movie_id'];
    }
}else{
    //新規の場合
    $sql = "SELECT * FROM `lyrics` ORDER BY `lyrics`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
    }

}




/* 配列作成 */
$album_ay = mkAlbumAy();


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
            <h1>歌詞登録</h1>
            <div class="input">
                <p>タイトル：</p>
                <input type="text" name="title" size="50" value="<?= $title ?>" /><br /><?= $error_ay["title"] ?>
            </div>
            <div class="input">
                <p>歌詞</p>
                <textarea name="lyric" cols="50" rows="5"><?= $lyric ?></textarea><br /><?= $error_ay["lyric"] ?>
            </div>
            <div class="input">
                <p>和訳</p>
                <textarea name="lyric_ja" cols="50" rows="5"><?= $lyric_ja ?></textarea>
            </div>
            <div class="input">
                <p>アルバム</p>
                <select name="album_id">
                    <?php
                        print getOptionHtml($album_ay,$album_id,"選択してください");
                    ?>
                </select><?= $error_ay["album_id"] ?>
            </div>
            <div class="input">
                <p>youtube</p>
                <input type="text" name="movie_id" size="50" value="<?= $movie_id ?>" /><br />
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
