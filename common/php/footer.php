<div class="contact-form d-none">
<?php include(DOCROOT."/contact_modal/index.php")?>
</div>
<div class="">
    <footer>
            <h2 class="f-logo"><a href="#"><img src="<?php echo $root; ?>/common/img/logo.png" alt="AMEX"></a></h2>
            <nav class="footer-nav">
                <ul>
                    <li><a href="#concept">ブランドコンセプト</a></li>
                    <li><a href="#develop">設計・製造・開発</a></li>
                    <li><a href="#recommend">製品紹介</a></li>
                    <li><a href="#blog">ブログ</a></li>
                    <li><a href="#info">会社案内</a></li>
                    <li class="contact-open">お問い合わせ</li>
                </ul>    
            </nav>
        
                <p class="copyright">Copyright&copy;株式会社 青木製作所</p>
        

    </footer>
</div>
<div id="pagetop"></div>
<script>

    <?php

    //問い合わせセッションある場合（エラーで戻ってくる場合）はモーダル開かせる。

    //変数定義
    if(isset($hasError) && $hasError == true){
        print "var contact_err = 1;";
    }else{
        print "var contact_err = 0;";
    }

    ?>

    $(function(){
        if (contact_err == 1){
            $(".contact-form").removeClass('d-none');
        }
    });


</script>
</body>

</html>