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



// INSERT
if (empty($id)) {
    //新規登録

    $sql = "INSERT INTO AFC_ticket (
        date, event, price, img, create_date
    ) VALUES (
        '$date', '$event', '$price', '$image', '$create_date'
    )";

} else {
    //更新
    $sql = "UPDATE AFC_ticket SET date = '$date', event = '$event', price = '$price', img = '$image' WHERE id = $id";
    //var_dump($sql);
//exit();
}
    $res = $mysqli->query($sql);
    if (!$res) {
        echo 'system error.';
        exit(1);
    }

$mysqli->close();
header("location:/manage/event/index.php");
?>


