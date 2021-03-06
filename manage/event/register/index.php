<?php
session_start();

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

if ($_POST != "") {
	extract($_POST);
}
//編集の場合はパラメータにidがつく
$id = $_GET['id'];

//ログイン済みの場合
if (isset($_SESSION['email'])) {
  $msg = 'ようこそ' .  h($_SESSION['email']) . "さん<br>";
  $link = "<a href='/manage/logout.php'>ログアウトはこちら。</a>";
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


if (isset($_POST["reg"])) {


	$error_ay = array();

	if ($year == "") {
		$error_ay["year"] = "<span class='console'>選択してください</span>";
	}

	if ($month == "") {
		$error_ay["month"] = "<span class='console'>選択してください</span>";
	}

    if ($day == "") {
		$error_ay["day"] = "<span class='console'>選択してください</span>";
	}


	if ($event == "") {
		$error_ay["event"] = "<span class='console'>入力してください</span>";
	}

    if ($price == "") {
		$error_ay["price"] = "<span class='console'>入力してください</span>";
	}

  if ($count == "") {
  $error_ay["count"] = "<span class='console'>入力してください</span>";
}

  if(!empty($id)){
      //編集の場合
      $sql = "SELECT * FROM `AFC_ticket` WHERE id = $id";
      $rst = $mysqli->query($sql);
      if (!$rst) {
          echo 'system error.' . $mysqli->error;
          exit(1);
      }

      //画像更新しない場合
      if(empty($_FILES['image']["name"])){
        while ($row = $rst->fetch_assoc()) {
            $image = $row['img'];
            $_SESSION['image'] = $image;
        }
      } else {
        //画像更新する場合
        $sql = "SELECT * FROM `AFC_ticket` WHERE id = $id";
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
        $_SESSION['year'] = $year;
        $_SESSION['month'] = $month;
        $_SESSION['day'] = $day;
        $_SESSION['event'] = $event;
        $_SESSION['price'] = $price;
        $_SESSION['count'] = $count;

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
    $sql = "SELECT * FROM `AFC_ticket` WHERE id = $id ORDER BY `AFC_ticket`.`date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
        echo 'system error.' . $mysqli->error;
        exit(1);
    }
    while ($row = $rst->fetch_assoc()) {
        //日時を分割
        list($year, $month, $day) = preg_split('/[-: ]/', $row['date']);
        //頭のゼロを取る
        $month = (int)$month;
        $day = (int)$day;
        $event = $row['event'];
        $price = $row['price'];
        $count = $row['count'];
        $image = $row['img'];
    }
}else{
    //新規の場合
    $sql = "SELECT * FROM `AFC_ticket` ORDER BY `AFC_ticket`.`date` ASC LIMIT 0 , 30";
    $rst = $mysqli->query($sql);
    if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
    }

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
		if ($value == $val) {
			$selected = ' selected';
		}
		$html .= "<option value='$key'$selected>$val</option>";
	}
	return $html;
}


//年配列
function mkYearAy(){
$year_ay = array();
//$year_ay[0] = date("Y");
$year_ay[0] = 2016;
$this_year = date("Y");
$year_diff = $this_year - $year_ay[0];
$year_plus = $year_diff + 5;
for($i=1;$i<$year_plus;$i++){
    $year_ay[$i] = $year_ay[0] + $i;
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
                <p>年：</p>
                <select name="year" id="select_year">
                    <?php
                        print getOptionHtmlForYear($year_ay,$year,"選択してください");
                    ?>
                </select><?= $error_ay["year"] ?>
            </div>
            <div class="input">
                <p>月：</p>
                <select name="month" id="select_month">
                    <?php
                        print getOptionHtml($month_ay,$month,"選択してください");
                    ?>
                </select><?= $error_ay["month"] ?>
            </div>
            <div class="input">
                <p>日：</p>
                <input type="hidden" name="setting_day" value="<?php echo $day; ?>">
                <select name="day" id="select_day">
                    <?php
                        print getOptionHtml($day_ay,$day,"選択してください");
                    ?>
                </select><?= $error_ay["day"] ?>
            </div>
            <div class="input">
                <p>フライヤー画像：</p>
                <input type="file" name="image" value=""><?= $error_ay["image"] ?><?= $error_ay["size"] ?>
            <?php
                    if((!empty($image))&&(empty($error_ay))){
                        echo '<img src="./images/'.$image.'" width="100" height="100">';
                    }
            ?>
            </div>
            <div class="input">
                <p>公演詳細：</p>
                <textarea name="event" cols="50" rows="5"><?= $event ?></textarea><br /><?= $error_ay["event"] ?>
            </div>
            <div class="input">
                <p>チケット代：</p>
                <input type="text" name="price" size="50" value="<?= $price ?>" /><br /><?= $error_ay["price"] ?>
            </div>
            <div class="input">
                <p>在庫枚数：</p>
                <input type="text" name="count" size="50" value="<?= $count ?>" /><br /><?= $error_ay["count"] ?>
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
<script src="./style/js/local.js"></script>
