<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        NAS - @yield('template_title')
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="google-site-verification" content="xjOUgezOv03ht4XdfShswB0Hh-49H_WsaM6Cx9GIR6A" />
    <!-- Bootstrap -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}">

     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/twitter-bootstrap.css') }}">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- css custom -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/ecommerce.css') }}">

    <!-- Sweetalert2 -->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <!-- Select2  -->
     <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/select2.css') }}">

    <!-- ligthbox  -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/lightbox.min.css') }}">

    <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/ecommerce/css/btn_flotante.css')}}" rel="stylesheet" />


    @include('shop.components.fuentes')

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    @yield('css_custom')


</head>

{{-- <body style="background: linear-gradient(0deg, rgba(247, 245, 238, 0.97) 0%, rgba(247, 245, 238, 0.97) 100%), url('{{ asset('ecommerce/patter_2_grande.png') }}') lightgray 50% / cover no-repeat;"> --}}
    <body style="background:#f9f4f4">

        <div class="container-fluid p-0">
            @include('shop.components.header')
        </div>

        @yield('ecomeerce')

        @include('shop.components.brands_ecommerce')
        @include('shop.components.footer_ecommerce')
        @include('shop.components.btn_flotante')


        <!-- Bootstrap -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/bootstrap_bundle.js') }}"></script>


        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/popper.js') }}"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> --}}

        <!-- jquery -->
        {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/jquery-3.7.0.js') }}"></script>

        <!-- dataTables -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- js custom -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/navbar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/preloader.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/ofline.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/lightbox.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/slide_grid.js') }}"></script>


        <!-- Sweetalert2 -->
         <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>-->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>

        <!-- Select2  -->
         <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/select2.min.js') }}"></script>

        <!-- Scanner  -->
         <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/html5-qrcode.min.js') }}"></script>

        <!-- jQuery (necesario para Owl Carousel) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script>
            $(document).ready(function () {
                let debounceTimer;

                $('#buscador, #buscador-movil').on('keyup', function (e) {
                    let inputField = $(this);
                    let query = inputField.val();
                    let resultadoBusqueda = inputField.attr('id') === 'buscador' ? '#resultadoBusqueda' : '#resultadoBusquedaMovil';
                    let spinner = inputField.attr('id') === 'buscador' ? '#spinnerBusqueda' : '#spinnerBusquedaMovil';

                    // Detectar la tecla Enter (Código 13)
                    if (e.keyCode === 13) {
                        window.location.href = "{{ route('tienda_online.filter') }}?query=" + encodeURIComponent(query);
                        return;
                    }

                    // Limpiar el temporizador anterior
                    clearTimeout(debounceTimer);

                    // Mostrar spinner
                    $(spinner).show();

                    // Esperar 1 segundo antes de hacer la petición AJAX
                    debounceTimer = setTimeout(() => {
                        if (query.length > 1) {
                            $.ajax({
                                url: "{{ route('productos.buscarNas') }}",
                                type: "GET",
                                data: { query: query },
                                success: function (data) {
                                    $(resultadoBusqueda).html(data);
                                    $(spinner).hide(); // Ocultar spinner
                                },
                                error: function () {
                                    $(resultadoBusqueda).empty();
                                    $(spinner).hide(); // Ocultar spinner
                                }
                            });
                        } else {
                            $(resultadoBusqueda).empty();
                            $(spinner).hide(); // Ocultar spinner si no hay consulta
                        }
                    }, 1000);
                });

                // Redireccionar al hacer clic en un producto
                $(document).on("click", ".producto-item", function () {
                    let url = $(this).data("url");
                    window.location.href = url;
                });
            });
            </script>

<script>
$(document).ready(function() {
    $(".agregar-carrito").click(function() {
        var productId = $(this).data("id");
        var cantidadInput = $("#cantidad_" + productId);
        var cantidad = cantidadInput.val() || 1;

        // 🎯 Obtener el botón de compra y su contenedor
        var boton = $(this);
        var spinner = $('<div class="spinner-border spinner-border-sm text-light ms-2" role="status"><span class="visually-hidden">Cargando...</span></div>');

        // 🚀 Ocultar el botón de "Comprar" y mostrar el spinner
        boton.html(spinner);
        boton.prop("disabled", true);

        $.ajax({
            url: "{{ route('carrito.agregarNas') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: productId,
                cantidad: cantidad
            },
            success: function(response) {
                let audio = new Audio("{{ asset('assets/media/audio/save_global_s.mp3') }}");
                audio.play();

                mostrarToast("✅ Producto agregado al carrito", "success");

                // ✅ Actualizar el contador del carrito en tiempo real
                actualizarContadorCarrito(response.total_productos);
            },
            error: function(xhr) {
                if (xhr.status === 400) {
                    mostrarToast(xhr.responseJSON.error, "error");
                } else {
                    mostrarToast("❌ Hubo un problema al agregar el producto", "error");
                }
            },
            complete: function() {
                // 🔄 Restaurar el botón original después de la petición
                boton.html('Comprar <i class="bi bi-cart-plus icon_comprar"></i>');
                boton.prop("disabled", false);
            }
        });
    });

    // ✅ Función para actualizar el contador del carrito en tiempo real
    function actualizarContadorCarrito(total) {
        let contador = $("#contador-carrito");

        contador.text(total); // Cambia el número en la burbuja del carrito

        if (total > 0) {
            contador.show(); // Muestra la bolita roja si hay productos
        } else {
            contador.hide(); // Oculta si está vacío
        }
    }

    function mostrarToast(mensaje, tipo) {
        let audioSrc = tipo === "success"
            ? "{{ asset('assets/media/audio/save_global_S.mp3') }}"
            : "{{ asset('assets/media/audio/stock_insuficiente_S.mp3') }}";

        let audio = new Audio(audioSrc);
        audio.play();

        Swal.fire({
            toast: true,
            position: "top-end",
            icon: tipo,
            title: mensaje,
            showConfirmButton: false,
            timer: 2000
        });
    }
});

    </script>



        <script>
            $(document).ready(function() {
                var token = $('meta[name="csrf-token"]').attr('content');
                // Inicializar el primer carrusel (Marcas)
                $("#brandsCarousel").owlCarousel({
                    loop: true,
                    margin: 15,
                    autoplay: true, // Activar autoplay
                    autoplayTimeout: 3000, // Tiempo en milisegundos (3 segundos)
                    autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
                    responsive: {
                        0: {
                            items: 3
                        },
                        576: {
                            items: 4
                        },
                        768: {
                            items: 5
                        },
                        1200: {
                            items: 6
                        }
                    }
                });

                $("#GaleriProductCarousel").owlCarousel({
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
                            items: 3
                        },
                        768: {
                            items: 3
                        },
                        1200: {
                            items: 3
                        }
                    }
                });

                $("#popularProductsCarousel").owlCarousel({
                    loop: true,
                    margin: 15,
                    autoplay: false,
                    dots:false,
                    autoplayTimeout: 9000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        576: {
                            items: 2
                        },
                        676: {
                            items: 3
                        },
                        768: {
                            items: 3 // 📌 Ajuste en pantallas de 768px
                        },
                        950: {  // 📌 Nuevo breakpoint para pantallas de 900px
                            items: 4
                        },
                        1200: {
                            items: 4
                        }
                    }
                });

                $("#loop_ofertasPromos").owlCarousel({
                    loop: true,
                    margin: 15,
                    autoplay: false,
                    autoplayTimeout: 9000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        576: {
                            items: 2
                        },
                        676: {
                            items: 3
                        },
                        768: {
                            items: 3 // 📌 Ajuste en pantallas de 768px
                        },
                        950: {  // 📌 Nuevo breakpoint para pantallas de 900px
                            items: 4
                        },
                        1200: {
                            items: 4
                        }
                    }
                });

                // Inicializar el segundo carrusel (Departamentos)
                $("#departmentsCarousel").owlCarousel({
                    loop: true,
                    margin: 15,
                    dots:false,
                    autoplay: true, // Activar autoplay
                    autoplayTimeout: 6000, // Tiempo en milisegundos (3 segundos)
                    autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
                    responsive: {
                        0: {
                            items: 3
                        },
                        576: {
                            items: 4
                        },
                        768: {
                            items: 5
                        },
                        1200: {
                            items: 6
                        }
                    }
                });

                $("#departmentsCarouselCorporal").owlCarousel({
                    loop: true,
                    margin: 15,
                    dots:false,
                    autoplay: true, // Activar autoplay
                    autoplayTimeout: 6000, // Tiempo en milisegundos (3 segundos)
                    autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
                    responsive: {
                        0: {
                            items: 3
                        },
                        576: {
                            items: 4
                        },
                        768: {
                            items: 5
                        },
                        1200: {
                            items: 6
                        }
                    }
                });

                // Inicializar el carrusel de Carnes y pescados
                $("#meatAndFishCarousel").owlCarousel({
                    loop: true,
                    margin: 15,
                    dots:false,
                    autoplay: true, // Activar autoplay
                    autoplayTimeout: 4500, // Tiempo en milisegundos (3 segundos)
                    autoplayHoverPause: true, // Pausar autoplay al pasar el mouse
                    responsive: {
                        0: {
                            items: 1
                        },
                        599: {
                            items: 2
                        },
                        768: {
                            items: 2
                        },
                        945: {
                            items: 3
                        },
                        1200: {
                            items: 3
                        }
                    }
                });
            });

        </script>

        @yield('js_custom')
        @yield('js_clientes')
        @yield('js_custom_pdf')
        @yield('js_caja_pass')
        @yield('js_scanner')
        @yield('js_custom_productos')
        @yield('js_custom2_clientes')
        @yield('js_custom2_empleado')
        @yield('js_custom_caja_reg')
        @yield('js_custom_cliente')
        @yield('js_custom_settings')
        @yield('js_custom_licencias')
        @yield('js_alert_key')
        @yield('js_alert_key_aprov')
        @yield('js_update_img_portada')
        @yield('js_proveedor')

</body>

</html>
