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
            src: url('https://plataforma.imnasmexico.com/assets/admin/fonts/Minion.ttf');
        }

        .img_portada {
            width: 812px;
            height:1280px;
            position:relative;
        }

        .img_reverso{
            width: 100%;
            height: auto;
            position:relative;
        }

        .container {
            position: absolute;
            top: 47%;
            left: 64%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:56.5%;
            left: 64%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top:80%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:74.3%;
            left: 21%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .img_firma{
            width: 230px;
            height: auto;
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

        .fecha{
            font-size: 15px;
            color: red;
        }

        .folio3{
            position:relative;
            font-size: 25px;
            color: red;
        }

        .oval-container {
            width: 240px;
            height: 330px;
            position: absolute;
            overflow: hidden;
            top: 42.7%;
            left: 7%;
            background: transparent;
        }

        .oval {
            width: 90%;
            height: 100%;
            border-radius: 50%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 40%);
            transform: translateX(-50%);
            left: 50%;
            background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
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
            <h4 class="fecha">Ciudad de México , México a {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

    </body>
</html>
