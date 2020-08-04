(function ($) {


   $(function(){
    $('a[href^="#"]').click(function(){
      var speed = 500;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var headerHeight =  $('.header-box').outerHeight();
      var position = target.offset().top - headerHeight;
      $("html, body").animate({scrollTop:position}, speed, "swing");
      return false;
    });
  });

    $(function(){
    $('.menu-trigger').on('click',function(){
      if($(this).hasClass('active')){
        $(this).removeClass('active');
        $('main').removeClass('open');
        $('.header-nav-sp').removeClass('open');
        $('.overlay').removeClass('open');
      } else {
        $(this).addClass('active');
        $('main').addClass('open');
        $('.header-nav-sp').addClass('open');
        $('.overlay').addClass('open');
      }
     });
    });

    $(function(){
      $('.overlay').on('click',function(){
        if($(this).hasClass('open')){
            $(this).removeClass('open');
            $('.menu-trigger').removeClass('active');
            $('main').removeClass('open');
            $('.header-nav-sp').removeClass('open');
          }
        });
      });



    function animateContent() {
        $(".cartain").each(function(){
                var $a = $(this).offset().top;
                var $b = $(window).scrollTop();
                var $c = $(window).height() * 0.8;
                if ($b > ($a - $c)) {
                    if(!$(this).hasClass("open")){
                    $(this).addClass("open");
                    }
                }
      });

    }

    function fadeinContent() {
        $(".fade").each(function(){
                var $a = $(this).offset().top;
                var $b = $(window).scrollTop();
                var $c = $(window).height() * 0.8;
                if ($b > ($a - $c)) {
                    if(!$(this).hasClass("in")){
                    $(this).addClass("in");
                    }
                }
      });

    }

    function scroll() {
        var dis = $(window).scrollTop();
        if (dis > 50) {
            $('.header-box').addClass('fixed');
        } else {
            $('.header-box').removeClass('fixed');
        }
    }




     $(window).on("load", function () {
         fadeinContent();
         animateContent();

    });

     $(window).on("scroll", function () {
        animateContent();
         fadeinContent();
          scroll();
    });


})(jQuery)
