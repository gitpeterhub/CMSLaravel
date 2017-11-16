$(document).ready(function () {
    //   var wow = new WOW().init();
    var i = 0;
    $(window).scroll(function () {

        var x = $(this).scrollTop();
        if (x > 300) {
            $('.content .text').slideDown(3000);
        }
        //        if (i == 0) {
        //            var wow = new WOW().init();
        //        } else {
        //
        //        }
        //        i = 1;
        //        $(".container").slideDown(1000);
    });

});
