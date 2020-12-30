<?php
//ini_set('display_errors', 1);
// GETメソッドでリクエストした値を取得

session_start();
require_once('./config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}

$id = $_GET['id'];

//ログイン済みの場合
/*
if (isset($_SESSION['email'])) {
  $msg = 'ようこそ' .  h($_SESSION['email']) . "さん<br>";
  $link = "<a href='/manage/logout.php'>ログアウトはこちら。</a>";
} else {
  header("location:/manage/index.php");
  exit;
}
*/

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}


$sql = "SELECT * FROM `lyrics` WHERE id = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam( 1, $id, PDO::PARAM_INT );
$stmt->execute();

$lyric = array();
function sanitize_br($str){
  
    return nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));

}
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $lyric[]=array(
    'id'=>$row['id'],
    //'img'=>'http://syuto-ito.boo.jp/manage/blog/register/images/'.$row['img']

    'title' => $row['title'],
    'lyric' => sanitize_br($row['lyric']),
    'lyric_ja' => sanitize_br($row['lyric_ja']),
    'album_id'=>$row['album_id'],
    'movie_id'=>$row['movie_id']
    );
}

//var_dump($lyric);

//jsonとして出力
header('Content-type: application/json');
echo json_encode($lyric, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
