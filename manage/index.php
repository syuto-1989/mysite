<?php

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

session_start();


//ログイン済みの場合
if (isset($_SESSION['email'])) {
  header("location:./event/index.php");
  exit;
}

//DB接続
$mysqli = new mysqli('mysql145.phy.lolipop.lan', 'LAA1126384', 'sitositosito111', 'LAA1126384-syutoito');
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}

//データ取得
$sql = "SELECT * FROM `AFC_ticket` ORDER BY `AFC_ticket`.`date` ASC LIMIT 0 , 30";
$rst = $mysqli->query($sql);
if (!$rst) {
    echo 'system error.' . $mysqli->error;
    exit(1);
}


include("../common/php/header.php")?>
<link rel="stylesheet" href="./style/css/local.css">
<link rel="stylesheet" href="./style/css/local-sp.css">


<main>
<section id="top">
    <div class="content-wrap">
        
           <form  action="login.php" method="post">
            <h1>ようこそ、ログインしてください。</h1>
            <div class="input">
             <label for="email">email</label>
             <input type="email" name="email">
            </div>
            <div class="input">
             <label for="password">password</label>
             <input type="password" name="password">
            </div>
             <button type="submit">ログイン</button>
               
           </form>
        
           <form action="signUp.php" method="post">
            <h1>初めての方はこちら</h1>
            <div class="input">
             <label for="email">email</label>
             <input type="email" name="email">
            </div>
            <div class="input">
             <label for="password">password</label>
             <input type="password" name="password">
            </div>
             <button type="submit">新規登録</button>
             <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
               
           </form>
    </div>
</section>




</main>

