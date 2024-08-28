<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crednecial</title>
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
            width: 321px;
            height:207px;
            position:relative;
        }

        .img_reverso{
            width: 321px;
            height:207px;
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
            top:62%;
            left: 115px;
            text-align: left;
        }

        .container3{
            position: absolute;
            top:93%;
            left: 18%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container4{
            position: absolute;
            top:85%;
            left: 40%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container5{
            position: absolute;
            top:23%;
            left: 70%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container6{
            position: absolute;
            top:86%;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container7{
            position: absolute;
            top:33%;
            left: 115px;
            text-align: left;
        }


        .container8{
            position: absolute;
            top:43%;
            left: 115px;
            text-align: left;
        }

        .container9{
            position: absolute;
            top:52%;
            left: 115px;
            text-align: left;
        }

        .container_folio_bajo1{
            position: absolute;
            top:23%;
            left: 44%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .img_firma{
            width: 80px;
            height: auto;
        }

        .curso{
            font-size:8px;
            color: red;
        }

        .nacionalidad{
            font-size: 8px;
            color: #000;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 10px;
            color: #000;
        }

        .curp{
            font-size: 7px;
            color: #000;
        }

        .folio3{
            position:relative;
            font-size: 8px;
            color: red;
        }

        .oval-container {
            width: 92px;
            height: 112px;
            position: absolute;
            overflow: hidden;
            top: 31.5%;
            left: 3.5%;
            background: transparent;
        }

        .oval-container2 {
            width: 44px;
            height: 54px;
            position: absolute;
            overflow: hidden;
            top: 24.5%;
            left: 83%;
            background: transparent;
        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 1%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 50%);
            transform: translateX(-50%);
            left: 50%;
             /* background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}'); */
            background-image: url('utilidades_documentos/{{ $fileName }}');
            background-size: cover;
            background-position: center center;
        }

        .oval2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }

        .container_imgtrasera{
            position: relative;
        }

        .curso_atras{
            position: absolute;
            top:82.5%;
            left: 4%;
            color: red;
            font-size: 5px
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 53.5%;
            left:74%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top:22.5%;
            left: 73%;
            display: inline-block;
        }

        .container_logo{
            position: absolute;
            top: 8.3%;
            left:23%;
            transform: translateX(-50%);

        }

        .img_logo{
            height: 35px!important;
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
            <img src="{{ $basePath . 'crdecnia_frontal_limpia.png' }}" class="img_portada">
        @endif

        {{-- <div class="container">
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        </div> --}}

        <div class="oval-container">
            <img src="{{ $basePathUtilidades . $fileName }}" style="width: 92px; height: 112px; clip-path: ellipse(50% 50% at 50% 50%); object-fit: cover;" />
        </div>

        <div class="oval-container2">
            <div class="oval2">
                <img src="{{ $basePathUtilidades . $fileName }}" alt="Imagen Ovalada">
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
            <h4 class="curso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container3">
            <h4 class="curp">{{ $curp }}</h4>
        </div>

        <div class="container4">
            <h4 class="nacionalidad">{{ $nacionalidad }}</h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.0,2.0) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container5">
            <h4 class="folio3">PERMANENTE</h4>
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

        <div class="container7">
            <h4 class="folio3">{{$nombres}}</h4>
        </div>

        <div class="container8">
            <h4 class="folio3">{{$apellido_apeterno}}</h4>
        </div>

        <div class="container9">
            <h4 class="folio3">{{$apellido_materno}}</h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        @if(!isset($fileName_logo))


        <div class="container6">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma">
            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
        </div>

        @elseif(empty($fileName_logo))


        <div class="container6">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma">
            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
        </div>

        @elseif($fileName_logo == 'Sin Logo')


        <div class="container6">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma">
            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
        </div>
        @else

        @endif


        <div class="container_imgtrasera">
            <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">
            <p class="curso_atras">{{ $curso }}</p>
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',1.5,1.5) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

    </body>
</html>
