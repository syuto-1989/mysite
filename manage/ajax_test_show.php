<?php
//ini_set('display_errors', 1);
// GETメソッドでリクエストした値を取得

session_start();
require_once('./config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}

$num = $_GET['number'];

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


$sql = "SELECT * FROM AFC_ticket LIMIT ?";
$stmt = $dbh->prepare($sql);
$stmt->bindParam( 1, $num, PDO::PARAM_INT );
$stmt->execute();

$event = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if(empty($row['img'])){
    $row['img'] = 'no-img.png';
  }
    $event[]=array(
    'id'=>$row['id'],
    //'img'=>'http://syuto-ito.boo.jp/manage/blog/register/images/'.$row['img']
        
    'date' => str_replace(array('-', '-'), array('年', '月'), $row['date']) . '日',
    'event' => $row['event'],
    'price' => $row['price'],
    'img'=>$row['img']
    );
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($event, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
