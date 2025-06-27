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

    @include('layouts.css')

    <!-- Bootstrap -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="https://192.168.1.143/imnasmexico_platform/public/assets/ecommerce/css/bootstrap.css">

    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}"> --}}

     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/twitter-bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="https://192.168.1.143/imnasmexico_platform/public/assets/ecommerce/css/twitter-bootstrap.css">

    <!-- css custom -->

    <!-- Sweetalert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}"> --}}
    <link rel="stylesheet" href="https://192.168.1.143/imnasmexico_platform/public/assets/ecommerce/css/sweetalert2.css">

    {{-- <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://192.168.1.143/imnasmexico_platform/public/assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css">

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

        @include('layouts.js')

        @yield('js_custom')

</body>

</html>
