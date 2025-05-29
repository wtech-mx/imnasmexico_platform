<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Link de Pago
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

    <!-- css custom -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/ecommerce.css') }}">

    <!-- Sweetalert2 -->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">


    @yield('css_custom')

    <style>
        .titulo{
            font-size: 20px;
            line-height: 25px;
        }
        .subtitle{
            font-size: 16px;
            line-height: 20px;
            color: rgba(0, 0, 0, .55);
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 19px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .strong_ticket{
            font-weight: 500;
        }

        .ticket_text{
            font-weight: 300;
        }


        .bi-share::before {
            content: "\f52e";
            font-size: 14px;
        }

        .compra_prote{
            background: #00a650;
            color: #fff;
            font-size: 9px;
            border-radius: 10px;
            padding: 4px;
        }

        .bi-shield::before {
            content: "\f53f";
            font-size: 13px;
        }

        .bi-cart::before {
            content: "\f242";
            font-size: 15px;
        }

        .btn_compra{
            background-color: #3483fa;
            border: none;
            border-radius: 13px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

    </style>

</head>

    <body style="background:#f9f4f4">
    <section class="d-flex justify-content-center align-items-start" style="min-height:100vh; background: #3483fa;">
        <div class="card p-3 mt-3 mb-5" style="max-width: 375px; width:100%;">

            {{-- — Header del ticket — --}}

            {{-- — Total del pago — --}}
            <div class="text-center mb-2">
            <div class="row">
                <div class="col-12">
                    <img src="https://plataforma.imnasmexico.com/cosmika/menu/logo.png" style="width: 90px">
                    <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" style="width: 130px">
                </div>
            </div>
            <h5>Link de pago</h5>
                <div class="d-flex justify-content-center" >
                    <p class="compra_prote">COMPRA PROTEGIDA <i class="icons_header bi bi-shield" style="color:#fff"></i></p>
                </div>
            </div>

            {{-- — Resumen de Totales — --}}
            <div class="border-top pt-2">
                <h5>Para continuar con tu proceso, por favor envía el comprobante de pago emitido por tu banco a tu asesor de ventas para validar la transacción. </h5>
            </div>

        </div>
    </section>



        <!-- Bootstrap -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/bootstrap_bundle.js') }}"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/popper.js') }}"></script>

        <!-- jquery -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/jquery-3.7.0.js') }}"></script>

        <!-- Sweetalert2 -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>

        @yield('js_custom')


</body>

</html>
