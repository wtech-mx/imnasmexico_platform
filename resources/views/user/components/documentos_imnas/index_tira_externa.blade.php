@extends('layouts.app_documenots')

@section('template_title')
    Tira de materias RN
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

@endphp

@section('css_custom')
    <style>

        .img_portada {
            width: 812px;
            height:1280px;
            position:relative;
        }

        .contenedor_reverso{
            position: relative;
        }

        .img_reverso{
            width: 812px;
            height:1280px;
        }

        .card-3d-wrap {
            width: 810px!important;
        }

        .container_nombre {
            position: absolute;
            top: 20%;
            left: 300px;
            text-align: center;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 18px;
            color: #000;
            width: 300px;

        }

        .containerz{
            position: absolute;
            top: 29%;
            left: 35%;
            background: #ffffff;
            width: 500px;
            height: 110px;
        }

        .oval-container {
            width: 103px;
            height: 117px;
            position: absolute;
            overflow: hidden;
            top: 28.5%;
            right:-63%;
            background: transparent;
        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 1%;
            background-color: transparent;
            position: absolute;
            background-image: url('{{ $basePathUtilidades .'/'. $tickets_externo->foto }}');
            transform: translateX(-50%);
            left: 50%;
            background-size: cover;
            background-position: center center;
        }

        .container_fecha{
            position: absolute;
            top:64.5%;
            width: 200px;
            left: 80%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:59.5%;
            right:-58%;
            text-align: center;
        }

        .fecha{
            font-size: 13px;
            color: red;
        }

        .folio3{
            position:relative;
            font-size: 12px;
            color: red;
            font-weight: bold;
        }

        .container_promedio{
            position: absolute;
            top:52.5%;
            left:106.5%;
            text-align: center;
        }


        .promedio{
            position:relative;
            font-size: 15px;
            font-weight: bold;
            padding: 10px;
            background: #fff;
        }

        .container_logo{
            position: absolute;
            top: 45px;
            left:190px;
        }

        .container_logo2{
            position: absolute;
            top: 45px;
            left:200px;
        }

        .container_logo3{
            position: absolute;
            top: 1120px;
            left:160px;
        }

        .img_logo{
            width: 95px;
        }

        .container_texto_tira{
            position: absolute;
            top:75%;
            left:35%;
            text-align: left;
            font-size: 28px;
            width: 610px;
        }

        .container_texto_tira2{
            position: absolute;
            top:70%;
            left:35%;
            text-align: left;
            font-size: 25px;
            width: 610px;
        }

        .container_cursoTrasero{
            position: absolute;
            width: 620px;
            position: absolute;
            top: 45%;
            left: 36%;
            background: #fff;
        }

        .texto_traser{
            font-size: 12px;
            line-height: 12px;
        }

        .curso_sm{
            font-size:12px;
            color: red;
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">

        <img src="{{ $basePath .'/'. 'tira_limmpia.png' }}" class="img_portada">

        <div class="container_nombre">
            <h4 class="nombre">{{ $tickets_externo->cliente }}</h4>
        </div>

        <div class="containerz">
            <p class="texto" style="font-size: 13px;text-align: justify;">
                La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del Registro Nacional
                Instituto Mexicano Naturales Ain Spa RIIMNAS, con registro de la Secretaria
                del Trabajo y Prevención Social STPS como Agente Capacitador Externo con Registro
                RIFC-680910-879-0013 , hace constar que el la Alumno(a) , con Numero de
                Folio: <strong style="color: red"> FOLIO {{ $tickets_externo->folio }}</strong>, con CURP: CURP {{ $tickets_externo->curp }}, Especialidad  <strong  style="color: red">{{ $tickets_externo->curso }} </strong>  Cubriendo todos los correspondientes.
                <br> Para afectos de desempeño académico  se expresa lo siguiente:
            </p>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container_fecha">
            <h4 class="fecha">
                @if(!isset($tickets_externo->fecha_inicial))
                    el dia {{ \Carbon\Carbon::parse($tickets_externo->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
                @else
                    el dia {{ \Carbon\Carbon::parse($tickets_externo->fecha_final)->isoFormat('D [de] MMMM [del] YYYY') }}
                @endif
            </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{ $tickets_externo->folio }}</h4>
        </div>


        <div class="container_promedio">
            <h4 class="promedio">10</h4>
        </div>

            @php
                $curso = $tickets_externo->curso;

                $variantesValidas = [
                    'Cosmiatría Estética',
                    'Cosmiatria Estética',
                    'Cosmiatria Estetica',
                    'COSMIATRIA ESTETICA',
                    'cosmiatria estetica',
                    'COSMIATRÍA ESTÉTICA',
                    'cosmiatría estética',
                    'cosmiatria estética',
                    'Cosmiatría Estética',
                    'Cosmiatría estetica',
                    // Agrega aquí cualquier otra variante que quieras cubrir
                ];
            @endphp

            @if(in_array($curso, $variantesValidas))
            <div class="container_texto_tira">
                <ul>
                        <li>Anatomía </li>
                        <li>Fisiología </li>
                        <li>Bioquímica </li>
                        <li>Química Cosmética </li>
                        <li>Nutrición </li>
                        <li>Patologías Estéticas Faciales </li>
                        <li>Patologías Estéticas Corporales </li>
                        <li>Masoterapia, Diferentes Técnicas </li>
                        <li>Aparatologías Estéticas </li>
                        <li>Técnicas Combinadas </li>
                        <li>Tratamientos Avanzados Faciales Y Corporales </li>
                        <li>Administración SPA </li>
                </ul>
            </div>
            @else
                <div class="container_texto_tira2">
                    <ul>
                        <li>Anatomía y fisiología.</li>
                        <li>La piel y sus partes.</li>
                        <li>Higiene y asepsia ante COVID.</li>
                        <li>Preparación de materiales y equipo para el tratamiento cosmetológico facial y corporal.</li>
                        <li>Extracción y Diagnóstico.</li>
                        <li>Química Cosmética.</li>
                        <li>Patologías faciales.</li>
                        <li>Patologías corporales.</li>
                        <li>Sistema Muscular.</li>
                        <li>Sistema Digestivo.</li>
                        <li>Sistema Linfático.</li>
                        <li>Tipos de Grasa.</li>
                        <li>Morfologías y Antropometría.</li>
                        <li>P.E.F.E. (Celulitis piel de naranja)</li>
                        <li>Tratamientos Reductivos, Reafirmantes y Modelantes.</li>
                        <li>Aparatologías Estéticas básicas.</li>
                        <li>Hoja clínica Cosmetológica Corporal.</li>
                        <li>Protocolos Faciales.</li>
                        <li>Protocolos Corporales.</li>
                    </ul>
                </div>
            @endif

    </div>

    <div class="card-back">

         <img src="{{ $basePath .'/'. 'tira_limmpia_reversa.png' }}" class="img_reverso">

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

                        <strong style="color:red">RIFC680910-879-0013 </strong>

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

                    <strong class="curso_sm"></strong>{{ $tickets_externo->curso }} <br><br>

                    </p>
            </div>
        </div>

    </div>
@endsection
