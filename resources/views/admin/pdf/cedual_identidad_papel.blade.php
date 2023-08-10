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
        .img_portada {
            width: 793px;
            height: 1120px;
        }
        .img_reverso {
            width: 793px;
            height: 1120px;
        }

        .contenedor{
            position: relative;
        }

        .curso{
            font-size: 25px;
            color: red;
            position: absolute;
            font-size: 25px;
            top:56.8%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;

        }

        .nombre{
            position: absolute;
            font-size: 25px;
            color: #000;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .folio1{
            position: absolute;
            font-size: 25px;
            color: red;
            top: 51.3%;
            right: 24px;
            text-align: center;
        }

        .folio{
            position: absolute;
            top: 14.5%;
            left: 65px;
            z-index: 10000;
            font-size: 50px;
            color: red;
        }

    </style>
</head>
<body>

    @php
        $palabras = explode(' ', ucwords(strtolower($nombre)));
        $parte1 = implode(' ', array_slice($palabras, 0, 2));
        $parte2 = implode(' ', array_slice($palabras, 2));
    @endphp

    <div class="contenedor">
        {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
        <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
        <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
        <h4 class="folio1">Folio {{$folio }}</h4>

    </div>

    <div class="contenedor">
        <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
        <h2 class="folio">Folio {{ $folio }}</h2>
    </div>



</body>
</html>
