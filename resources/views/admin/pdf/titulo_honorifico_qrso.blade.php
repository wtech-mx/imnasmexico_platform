<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titulo Honorifico</title>
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
            top:67.2%;
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
            width: 210px;
            height: 345px;
            position: absolute;
            overflow: hidden;
            top: 40%;
            left: 15%;
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

    </style>
</head>

    <body>

        @php
            $palabras = explode(' ', ucwords(strtolower($nombre)));
            $parte1 = implode(' ', array_slice($palabras, 0, 2));
            $parte2 = implode(' ', array_slice($palabras, 2));
        @endphp

        {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}
        {{-- <img src="tipos_documentos/titulo honorifico_sinmarco.png" class="img_portada"> --}}

        <div class="container_marco">
            {{-- <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_pro.png" class="img_marco">
        </div>

        <div class="container">
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
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
            <h4 class="curso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="containerx">
            <h4 class="fechax"><strong>{{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }}</strong> </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">FOLIO {{$folio}}</h4>
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

        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

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
            <h4 class="folio3">FOLIO {{$folio}}</h4>
        </div>

        <div class="qr_container3">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',6,6) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

    </body>
</html>
