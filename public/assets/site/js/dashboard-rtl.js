$(document).ready(function () {
    "use strict";
    // sidemenu
    $(document).on('click','#main-menu-toggle',function (e) {
        e.preventDefault();
        $('.left-side-menu').css("right", 0).css("opacity", 1);
        $('.side-overlay').fadeIn();
        $('body, html').css("overflow-y", "hidden");
        $('.side-overlay, #closeMenu').click(function () {
            $('.left-side-menu').css("right", "-900px").css("opacity", 0);
            $('.side-overlay').fadeOut();
            $('body, html').css("overflow-y", "auto");
        });
    });
    // messages sidemenu
    $(document).on('click','#message-menu-toggle',function (e) {
        e.preventDefault();
        $('.messages-side-menu').css("right", 0).css("opacity", 1);
        $('.messages-side-overlay').fadeIn();
        $('body, html').css("overflow-y", "hidden");
        $('.messages-side-overlay, #closeMenu').click(function () {
            $('.messages-side-menu').css("right", "-900px").css("opacity", 0);
            $('.messages-side-overlay').fadeOut();
            $('body, html').css("overflow-y", "auto");
        });
    });
    
});