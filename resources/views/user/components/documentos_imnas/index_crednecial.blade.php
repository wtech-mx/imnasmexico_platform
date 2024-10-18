@extends('layouts.app_documenots')

@section('template_title')
    Cedula
@endsection

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
                $palabras = explode(' ', ucwords(strtolower($tickets->nom_curso)));
                $nombreCompleto = explode(' ', $tickets->nombre);

                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;


                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');
            }else{


                if ($tickets == null) {

                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->cliente)));
                    $firma = null;
                    $nombreCurso = $tickets_externo->curso;
                    $nombreCompleto = explode(' ', $tickets_externo->cliente);

                }else {

                    $foto = $tickets->User->Documentos->foto_tam_infantil;
                    $firma = $tickets->User->Documentos->firma;

                    $palabras = explode(' ', ucwords(strtolower($tickets->Cursos->nombre)));

                    $nombreCompleto = explode(' ', $tickets->Cursos->nombre);

                    $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
                }


            }

            $cantidad_palabras = count($palabras);
            $folio = isset($tickets->folio) ? $tickets->folio : $tickets_externo->folio;

            $cursoNombre = isset($tickets->Cursos->nombre)
            ? $tickets->Cursos->nombre
            : (isset($cursoNombre)
                ? $tickets->nom_curso
                : $tickets_externo->curso);
@endphp

@section('css_custom')
    <style>
        .img_portada {
            width: 480px;
            height: 305px;
            position:relative;
        }

        .img_reverso{
            width: 480px;
            height: 305px;
            position:relative;
        }

        .card-3d-wrapper {
            height: 304px!important;
        }

        .oval-container {
            width: 140px;
            height: 170px;
            position: absolute;
            overflow: hidden;
            top: 30%;
            left: 3%;
            background: transparent;
        }

        .oval-container2{
            width: 60px;
            height: 85px;
            position: absolute;
            overflow: hidden;
            top: 23%;
            left: 83.6%;
            background: transparent;
        }

        @php
            if (isset($tickets->User)) {
                $backgroundImage = $basePathDocumentos . '/' . $tickets->User->telefono . '/' . $foto;
            } else {
                $backgroundImage = 'https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png';
            }
        @endphp

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 1%;
            background-color: transparent;
            position: absolute;
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $backgroundImage }}');
            background-size: cover;
            background-position: center center;
        }

        .oval2 {
            width: 100%;
            height: 100%;
            border-radius: 1%;
            background-color: transparent;
            position: absolute;
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $backgroundImage }}');
            opacity: 0.5;
            background-size: cover;
            background-position: center center;
        }

        .conatiner_curso{
            position: absolute;
            top:65%;
            left: 168px;
            text-align: left;
        }

        .curso{
            font-size:10px;
            font-size:{{$tickets->tam_letra_credencial_especialidad}}px!important;
            color: red;
        }

        .curp{
            font-size:10px;
            color: red;
        }

        .nacionalidad{
            font-size:10px;
            color: red;
        }

        .nombre{
            font-size:10px;
            color: red;
        }

        .folio{
            font-size:10px;
            color: red;
        }

        .vigencia{
            font-size:10px;
            color: red;
        }

        .curso_atras{
            font-size:8px;
            color: red;
        }

        .container_curp{
            position: absolute;
            top:95%;
            left: 18%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_nacionalidad{
            position: absolute;
            top:85%;
            left: 39.5%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 53.5%;
            left:36%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top:22.5%;
            left: 73%;
            display: inline-block;
        }

        .container_nombre{
            position: absolute;
            top:33%;
            left: 170px;
            text-align: left;
        }

        .container_apellidoPaterno{
            position: absolute;
            top:43%;
            left: 170px;
            text-align: left;
        }

        .container_apellidoMaterno{
            position: absolute;
            top:53%;
            left: 170px;
            text-align: left;
        }

        .container_firma{
            position: absolute;
            top:82%;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .img_firma{
            width: 80px;
            height: auto;
        }

        .container_imgtrasera{
            position: absolute;
            top:82%;
            left: 4%;
        }

        .container_folio{
            position: absolute;
            top:22%;
            left: 37%;
            text-align: left;
        }

        .container_vigencia{
            position: absolute;
            top:22%;
            left: 65%;
            text-align: left;
        }

        .container_logo{
            position: absolute;
            top: 15px;
            left:88px;
        }

        .img_logo{
            width: 53px;
        }

    </style>
@endsection

@section('content_documentos')

    <div class="card-front">

        @if(!isset($tickets->User->logo))
            <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">
        @else
            <img src="{{ $basePath .'/'. 'portada_credneicla_logo_empresa.png' }}" class="img_portada">
        @endif

        <div class="container_logo">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="oval-container2">
            <div class="oval2">
            </div>
        </div>

        <div class="container_folio">
            <h4 class="folio">{{$folio}}</h4>
        </div>

        <div class="container_vigencia">
            <h4 class="vigencia">Permanente</h4>
        </div>

        <div class="conatiner_curso">

            @php


                if(isset($tickets_externo->curso)){
                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->curso)));

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

                }else{
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
                }


            @endphp
            <h4 class="curso">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container_curp">
            <h4 class="curp">CURP</h4>
        </div>

        <div class="container_nacionalidad">
            <h4 class="nacionalidad">Mexicana</h4>
        </div>

        @php
            // Separar el nombre completo en nombreCompleto
            // Asignar las partes correspondientes
            $apellidoMaterno = array_pop($nombreCompleto);
            $apellidoPaterno = array_pop($nombreCompleto);
            $nombre = implode(' ', $nombreCompleto);
        @endphp

        <div class="container_nombre">
            <h4 class="nombre">{{$nombre}}</h4>
        </div>

        <div class="container_apellidoPaterno">
            <h4 class="nombre">{{$apellidoPaterno}}</h4>
        </div>

        <div class="container_apellidoMaterno">
            <h4 class="nombre">{{$apellidoMaterno}}</h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',3.1,3.1) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container_firma">

            @if($firma == null)

            @else
                 <img src="{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$firma }}" class="img_firma">
            @endif

        </div>

    </div>

    <div class="card-back">
        <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">

        <div class="container_imgtrasera">
            <p class="curso_atras">

                {{ ucwords(strtolower($cursoNombre)) }}


            </p>
        </div>

    </div>

@endsection
