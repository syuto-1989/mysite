<?php
//ini_set('display_errors', 1);
session_start();
//require_once('./config.php');
$mail = $_POST['email'];
$dsn = "mysql:host=mysql145.phy.lolipop.lan; dbname=LAA1126384-syutoito; charset=utf8mb4";
$username = "LAA1126384";
$password = "sitositosito111";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}


//POSTのvalidate
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}

$sql = "SELECT * FROM userData WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $mail);
$stmt->execute();
$member = $stmt->fetch();
$pass = password_hash($member['password'], PASSWORD_DEFAULT);
//var_dump($member['password']);
//exit();
//指定したハッシュがパスワードにマッチしているかチェック
//if ($_POST['password'] == $member['password']) {
if (password_verify($_POST['password'], $member['password'])){
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['email'] = $member['email'];
    //$msg = 'ログインしました。';
    //$link = '<a href="index.php">ホーム</a>';
    header("location:./event/index.php");
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="./index.php">戻る</a>';
}
    


//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//

include("../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        
           <form  action="login.php" method="post">
                <h1><?php echo $msg; ?></h1>
                <?php echo $link; ?>
               
           </form>

    </div>
</section>




</main>

