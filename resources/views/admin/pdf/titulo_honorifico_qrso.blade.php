<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titulo Honorifico</title>
    @php
        $isNoImage = $fileName === 'https://plataforma.imnasmexico.com/cursos/no-image.jpg';

        $domain = request()->getHost();
            $basePath = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/tipos_documentos/'
                    : 'tipos_documentos/';

            $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                    : 'utilidades_documentos/';

            $palabras = explode(' ', ucwords(strtolower($nombre)));
            $parte1 = implode(' ', array_slice($palabras, 0, 2));
            $parte2 = implode(' ', array_slice($palabras, 2));

    @endphp

    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Monotype Corsiva Normal';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/oldenglishtextmt.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Monotype';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/oldenglishtextmt.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Monotype Corsiva Bold';
            font-style: normal;
            font-weight: 900;
            src: url('{{ storage_path('fonts/Brush.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'bethaine';
            font-style: normal;
            font-weight: 900;
            src: url('{{ storage_path('fonts/bethaine.ttf') }}') format('truetype');
        }

        h1 {
            font-family: 'Monotype Corsiva Bold';
            font-weight: 900;
            font-size: {{ $tam_letra_especi }}px;
            color: #353535;
        }

        h6 {
            font-family: 'bethaine';
            font-weight: 900;
            font-size: 33px;
            margin: -60px 0 0 0;
            color: #353535;
            line-height: 0.45; /* Ajusta el valor según necesites */
        }

        h7 {
            font-family: 'bethaine';
            font-weight: 900;
            font-size: 27px;
            margin: -60px 0 0 0;
            color: #353535;
            line-height: 0.45; /* Ajusta el valor según necesites */
        }


        h2 {
            font-family: 'Monotype Corsiva Normal';
            font-weight: normal;
            font-size: {{ $tam_letra_nombre }}px;
            color: #000;
            <?php if($capitalizar == 'Si'): ?>
                text-transform: uppercase;
            <?php endif; ?>
        }

        h5 {
            font-family: 'Monotype Corsiva Normal';
            font-weight: normal;
            font-size: 21px;
            color: #000;
                line-height: 1.2; /* Ajusta el valor según necesites */
        }

        .img_portada {
            width: 100%;
            height:auto;
            position:relative;
        }

        .img_reverso{
            width: 100%;
            height: auto;
            position:relative;
        }

        .container {
            position: absolute;
            top: 44.5%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:55%;
            left: 65%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .containerx{
            position: absolute;
            top:67%;
            left: 82%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:90.5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top:90%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container4{
            position: absolute;
            top: 3.2%;
            left:110px;
        }

        .container6{
            position: absolute;
            top: 5.8%;
            left:110px;
        }

        .container_idocurp{
            position: absolute;
            top: 5.8%;
            left:12px;
        }
        .container7{
            position: absolute;
            top: 8.3%;
            left:118px;
        }

        .container8{
            position: absolute;
            top: 10.8%;
            left:175px;
        }

        .container9{
            position: absolute;
            top: 13.3%;
            left:120px;
        }

        .container10{
            /* position: absolute;
            top:57%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center; */
            position: absolute;
            top:41%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 900px;
            background: #fff;
        }

        .texto_traser{
            font-size: 17px;
            line-height: 23px;
        }

        .container5{
            position: absolute;
            top: 80%;
            right:50px;
        }

        .img_firma{
            width: 230px;
            height: auto;
        }

        .container_marco{
            position: absolute;
            top: 33%;
            left: 11.5%;
            z-index: 100;

        }

        .img_marco{
            width: 300px;
            height: 540px;
        }

        .curso{
            font-size: 35px;
            color: #353535;
        }

        .fechax{
            color: #353535;
        }


        .folio2{
            position:relative;
            font-size: 18px;
            color: red;
        }

        .idocurp{
            position:relative;
            font-size: 18px;
            color: #616161;
            padding: 1px 10px 1px 5px;
            background: #fff;
        }

        .folio3{
            position:relative;
            font-size: {{ $tam_letra_folio }}px;
            color: red;
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
            background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
            background-size: cover;
            background-position: center center;
        }

        .oval-container {
            width: 210px;
            height: 345px;
            position: absolute;
            overflow: hidden;
            left: 15%;
            background: transparent;
            top: 40%;
            /* Ajuste condicional de top */
        }


        .qr_container{
            width: 100%;
            position: absolute;
            top: 82%;
            left:11.2%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top: 82%;
            left:79.9%;
            display: inline-block;
        }

        .qr_container3{
            width: 100%;
            position: absolute;
            top: 4.9%;
            left:78%;
            display: inline-block;
        }

        .container_logo {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
        }
        .container_logo2{
            position: absolute;
            top: 93.5%;
            left:29%;
            transform: translateX(-50%);

        }

        .container_logo_reversa{
            width: 100%;
            position: absolute;
            top: 93.5%;
            left:29%;
        }

        .img_logo {
            height: 500px!important;
            /* Puedes ajustar el ancho aquí si es necesario */
        }
        .img_logo2{
            height:  80px!important;
        }

        .container_registro{
            position: absolute;
            top: 53%;
            left: 12%;
            z-index: 100000;
            top: {{ $isNoImage  ? '60%' : '53%' }};

        }

        .img_registro{
            width: 50%;
        }

        .container_firma_director_front{
            position: absolute;
            top: 1215px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container_firma_director_front_text{
            position: absolute;
            top: 1370px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container_firma_director{
            position: absolute;
            top: 1240px;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_firma_director_text{
            position: absolute;
            top: 1340px;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .firma_img{
            height: 170px!important;
        }

    </style>
</head>

    <body>

        @if(!isset($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif(empty($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">
            @else

            @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')
                <img src="{{ $basePath . 'titulo_frontal_limpio_sin_firma_front.png' }}" class="img_portada">
                <div class="container_firma_director_front">
                    <img style="text-align: center;" src="{{ $basePathUtilidades . $fileName_firma_director }}" class="firma_img">

                </div>
                <div class="container_firma_director_front_text">
                    <h6 style="text-align: center;">{{ $director }} <br>
                        @php
                            // Divide el curso por espacios en blanco
                            $palabrasTextFirma = explode(' ', $firma_directora);

                            // Inicializa la cadena formateada
                            $Textofirma_directora = '';
                            $contador_palabras = 0;

                            foreach ($palabrasTextFirma as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $Textofirma_directora .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 5 == 0) {
                                    $Textofirma_directora .= "<br>";
                                }
                            }
                        @endphp
                        {!! $Textofirma_directora !!}
                    </h6>
                </div>
            @else
                <img src="{{ $basePath . 'titulo_frontal_limpio.png' }}" class="img_portada">
            @endif

        @endif

        <div class="container_registro">
            <img src="https://plataforma.imnasmexico.com/utilidades_documentos/logo_registronas.png" class="img_registro">
        </div>

        <div class="container_marco">
            {{-- <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_pro.png" class="img_marco">
        </div>

        <div class="container_logo">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo">
            @endif
        </div>

        <div class="container_logo2">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo2">

            @endif
        </div>

        <div class="container">
            <h2 >{{ $parte1 }}<br>{{ $parte2 }}</h2>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container2">
            @php
                // Divide el curso por espacios en blanco
                $palabras = explode(' ', $curso);

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
            @endphp
            <h1>{!! $curso_formateado !!}</h1>
        </div>

        <div class="containerx">
            <h5>{{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h5>
        </div>

        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        @if(!isset($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">
            @elseif(empty($fileName_logo))
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/titulo_reverso_limpio_firma_director.png" class="img_reverso">
            @elseif($fileName_logo == 'Sin Logo')
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/titulo_reverso_limpio_firma_director.png" class="img_reverso">
            @else
            @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')
                <img src="{{ $basePath . 'titulo_reverso_limpio_firma_director.png' }}" class="img_reverso">

                <div class="container_firma_director">

                    @if(empty($fileName_firma_directorOtra))
                        <img src="{{ $basePathUtilidades . $fileName_firma_director }}" class="firma_img"><br>
                    @else
                        <img src="{{ $basePathUtilidades . $fileName_firma_directorOtra }}" class="firma_img"><br>
                    @endif

                </div>
                <div class="container_firma_director_text">

                    <h7 style="text-align: center;">{{ $director }} <br>
                        @php
                            // Divide el curso por espacios en blanco
                            $palabrasTextFirma = explode(' ', $firma_directora2);

                            // Inicializa la cadena formateada
                            $Textofirma_directora = '';
                            $contador_palabras = 0;

                            foreach ($palabrasTextFirma as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $Textofirma_directora .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 5 == 0) {
                                    $Textofirma_directora .= "<br>";
                                }
                            }
                        @endphp
                        {!! $Textofirma_directora !!}
                    </h7>
                </div>
            @else
                <img src="{{ $basePath . 'titulo_reverso_limpio.png' }}" class="img_reverso">
            @endif

        @endif

        @php
            // Divide el curso por espacios en blanco
            $palabras = explode(' ', $nombre);

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

        <div class="container4">
            <h4 class="folio2">{!! $nombre_formateado !!}</h4>
        </div>

        <div class="container_idocurp">
            <h4 class="idocurp">{{ $idocurp }}</h4>
        </div>

        <div class="container6">
            <h4 class="folio2">{{$curp}}</h4>
        </div>

        <div class="container7">
        @php
            // Divide el curso por espacios en blanco
            $palabras = explode(' ', $curso);

            // Inicializa la cadena formateada
            $curso_formateado = '';
            $contador_palabras = 0;

            foreach ($palabras as $palabra) {
                // Agrega la palabra actual a la cadena formateada
                $curso_formateado .= $palabra . ' ';

                // Incrementa el contador de palabras
                $contador_palabras++;

                // Agrega un salto de línea después de cada tercera palabra
                if ($contador_palabras % 6 == 0) {
                    $curso_formateado .= "<br>";
                }
            }
        @endphp
            <h4 class="folio2">{!! $curso_formateado !!}</h4>
        </div>

        <div class="container8">
            <h4 class="folio2">{{ $nacionalidad }}</h4>
        </div>

        <div class="container9">
            <h4 class="folio2">PERMANENTE_</h4>
        </div>

        {{-- <div class="container10">
            <h4 class="folio2">{!! $curso_formateado !!}</h4>
        </div> --}}

        <div class="container10">
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
                como Agente Capacitador Externo con Número de Registro: <strong style="color:red">{{ $clave_rfc }} </strong><br><br>

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

            <strong class="curso_sm" style="color: red"> {!!  $curso_formateado !!}</strong> <br> <br>

            Este reconocimiento es INVALIDO si no tiene todas las firmas, sellos y QR's que lo acrediten <br>

            </p>
        </div>


        <div class="container3">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        <div class="qr_container3">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',6,6) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container_logo_reversa">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo2">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo2">
            @endif
        </div>

    </body>
</html>
