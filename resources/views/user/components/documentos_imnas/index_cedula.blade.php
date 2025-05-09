@extends('layouts.app_documenots')

@section('template_title')
    Cedula RN
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
                $palabras = explode(' ', ucwords(strtolower($tickets->nombre)));

                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;

                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');

            }else{

                if ($tickets == null) {
                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->cliente)));
                    $firma = null;
                    $foto = $tickets_externo->foto;

                }else {

                $foto = $tickets->User->Documentos->foto_tam_infantil;

                $firma =$tickets->User->Documentos->firma;

                $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));

                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
                }
            }

            $cantidad_palabras = count($palabras);

            // Contar las palabras
            $cursoNombre = isset($tickets->Cursos->nombre)
            ? $tickets->Cursos->nombre
            : (isset($tickets->nom_curso)
                ? $tickets->nom_curso
                : $tickets_externo->curso);

            $cursoNombre = ucwords(strtolower($cursoNombre));

            $wordCount = str_word_count($cursoNombre);

            $folio = isset($tickets->folio) ? $tickets->folio : $tickets_externo->folio;
            $characterCount = strlen($folio);

            $folioReverso = isset($tickets->folio) ? $tickets->folio : $tickets_externo->folio;
            $characterCountReverso = strlen($folioReverso);

@endphp


@section('css_custom')

