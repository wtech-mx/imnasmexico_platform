@extends('layouts.app_documenots')

@section('template_title')
    Cedula
@endsection

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grey+Qo&display=swap" rel="stylesheet">

@php
            $domain = request()->getHost();
            $basePath = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/tipos_documentos/'
                    : asset('tipos_documentos/');

            $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                    : asset('utilidades_documentos/');

            $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');

            if (isset($tickets->foto_cuadrada)) {
                $palabras = explode(' ', ucwords(strtolower($tickets->nombre)));

                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;
                $nombreCurso = $tickets->nom_curso;


                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');

            }else{
                $foto = $tickets->User->Documentos->foto_tam_infantil;
                $firma = $tickets->User->Documentos->firma;
                $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));
                $nombreCurso = $tickets->Cursos->nombre;
                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
            }

            $cantidad_palabras = count($palabras);

@endphp

@section('css_custom')
    <style>

        @font-face {
            font-family: 'oldenglishtextmt';
            src: url('{{ asset('assets/admin/fonts/oldenglishtextmt.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Brush';
            src: url('{{ asset('assets/admin/fonts/Brush.otf') }}') format('truetype');
        }

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

        h4.nombre {
            font-family: 'oldenglishtextmt';
            font-size: 20px;
            color: #000;
        }

        .container_marco {
            position: absolute;
            top: 33%;
            left: 9%;
            z-index: 100;
        }

        .img_marco {
            width: 130px;
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
            background-image: url('{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$foto }}');
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

        h4.curso {
            font-family: 'Brush';
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

        .container_logo{
            position: absolute;
            top: 95%;
            left:140px;
        }

        .img_logo{
            width: 30px;
        }

        .container_logo2{
            position: absolute;
            top: 35px;
            left:180px;
        }

        .img_logo2{
            width: 150px;
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">

        @if(!isset($tickets->User->logo))
            <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">
        @else
            <img src="{{ $basePath .'/'. 'titulo_frontal_limpio.png' }}" class="img_portada">
        @endif

        <div class="container_logo">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_logo2">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo2">
            @endif
        </div>

        <div class="container_marco">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_pro.png" class="img_marco">
        </div>

        <div class="container_nombre">

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

        <div class="container_curso">

            @php
                // Divide el curso por espacios en blanco
                $palabras = explode(' ', $nombreCurso);

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
            <h4 class="fecha">
            <strong>

            @if(!isset($tickets->Cursos->fecha_inicial))
                Ciudad de México , México a  {{ \Carbon\Carbon::parse($tickets->fecha_curso)->isoFormat('D [de] MMMM [del] YYYY') }}
             @else
                Ciudad de México , México a  {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
             @endif

            </strong> </h4>
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

        @if(!isset($tickets->User->logo))
            <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else
            <img src="{{ $basePath .'/'. 'titulo_reverso_limpio.png' }}" class="img_reverso">
        @endif

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

        <div class="container_logo">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

    </div>
@endsection
