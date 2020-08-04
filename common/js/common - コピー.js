(function ($) {



    function embedGoogleMap() {
        if ($(".map").find("iframe").length) {
            var map = $(".map").html();
            $(".map").find("iframe").remove();
            $(window).on("load", function () {
                setTimeout(function () {
                    $(".map").html(map);
                }, 500);
            });
        }
    }
    function do_featured() {
        setTimeout(function () {
            $(".main-featured").addClass("do");
            setTimeout(function () {
                $(".featured-bg").addClass('zoomo');
            }, 2000);
        });
    }

    function checkBgLoading() {
        $('.featured-bg').imagesLoaded({
            background: true
        }, function () {
            $(".lds-spinner").fadeOut(200, function () {
                do_featured();
            });
        });
    }
    function click(){
        $('.scroll').on('click', function () {
            var height = $('.main-featured-outer').height();
            $('html,body').animate({
                scrollTop: height
            }, 300);
        });
       $("#pagetop").on("click", function () {
            $('body,html').animate({
                scrollTop: 0
            }, 1200);
        });
    }
    function scroll() {
        var dis = $(window).scrollTop();
        if (dis > 100) {
           $('.header-box').addClass('do');
        } else {
            $('.header-box').removeClass('do');
        }
        if (dis > 800) {
            $("#pagetop").fadeIn();
        } else {
            $("#pagetop").hide();
        }
    }
    $(window).on('scroll',function(){
        scroll();
    })
  $(function () {
      embedGoogleMap();
       checkBgLoading();
      click();
  });



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

///20190315//
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


        $(function(){
        $('.contact-open').on('click',function(){
        if($('.contact-form').hasClass('d-none')){
        $('.contact-form').removeClass('d-none');
        }
        else if(!$('.contact-form').hasClass('d-none')){
            $('.contact-form').addClass('d-none');
        }
        });

        $('.close-btn').on('click',function(){
        $('.contact-form').addClass('d-none');

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
