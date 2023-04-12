// $(window).load(function(){
//     $('#page-loader').fadeOut(1000);
// });

$(window).on('load', function () {
    // Se establece un tiempo de espera de 3 segundos
    setTimeout(function() {
        // Se verifica si el contenido ha sido cargado
        if($('body').hasClass('loaded')){
            return;
        }
        // Si después de 3 segundos el contenido no se ha cargado, se oculta el preloader
        jQuery("#page-loader").fadeOut("slow");
        $('body').addClass('loaded');
    }, 3000);
});

// $(window).on('load', function () {
//     setTimeout(function(){
//        jQuery("#page-loader").fadeOut("slow");
//     }, 3000);
//  });

//  setTimeout(function(){
//     jQuery("#page-loader").fadeOut("slow");
//  }, 3000);
