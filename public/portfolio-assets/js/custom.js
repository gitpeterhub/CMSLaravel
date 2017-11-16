$(document).ready(function () {
    new WOW().init();
    $('.navbar-nav li').click(function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    });
});
