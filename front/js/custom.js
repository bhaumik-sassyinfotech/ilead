$(document).ready(function () {

});


$(function () {
    // variables ftw!
    var win = $(window),
        sectionHeight = $('.portal-section').height(),
        mainNav = $('.pc-nav'),
        mainNavIcon = $('#nav-icon4'),
        portalIcon = $('.burber-icon'),
        PortalMainNav = $('.portal-menu ul');

    // fire it once on document.ready
    resizeHandler();

    // Fires on every resize   
    win.resize(resizeHandler); 
    function resizeHandler() {                 
           
        if (win.width() <= 767) {        
            mobileMenu(mainNav, mainNavIcon);
        }
        if (win.width() < 1024) { 
        SlideDown(PortalMainNav,portalIcon);
        }
        if (win.width() >= 1024) { 
            sideHeight(PortalMainNav,sectionHeight);
        }
    }
            function mobileMenu(p,e) {
                $(p).addClass('slide-out');
                $(e).click(function () {
                    $(this).toggleClass('open');
                    $(p).toggleClass('slide-out slide-in')
                });
            }
            function sideHeight(a,b){                
                $(a).css('height', b);                
            }
            function SlideDown(a,b){
                b.click(function(){                    
                    $(this).stop().toggleClass('white');
                    a.stop().slideToggle();
                });
            }
});


       
 
        $(function() {  
            
            
             $('.dwn-appslider').owlCarousel({
            nav: true,
            loop: true,
            navText: ["", ""],
            dots: false,
            items: 1
        });

        $('.testimonial-slider').owlCarousel({
            nav: true,
            loop: true,
            dots: false,
            navText: ["", ""],
            //   animateOut: 'fadein',
            animateIn: 'bounceIn',
            smartSpeed: 450,

            items: 1
        })


            $("#mySlider2").AnimatedSlider( { prevButton: "#btn_prev2", 
                                             nextButton: "#btn_next2",
                                             visibleItems: 5,
                                              
                                             infiniteScroll: true,
                                             willChangeCallback: function(obj, item) { 
//                                                $('.next_hidden').css('opacity', 0);
                                             },
                                             changedCallback: function() { 
//                                                 alert("hello");
//                                                 $('.previous_hidden').css('opacity', 1);
                                             }
                                          });
        });
   
    
    
	<!-- Start For Video play -->

	
