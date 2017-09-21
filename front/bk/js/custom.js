$(function () {
    // variables ftw!
    var win = $(window);

    // fire it once on document.ready
    resizeHandler();

    // Fires on every resize   
    win.resize(resizeHandler);

    function resizeHandler() {
        if (win.width() >= 768) {

            $(window).scroll(function () {
                var winTop = $(window).scrollTop();
                if (winTop >= 30) {
                    $("body").addClass("sticky-header");
                } else {
                    $("body").removeClass("sticky-header");
                } //if-else
            }); //win func.

        } else {
            $(document).ready(function () {
                $('#nav-icon3').click(function () {
                    $(this).toggleClass('open');
                    $('.nav-wrapper nav').toggleClass('slideout slidein');
                    $('body').toggleClass('overflow-hidden');
                });
            });
        }
    }
    
    
   
});
 /*Promote home page slider*/
    
adminmenu();
function adminmenu(){
    $('.mobile-admin-menu').click(function(){
        $('.profile-sidebar ul').stop().slideToggle();
    });
}
    function promoteSlider(){
          $('.promote-slider').owlCarousel({
            loop: true,        
            margin: 10,
            autoplay:true,
autoplayTimeout:3000,
autoplayHoverPause:true,
            nav: false,
              dots:false,
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        })
    } 

function categorySlider(){
          $('.gift-category').owlCarousel({
            loop: true,        
            margin: 10,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            nav: false,
            dots:true,
            responsive: {
                0: {
                    items: 1
                }               
            }
        })
    }