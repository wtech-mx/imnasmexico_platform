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

        .oval-container2{
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
             background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /*background-image: url('utilidades_documentos/{{ $fileName }}');*/
            background-size: cover;
            background-position: center center;
        }

        .oval2 {
            width: 100%;
            height: 100%;
            border-radius: 1%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 50%);
            transform: translateX(-50%);
            left: 50%;
             background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /* background-image: url('utilidades_documentos/{{ $fileName }}');*/
            opacity: 0.5;
            background-size: cover;
            background-position: center center;
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

        {{-- <div class="container">
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        </div> --}}

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="oval-container2">
            <div class="oval2">
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

        <div class="container5">
            <h4 class="folio3">PERMANENTE</h4>
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

        <div class="container6">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma">
            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
        </div>

        <div class="container_imgtrasera">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
            <p class="curso_atras">{{ $curso }}</p>
        </div>

        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

    </body>
</html>
