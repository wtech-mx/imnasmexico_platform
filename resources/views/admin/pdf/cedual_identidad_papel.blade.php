<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/tipos_documentos/'
                : 'tipos_documentos/';

        $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                : 'utilidades_documentos/';


        if( $fileName == null){
            $fileName= $pdfData['foto_tam_infantil'];
        }


    @endphp

    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Minion';
            src: url('plataforma.imnasmexico.com/assets/admin/fonts/Minion.ttf');
            font-weight: normal;
            font-style: normal;
        }


        .img_portada {
            width: 480px;
            height: 668px;
            position:relative;
        }

        .container {
            position: absolute;
            top: 45.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_leyenda2_cp {
            position: absolute;
            top: 52.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:57%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_logo_cp{
            position: absolute;
            top:17%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_leyenda1_cp{
            position: absolute;
            top:36%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_aviso_privacidad_cp{
            position: absolute;
            top:68%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 400px;
            line-height: 0.9;

        }

        .container_tipo_vigencia_abrev_cp{
            position: absolute;
            top:22%;
            right: 3%;
            text-align: center;
        }

        .container_qr_cp{
            position: absolute;
            top:36%;
            right: -9%;
            text-align: center;
        }

        .container_firma1_cp{
            position: absolute;
            top:68%;
            right: -34%;
            text-align: center;
        }

        .container_firma2_cp{
            position: absolute;
            top:68%;
            left: -34%;
            text-align: center;
        }

        .tipo_abrev{
            text-transform: uppercase;
            color: red;
            font-size: 19px;
        }

        .tipo_vigencia_abrev_cp{
            font-size: 55px;
            text-transform: uppercase;
            color: red;
        }

        .firma1_cp{
            width: 35%;
        }

        .firma2_cp{
            width: 35%;
        }

        .logo_cp{
            width: 107%;
        }

        .leyenda1_cp{
            color: red;
            font-size: 35px;
            text-align: center;
        }

        .qr_cp{
            width: 50%;
        }

        .leyenda2_cp{
            font-size: 15px;
            text-align: center;
        }

        .container7{
            position: absolute;
            top:78%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container6{
            position: absolute;
            top:61%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 500px;
        }

        .container3{
            position: absolute;
            top: 51%;
            right: 17px;
            text-align: center;
        }

        .container4{
            position: absolute;
            top: 15%;
            left:70px;
        }

        .container5{
            position: absolute;
            top: 75%;
            right:45px;
        }

        .img_firma{
            width: 100px;
            height: auto;
        }

        .img_reverso{
            width: 480px;
            height: 668px;
            position:relative;
        }

        .curso{
            font-size: 17px;
            color: red;
        }

        .curso_sm{
            font-size: 11px;
            color: red;
        }

        .fecha{
            font-size: 12px;
            color: #000;
        }

        .aviso_privacidad_cp{
            font-size: 12px;
            color: #000;
            line-height: 0.5;
        }

        .nombre{
            font-family: 'Minion', sans-serif;
            font-size: 17px;
            color: #000;
        }

        .folio{
            position:relative;
            font-size:19px;
            color: red;
        }

        .folio2{
            position:relative;
            font-size: 25px;
            color: red;
        }

        .oval-container {
            width: 123px;
            height: 185px;
            position: absolute;
            overflow: hidden;
            top: 28%;
            left: 5%;
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
        }

        .oval {
            width: 100%;
            height: 100%;
            background: #fff;
            margin: 0;
            padding: 0;
            margin-top: 8px;
            /* background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}'); */
            background-image: url('{{ $basePathUtilidades . $fileName }}');
            background-size: cover;
            background-position: center center;
        }
    </style>
</head>

    <body>

    @php
        if ($nombre == NULL) {
            $nombre = $pdfData['alumno']->name;
        }

        $palabras = explode(' ', ucwords(strtolower($nombre)));
        $cantidad_palabras = count($palabras);

    @endphp

    {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
    {{-- <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}

    @if($pdfData['curso']->nombre == null)
        <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

        @else
        <img src="{{ $basePath . $tipo_documentos->fondo_cp }}" class="img_portada">

    @endif

    <div class="container">
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

    <div class="container_leyenda2_cp">
        <p class="leyenda2_cp">{{ $tipo_documentos->leyenda2_cp }}</p>
    </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container_logo_cp">
            <img src="tipos_documentos/{{ $tipo_documentos->logo_cp }}" class="logo_cp">
        </div>

        <div class="container_tipo_vigencia_abrev_cp">
            <P class="tipo_vigencia_abrev_cp">{{ $tipo_documentos->tipo_vigencia_abrev_cp }} <br> <strong class="tipo_abrev">TIPO</strong></P>
        </div>

        <div class="container_qr_cp">
            <img src="{{ $basePath . $tipo_documentos->qr_cp }}" class="qr_cp">
        </div>

        <div class="container_leyenda1_cp">
            <h4 class="leyenda1_cp">{{ $tipo_documentos->leyenda1_cp }}</h4>
        </div>

        <div class="container2">
            <h4 class="curso">

                @php
                    if ($curso == NULL) {
                        $curso = $pdfData['curso']->nombre;
                    }
                @endphp

                {{ ucwords(strtolower($curso)) }}
            </h4>
        </div>

        @php
            if ($fecha == null) {
                $fecha = $pdfData['fecha_curso'];
            }
        @endphp

        <div class="container6">
            <h4 class="fecha">Expedido en la Ciudad de México, el {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="container_aviso_privacidad_cp">
            <p class="aviso_privacidad_cp">
                 {!! $pdfData['aviso_privacidad_cp'] !!}
            </p>
        </div>

        <div class="container_firma1_cp">
            <img src="{{ $basePath . $tipo_documentos->firma1_cp }}" class="firma1_cp">
        </div>

        <div class="container_firma2_cp">
            <img src="{{ $basePath . $tipo_documentos->firma2_cp }}" class="firma2_cp">
        </div>

        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso">
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

        <div class="container4">
            <h4 class="folio2">{{$folio}}</h4>
        </div>

        <div class="container5">

            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"
            @if (!isset($fileName_firma))
                src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png"
            @endif>

            {{-- <img src="utilidades_documentos/{{ $fileName_firma }}" class="img_firma">--}}
        </div>

        <div class="container7">
            <h4 class="curso_sm">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

    </body>
</html>
