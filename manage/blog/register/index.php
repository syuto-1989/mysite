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
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

$error_ay = array();
if (isset($_POST["reg"])) {

	if ($title == "") {
		$error_ay["title"] = "<span class='console'>選択してください</span>";
	}

	if ($comment == "") {
		$error_ay["comment"] = "<span class='console'>選択してください</span>";
	}

  if(!empty($id)){
      //編集の場合
      $sql = "SELECT * FROM `blog` WHERE id = $id";
      $rst = $mysqli->query($sql);
      if (!$rst) {
          echo 'system error.' . $mysqli->error;
          exit(1);
      }
      //画像更新しない場合
      if(empty($_FILES['image'])){
        while ($row = $rst->fetch_assoc()) {
            $image = $row['img'];
            $_SESSION['image'] = $image;
        }
      } else {
        //画像更新する場合
        $sql = "SELECT * FROM `blog` WHERE id = $id";
        $rst = $mysqli->query($sql);
        if (!$rst) {
            echo 'system error.' . $mysqli->error;
            exit(1);
        }

        while ($row = $rst->fetch_assoc()) {
          //既に画像が登録されている場合は、一旦削除
          if(!empty($row['img'])){
            $old_image = $row['img'];
            $old_file = "./images/$old_image";
            unlink($old_file);
          }
        }

        //画像処理
        $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
        $file = "./images/$image";
        if ($_FILES['image']['size'] > 1000000) {
            $error_ay["size"] = "<span class='console'>ファイルが大きすぎます</span>";
        }
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
            move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
                if (exif_imagetype($file)) {//画像ファイルかのチェック
                    //$_SESSIONに$_POSTの値を入れる
                    $_SESSION['image'] = $image;
                } else {
                    $error_ay["image"] = "<span class='console'>画像ファイルではありません</span>";
                    unlink($file);
                }
            }
      }
  } else {

    //画像処理
    $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
    $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
    $file = "./images/$image";
    if ($_FILES['image']['size'] > 1000000) {
        $error_ay["size"] = "<span class='console'>ファイルが大きすぎます</span>";
    }
    if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                //$_SESSIONに$_POSTの値を入れる
                $_SESSION['image'] = $image;

            } else {
                $error_ay["image"] = "<span class='console'>画像ファイルではありません</span>";
                unlink($file);
            }
        }
      }
	if (empty($error_ay)) {
		//$_SESSIONに$_POSTの値を入れる
        $_SESSION['title'] = $title;
        $_SESSION['comment'] = $comment;
        $_SESSION['user_id'] = $user_id;

        if(empty($id)){
        //新規の場合
		  header("location:./register.php");
        } else {
        //編集の場合
          header("location:./register.php?id=$id");
        }
	}



} else {
			$_SESSION['image'] = '';
}



//データ取得
if(!empty($id)){
    //編集の場合
    $sql = "SELECT * FROM `blog` WHERE id = $id ORDER BY `blog`.`create_date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
        echo 'system error.' . $mysqli->error;
        exit(1);
    }
    while ($row = $rst->fetch_assoc()) {
        $image = $row['img'];
        $title = $row['title'];
        $comment = $row['comment'];
    }
}else{
    //新規の場合
    $sql = "SELECT * FROM `blog` ORDER BY `blog`.`create_date` ASC LIMIT 0 , 30";
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
                <p>画像：</p>
                <input type="file" name="image" value=""><?= $error_ay["image"] ?><?= $error_ay["size"] ?>
            <?php
                    if((!empty($image))&&(empty($error_ay))){
                        echo '<img src="./images/'.$image.'" width="100" height="100">';
                    }
            ?>
            </div>
            <div class="input">
                <p>タイトル：</p>
                <input type="text" name="title" size="50" value="<?= $title ?>" /><br /><?= $error_ay["title"] ?>
            </div>
            <div class="input">
                <p>コメント</p>
                <textarea name="comment" cols="50" rows="5"><?= $comment ?></textarea><br /><?= $error_ay["comment"] ?>
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
