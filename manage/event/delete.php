<?php
session_start();

if ($_SESSION != "") {
	extract($_SESSION);
}
$id = $delete;

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



//データ取得
$sql = "SELECT * FROM AFC_ticket WHERE id = $id";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}
//画像があるものはファイル削除
while ($row = $rst->fetch_assoc()) {
if(!empty($row['img'])){
    $imagePath = './register/images/'.$row['img'];
    unlink($imagePath);
}
}
// DELETE
$sql = "DELETE FROM AFC_ticket WHERE id = $id";
$res = $mysqli->query($sql);
if (!$res) {
    echo 'system error.';
    exit(1);
}

$mysqli->close();
header("location:./index.php");
?>

