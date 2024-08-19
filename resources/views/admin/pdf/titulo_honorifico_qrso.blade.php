<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titulo Honorifico</title>
    @php
        $isNoImage = $fileName === 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';
    @endphp
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Monotype Corsiva Normal';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/oldenglishtextmt.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Monotype';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/oldenglishtextmt.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Monotype Corsiva Bold';
            font-style: normal;
            font-weight: 900;
            src: url('{{ storage_path('fonts/Brush.ttf') }}') format('truetype');
        }

        h1 {
            font-family: 'Monotype Corsiva Bold';
            font-weight: 900;
            font-size: 45px;
            color: #353535;
        }

        h2 {
            font-family: 'Monotype Corsiva Normal';
            font-weight: normal;
            font-size: 45px;
            color: #000;
        }

        h5 {
            font-family: 'Monotype Corsiva Normal';
            font-weight: normal;
            font-size: 21px;
            color: #000;
        }

        .img_portada {
            width: 100%;
            height:auto;
            position:relative;
        }

        .img_reverso{
            width: 100%;
            height: auto;
            position:relative;
        }

        .container {
            position: absolute;
            top: 44.5%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:55%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .containerx{
            position: absolute;
            top:67%;
            left: 82%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:90.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top:90%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container4{
            position: absolute;
            top: 3.2%;
            left:110px;
        }

        .container6{
            position: absolute;
            top: 5.8%;
            left:110px;
        }

        .container7{
            position: absolute;
            top: 8.3%;
            left:118px;
        }

        .container8{
            position: absolute;
            top: 10.8%;
            left:175px;
        }

        .container9{
            position: absolute;
            top: 13.3%;
            left:120px;
        }

        .container10{
            position: absolute;
            top:57%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
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

        .container_marco{
            position: absolute;
            top: 33%;
            left: 11.5%;
            z-index: 100;

        }

        .img_marco{
            width: 300px;
            height: 540px;
        }

        .curso{
            font-size: 35px;
            color: #353535;
        }

        .fechax{
            color: #353535;
        }


        .folio2{
            position:relative;
            font-size: 18px;
            color: red;
        }

        .folio3{
            position:relative;
            font-size: 15px;
            color: red;
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
            background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
            background-size: cover;
            background-position: center center;
        }

        .oval-container {
            width: 210px;
            height: 345px;
            position: absolute;
            overflow: hidden;
            left: 15%;
            background: transparent;
            top: 40%;
            /* Ajuste condicional de top */
        }


        .qr_container{
            width: 100%;
            position: absolute;
            top: 82%;
            left:11.2%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top: 82%;
            left:79.9%;
            display: inline-block;
        }

        .qr_container3{
            width: 100%;
            position: absolute;
            top: 4.9%;
            left:78%;
            display: inline-block;
        }

        .container_logo{
            position: absolute;
            top: 45px;
            left: 150px;
        }

        .container_logo2{
            position: absolute;
            top: 94%;
            left:35%;
        }

        .container_logo_reversa{
            width: 100%;
            position: absolute;
            top: 93.5%;
            left:30%;
        }

        .img_logo{
            width: 700px;
        }

        .img_logo2{
            width: 100px;
        }

        .container_registro{
            position: absolute;
            top: 53%;
            left: 12%;
            z-index: 100000;
            top: {{ $isNoImage  ? '60%' : '53%' }};

        }

        .img_registro{
            width: 50%;
        }

    </style>
</head>

    <body>

        @php

            $domain = request()->getHost();
            $basePath = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/tipos_documentos/'
                    : 'tipos_documentos/';

            $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                    : 'utilidades_documentos/';

            $palabras = explode(' ', ucwords(strtolower($nombre)));
            $parte1 = implode(' ', array_slice($palabras, 0, 2));
            $parte2 = implode(' ', array_slice($palabras, 2));
        @endphp

        @if(!isset($fileName_logo))
        <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

        @elseif(empty($fileName_logo))
        <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

        @elseif($fileName_logo == 'Sin Logo')
        <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">
        @else
        <img src="{{ $basePath . 'titulo_frontal_limpio.png' }}" class="img_portada">
        @endif

        <div class="container_registro">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/logo_registronas.png" class="img_registro">
        </div>

        <div class="container_marco">
            {{-- <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_pro.png" class="img_marco">
        </div>

        <div class="container_logo">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_logo2">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo2">
            @endif
        </div>

        <div class="container">
            <h2 >{{ $parte1 }}<br>{{ $parte2 }}</h2>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container2">
            @php
                // Divide el curso por espacios en blanco
                $palabras = explode(' ', $curso);

                // Inicializa la cadena formateada
                $curso_formateado = '';
                $contador_palabras = 0;

                foreach ($palabras as $palabra) {
                    // Agrega la palabra actual a la cadena formateada
                    $curso_formateado .= $palabra . ' ';

                    // Incrementa el contador de palabras
                    $contador_palabras++;

                    // Agrega un salto de línea después de cada tercera palabra
                    if ($contador_palabras % 4 == 0) {
                        $curso_formateado .= "<br>";
                    }
                }
            @endphp
            <h1>{!! $curso_formateado !!}</h1>
        </div>

        <div class="containerx">
            <h5>{{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h5>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        @if(!isset($fileName_logo))
        <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">

        @elseif(empty($fileName_logo))
        <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">

        @elseif($fileName_logo == 'Sin Logo')
        <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else
        <img src="{{ $basePath . 'titulo_reverso_limpio.png' }}" class="img_reverso">
        @endif

        @php
            // Divide el curso por espacios en blanco
            $palabras = explode(' ', $nombre);

            // Inicializa la cadena formateada
            $nombre_formateado = '';
            $contador_palabras = 0;

            foreach ($palabras as $palabra) {
                // Agrega la palabra actual a la cadena formateada
                $nombre_formateado .= $palabra . ' ';

                // Incrementa el contador de palabras
                $contador_palabras++;

                // Agrega un salto de línea después de cada tercera palabra
                if ($contador_palabras % 4 == 0) {
                    $nombre_formateado .= "<br>";
                }
            }

        @endphp

        <div class="container4">
            <h4 class="folio2">{!! $nombre_formateado !!}</h4>
        </div>

        <div class="container6">
            <h4 class="folio2">{{$curp}}</h4>
        </div>

        <div class="container7">
            @php
            // Divide el curso por espacios en blanco
            $palabras = explode(' ', $curso);

            // Inicializa la cadena formateada
            $curso_formateado = '';
            $contador_palabras = 0;

            foreach ($palabras as $palabra) {
                // Agrega la palabra actual a la cadena formateada
                $curso_formateado .= $palabra . ' ';

                // Incrementa el contador de palabras
                $contador_palabras++;

                // Agrega un salto de línea después de cada tercera palabra
                if ($contador_palabras % 6 == 0) {
                    $curso_formateado .= "<br>";
                }
            }
        @endphp
            <h4 class="folio2">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container8">
            <h4 class="folio2">{{ $nacionalidad }}</h4>
        </div>

        <div class="container9">
            <h4 class="folio2">PERMANENTE_</h4>
        </div>

        <div class="container10">
            <h4 class="folio2">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container3">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="qr_container3">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',6,6) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container_logo_reversa">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo2">
            @endif
        </div>


    </body>
</html>
