<?php
ini_set('display_errors', 1);
session_start();
require_once('./config.php');

if ($_SESSION != "") {
	extract($_SESSION);
}

$id = 1;

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


$sql = "SELECT * FROM profiles";
$stmt = $dbh->prepare($sql);
$stmt->execute();

$profiles = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $profiles[] = array(
    'texts'=>$row['texts'],
    'birth'=>$row['birth'],
		'age'=>$row['age'],
    //'img'=>'https://syutoito.site/manage/outputs/register/images/'.$row['img']
    );
}

$now = (int)date('Ymd');
$birthday  = $profiles[0]['birth'];
$birthday = (int)(str_replace('/', '', $birthday));
$age = floor(($now - $birthday)/10000);

if($age > $profiles[0]['age']){
	$sql = "UPDATE profiles SET age = :age WHERE id = :id";
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam( ':id', $id, PDO::PARAM_INT);
	$stmt->bindParam( ':age', $age, PDO::PARAM_INT);
	$stmt->execute();

	$profiles[0]['age'] = $age;

}

//jsonとして出力
header('Access-Control-Allow-Origin: *');
echo json_encode($profiles, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
