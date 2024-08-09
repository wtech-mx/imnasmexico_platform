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

$palabras = explode(' ', ucwords(strtolower($tickets->User->name)));
$cantidad_palabras = count($palabras);

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

    .folio{
        position:relative;
        font-size:17px;
        color: red;
    }

    .folioReverso{
        position:relative;
        font-size: 25px;
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
        top: 28%;
        left: 5%;
    }
    .oval {
        width: 100%;
        height: 100%;
        background: #fff;
        margin: 0;
        padding: 0;
        margin-top: 8px;
        background-image: url('{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$tickets->User->Documentos->foto_tam_infantil }}');
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
        left: 36%;
    }

</style>


@endsection

@section('content_documentos')

<div class="card-front">
    <img src="{{ $basePath .'/'. $tipo_documentos->img_portada }}" class="img_portada">


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
            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.5,2.5) . '" style="background: #fff; padding: 10px;"   />';
        @endphp
    </div>

    <div class="container_folio">
        <h4 class="folio"> {{$tickets->folio}}</h4>
    </div>

    <div class="container_curso">
        <h4 class="curso">{{ ucwords(strtolower($tickets->Cursos->nombre)) }}</h4>
    </div>

    <div class="container_fecha">
        <h4 class="fecha">Expedido en la Ciudad de México, el {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
    </div>

  </div>

<div class="card-back">

    <img src="{{ $basePath .'/'. $tipo_documentos->img_reverso }}" class="img_reverso">

    <div class="container_folioReverso">
        <h4 class="folioReverso">{{$tickets->folio}}</h4>
    </div>

    <div class="container_firma">

        @if($tickets->User->Documentos->firma == null)

        @else
             <img src="{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$tickets->User->Documentos->firma }}" class="img_firma">
        @endif

    </div>

    <div class="container_CursoReverso">
        <h4 class="curso_sm">{{ ucwords(strtolower($tickets->Cursos->nombre)) }}</h4>
    </div>

    <div class="qr_container2">
        @php
            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.5,2.5) . '" style="background: #fff; padding: 10px;"   />';
        @endphp
    </div>

  </div>

@endsection

