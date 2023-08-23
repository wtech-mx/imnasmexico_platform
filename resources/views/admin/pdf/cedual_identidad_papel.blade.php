<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Minion';
            src: url('file:///E:/laragon/www/imnasmexico_platform/public/assets/admin/fonts/Minion.ttf');
        }

        .img_portada {
            width: 793px;
            height: 1120px;
            position:relative;
        }

        .container {
            position: absolute;
            top: 44%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:57%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top: 51.3%;
            right: 24px;
            text-align: center;
        }

        .container4{
            position: absolute;
            top: 15%;
            left:70px;
        }

        .container5{
            position: absolute;
            top: 80%;
            right:50px;
        }

        .img_firma{
            width: 230px;
            height: auto;
        }

        .img_reverso{
            width: 793px;
            height: 1120px;
            position:relative;
        }

        .curso{
            font-size: 25px;
            color: red;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 25px;
            color: #000;
        }

        .folio{
            position:relative;
            font-size: 24px;
            color: red;
        }

        .folio2{
            position:relative;
            font-size: 35px;
            color: red;
        }

        .oval-container {
            width: 185px;
            height: 285px;
            position: absolute;
            overflow: hidden;
            top: 32%;
            left: 9%;
            background: transparent;
        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 50%);
            transform: translateX(-50%);
            left: 50%;
            background-image: url('https://plataforma.imnasmexico.com/curso/64378d058a10838,000.jpg'); */
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */

            background-size: cover;
            background-position: center center;
        }
    </style>
</head>

    <body>

        @php
            $palabras = explode(' ', ucwords(strtolower($nombre)));
            $parte1 = implode(' ', array_slice($palabras, 0, 2));
            $parte2 = implode(' ', array_slice($palabras, 2));
        @endphp

        {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}

        <div class="container">
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container2">
            <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

        <div class="container3">
            <h4 class="folio">FOLIO {{$folio}}</h4>
        </div>

        <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">

        <div class="container4">
            <h4 class="folio2">FOLIO {{$folio}}</h4>
        </div>

        <div class="container5">
            <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma">
        </div>

    </body>
</html>
