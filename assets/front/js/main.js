(function ($) {
	"use strict";

    jQuery(document).ready(function($){
    	
    //-----------Slick Nav Mobile menu-----------
       $('#menuResponsive').slicknav({
           prependTo: "#mobile-menu-wrap",
           allowParentLinks : false,
           label: ''    
       });
       
        $(".slicknav_btn").on('click', function() {
          if ( $(this).hasClass("slicknav_collapsed")) {
            $(".slicknav_icon").html('<i class="fa fa-bars"></i>');
          } else {
            $(".slicknav_icon").html('<i class="fa fa-times"></i>');
          }
        });

       $(window).bind('scroll', function() {
        var navHeight = $(".header-top-area").height();
        ($(window).scrollTop() > navHeight) ? $('.header-area-wrapper').addClass('goToTop') : $('.header-area-wrapper').removeClass('goToTop');
        });

    /*  dropdown  */
        $('.menuUl').hide();
        $('.menuLi').click(function(){
            $('.menuUl').toggle();
        });
    

    //---------Iframe video popup-----------
   //  $(".video-play-btn").magnificPopup({
  	// 	type: 'video',
  	// });

 
	//---------venobox-----------
    // $('.venobox').venobox();

    $("#user_subscribe").click(function(){
      var sub_btn = $(this);
      var uid = $(this).attr('role');
      $.ajax({
          type: "GET",
          url: user_subscribe_url,
          data:{uid:uid},
          success:function(data){
            if(parseInt(data) == 1)
            {
              sub_btn.removeClass('btn-danger');
              sub_btn.addClass('btn-primary');
              sub_btn.text('Subscribed');
            }else if(parseInt(data) == 0)
            {
              sub_btn.addClass('btn-danger');
              sub_btn.removeClass('btn-primary');
              sub_btn.text('Subscribe');
            }
          }
        });
    });


    });


    jQuery(window).load(function(){

        
    });


}(jQuery));	