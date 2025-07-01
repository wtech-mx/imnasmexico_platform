<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Cotizador - @yield('template_title')
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="{{ asset('assets/ecommerce/media/fonts/nunito/nunito.css') }}" rel="stylesheet">
    <meta name="google-site-verification" content="xjOUgezOv03ht4XdfShswB0Hh-49H_WsaM6Cx9GIR6A" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/twitter-bootstrap.css') }}">
    <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- css custom -->

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <!-- Owl Carousel CSS -->

    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/owl.theme.default.min.css') }}">

    @yield('css_custom')

    <style>
        body {
            background: #f8f9fa;
        }

        .product-navbar {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            text-align: left;
        }

        .product-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 5px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            max-height: 80px;
            object-fit: contain;
        }

        .product_category {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 10px;
            text-align: left;
        }

        .product_category img {
            width: 100%;
            max-height: 80px;
            object-fit: contain;
            border-radius: 6px;
        }

        .sidebar {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .badge-category {
            font-size: 12px;
            color: #888;
        }
        .btn-counter {
            border: 1px solid #ccc;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            line-height: 1;
        }

        .tittle_category{
            font-size: 9px;
            font-weight: bold;
        }

        .text_items{
            font-size: 9px;
            font-weight: normal;
        }


        .btns_flotantes{
            position: absolute;
            top: 25px;
            right: 0;
        }

        .card_tittle_product{
            font-size: 12px;
        }

    </style>

</head>

<body style="background:#f9f4f4">

        @yield('cotizador')

        <!-- jQuery (necesario para Owl Carousel) -->
        <script src="{{ asset('assets/ecommerce/dataTables/js/jquery-3.6.0.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/bootstrap_bundle.js') }}"></script>

        <!-- Owl Carousel JS -->
        <script src="{{ asset('assets/ecommerce/dataTables/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/ecommerce/dataTables/js/owl.carousel.min.js') }}"></script>

        <script>

            const owlSettings = {
                loop: true,
                margin: 15,
                autoplay: false,
                dots:false,
                autoplayTimeout: 9000,
                autoplayHoverPause: true,
                nav: true,
                responsive: {
                    0: { items: 3 },
                    420: { items: 3 },
                    576: { items: 4 },
                    676: { items: 5 },
                    768: { items: 5 },
                    950: { items: 6 },
                    1200: { items: 6 }
                }
            };

            $("#loop_categorias_corp").owlCarousel(owlSettings);
            $("#loop_categorias_facial").owlCarousel(owlSettings);

            function actualizarHora() {
                const ahora = new Date();
                let horas = ahora.getHours();
                const minutos = ahora.getMinutes().toString().padStart(2, '0');
                const segundos = ahora.getSeconds().toString().padStart(2, '0');
                const ampm = horas >= 12 ? 'PM' : 'AM';

                horas = horas % 12;
                horas = horas ? horas : 12; // hora 0 debe ser 12

                const horaFormateada = `${horas}:${minutos}:${segundos} ${ampm}`;
                document.getElementById('hora-actual').textContent = horaFormateada;
            }

            // Actualizar al cargar y luego cada segundo
            actualizarHora();
            setInterval(actualizarHora, 1000);

        </script>

        @yield('js_custom')


</body>

</html>
