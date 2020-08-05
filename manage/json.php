<?php
//ini_set('display_errors', 1);
session_start();
require_once('./config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}

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


$sql = "SELECT * FROM blog WHERE title = 'artwork'";
$stmt = $dbh->prepare($sql);
$stmt->execute();

$blog = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if(empty($row['img'])){
    $row['img'] = 'no-img.png';
  }
    $blog[]=array(
    'id'=>$row['id'],
    'date'=>$row['date'],
    'title'=>$row['title'],
    'comment'=>$row['comment'],
    'img'=>$row['img']
    //'img'=>'http://syuto-ito.boo.jp/manage/blog/register/images/'.$row['img']
    );
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($blog, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
