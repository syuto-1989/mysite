(function ($) {
   $(document).ready(function(){
  $('.top-slider').slick({
        autoplay: false,
        autoplaySpeed: 5000,
        fade: true,
        arrows: true,
        dots: true,
        speed: 1000,

     });


});



    
$(function(){

              $('.slideshow').each(function(i){
                var $slides = $('.slideshow li'),
                slidesCount = $slides.length,
                currentIndex = 0,
                firstIndex = 0;


                $slides.eq(currentIndex).addClass('fadein');
               setInterval(showNextSlide, 4000,"linear");

          function showNextSlide(){
                var nextIndex = (currentIndex + 1) %  slidesCount;
                $slides.eq(nextIndex).addClass('fadein');
                 currentIndex = nextIndex;

                var lastIndex = (firstIndex + 20) %  slidesCount;
                var fifthIndex = (currentIndex + 4) %  slidesCount;
                var sixthIndex = (firstIndex + 5) %  slidesCount;

              if($slides.eq(lastIndex).hasClass('fadein')){
                $slides.removeClass('fadein');
                  }




            }

        });
    });


})(jQuery)
