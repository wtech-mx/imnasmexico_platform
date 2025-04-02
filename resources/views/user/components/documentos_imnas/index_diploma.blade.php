@extends('layouts.app_documenots')

@section('template_title')
    Diploma RN
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
                $nombreCompleto = ucwords(strtolower($tickets->nombre));
                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;


                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');

                $basePathFirmaDirect = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');

            }else{


                if ($tickets == null) {

                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->cliente)));
                    $firma = null;
                    $nombreCurso = $tickets_externo->curso;
                    $nombreCompleto = ucwords(strtolower($tickets_externo->cliente));
                    $foto = $tickets_externo->foto;
                    $firma = $tickets_externo->firma;
                }else {

                    $foto = $tickets->User->Documentos->foto_tam_infantil;
                    $firma = $tickets->User->Documentos->firma;

                    $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));

                    $nombreCompleto = ucwords(strtolower($tickets->User->name));
                    $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
                }


            }

            $cantidad_palabras = count($palabras);

            // Contar las palabras
            $cursoNombre = isset($tickets->Cursos->nombre)
            ? $tickets->Cursos->nombre
            : (isset($cursoNombre)
                ? $tickets->nom_curso
                : $tickets_externo->curso);

            $folio = isset($tickets->folio) ? $tickets->folio : $tickets_externo->folio;

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
            width: 90%;
            height: 100%;
            border-radius: 50%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 40%);
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $backgroundImage }}');
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
            width: 424px;
            position: absolute;
            top: 19%;
            background: #fff;
        }

        .texto_traser{
            font-size: 9px;
            line-height: 11px;
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

        .container_logo{
            position: absolute;
            top: 30px;
            left:280px;
        }

        .img_logo{
            width: 150px;
            width: {{ $tickets?->logo_diploma ?? 150 }}px!important;
        }


        .container_logo2{
            position: absolute;
            top: 680px;
            left:25px;
        }

        .container_firma_director{
            position: absolute;
            top: 680px;
            left:200px;
        }

        .texto_firma_direct{
            font-size: 7px;
        }

        .img_logo2{
            width: 65px;
        }

        .img_firna{
            width: 80px;
        }

        .container_logoreversa{
            position: absolute;
            top: 680px;
            left:95px;
        }

        .img_logoreversa{
            width: 50px;
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">

        @if(!isset($tickets->User->logo))

            <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">

        @else

            @if($tickets->firma_director == 'si')
                <img src="{{ $basePath . '/' . 'diploma_logo_firma_director.png' }}" class="img_portada">
            @else
                <img src="{{ $basePath .'/'. 'diploma_fontal_limpio.png' }}" class="img_portada">
            @endif

        @endif

        <div class="container_logo">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_marco">
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_diploma.png" class="img_marco">
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>


        <div class="container_curso">
            <h4 class="nombre">
                {{ $cursoNombre }}
            </h4>
        </div>

        <div class="container_nombre">
            <h4 class="curso">
                {{ $nombreCompleto }}
            </h4>
        </div>

        <div class="container_fecha">
            <h4 class="fecha">
                @if(!isset($tickets->Cursos->fecha_inicial) && !isset($tickets->fecha_curso))
                Ciudad de México , México a
                @elseif(!isset($tickets->Cursos->fecha_inicial))
                Ciudad de México , México a, el {{ \Carbon\Carbon::parse($tickets->fecha_curso)->isoFormat('D [de] MMMM [del] YYYY') }}
                @else
                Ciudad de México , México a, el {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
                @endif
            </h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.4,2.4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>


        <div class="container_folio_bajo1">
            <h4 class="folio">{{$folio}}</h4>
        </div>

        <div class="container_logo2">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo2">
            @endif
        </div>



@if($tickets?->firma_director == 'si')
    <div class="container_firma_director">
        <img src="{{ $basePathFirmaDirect  . '/' . $tickets?->User?->telefono . '/' . $tickets?->User?->RegistroImnasEscuela?->firma }}" class="img_firna">
        <p class="text-center texto_firma_direct">
            @php
                function insertarSaltosDeLinea($texto, $cadaCuantasPalabras = 3) {
                    $palabras = explode(' ', $texto);
                    $resultado = '';

                    foreach ($palabras as $index => $palabra) {
                        $resultado .= $palabra . ' ';
                        if (($index + 1) % $cadaCuantasPalabras === 0) {
                            $resultado .= '<br>';
                        }
                    }

                    return $resultado;
                }

                $textoFinal = $tickets?->texto_firma_personalizada ?: $tickets?->texto_director;
            @endphp

            {{-- Solo mostrar el nombre del director si no hay texto personalizado --}}
            @if (empty($tickets?->texto_firma_personalizada))
                @php
                    $words = explode(' ', $tickets?->User?->name ?? '');
                    $chunks = array_chunk($words, 3);
                    foreach ($chunks as $chunk) {
                        echo implode(' ', $chunk) . '<br>';
                    }
                @endphp
            @else
                {!! insertarSaltosDeLinea($textoFinal, 3) !!}
            @endif
        </p>

    </div>
@endif


    </div>

    <div class="card-back">

        @if(!isset($tickets->User->logo))
            <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else
            <img src="{{ $basePath .'/'. 'diploma_reverso_limpio.png' }}" class="img_reverso">
        @endif

        <div class="d-flex justify-content-center">
            <div class="container_cursoTrasero">
                    <p class="text-center texto_traser">

                        <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br> <br>
                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES.	 LIBRO MIL CIENTO
                        CUARENTA Y TRES.	 CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE
                        REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y,	 B.- LA REFORMA AL ARTÍCULO
                        SEXTO DE LOS ESTATUTOS SOCIALES, que resulta	n de LA PROTOCOLIZACIÓN del acta de Asamblea
                        General Extraordinaria de Socios de “INSTITUTO MEXICANO NATURALES AIN SPA”, SOCIEDAD CIVIL. <br><br>

                        Artículo 5o de la Constitución Política de los Estados Unidos Mexicanos: <br><br>

                        “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo
                        que le acomode, siendo lícitos. ... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial. <br>

                        Artículo 153 de la Ley General del Trabajo, apartado I, III y IV. En General mejorar el nivel educativo, la competencia
                        laboral y las habilidades de los trabajadores. <br><br>

                        Registrado ante la Secretaría del Trabajo y Previsión Social el Instituto Mexicano Naturales Ain Spa,
                        como Agente Capacitador Externo con Número de Registro:

                        @if(!isset($tickets->User->clave_clasificacion))
                            <strong style="color:red">RIFC680910-879-0013 </strong>
                        @else
                            <strong style="color:red">{{ $tickets->User->clave_clasificacion }} </strong>
                        @endif

                        <br><br>

                        A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE
                        LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES,
                        que resulta	n de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de “INSTITUTO
                        MEXICANO NATURALES AIN SPA”, SOCIEDAD CIVIL... <br><br>

                        XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su
                        plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016,
                        mismo momento en que lo autorizo definitivamente.- Doy Fe. <br><br>


                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da
                        el siguiente nombramiento conforme a Derecho, e inscrito en el Registro Nacional Instituto Mexicano Naturales
                        Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exigen los planes de estudios
                        especializado en <br><br>

                    <strong class="curso_sm"> {{ $cursoNombre }}</strong> <br><br>

                    </p>
            </div>
        </div>

        {{-- <div class="container_cursoTrasero">
            <h4 class="curso_sm">
                {{ $cursoNombre }}
            </h4>
        </div> --}}

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.4,2.4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container_logoreversa">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logoreversa">
            @endif
        </div>

    </div>

@endsection
