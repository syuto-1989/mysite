<?php
session_start();
//require_once('./config.php');
//フォームからの値をそれぞれ変数に代入
$mail = $_POST['email'];
//$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$dsn = "mysql:host=mysql145.phy.lolipop.lan; dbname=LAA1126384-syutoito; charset=utf8mb4";
$username = "LAA1126384";
$password = "sitositosito111";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

//POSTのValidate。
if (!$mail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}
//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
  return false;
}

//フォームに入力されたemailがすでに登録されていないかチェック
$sql = "SELECT * FROM userData WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $mail);
$stmt->execute();
$member = $stmt->fetch();

if ($member['email'] === $mail) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="/manage/index.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO userData(email, password) VALUES (:email, :password)";
    $stmt = $dbh->prepare($sql);
    //$stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $mail);
    $stmt->bindValue(':password', $pass);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="/manage/index.php">ログインページ</a>';
}

    


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

