// $(window).load(function(){
//     $('#page-loader').fadeOut(1000);
// });

$(window).on('load', function () {
    setTimeout(function() {
        jQuery("#page-loader").fadeOut("slow");
    }, 3000); // 3 segundos
});
