<?php
session_start();

if ($_SESSION != "") {
	extract($_SESSION);
}

//編集の場合はパラメータにidがつく
$id = $_GET['id'];

//DB接続
$mysqli = new mysqli('mysql145.phy.lolipop.lan', 'LAA1126384', 'sitositosito111', 'LAA1126384-syutoito');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

$create_date = date('Y-m-d H:i:s');
$date = date('Y-m-d');


// INSERT
if (empty($id)) {
    //新規登録

    $sql = "INSERT INTO blog (
        date, title, comment, user_id, img, create_date
    ) VALUES (
        '$date', '$title', '$comment', '$user_id', '$image', '$create_date'
    )";

} else {
    //更新
    $sql = "UPDATE blog SET title = '$title', comment = '$comment', img = '$image' WHERE id = $id";

}
    $res = $mysqli->query($sql);
    if (!$res) {
        echo 'system error.';
        exit(1);
    }

$mysqli->close();
header("location:/manage/blog/index.php");

//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../common/php/header.php")?>
