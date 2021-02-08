<?php
session_start();

if ($_SESSION != "") {
	extract($_SESSION);
}
$id = $delete;

//DB接続
$mysqli = new mysqli('', '', '', '');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

//データ取得
$sql = "SELECT * FROM `lyrics` ORDER BY `lyrics`.`create_date` ASC LIMIT 0 , 30";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}



//データ取得
$sql = "SELECT * FROM lyrics WHERE id = $id";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}

// DELETE
$sql = "DELETE FROM lyrics WHERE id = $id";
$res = $mysqli->query($sql);
if (!$res) {
    echo 'system error.';
    exit(1);
}

$mysqli->close();
header("location:./index.php");
?>
