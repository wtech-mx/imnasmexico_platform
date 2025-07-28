<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diploma Cosmica</title>
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
            position: absolute;
        }

        .container {
            position: absolute;
            top: 34%;
            left: 25%;

            text-align: left;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 40px;
            color: #000;
        }

        .fecha{
            position:relative;
            top: 70%;
            left: 26%;
            font-size: 40px
        }


    </style>
</head>
<body>

    {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
    {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}
    <img src="https://plataforma.imnasmexico.com/tipos_documentos/diploma_head_spa.png" class="img_portada">

    @php
        $nombre_formateado = ucwords(strtolower($nombre));
        $cantidad_palabras = str_word_count($nombre_formateado);
    @endphp

    @if ($cantidad_palabras <= 4)
        @php $top_valor = '35%'; @endphp
    @elseif ($cantidad_palabras <= 5)
        @php $top_valor = '31%'; @endphp
    @endif

    <div class="container" style="top: {{ $top_valor }} !important; left: 15%; text-align: left;">
        <h4 class="nombre">{{ $nombre_formateado }}</h4>
    </div>



    {{-- <h4 class="fecha">
            @php
                $fecha_timestamp = strtotime($fecha);
                $fecha_formateada = date('d-m-Y', $fecha_timestamp);
            @endphp
            {{$fecha_formateada}}
    </h4> --}}

</body>
</html>