<style>
    .img_portada {
        width: 480px;
        height: 668px;
        position:relative;
    }
    .img_reverso{
        width: 480px;
        height: 668px;
        position:relative;
    }

    .container_nombre {
        position: absolute;
        top: 45.5%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .nombre{
        font-family: 'Minion', sans-serif;
        font-size: 17px;
        color: #000;
    }

    .curso{
        font-size: 17px;
        color: red;
    }

    .curso_sm{
        font-size: 11px;
        color: red;
    }

    /* .folio{
        position:relative;
        font-size:17px;
        color: red;
    } */

    .folio {
        font-size: 17px;
        color: red;
    }

    .folio.small-font {
        margin-top: 4px;
        font-size: 11px;
        font-size: {{ $tickets?->tam_letra_folio_cedula ?? 11 }}px!important;
    }


    .folioReverso{
        position:relative;
        font-size: 25px;
        color: red;
    }

    .folioReverso.small-font-reverso {
        position:relative;
        font-size: 18px;
        font-size: {{ $tickets?->tam_letra_folioTrasero_cedula ?? 18 }}px!important;
        color: red;
    }

    .fecha{
        font-size: 12px;
        color: #000;
    }

    .oval-container {
        width: 123px;
        height: 185px;
        position: absolute;
        overflow: hidden;
        top: 26%;
        left: 5%;
    }

    <?php
        if (isset($tickets->User)) {
            $backgroundImage = $basePathDocumentos . '/' . $tickets->User->telefono . '/' . $foto;
        } else if(isset($tickets_externo->foto)) {
                $backgroundImage = $basePathUtilidades . '/' . $foto;
        } else {
            $backgroundImage = 'https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png';
        }
    ?>

    .oval {
        width: 100%;
        height: 100%;
        background: #fff;
        margin: 0;
        padding: 0;
        margin-top: 8px;
        background-image: url('{{ $backgroundImage }}');
        background-size: cover;
        background-position: center center;
    }

    .qr_container{
        width: 100%;
        position: absolute;
        top: 34.7%;
        left:37.5%;
        display: inline-block;
    }

    .container_curso{
        position: absolute;
        top:57%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .container_folio{
        position: absolute;
        top: 51%;
        right: 17px;
        text-align: center;
    }

    .container_fecha{
        position: absolute;
        top:61%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 500px;
    }

    .qr_container2{
        width: 100%;
        position: absolute;
        top:80%;
        left: 0%;
        display: inline-block;
    }

    .container_folioReverso{
        position: absolute;
        top: 15%;
        left:70px;
    }

    .container_firma{
        position: absolute;
        top: 75%;
        right:45px;
    }

    .img_firma{
        width: 100px;
        height: auto;
    }

    .container_CursoReverso{
        position: absolute;
        top:76%;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center; /* Centra horizontalmente */
        align-items: center; /* Centra verticalmente */
        text-align: center; /* Centra el texto dentro del contenedor */
    }

    .container_logo{
        position: absolute;
        top: 55px;
        left:300px;
    }

    .img_logo{
        width: 100px;
        width: {{ $tickets?->logo_cedula ?? 100 }}px!important;
    }

    .container_logo2{
        position: absolute;
        top: 555px;
        left:50px;
    }

    .img_logo2{
        width: 80px;
    }

    .curso {
        font-size: 17px;
        color: red;
    }

    .curso.small-font {
        font-size: 12px;
        font-size: <?php $tickets?->tam_letra_especialidad_cedula ?? 12 ?>px!important;
    }

        .container_clave_rfc{
            position: absolute;
            top: 58%;
            left: 70%;
            padding: 0px;
            margin: 0px;
            background-image: url("https://plataforma.imnasmexico.com/utilidades_documentos/pattern_cedula.png");
            background-repeat: repeat-x; /* Repetir solo en el eje X */
            background-size: cover;
            background-position: center; /* Centrar la imagen horizontalmente */
            background-size: auto; /* Asegura que la imagen conserve su tamaño original */
        }

        .clave_rfc{
            color: #000;
            font-size: 10px;
            font-weight: bold;
            padding: 0px;
            margin: 0px;
            letter-spacing: 0.8px;
            line-height: 10px;
        }


</style>


@endsection

@section('content_documentos')

<div class="card-front">

    @if(!isset($tickets->User->logo))
        <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">
    @else
        <img src="{{ $basePath  . '/' . 'ceudla_frontal_limpia.png' }}" class="img_portada">
    @endif


    <div class="container_logo">
        @if(!isset($tickets->User->logo))
        @else
            <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
        @endif
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

    <div class="qr_container">
        @php
            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.5,2.5) . '" style="background: #fff; padding: 10px;"   />';
        @endphp
    </div>

    {{-- <div class="container_folio">
        <h4 class="folio"> {{$tickets->folio}}</h4>
    </div> --}}

    <div class="container_folio">
        <h4 class="folio {{ $characterCount > 14 ? 'small-font' : '' }}">
            {{ $folio }}
        </h4>
    </div>


    <div class="container_curso">
        {{-- <h4 class="curso">

            @if(!isset($tickets->Cursos->nombre))
                {{ ucwords(strtolower($tickets->nom_curso)) }}
            @else
                {{ ucwords(strtolower($tickets->Cursos->nombre)) }}
            @endif

        </h4> --}}

        <h4 class="curso {{ $wordCount > 7 ? 'small-font' : '' }}">
            {{ $cursoNombre }}
        </h4>
    </div>

    <div class="container_fecha">
        <h4 class="fecha">
            @if(!isset($tickets->Cursos->fecha_inicial) && !isset($tickets->fecha_curso))
                Expedido en la Ciudad de México
            @elseif(!isset($tickets->Cursos->fecha_inicial))
                Expedido en la Ciudad de México, el {{ \Carbon\Carbon::parse($tickets->fecha_curso)->isoFormat('D [de] MMMM [del] YYYY') }}
            @else
                Expedido en la Ciudad de México, el {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
            @endif
        </h4>

    </div>

    <div class="container_logo2">
        @if(!isset($tickets->User->logo))
        @else
            <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo2">
        @endif
    </div>

  </div>

<div class="card-back">

    @if(!isset($tickets->User->logo))
        <img src="{{ $basePath .'/'. $tipo_documentos->img_reverso }}" class="img_reverso">
    @else
        <img src="{{ $basePath   .'/'.  'ceudla_trasera_limpia.png' }}" class="img_reverso">
    @endif

    {{-- <div class="container_folioReverso">
        <h4 class="folioReverso">{{$tickets->folio}}</h4>
    </div> --}}

    <div class="container_folioReverso">
        <h4 class="folioReverso {{ $characterCountReverso > 14 ? 'small-font-reverso' : '' }}">
            {{ $folioReverso }}
        </h4>
    </div>

    <div class="container_firma">

        @if($firma == null)

        @else
             <img src="{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$firma }}" class="img_firma">
        @endif

    </div>

    <div class="container_clave_rfc">
        <p class="clave_rfc">
            @if(!isset($tickets->User->clave_clasificacion))
                RIFC680910-879-0013
            @else
                {{ $tickets->User->clave_clasificacion }}
            @endif
        </p>
    </div>

    <div class="container_CursoReverso">
        <h4 class="curso_sm">
            {{ $cursoNombre }}
        </h4>
    </div>

    <div class="qr_container2">
        @php
            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.5,2.5) . '" style="background: #fff; padding: 10px;"   />';
        @endphp
    </div>

  </div>

@endsection

