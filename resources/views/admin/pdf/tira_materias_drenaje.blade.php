<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tira materterias Cosmetologia F y C</title>
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

        .contenedor_reverso{
            position: relative;
        }

        .img_reverso{
            width: 812px;
            height:1280px;
        }

        .nombre_reverso{
            position: absolute;
            top: 55%;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: red;
            font-size: 20px;
        }

        .container {
            position: absolute;
            top: 15%;
            left: 56%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .containerz{
            position: absolute;
            top: 16%;
            left: 17.6%;
            background: #ffffff;
            width: 508px;
            height: 110px;
        }

        .container2{
            position: absolute;
            top:21.3%;
            left: 22.7%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top:33.4%;
            left: 45%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .container4{
            position: absolute;
            top:21.2%;
            letter-spacing: -0.5px;
            left: 35.1%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:30.7%;
            right:3%;
            text-align: center;
        }

        .img_firma{
            width: 230px;
            height: auto;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 15px;
            color: #000;
        }

        .fecha{
            font-size: 14px;
            color: red;
        }

        .folio3{
            position:relative;
            font-size: 22px;
            color: red;
        }


        .folio2{
            position:relative;
            font-size: 6px;
            color: red;
        }

        .curp{
            position:relative;
            font-size: 4px;
            color: red;
        }

        .oval-container {
            width: 103px;
            height: 117px;
            position: absolute;
            overflow: hidden;
            top: 14.8%;
            right: 4.2%;
            background: transparent;
        }

        .oval {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* clip-path: ellipse(50% 50% at 50% 50%); */
            transform: translateX(-50%);
            left: 50%;
            position: absolute;
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 7.8%;
            left:85.7%;
        }

        .container_logo{
            position: absolute;
            top: 53px;
            left:28%;
            transform: translateX(-50%);

        }

        .img_logo{
            height: 80px!important;
        }

        .container_rectangular{
            position: absolute;
            top: 96%;
            left: 17.6%;
            background: #ffffff;
            width: 600px;
            height: 40px;
        }

        .container_logo_reverso{
            position: absolute;
            top: 52px;
            left:33%;
            transform: translateX(-50%);
        }

        .container_logo_reverso_abajo{
            position: absolute;
            top: 1120px;
            left:28%;
            transform: translateX(-50%);
        }

        .container_promedio{
            position: absolute;
            top:28.5%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
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

            @if(!isset($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif(empty($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif($fileName_logo == 'Sin Logo')
            <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">
            @else
            <img src="{{ $basePath . 'tira_carrera_logo.png' }}" class="img_portada">
            @endif

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
        <div class="container">
            <h4 class="nombre">{{ $nombre }}<</h4>
        </div>

        <div class="containerz">
            <p class="texto" style="font-size: 13px;text-align: justify;">
                La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del Registro Nacional
                Instituto Mexicano Naturales Ain Spa RIIMNAS, con registro de la Secretaria
                del Trabajo y Prevención Social STPS como Agente Capacitador Externo con Registro
                RIFC-680910-879-0013 , hace constar que el la Alumno(a) , con Numero de
                Folio: <strong style="color: red"> {{$folio}} </strong> con CURP: <strong  style="color: red">{{$curp}} </strong>,  curso  <strong  style="color: red">{{ ucwords(strtolower($curso)) }} </strong>  Cubriendo todos los correspondientes. <br> Para afectos de desempeño académico  se expresa lo siguiente:
            </p>
        </div>

        <div class="oval-container">
            <img class="oval" src="{{ $basePathUtilidades . $fileName }}" alt="Imagen">
        </div>

        <div class="container_promedio" style="background: #fff;width:50px;heigth:50px;">
            <p>{{ $promedio }}</p>
        </div>

        <div class="container3">
            <h4 class="fecha">el dia {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="container_logo_reverso">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo">
            @endif
            <h4 class="nombre_reverso">{{ ucwords(strtolower($curso)) }}</h4>

        </div>

        <div class="container_logo_reverso_abajo">
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
        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',3,3) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>


    </body>
</html>
