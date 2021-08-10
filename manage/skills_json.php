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


//$sql = "SELECT * FROM skills";
$sql = "SELECT s.id, s.skills, s.level, s.skill_level, s.category AS skill_category_id, sc.id AS category_id, sc.name AS category_name
FROM skills s
INNER JOIN skills_category sc ON s.category = sc.id
WHERE sc.del_flag =0";
$stmt = $dbh->prepare($sql);
$stmt->execute();

$skills = array();
/*
$sql_cate = "SELECT sc.id AS category_id, sc.name AS category_name
FROM skills_category sc
WHERE sc.del_flag =0";
$stmt_cate = $dbh->prepare($sql_cate);
$stmt_cate->execute();
*/

//$categories = array();
/*
while($row = $stmt_cate->fetch(PDO::FETCH_ASSOC)){
	$categories[] = [
		$row['category_id'] => $row['category_name']
	];
}*/

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  if(empty($row['img'])){
    $row['img'] = 'no-img.png';
  }
			$skills[] = array(
			'skills'=>$row['skills'],
			'level'=>$row['level'],
			'skill_level'=>$row['skill_level'],
			'category_id'=>$row['skill_category_id'],
			'category_name'=>$row['category_name'],
			);
	}


//jsonとして出力
header('Content-type: application/json');
echo json_encode($skills, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

?>
