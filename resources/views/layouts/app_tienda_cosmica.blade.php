<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}"> --}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">

    <link rel="shortcut icon" href="{{ asset('cosmika/menu/logo.png') }}" type="image/png">

    <title>
        @yield('template_title') - {{$configuracion->nombre_sistema}}
    </title>

    <link href="{{asset('assets/user/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/ecomeerce_cosmica.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/ecomeerce_fuentes.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/btn_flotante.css')}}" rel="stylesheet" />

    <style>

        #searchForm {
            transition: opacity 0.3s ease-in-out;
        }

    </style>
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    @yield('css_custom')

    <!-- Font Awesome Icons -->
    {{-- <link href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.cs')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @font-face {
            font-family: "Avenir";
            src: url('{{asset('cosmika/tipografia/Avenir.ttc')}}');
        }

        @font-face {
            font-family: "Christmas";
            src: url('{{asset('cosmika/tipografia/Christmas.otf')}}');
        }

        @font-face {
            font-family: "Quinsi";
            src: url('{{asset('cosmika/tipografia/Quinsi.ttf')}}');
        }

        @font-face {
            font-family: "SwilyBright_Italic";
            src: url('{{asset('cosmika/tipografia/SwilyBright_Italic.otf')}}');
        }

        .Avenir{
            font-family: 'Avenir';
        }

        .Christmas{
            font-family:'Christmas';
        }

        .Quinsi{
            font-family:'Quinsi';
        }

        .SwilyBright_Italic{
            font-family:'SwilyBright_Italic';
        }

        .btn-prev-facial, .btn-next-facial,
        .btn-prev-corporal, .btn-next-corporal {
            background: rgba(0, 0, 0, 0);
            color: #D8BBB8;
            border: none;
            font-size: 24px;
            padding: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-prev-facial:hover, .btn-next-facial:hover,
        .btn-prev-corporal:hover, .btn-next-corporal:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        /* Ocultar flechas en pantallas menores a 768px */
        @media (max-width: 500px) {
            .btn-prev-facial, .btn-next-facial,
            .btn-prev-corporal, .btn-next-corporal {
                display: none !important;
            }
        }



    </style>

  </head>

  <body class="body @yield('body_custom')">

    @include('tienda_cosmica.Components.header')

    @yield('content')

    @include('tienda_cosmica.Components.footer')

    @include('tienda_cosmica.Components.btn_flotante')

    @include('layouts.alertas')

    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;"></div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <!-- jQuery (necesario para Owl Carousel) -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
 let facialCarousel = $("#facialPopular").owlCarousel({
        loop: true,
        margin: 15,
        nav: false, // Desactivar las flechas por defecto
        dots: true, // Puedes mantener los dots si quieres
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: { items: 2 },
            576: { items: 3 },
            768: { items: 4 },
            992: { items: 5 },
            1200: { items: 6 }
        }
    });

    let corporalCarousel = $("#corporalPopular").owlCarousel({
        loop: true,
        margin: 15,
        nav: false, // Desactivar las flechas por defecto
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: { items: 2 },
            576: { items: 3 },
            768: { items: 4 },
            992: { items: 5 },
            1200: { items: 6 }
        }
    });

    // Botones de navegación manual para facial
    $(".btn-prev-facial").click(function(){
        facialCarousel.trigger('prev.owl.carousel');
    });

    $(".btn-next-facial").click(function(){
        facialCarousel.trigger('next.owl.carousel');
    });

    // Botones de navegación manual para corporal
    $(".btn-prev-corporal").click(function(){
        corporalCarousel.trigger('prev.owl.carousel');
    });

    $(".btn-next-corporal").click(function(){
        corporalCarousel.trigger('next.owl.carousel');
    });
        $("#generalPopular").owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            navText: [
                '<i class="bi bi-chevron-left"></i>',
                '<i class="bi bi-chevron-right"></i>'
            ],
            autoplay: false, // Activar autoplay
            autoplayTimeout: 3000, // Tiempo en milisegundos (3 segundos)
            autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 3
                },
                768: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        });
        $("#carousel_Single_Product").owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            navText: [
                '<i class="bi bi-chevron-left"></i>',
                '<i class="bi bi-chevron-right"></i>'
            ],
            autoplay: true, // Activar autoplay
            autoplayTimeout: 3000, // Tiempo en milisegundos (3 segundos)
            autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 4
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchIcon = document.getElementById("toggleForm"); // Icono de la lupa
            const searchForm = document.getElementById("searchForm"); // Formulario de búsqueda
            const navbarBrand = document.querySelector(".navbar-brand"); // Logo
            const searchInput = document.getElementById("buscador"); // Input de búsqueda

            // Mostrar/Ocultar el formulario al hacer clic en la lupa
            searchIcon.addEventListener("click", function () {
                searchForm.classList.toggle("d-none");

                // Ocultar el logo en móvil cuando se muestre el buscador
                if (!searchForm.classList.contains("d-none") && window.innerWidth <= 992) {
                    navbarBrand.classList.add("d-none");
                }
            });

            // Ocultar el logo si el usuario hace clic dentro del input en móvil
            searchInput.addEventListener("focus", function () {
                if (window.innerWidth <= 992) {
                    navbarBrand.classList.add("d-none");
                }
            });

            // Ocultar el buscador si se hace clic fuera
            document.addEventListener("click", function (event) {
                if (!searchForm.contains(event.target) && !searchIcon.contains(event.target)) {
                    searchForm.classList.add("d-none");

                    if (window.innerWidth <= 992) {
                        navbarBrand.classList.remove("d-none"); // Mostrar el logo nuevamente
                    }
                }
            });

            // Evitar que se cierre si el usuario hace clic dentro del buscador
            searchForm.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            // Detectar Enter en el buscador para redirigir a la vista de resultados
            searchInput.addEventListener("keypress", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Evita el envío normal del formulario
                    let query = searchInput.value.trim();
                    if (query.length > 1) {
                        window.location.href = `/tienda/busqueda?query=${encodeURIComponent(query)}`;
                    }
                }
            });
        });

        $(document).ready(function () {
            $('#buscador').on('keyup', function () {
                let query = $(this).val();

                if (query.length > 1) {
                    $.ajax({
                        url: '{{ route("productos.buscar") }}',
                        type: 'GET',
                        data: { query: query },
                        success: function (data) {
                            $('#resultadoBusqueda').html(data);
                        }
                    });
                } else {
                    $('#resultadoBusqueda').empty();
                }
            });

            // Redireccionar al hacer clic en un producto
            $(document).on('click', '.producto-item', function () {
                let url = $(this).data('url');
                window.location.href = url;
            });
        });
    </script>



    @yield('js')

  </body>
</html>
