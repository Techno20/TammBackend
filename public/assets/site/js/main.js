/*global $, jQuery, console, alert, prompt */
$(window).on('load',function() {
    // Animate loader off screen
    $(".se-pre-con,.pre-loader").delay(500).fadeOut("slow");
    new WOW().init(
    {
        mobile:       false,
        live:         true
    });
});
$(document).ready(function () {
    "use strict";
    // Public Elemnts
    // new WOW().init();

    $('[placeholder]').focus(function () { // Placeholder
        $(this).attr('data-place', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-place'));
    });


     // search box
    $(document).on('click','.search-btn', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.header-search').slideToggle();
    });
     // sidemenu
    $('#openMenu').click(function (e) {
        e.preventDefault();
        $('.side-menu').css("left", 0).css("opacity", 1);
        $('.side-overlay').fadeIn();
        $('body, html').css("overflow-y", "hidden");
        $('.side-overlay, #closeMenu').click(function () {
            $('.side-menu').css("left", "-900px").css("opacity", 0);
            $('.side-overlay').fadeOut();
            $('body, html').css("overflow-y", "auto");
        });
    });
    $(document).on('click','.profile-toggle',function (e) {
        e.preventDefault();
        $('.profile-sidebar').slideToggle();      
    });

 


    

     /*-----------------------------------
     * FIXED  MENU - HEADER
     *-----------------------------------*/
    function menuscroll() {
        // var $navmenu = $('.nav-menu');
        var $navmenu = $('.header_bottom,.account_header');
        if ($(window).scrollTop() > 50) {
            $navmenu.addClass('is-scrolling');
        } else {
            $navmenu.removeClass("is-scrolling");
        }
    }
    menuscroll();
    $(window).on('scroll', function() {
        menuscroll();
    });
    /*-----------------------------------
     * ONE PAGE SCROLLING
     *-----------------------------------*/
    // Select all links with hashes
    // add custom :     .not('[data-toggle="collapse"]').not('[data-toggle="collapse"]')
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle="pill"]').not('[data-toggle="tab"]').not('[data-toggle="collapse"]').not('[data-toggle="modal"]').on('click', function(event) {
        // On-page links
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 60
                }, 1000, function() {
                    // Callback after animation
                    // Must change focus!
                    // var $target = $(target);
                    // $target.focus();
                    // if ($target.is(":focus")) { // Checking if the target was focused
                    //     return false;
                    // } else {
                    //     $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                    //     $target.focus(); // Set focus again
                    // };
                });
            }
        }
    });

    // $('body').scrollspy({ target: '#main_menu' });

    // scroll-up
    $(document).on('click',"#move-to-top",function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1500);
    });


    // sliders
    $('.news-imgs-slider').owlCarousel({
        // center: true,
        items: 1,
        loop: true,
        rtl: true,
        nav:true,
        navText: ["<i class='fas fa-chevron-right' title='Prev'></i>","<i class='fas fa-chevron-left' title='Next'></i>"],      
        dots:true,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        dotsContainer: '#news-img-titles',
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:1,
            },
            // breakpoint from 768 up
            992 : {
                items:1,
            }
        }
    });
    $(document).on('click','#news-img-titles .s-item-title',function () {   
        $('.news-imgs-slider.owl-carousel').trigger('to.owl.carousel', [$(this).index(), 300]);
    });
    // services-cat-slider-1
    $('.services-cat-slider-1').owlCarousel({
        // center: true,
        // items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:2,
            },
            // breakpoint from 480 up
            480 : {
                items:2,
            },
            // breakpoint from 768 up
            768 : {
                items:3,
            },
            // breakpoint from 768 up
            992 : {
                items:4,
            },
            // breakpoint from 992 up
            1200 : {
                items:5,
            }
        }
    });
    // services-slider-1
    $('.services-slider-1').owlCarousel({
        // center: true,
        // items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:2,
            },
            // breakpoint from 768 up
            768 : {
                items:3,
            },
            // breakpoint from 768 up
            992 : {
                items:4,
            },
            // breakpoint from 992 up
            1200 : {
                items:5,
            }
        }
    });
    // marketplace-slider-1
    $('.marketplace-slider-1').owlCarousel({
        // center: true,
        // items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:2,
                slideBy:2
            },
            // breakpoint from 480 up
            480 : {
                items:2,
                slideBy:2
            },
            // breakpoint from 768 up
            768 : {
                items:3,
                slideBy:3
            },
            // breakpoint from 768 up
            992 : {
                items:4,
                slideBy:4
            },
            // breakpoint from 992 up
            1200 : {
                items:5,
                slideBy:5
            }
        }
    });
    
    // testimonials-slider
    $('.testimonials-slider').owlCarousel({
        // center: true,
        items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:true,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:1,
            },
            // breakpoint from 768 up
            992 : {
                items:1,
            }
        }
    });
    // service-item-slider
    $('.service-item-slider').owlCarousel({
        // center: true,
        items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:true,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 768 up
            768 : {
                items:1,
            },
            // breakpoint from 768 up
            992 : {
                items:1,
            }
        }
    });
    // recommended-serv-slider
    $('.recommended-serv-slider').owlCarousel({
        // center: true,
        // items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:0,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:1,
            },
            // breakpoint from 576 up
            576 : {
                items:2,
            },
            // breakpoint from 768 up
            768 : {
                items:2,
            },
            // breakpoint from 768 up
            992 : {
                items:3,
            },
            // breakpoint from 992 up
            1200 : {
                items:2,
            }
        }
    });
    // top-rated-seller-slider
    /*******************************/ 
    // recalcCarouselWidth($('.top-rated-seller-slider')); 
    $('.top-rated-seller-slider').owlCarousel({
        // center: true,
        items: 1,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        margin:0,
        smartSpeed:450,
        autoWidth:true,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
            },
            // breakpoint from 480 up
            480 : {
                items:2,
            },
            // breakpoint from 768 up
            768 : {
                items:2,
            },
            // breakpoint from 768 up
            992 : {
                items:4.2,
            },
            // breakpoint from 992 up
            1200 : {
                items:4.15,
            }
        }
    });
    // $(window).on('resize', function(e){
    //     if($(window).outerWidth() <= 991){
    //        recalcCarouselWidth($('.top-rated-seller-slider'));
    //     }
    // }).resize();
    
    function recalcCarouselWidth(carousel) {
        var $stage = carousel.find('.owl-stage'),
             stageW = $stage.width(),
             $el = carousel.find('.owl-item .item img.main-img'),
             elW = 0;
        $el.each(function() {
            elW += $(this)[0].getBoundingClientRect().width;
            console.log(elW,Math.ceil($(this)[0].getBoundingClientRect().width));
            $(this).closest('.item').css("width",Math.ceil($(this)[0].getBoundingClientRect().width));
        });
        if ( elW > stageW ) {
         console.log('elW maggiore di stageW: ' +  elW + ' > ' + stageW);
         $stage.width( Math.ceil( elW ) );
        }
    }
    
    /*******************************/ 
    // main-categories-slider
    $('.main-categories-slider').owlCarousel({
        // center: true,
        autoWidth:true,
        loop: true,
        rtl: false,
        nav:true,
        navText: ["<i class='fas fa-chevron-left' title='Prev'></i>","<i class='fas fa-chevron-right' title='Next'></i>"],      
        dots:false,
        autoplay: false,
        navSpeed: 2000,
        autoplaySpeed: 1500,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        margin:15,
        smartSpeed:450,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:2,
            },
            // breakpoint from 480 up
            480 : {
                items:3,
            },
            // breakpoint from 768 up
            768 : {
                items:4,
            },
            // breakpoint from 768 up
            992 : {
                items:5,
            },
            // breakpoint from 992 up
            1200 : {
                items:6,
            }
        }
    });
    recalcCarouselCategoriesWidth($('.main-categories-slider'));
    function recalcCarouselCategoriesWidth(carousel) {
        var $stage = carousel.find('.owl-stage'),
             stageW = $stage.width(),
             $el = carousel.find('.owl-item .item'),
             elW = 0;
        $el.each(function() {
            elW += $(this)[0].getBoundingClientRect().width;
            $(this).css("width",Math.ceil($(this)[0].getBoundingClientRect().width));
        });
        if ( elW > stageW ) {
            $stage.width( Math.ceil( elW ) );
        }
        carousel.trigger('to.owl.carousel', [carousel.find('.item.active').parent().index()+1, 300]);
    }
    // $(document).on('click','.main-categories-slider .item',function () {   
    //     $('.main-categories-slider .item').removeClass('active');
    //     $(this).addClass('active');
    // });
    /*******************************/ 


    $('.modal').on('shown.bs.modal', function () {
      $('body').addClass('modal-open');
    });
    /*****************************************/ 
    // h-icons-dropdown
    $(document).on('click','.user-quick-menu > a',function(e) {
        e.preventDefault();
        let container = $(this).parent();
        if(!container.hasClass('show')){
            $('.user-quick-menu').removeClass('show');
        }
        container.toggleClass('show');
    });
    // messages sidemenu
    $(document).on('click','#message-menu-toggle',function (e) {
        e.preventDefault();
        $('.messages-side-menu').css("left", 0).css("opacity", 1);
        $('.messages-side-overlay').fadeIn();
        $('body, html').css("overflow-y", "hidden");
        $('.messages-side-overlay, #closeMenu').click(function () {
            $('.messages-side-menu').css("left", "-900px").css("opacity", 0);
            $('.messages-side-overlay').fadeOut();
            $('body, html').css("overflow-y", "auto");
        });
    });
});