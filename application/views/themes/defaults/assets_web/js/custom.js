jQuery(document).on('ready', function ($) {
    "use strict";

    
    // Hide Loading Box (Preloader)
    $('.preloader').delay(300).fadeOut('slow');
    $('body').delay(300).css({'overflow':'visible'});

    /*-----------------------------
        MAIN SLIDER (OWL CAROUSEL)
    ------------------------------*/
    $('.main_slider').owlCarousel({
        loop:true,
        nav : true,
        autoplay: true,
        items: 1,
        autoplayTimeout: 4000,
        smartSpeed: 1500,
        navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>']
    }); 
    
    // Main Slider Text Animation
    $(".main_slider").on("translate.owl.carousel", function () {
        $(this).find(".owl-item .animated_caption > h3").removeClass("fadeInDown animated").css("opacity","0");
        $(this).find(".owl-item .animated_caption > h2").removeClass("zoomIn animated").css("opacity","0");
        $(this).find(".owl-item .animated_caption > a").removeClass("fadeInUp animated").css("opacity","0");
    });          
    $(".main_slider").on("translated.owl.carousel", function () {
        $(this).find(".owl-item.active .animated_caption > h3").addClass("fadeInDown animated").css("opacity","1");
        $(this).find(".owl-item.active .animated_caption > h2").addClass("zoomIn animated").css("opacity","1");
        $(this).find(".owl-item.active .animated_caption > a").addClass("fadeInUp animated").css("opacity","1");
    }); 
    
    $('.menu_slider').owlCarousel({
        loop:true,
        nav : true,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        animateOut: 'fadeOut',
        items: 1,
        navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>']
    }); 
    
    $('.team_slider').owlCarousel({
        loop:true,
        nav : true,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 25,
        items: 3,
        navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        responsive:{
            0:{
                items: 1
            },
            520:{
                items: 2
            },
            992:{
                items: 3
            }
        }
    }); 
    
    $(".offer_slider").owlCarousel({
        loop: false,
        nav : true,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 30,
        autoplayHoverPause: true,
        navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        responsive:{
            0:{
                items: 1
            },
            460:{
                items: 2
            },
            767:{
                items: 3
            },
            992:{
                items: 4
            }
        }
    });
    
    $(".post_slider").owlCarousel({
        loop: true,
        nav : true,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        responsive:{
            0:{
                items: 2
            },
            480:{
                items: 3
            },
            575:{
                items: 4
            },
            768:{
                items: 5
            },
            1199:{
                items: 6
            }
        }
    });
        
    $(".table_chart_inner a").click(function(){
        $(this).find("img").css({
            '-webkit-filter':'grayscale(100%)',
        });
        $(this).parents().siblings().find("img").css({
            '-webkit-filter':'none',
        });
    });
    
    /*------------------------------------
     Mobile Menu
     -------------------------------------- */

    $("#mobile-menu").metisMenu();

    $('#dismiss, .overlay').on('click', function () {
        $('.sidebar-nav').removeClass('active');
        $('.overlay').fadeOut();
    });

    $('#sidebarCollapse').on('click', function () {
        $('.sidebar-nav').addClass('active');
        $('.overlay').fadeIn();
    });
    
    /*------------------------------------
     Datepicker
     -------------------------------------- */
    $('.datepicker').datepicker({
        autoclose: true,
		format: "yyyy-m-d"
    });
    $('.datepickerreserve').datepicker({
        autoclose: true,
		format: "yyyy-m-d",
		startDate: '-0d',
    });
    
    /*------------------------------
    Clock Picker
    -------------------------------*/
    var input = $('#time, #reservation_time').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });

    /*---------------------------
        Sticky Menu
    -----------------------------*/
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.header_top').addClass('menu_fixed');
        } else {
            $('.header_top').removeClass('menu_fixed');
        }
    });


    /*----------------------------
        SCROLL TO TOP
    ------------------------------*/
    // Back to top js
    var offset = 100,
        offset_opacity = 1200,
        scroll_top_duration = 1500,
        $back_to_top = $('.cd-top');

    $(window).on('scroll', function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) { 
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
        );
    });
    
    
    $("#search-icon").click(function(){
        $(".search_box").toggle();
    });


    /*--------------------------
        ACTIVE WOW JS
    ----------------------------*/
    new WOW().init();

}(jQuery));