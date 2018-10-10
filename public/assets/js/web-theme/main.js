/*jslint browser: true*/
/*global $, jQuery ,AOS*/


(function ($) {

    "use strict";

    var $window = $(window),
        $body = $('body'),
        $zogoMenu = $('.zogo-menu');


    $(document).ready(function () {


        new WOW().init();
        /*START SCROLL SPY JS*/
        $body.scrollspy({
            target: '#main_menu'
        });
        /*END SCROLL SPY JS*/


        $window.scroll(function () {
            var currentLink = $(this);
            if ($(currentLink).scrollTop() > 0) {
                $zogoMenu.addClass("sticky");
            } else {
                $zogoMenu.removeClass("sticky");
            }
        });
        /*END MENU JS*/

  /*Start scroll JS*/
            $("a.scroll-section").on("click", function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) +"]");
                if (target.length) {
                    $("html, body").animate({
                    scrollTop: target.offset().top -60
                }, 1000, "easeInOutExpo");
                    return false;
                }
            }

            return false;
        });

  /*END scroll JS*/

    //  back-top scrolling
    //================================================================================
//Check to see if the window is top if not then display button
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.back-top').fadeIn();
        } else {
            $('.back-top').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('.back-top').click(function(){
        $('html, body').animate({scrollTop : 0},1000, "easeInOutExpo");
        return false;
    });
 //  back-top scrolling end
    //================================================================================



    });


}(jQuery));