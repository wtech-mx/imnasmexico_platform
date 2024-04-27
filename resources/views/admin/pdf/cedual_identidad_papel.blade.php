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
            src: url('plataforma.imnasmexico.com/assets/admin/fonts/Minion.ttf');
            font-weight: normal;
            font-style: normal;
        }


        .img_portada {
            width: 480px;
            height: 668px;
            position:relative;
        }

        .container {
            position: absolute;
            top: 45.5%;
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

        .container7{
            position: absolute;
            top:78%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container6{
            position: absolute;
            top:61%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top: 51%;
            right: 17px;
            text-align: center;
        }

        .container4{
            position: absolute;
            top: 15%;
            left:70px;
        }

        .container5{
            position: absolute;
            top: 75%;
            right:45px;
        }

        .img_firma{
            width: 100px;
            height: auto;
        }

        .img_reverso{
            width: 480px;
            height: 668px;
            position:relative;
        }

        .curso{
            font-size: 17px;
            color: red;
        }

        .curso_sm{
            font-size: 11px;
            color: red;
        }

        .fecha{
            font-size: 8px;
            color: #000;
        }


        .nombre{
            font-family: 'Minion', sans-serif;
            font-size: 17px;
            color: #000;
        }

        .folio{
            position:relative;
            font-size:19px;
            color: red;
        }

        .folio2{
            position:relative;
            font-size: 25px;
            color: red;
        }

        .oval-container {
            width: 123px;
            height: 185px;
            position: absolute;
            overflow: hidden;
            top: 31%;
            left: 8%;
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
        }

        .oval {
            width: 100%;
            height: 100%;
            background: #fff;
            margin: 0;
            padding: 0;
            margin-top: 8px;
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
        $cantidad_palabras = count($palabras);
    @endphp

    {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
    <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
    {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}

    <div class="container">
        @for ($i = 0; $i < $cantidad_palabras; $i += 2)
            @php
                $linea = '';
                if (isset($palabras[$i])) {
                    $linea .= $palabras[$i];
                    if (isset($palabras[$i + 1])) {
                        $linea .= ' ' . $palabras[$i + 1];
                    }
                }
                if ($i + 2 < $cantidad_palabras) {
                    $linea .= '<br>';
                }
            @endphp
            <h4 class="nombre">{!! $linea !!}</h4>
        @endfor
    </div>



        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container2">
            <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

        <div class="container6">
            <h4 class="fecha">Expedido en la Ciudad de México, el {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="container3">
            <h4 class="folio"> {{$folio}}</h4>
        </div>

        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

        <div class="container4">
            <h4 class="folio2">{{$folio}}</h4>
        </div>

        <div class="container5">

            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"
            @if (!isset($fileName_firma))
                src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png"
            @endif>

            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma">--}}
        </div>

        <div class="container7">
            <h4 class="curso_sm">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

    </body>
</html>
