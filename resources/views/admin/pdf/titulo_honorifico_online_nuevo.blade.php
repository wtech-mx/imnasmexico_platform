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
            top: 45%;
            left: 70%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:59%;
            left: 65%;
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
            top:75%;
            left: 62%;
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

        .curso{
            font-size: 35px;
            color: #353535;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 45px;
            color: #000;
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

        .oval-container {
            width: 265px;
            height: 430px;
            position: absolute;
            overflow: hidden;
            top: 39%;
            left: 11%;
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
            if ($contador_palabras % 2 == 0) {
                $nombre_formateado .= "<br>";
            }
        }
        @endphp

        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
         {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}

        <div class="container">
            <h4 class="nombre">{!! $nombre_formateado !!}</h4>
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
                    if ($contador_palabras % 3 == 0) {
                        $curso_formateado .= "<br>";
                    }
                }
            @endphp

            <h4 class="curso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container3">
            <h4 class="fecha">Expedido en la Ciudad de México , el dia {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

    </body>
</html>
