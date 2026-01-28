(function($){
    $( document ).ready(function() {
      // $( ".addcart-link" ).click(function() {
      //       $( ".product-mini-cart" ).addClass( "bzotech-2" );
      //     });

        
      //     $( ".mobile-filter a" ).click(function(e) {
      //       e.preventDefault();
      //       $( '.sidebar-position-left' ).toggleClass('mobile-show');
          
            
      //   });
        

      //   $( ".closeds-menu" ).click(function() {
          
      //       $( '.sidebar-position-left' ).addClass('mobile-show_closed');
          
            
      //   });

      // });
      // on( "click", "tr", function() {
      //   console.log( $( this ).text() );
      // });
      $('.mobile-filter a').click(function (){
        if(!$('.sidebar-position-left').hasClass('mobile-show')){
          $('.sidebar-position-left').addClass('mobile-show');
          
          
        }
       
      });
      
        $( ".closeds-menu" ).click(function() {
         
           $('.sidebar-position-left').removeClass('mobile-show');
        });
      
       

      $(".sidebar-type-default").on('focusout',function(){
        $('.sidebar-position-left').removeClass('mobile-show');
      });

     var wow = new WOW();
      wow.init();
      /*if ($(window).width() > 767) {
        window.addEventListener('scroll', function(e) {
            if($('.bzotech-info-box-style11').length > 0) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();
        
                var elemTop = $('.bzotech-info-box-style11').offset().top;
                var elemBottom = elemTop + $('.bzotech-info-box-style11').height();
                if($(window).scrollTop()+$('.bzotech-info-box-style11').height() < elemTop) {
                    $('.wow').removeClass('animated');
                    $('.wow').removeAttr('style');
                    var wow = new WOW();
                    wow.init();
                }
            }
        });
        }*/

    });

  
})(jQuery);




