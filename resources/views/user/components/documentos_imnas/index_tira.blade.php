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

            $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');

            if (isset($tickets->foto_cuadrada)) {
                $palabras = explode(' ', ucwords(strtolower($tickets->nombre)));
                $nombreAAlmno = $tickets->nombre;
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
                $nombreAAlmno = $tickets->User->name;

                $nombreCurso = $tickets->Cursos->nombre;
                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
            }

            $cantidad_palabras = count($palabras);

            if ( isset($tickets->curp_escrito)) {
                $curp = $tickets->curp_escrito;
            }else{
                $curp = $tickets->User->curp_escrito ?? '';

            }

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
            transform: translateX(-50%);
            left: 50%;
            background-image: url('{{ $basePathDocumentos .'/'. $tickets->User->telefono .'/'.$foto }}');
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

        @if(!isset($tickets->promedio))

        @else
            .promedio{
                position:relative;
                font-size: 15px;
                font-weight: bold;
                padding: 10px;
                background: #fff;
            }
        @endif


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
            font-size: 25px;
            font-size: <?php $tickets->tam_letra_lista_tira_materias ?>px!important;
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

        @if(!isset($tickets->User->logo))
        <img src="{{ $basePath . '/' . $tipo_documentos->img_portada }}" class="img_portada">
        @else
            <img src="{{ $basePath .'/'. 'tira_limmpia.png' }}" class="img_portada">
        @endif


        <div class="container_logo">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_nombre">
            <h4 class="nombre">{{ $nombreAAlmno }}</h4>
        </div>

        <div class="containerz">
            <p class="texto" style="font-size: 13px;text-align: justify;">
                La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del Registro Nacional
                Instituto Mexicano Naturales Ain Spa RIIMNAS, con registro de la Secretaria
                del Trabajo y Prevención Social STPS como Agente Capacitador Externo con Registro
                RIFC-680910-879-0013 , hace constar que el la Alumno(a) , con Numero de
                Folio: <strong style="color: red"> {{$tickets->folio}} </strong>, con CURP: {{$curp}}, curso  <strong  style="color: red">{{ ucwords(strtolower($nombreCurso)) }} </strong>  Cubriendo todos los correspondientes.
                <br> Para afectos de desempeño académico  se expresa lo siguiente:
            </p>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container_fecha">
            <h4 class="fecha">
                @if(!isset($tickets->Cursos->fecha_inicial))
                    el dia {{ \Carbon\Carbon::parse($tickets->fecha_curso)->isoFormat('D [de] MMMM [del] YYYY') }}
                @else
                    el dia {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('D [de] MMMM [del] YYYY') }}
                @endif

            </h4>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$tickets->folio}}</h4>
        </div>

        @if(!isset($tickets->promedio))

        @else
            <div class="container_promedio">
                <h4 class="promedio">{{$tickets->promedio}}</h4>
            </div>
        @endif


        <div class="container_texto_tira">
            <ul>
                @if (is_int($subtemas) && $subtemas === 0)
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
                @elseif(is_iterable($subtemas))
                    @foreach ($subtemas as $item)
                        <li>{{ $item->subtema }}</li>
                    @endforeach
                @endif


            </ul>
        </div>

    </div>

    <div class="card-back">

        @if(!isset($tickets->User->logo))
        <img src="{{ $basePath . '/' . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else
            <img src="{{ $basePath .'/'. 'tira_limmpia_reversa.png' }}" class="img_reverso">
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

                    <strong class="curso_sm"></strong> {{ ucwords(strtolower($nombreCurso)) }} <br><br>

                    </p>
            </div>
        </div>


        <div class="container_logo2">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_logo3">
            @if(!isset($tickets->User->logo))
            @else
                <img src="{{ $basePathUtilidades  .'/'.  $tickets->User->logo }}" class="img_logo">
            @endif
        </div>

    </div>
@endsection
