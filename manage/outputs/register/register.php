<?php
session_start();
require_once('../../config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}

//編集の場合はパラメータにidがつく
$id = $_GET['id'];

//DB接続
//$mysqli = new mysqli('mysql145.phy.lolipop.lan', 'LAA1126384', 'sitositosito111', 'LAA1126384-syutoito');
$mysqli = new mysqli('localhost', 'root', 'sitositosito111', 'syutoito_test');
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

    $sql = "INSERT INTO outputs (
        date, title, comment, link, img, create_date
    ) VALUES (
        '$date', '$title', '$comment', '$url', '$image', '$create_date'
    )";

} else {
    //更新
    $sql = "UPDATE outputs SET title = '$title', comment = '$comment', link = '$url', img = '$image' WHERE id = $id";

}

    $res = $mysqli->query($sql);
    if (!$res) {
				printf("Errormessage: %s\n", $mysqli->error);
        echo 'system error.';
        exit(1);
    }

$mysqli->close();
header("location:/manage/outputs/register/index.php");

//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../common/php/header.php")?>
