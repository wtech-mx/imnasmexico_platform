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

        .img_reverso{
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
            position:absolute;
            font-size: 35px;
            color: red;
            bottom:: 500px;
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
    <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">

    <div class="container">
        <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
    </div>

    <div class="container2">
        <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
    </div>

    <div class="container3">
        <h4 class="folio">FOLIO {{$folio}}</h4>
    </div>

    <div class="container4">
        <h4 class="folio2">FOLIO {{$folio}}</h4>
    </div>

    <div class="contenedo_img">
        <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">

    </div>


</body>
</html>
