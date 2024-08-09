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

            if (!isset($tickets->User->Documentos->foto_tam_infantil)) {
                $palabras = explode(' ', ucwords(strtolower($tickets->nombre)));

                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;


                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');

            }else{
                $foto = $tickets->User->Documentos->foto_tam_infantil;
                $firma = $tickets->User->Documentos->firma;
                $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));

                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
            }

            $cantidad_palabras = count($palabras);


@endphp

@section('css_custom')
    <style>
        .img_portada {
            width: 480px;
            height: 800px;
            position: relative;
        }

        .img_reverso {
            width: 480px;
            height: 800px;
            position: relative;
        }

        .container_marco{
            position: absolute;
            top: 41%;
            left: -2%;
            z-index: 100;
        }

        .img_marco{
            width: 200px;
            height: 323px;
        }

        .oval-container {
            width: 170px;
            height: 230px;
            position: absolute;
            overflow: hidden;
            top: 50%;
            left: 2%;
            background: transparent;
        }

        .oval {
            width: 90%;
            height: 100%;
            border-radius: 50%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 40%);
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$foto }}');
            background-size: cover;
            background-position: center center;
        }

        .container_nombre{
            position: absolute;
            top:55%;
            left: 50%;
        }

        .container_curso{
            position: absolute;
            top:66%;
            left: 50%;
        }

        .curso{
            font-size: 11px;
        }

        .nombre{
            font-size: 11px;
        }

        .container_fecha{
            position: absolute;
            top:98%;
            left: 29%;
        }

        .fecha{
            font-size: 10px;
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 82%;
            left:38%;
            display: inline-block;
        }

        .container_folio_bajo1{
            position: absolute;
            top:88%;
            left: 8%;
        }

        .folio{
            font-size: 13px;
            color: red;
        }


        .container_cursoTrasero{
            position: absolute;
            top:67%;
            left: 33%;
        }

        .curso_sm{
            font-size:12px;
            color: red;
        }

        .qr_container2{
            position: absolute;
            top: 84%;
            left:76%;
        }

    </style>

@endsection

@section('content_documentos')

    <div class="card-front">
        <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">

        <div class="container_marco">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_diploma.png" class="img_marco">
        </div>

        @php
            $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));
            $parte1 = implode(' ', array_slice($palabras, 0, 2));
            $parte2 = implode(' ', array_slice($palabras, 2));
        @endphp

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container_curso">
            <h4 class="nombre">
                @if(!isset($tickets->Cursos->nombre))
                    {{ ucwords(strtolower($tickets->nom_curso)) }}
                @else
                    {{ ucwords(strtolower($tickets->Cursos->nombre)) }}
                @endif
            </h4>
        </div>

        <div class="container_nombre">
            <h4 class="curso">{{ ucwords(strtolower($tickets->User->name)) }}</h4>
        </div>

        <div class="container_fecha">
            <h4 class="fecha">
                @if(!isset($tickets->Cursos->fecha_inicial))
                   Ciudad de México , México a  {{ \Carbon\Carbon::parse($tickets->fecha_curso)->isoFormat('D [de] MMMM [del] YYYY') }}
                @else
                   Ciudad de México , México a  {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
                @endif

            </h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.4,2.4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>


        <div class="container_folio_bajo1">
            <h4 class="folio">{{$tickets->folio}}</h4>
        </div>


    </div>

    <div class="card-back">

        <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">

        <div class="container_cursoTrasero">
            <h4 class="curso_sm">

            @if(!isset($tickets->Cursos->nombre))
                {{ ucwords(strtolower($tickets->nom_curso)) }}
            @else
                {{ ucwords(strtolower($tickets->Cursos->nombre)) }}
            @endif

            </h4>
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.4,2.4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>



    </div>

@endsection
