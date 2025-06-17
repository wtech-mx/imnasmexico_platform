<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="https://zocofresh.com/assets/css/ticket.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

  <style>
    body {
        background-color: #414141!important;
    }
  </style>
</head>
<body>

<main class="ticket-system">
   <div class="top">
   <h1 class="title">Espera un segundo, tu tiket se está imprimiendo.</h1>
   <div class="printer">
   </div>

   <div class="receipts-wrapper">
        <div class="receipt">
<div class="receipt">
            <div class="details">
                <div class="item"> </div>
                <div class="item">
                    <img class="logo_ticket" src="{{ asset('ecommerce/Logo_horizontal_negro.png') }}" style="width: 180px !important;">
                </div>
                <div class="item"></div>
            </div>

            <div class="d-flex justify-content-center">
                <p class="text-center" style="font-size: 10px">
                    ZOCOFRESH <br>
                    Tel:558914-2564 / 5589142565 <br>
                    RFC:ZFR2306262N7 <br>
                    ventas@zocofresh.com.mx / zocofresh@gmail.com <br>
                    zocofresh.com <br>
                    ZOCO FREESH IGNACIO RAYON 51 <br>
                    BARRIO SAN FELIPE <br>
                    51950 - TONATICO <br>
                    México <br>
                    SUCURSAL MÉRIDA 64, ROMA NORTE, CUAUHTEMOC , <br>
                    06700, CDMX <br>
                    ------------------- <br>
                    Servido por "" <br>
                    <strong style="font-size: 19px;"></strong>
                </p>
            </div>


            <div class="details row">

                {{-- Datos de venta --}}

                <p class="text-center" style="font-size: 10px">
                    ZOCOFRESH <br>
                    Tel:558914-2564 / 5589142565 <br>
                    RFC:ZFR2306262N7 <br>
                    ventas@zocofresh.com.mx / zocofresh@gmail.com <br>
                    zocofresh.com <br>
                    ZOCO FREESH IGNACIO RAYON 51 <br>
                    BARRIO SAN FELIPE <br>
                    51950 - TONATICO <br>
                    México <br>
                    SUCURSAL MÉRIDA 64, ROMA NORTE, CUAUHTEMOC , <br>
                    06700, CDMX <br>
                    ------------------- <br>
                    Servido por "" <br>
                    <strong style="font-size: 19px;"></strong>
                </p>


            </div>
        </div>

        <div class="receipt qr-code">

            {{-- qr dinamico --}}


            <div class="description">
            <h2 style="font-size: 21px;">¡Gracias por su Compra! </h2>
            </div>
        </div>
        </div>
   </div>

</main>

</body>

</html>
