<?php
session_start();
//require_once('./config.php');

$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊


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


                <p>ログアウトしました。</p>
                <a href="./index.php">ログインへ</a>
               
           </form>

    </div>
</section>




</main>

