@extends('layouts.app_documenots')

@section('template_title')
    Cedula
@endsection

@php
    $domain = request()->getHost();
    $basePath =
        $domain == 'plataforma.imnasmexico.com'
            ? 'https://plataforma.imnasmexico.com/tipos_documentos/'
            : asset('tipos_documentos/');

    $basePathUtilidades =
        $domain == 'plataforma.imnasmexico.com'
            ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
            : asset('utilidades_documentos/');

    $basePathDocumentos =
        $domain == 'plataforma.imnasmexico.com'
            ? 'https://plataforma.imnasmexico.com/documentos/'
            : asset('documentos/');

    $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));
    $parte1 = implode(' ', array_slice($palabras, 0, 2));
    $parte2 = implode(' ', array_slice($palabras, 2));

@endphp

@section('css_custom')
    <style>
        .img_portada {
            width: 480px;
            height: 668px;
            position: relative;
        }

        .img_reverso {
            width: 480px;
            height: 668px;
            position: relative;
        }

        .container_nombre {
            position: absolute;
            top: 46.5%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .nombre {
            font-family: 'Minion';
            font-size: 20px;
            color: #000;
        }

        .container_marco {
            position: absolute;
            top: 33%;
            left: 11.5%;
            z-index: 100;
        }

        .img_marco {
            width: 115px;
            height: 215px;
        }

        .oval-container {
            width: 90px;
            height: 145px;
            position: absolute;
            overflow: hidden;
            top: 40%;
            left: 14%;
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
            background-image: url('{{ $basePathDocumentos . '/' . $tickets->User->telefono . '/' . $tickets->User->Documentos->foto_tam_infantil }}');
            background-size: cover;
            background-position: center center;
        }

        .container_curso {
            position: absolute;
            top: 55.7%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .curso {
            font-size: 15px;
            color: #000;
        }

        .container_fecha{
            position: absolute;
            top:70.5%;
            left: 58%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .fecha{
            color: #000;
            font-size: 9px;
        }

        .container_folio_bajo1{
            position: absolute;
            top:92.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .folio{
            font-size: 5px;
            color: red;
        }

        .folio_reversa{
            font-size: 5px;
            color: red;
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 82%;
            left:-33%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top: 82%;
            left:36%;
            display: inline-block;
        }

        .qr_container3{
            width: 100%;
            position: absolute;
            top: 4.5%;
            left:36%;
            display: inline-block;
        }

        .container_nombre_formateado{
            position: absolute;
            top: 3.2%;
            left:45px;
        }

        .nombre_reverso{
            position:relative;
            font-size: 9px;
            color: red;
        }

        .container_nacionalidad{
            position: absolute;
            top: 10.8%;
            left:70px;
        }

        .container_vigencia{
            position: absolute;
            top: 13.3%;
            left:48px;
        }

        .container_folio_reversa{
            position: absolute;
            top:92.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_cursoreversa{
            position: absolute;
            top: 8%;
            left:48px;
        }

        .container_cursoreversa_medio{
            position: absolute;
            top: 58%;
            left:37%;
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">
        <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">

        <div class="container_marco">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_pro.png" class="img_marco">
        </div>

        <div class="container_nombre">
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container_curso">
            @php
                // Divide el curso por espacios en blanco
                $palabras = explode(' ', $tickets->Cursos->nombre);

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
                        $curso_formateado .= '<br>';
                    }
                }
            @endphp
            <h4 class="curso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container_fecha">
            <h4 class="fecha"><strong>{{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicio)->isoFormat('D [de] MMMM [del] YYYY') }}</strong> </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio">{{$tickets->folio}}</h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',1.5,1.5) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',1.5,1.5) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

    </div>

    <div class="card-back">
        <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">

        @php
            // Divide el curso por espacios en blanco
            $palabras = explode(' ', $tickets->User->name);

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

        <div class="container_nombre_formateado">
            <h4 class="nombre_reverso">{!! $nombre_formateado !!}</h4>
        </div>

        <div class="container_nacionalidad">
            <h4 class="nombre_reverso">Mexicana</h4>
        </div>

        <div class="container_vigencia">
            <h4 class="nombre_reverso">Permanente</h4>
        </div>

        <div class="container_cursoreversa">
            <h4 class="nombre_reverso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container_cursoreversa_medio">
            <h4 class="nombre_reverso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container_folio_reversa">
            <h4 class="folio_reversa">{{$tickets->folio}}</h4>
        </div>

        <div class="qr_container3">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.3,2.3) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

    </div>
@endsection
