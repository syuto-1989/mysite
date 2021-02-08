<?php
//ini_set('display_errors', 1);
session_start();

if ($_SESSION != "") {
	extract($_SESSION);
}

//編集の場合はパラメータにidがつく
$id = $_GET['id'];

//DB接続
$mysqli = new mysqli('', '', '', '');
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

    $sql = "INSERT INTO lyrics (
        date, title, lyric, lyric_ja, album_id, movie_id, create_date
    ) VALUES (
        '$date', '$title', '$lyric', '$lyric_ja', '$album_id', '$movie_id', '$create_date'
    )";

} else {
    //更新
    $sql = "UPDATE lyrics SET title = '$title', lyric = '$lyric', lyric_ja = '$lyric_ja', album_id = '$album_id', movie_id = '$movie_id' WHERE id = $id";

}
    $res = $mysqli->query($sql);
    if (!$res) {
        echo 'system error.';
        exit(1);
    }

$mysqli->close();
header("location:/manage/lyric/index.php");
?>
