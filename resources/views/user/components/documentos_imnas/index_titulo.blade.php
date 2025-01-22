@extends('layouts.app_documenots')

@section('template_title')
    Titulo Honorifico RN -
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
                $nombrePersona = $tickets->nombre;
                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;

                $nombreCurso = $tickets->nom_curso;

                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');

                $basePathFirmaDirect = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');

            }else{

                if ($tickets == null) {

                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->cliente)));
                    $nombrePersona = $tickets_externo->cliente;
                    $firma = null;
                    $nombreCurso = $tickets_externo->curso;
                    $foto = $tickets_externo->foto;
                    $firma = $tickets_externo->firma;
                }else {

                    $foto = $tickets->User->Documentos->foto_tam_infantil;
                    $firma = $tickets->User->Documentos->firma;

                    $palabras = explode(' ', ucwords(strtolower($tickets->User->name)));
                    $nombrePersona = $tickets->User->name;

                    $nombreCurso = $tickets->Cursos->nombre;
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

            if ( isset($tickets->curp_escrito)) {
                $curp = $tickets->curp_escrito;
            }else{
                $curp = '';
            }
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

        @font-face {
            font-family: 'bethaine';
            font-style: normal;
            font-weight: 900;
            src: url('{{ asset('assets/admin/fonts/Bethaine.ttf') }}') format('truetype');
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
            font-size: {{ $tickets?->tam_letra_nombre_th ?? 20 }}px!important;
            color: #000;
            @if($tickets && $tickets->capitalizar_nombre === 'Si')
                text-transform: uppercase;
            @endif
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
            border-radius: 50%;
            background-color: transparent;
            position: absolute;
            clip-path: ellipse(50% 50% at 50% 50%);
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $backgroundImage }}');
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
            font-size: {{ $tickets?->tam_letra_especialidad_th ?? 15 }}px!important;
            color: #000;
        }

        .container_fecha{
            position: absolute;
            top: 67.5%;
            left: 57%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: #fff;
            width: 300px;
        }

        .fecha{
            font-family: 'oldenglishtextmt';
            color: #000;
            font-size: 10px;
        }

        .container_folio_bajo1{
            position: absolute;
            top:91.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .folio{
            font-size: 5px;
            font-size: {{ $tickets?->tam_letra_folio_th ?? 5 }}px!important;
            color: red;
        }

        .folio_reversa{
            font-size: 5px;
            font-size: {{ $tickets?->tam_letra_folio_th ?? 5 }}px!important;
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

        .container_texto_atras{
            position: absolute;
            top: 3.2%;
            left: 4px;
            background: #fff;
            width: 173px;
        }

        .container_curp{
            position: absolute;
            top: 5.8%;
            left:45px;
        }

        .nombre_reverso{
            position:relative;
            font-size: 9px;
            color: red;
            text-align: left;
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
            top:91.5%;
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
            width: 30px;        }

        .container_logo2{
            position: absolute;
            top: 35px;
        }

        .img_logo2{
            width: 150px;
            width: {{ $tickets?->logo_titulo ?? 150 }}px!important;
        }

        .container_firma_director{
            position: absolute;
            top: 440px;
            left:200px;
        }

        .container_firma_director_text{
            position: absolute;
            top: 492px;
            left:210px;
        }

        .container_cursoTrasero{
            position: absolute;
            width: 424px;
            position: absolute;
            top: 19%;
            background: #fff;
        }

        .texto_traser{
            font-size: 7.5px;
            line-height: 8.7px;
        }

        .texto_firma_direct{
            font-size: 10px;
            font-family: 'bethaine';
        }

        .container_firma_director_text2{
            position: absolute;
            top: 484px;
            left: 280px;
        }

        .texto_firma_direct2{
            font-size: 10px;
            font-family: 'bethaine';
        }

        .container_firma_director2{
            position: absolute;
            top: 420px;
            left: 271px;
        }

        .img_firna{
            width: 90px;
        }

        .img_firna2{
            width: 90px;
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">

        <div class="container">
            <div class="row">
                <div class="col-3 text-center border p-2" style="margin-top: 30px">
                    <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width: 130px">
                </div>

                <div class="col-3 text-center border p-2" style="margin-top: 30px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                    </div>
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-3 text-center border p-2" style="margin-top: 30px">
                    <img class=" " src="{{ $basePath . 'stps.webp'}}" style="width: 150px">
                </div>

                <div class="col-3 text-center border p-2" style="margin-top: 30px">
                    <h6 class="azul_claro tipo uppercase  p-0" style="margin-top: 30px">
                        TIPO
                    </h6>

                    <h6 class="azul_claro cea uppercase m-0 p-0">
                        CFC
                    </h6>
                </div>

            </div>

            <div class="row">
                <div class="col-4 text-center border p-2">
                    <div class="oval-container">
                        <img class="oval" src="{{ $basePathUtilidades . $fileName }}" alt="Imagen">
                    </div>

                    <h6 class="azul_claro folio uppercase  p-0" style="margin-top: 20px">
                        folio
                    </h6>

                    <h6 class="azul_claro folio_num uppercase m-0 p-0">
                        {{$folio}}
                    </h6>
                </div>

                <div class="col-8 text-start border">
                    <h6 class="uppercase titulo_cedula m-0 p-0">
                        REGISTRO NACIONAL
                    </h6>
                    <h5 class="uppercase subtitulo_cedula  m-0 p-0">
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </h5>
                    <p class="texto_principal_cedula" style="">
                        La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del
                         Registro Nacional Instituto Mexicano Naturales Ain Spa RIIMNAS,
                         con registro <strong class="texto_prinipal_strong"> {{ $clave_rfc }}</strong> en la Secretaría del Trabajo y Previsión
                         Social STPS como Agente Capacitador Externo, hace constar que el/la
                          Alumno(a) <strong class="texto_prinipal_strong"> {!! $nombre !!}</strong> , con número de folio <strong class="texto_prinipal_strong">CFC000918771</strong> con
                           CURP: <strong class="texto_prinipal_strong">JDAR090213MMCMLTA4</strong> , cursó la especialidad de <strong class="texto_prinipal_strong"> {{ ucwords(strtolower($curso)) }}</strong> ,
                            cubriendo todos los créditos correspondientes.
                        Para efectos de desempeño académico se expresa lo siguiente:
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-4 text-start border p-2">
                    <table class="table" style="border: solid 1px #2c6d77;padding:20px 15px 20px 15px;">
                        <tbody class="m-0 p-0">
                            <tr class="m-0 p-0">
                                <td class="text-start col_izquierda uppercase m-0 p-0" >CREDITOS</td>
                                <td class="text-start col_derecha_texto">
                                    Obligatorios: 280 <br>
                                    Optativos: 0 <br>
                                    Totales: 280
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-4 text-start border p-2">
                    <table class="table" style="border: solid 1px #2c6d77;margin-left:20px;padding:26px 15px 26px 15px;">
                        <tbody>
                            <tr>
                                <td class="text-start col_izquierda uppercase" >% DE MATERIAS <br> APROBADAS</td>
                                <td class="text-start col_derecha"  style="padding-left: 15px">
                                    100%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-4 text-start border p-2">
                    <table class="table" style="border: solid 1px #2c6d77;margin-left:10px;padding:26px 15px 26px 15px;">
                        <tbody>
                            <tr>
                                <td class="text-start col_izquierda uppercase" >Promedio general</td>
                                <td class="text-start col_derecha" style="padding-left: 15px">
                                    9.6
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-left border" style="padding:0px 20px 20px 20px;">
                    @php
                        $totalSubtemas = count($subtemas);
                        $faltantes = 18 - $totalSubtemas; // Calculamos cuántos faltan para llegar a 20
                    @endphp

                    @foreach ($subtemas as $subtema)
                        <p class="contenedor_materia" style="padding: 0 0  0 20px; margin: 8px;">{{ $subtema->subtema }}</p>
                    @endforeach

                    {{-- Agregamos etiquetas vacías si hay menos de 20 registros --}}
                    @for ($i = 0; $i < $faltantes; $i++)
                        <p class="contenedor_materia" style="padding: 0 0  0 20px; margin: 8px;">&nbsp;</p>
                    @endfor

                </div>

            </div>
        </div>

    </div>

    <div class="card-back">

        @if(!isset($tickets->User->logo))

            <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else

            @if($tickets->firma_director == 'si')
                <img src="{{ $basePath . '/' . 'titulo_reverso_limpio_firma_director.png' }}" class="img_reverso">
            @else
                <img src="{{ $basePath .'/'. 'titulo_reverso_limpio.png' }}" class="img_reverso">
            @endif

        @endif

        <div class="container_texto_atras">
            <p class="nombre_reverso">
                <strong class="text-dark"> NOMBRE: </strong>{!! $nombrePersona !!} <br>
                <strong class="text-dark"> CURP:</strong> {{ $curp }} <br>
                <strong class="text-dark"> NACIONALIDAD:</strong> Mexicana <br>
                <strong class="text-dark"> VIGENCIA: </strong>Permanente <br>
                <strong class="text-dark"> CARRERA: </strong>{!! $nombreCurso !!} <br>
            </p>
        </div>

        {{-- <div class="container_nombre_formateado">
            <h4 class="nombre_reverso">{!! $linea !!}</h4>
        </div>

        <div class="container_curp">
            <h4 class="nombre_reverso">{{ $curp }}</h4>
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
        --}}

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

                    <strong class="curso_sm" style="color: red"> {!!  $curso_formateado !!}</strong>

                    </p>
            </div>
        </div>


        @if($tickets?->firma_director == 'si')
            <div class="container_firma_director2">
                <p class="text-center">
                    <img src="{{ $basePathFirmaDirect  .'/'.  $tickets->User->telefono . '/' .$tickets->User->RegistroImnasEscuela->firma }}" class="img_firna2">
                </p>
            </div>

            <div class="container_firma_director_text2">
                <p class="text-center texto_firma_direct">
                    @php
                        $words = explode(' ', $tickets->User->name);
                        $chunks = array_chunk($words, 3);
                        foreach ($chunks as $chunk) {
                            echo implode(' ', $chunk) . '<br>';
                        }
                    @endphp
                    {{ $tickets->texto_director }}
                </p>
            </div>
        @endif

        <div class="container_folio_reversa">
            <h4 class="folio_reversa">{{$folio}}</h4>
        </div>

        <div class="qr_container3">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.3,2.3) . '" style="background: #fff; padding: 5px;"   />';
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
