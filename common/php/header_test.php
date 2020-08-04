<?php
// set the root directory
$root = "http://syuto-ito.boo.jp/";
if (function_exists(getResultBlogNewBadgeInGnav)){
    $dispBlogNewBadgeResult = getResultBlogNewBadgeInGnav();//trueならNEWをGnavのブログリンクに表示する
}
?>
<!doctype html>
<html lang="ja">

<head>
<!-- Global site tag (gtag.js) - Google Analytics
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146481483-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146481483-1');
</script> -->

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
    <script src="<?php echo $root; ?>/common/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo $root; ?>/common/js/slick.min.js"></script>
    <script src="<?php echo $root; ?>/common/js/common.js"></script>
    <script src="<?php echo $root; ?>/style/js/local.js"></script>
    <meta name="format-detection" content="telephone=no, email=no, address=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">


<?php if($cb_cms_flag): ?>
    <link rel="stylesheet" type="text/css" href="<?= SITEROOT ?>/all-common/library/bs4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= SITEROOT ?>/all-common/library/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?= SITEROOT ?>/blog/common/css/general.css">
    <link rel="stylesheet" type="text/css" href="<?= SITEROOT ?>/blog/common/css/general-sp.css">
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/common.css">
    <link rel="stylesheet" href="<?php echo $root; ?>/common/css/common-sp.css">

    <link rel="stylesheet" type="text/css" href="./style/css/local.css">
    <link rel="stylesheet" type="text/css" href="./style/css/local-sp.css">
    <?= $css ?>
<?php endif ?>


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
                    <li class="mincho"><a href="#notes">NOTES</a></li>
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
                    <li class="mincho"><a href="#notes">NOTES</a></li>
                    <li class="mincho"><a href="#link">LINK</a></li>
                </ul>
            </nav>
         <div class="overlay"></div>
    </div>
        </header>
    </div>
