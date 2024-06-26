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
            top:31.6%;
            right:3%;
            transform: translate(-50%, -50%);
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
            right:4.2%;
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
            background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
            background-size: cover;
            background-position: center center;

        }

    </style>
</head>

    <body>
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

         <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
       {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">--}}

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
            <div class="oval">
            </div>
        </div>

        <div class="container3">
            <h4 class="fecha">el dia {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="contenedor_reverso">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">

           {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">--}}
            <h4 class="nombre_reverso">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

    </body>
</html>
