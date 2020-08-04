<?php
// set the root directory
$root = "http://192.168.33.10:8000";

?>
<!doctype html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <meta name=”robots” content=”noindex”>
    <title><?= $ttl ?></title>
    <meta name="description" content="<?= $dec ?>">
    <meta name="keywords" content="<?= $kw ?>">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/slick.css">
    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/common.css">
    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/common-sp.css">
    <script src="<?php echo $root; ?>/common/js/jquery.min.js"></script>
    <script src="<?php echo $root; ?>/common/js/slick.min.js"></script>
    <script src="<?php echo $root; ?>/common/js/common.js"></script>
    <script src="<?php echo $root; ?>/style/js/local.js"></script>
    <meta name="format-detection" content="telephone=no, email=no, address=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">



</head>

<body>

    <div class="header-box">
        <header>
            <div class="main-row">
                <div class="sp-flex">
                    <div class="sp-info">


                    </div>
                </div>

            </div>

            <nav class="header-nav only-pc">
                <ul>
                    <li class="mincho"><a href="#top">TOP</a></li>
                    <li class="mincho"><a href="#about">ABOUT</a></li>
                    <li class="mincho"><a href="#artwork">ARTWORK</a></li>
                    <li class="mincho"><a href="#link">LINK</a></li>
                </ul>
            </nav>



    <div class="only-sp">
        <div class="menu-trigger" href="">
           <span></span>
           <span></span>
           <span></span>
        </div>


            <nav class="header-nav-sp">
                <ul>
                    <li class="mincho"><a href="#top">TOP</a></li>
                    <li class="mincho"><a href="#about">ABOUT</a></li>
                    <li class="mincho"><a href="#artwork">ARTWORK</a></li>
                    <li class="mincho"><a href="#link">LINK</a></li>
                </ul>
            </nav>
         <div class="overlay"></div>
    </div>
        </header>
    </div>
