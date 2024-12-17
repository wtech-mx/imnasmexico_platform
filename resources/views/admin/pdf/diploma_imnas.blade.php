<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diploma Imnas</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Minion';
            src: url('https://plataforma.imnasmexico.com/assets/admin/fonts/Minion.ttf');
        }

        @font-face {
            font-family: 'bethaine';
            font-style: normal;
            font-weight: 900;
            src: url('{{ storage_path('fonts/bethaine.ttf') }}') format('truetype');
        }

        h6 {
            font-family: 'bethaine';
            font-weight: 900;
            font-size: 33px;
            margin: -60px 0 0 0;
            color: #353535;
            line-height: 0.45; /* Ajusta el valor según necesites */

        }


        .img_portada {
            width: 812px;
            height:1280px;
            position:relative;
        }

        .img_reverso{
            width: 100%;
            height: auto;
            position:relative;
        }

        .container {
            position: absolute;
            top: 47%;
            left: 64%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top:56.5%;
            left: 64%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container3{
            position: absolute;
            top:80%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_folio_bajo1{
            position: absolute;
            top:74.3%;
            left: 21%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .img_firma{
            width: 230px;
            height: auto;
        }

        .curso{
            font-size: 25px;
            color: red;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 25px;
            color: #000;
            <?php if($capitalizar == 'Si'): ?>
                text-transform: uppercase;
            <?php endif; ?>
        }

        .fecha{
            font-size: 15px;
            color: red;
        }

        .folio3{
            position:relative;
            font-size: 25px;
            color: red;
        }

        .container_marco{
            position: absolute;
            top: 35%;
            left: 3.5%;
            z-index: 100;

        }

        .img_marco{
            width: 300px;
            height: 475px;
        }

        .oval-container {
            width: 240px;
            height: 290px;
            position: absolute;
            overflow: hidden;
            top: 42.7%;
            left: 7%;
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
            background-image: url('https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName }}');
            /* background-image: url('utilidades_documentos/{{ $fileName }}'); */
            background-size: cover;
            background-position: center center;
        }

        .container7{
            position: absolute;
            top:41%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 712px;
            background: #fff;
        }

        .texto_traser{
            font-size: 14px;
            line-height: 19px;
        }

        .curso_sm{
            font-size: 20px;
            color: red;
        }

        .qr_container{
            width: 100%;
            position: absolute;
            top: 68.5%;
            left:80%;
            display: inline-block;
        }

        .qr_container2{
            width: 100%;
            position: absolute;
            top: 72%;
            left:76%;
            display: inline-block;
        }

        .container_clave_rfc{
            width: 100%;
            position: absolute;
            top: 79%;
            left:10%;
            display: inline-block;
        }

        .clave_rfc{
            color: #000;
            font-weight: bold;
            font-size: 16px;
            background: #fff;
            padding: 0px 10px 0px 10px;
            display: inline-block;
        }

        .container_logo_reverso{
            position: absolute;
            top: 88%;
            left:180px;
            transform: translateX(-50%);
        }

        .img_logo_reversa{
            height: 70px!important;
        }

        .container_logo{
            position: absolute;
            top: 80px;
            left:75%;
            transform: translateX(-50%);
        }

        .container_firma_director{
            position: absolute;
            top: 1070px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container_firma_director2{
            position: absolute;
            top: 1150px;
            left: 50%;
            transform: translateX(-50%);
        }

        .firma_img{
            height: 90px!important;
        }

        .container_logo2{
            position: absolute;
            top: 1070px;
            left:12%;
            transform: translateX(-50%);
        }

        .img_logo{
            height: 200px!important;
        }

        .img_logo2{
            height: 100px!important;
        }

    </style>
</head>

    <body>
        @php
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

        {{-- <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada"> --}}

            @if(!isset($fileName_logo))
                <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif(empty($fileName_logo))
                <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="{{ $basePath . $tipo_documentos->img_portada }}" class="img_portada">
            @else

                @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')
                    <img src="{{ $basePath . 'diploma_logo_firma_director.png' }}" class="img_portada">
                    <div class="container_firma_director">
                        <img src="{{ $basePathUtilidades . $fileName_firma_director }}" class="firma_img" alt>
                    </div>
                    <div class="container_firma_director2">
                        <p style="font-size:10px;text-align: center;">{{ $director }} <br>
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
                            </p>
                    </div>
                @else
                    <img src="{{ $basePath . 'diploma_fontal_limpio.png' }}" class="img_portada">
                @endif

            @endif

        <div class="container_marco">
            {{-- <img src="https://plataforma.imnasmexico.com/utilidades_documentos/{{ $fileName_firma }}" class="img_firma"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/marco_diploma.png" class="img_marco">
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
            <h4 class="nombre">{{ $parte1 }}<br>{{ $parte2 }}</h4>
        </div>

        <div class="oval-container">
            <div class="oval">
            </div>
        </div>

        <div class="container2">
            <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
        </div>

        <div class="container3">
            <h4 class="fecha">Ciudad de México , México a {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }} </h4>
        </div>

        <div class="qr_container">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>


        <div class="container_folio_bajo1">
            <h4 class="folio3">{{$folio}}</h4>
        </div>

        @if(!isset($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">

        @elseif(empty($fileName_logo))
            <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">

        @elseif($fileName_logo == 'Sin Logo')
            <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso">
        @else
            <img src="{{ $basePath . 'diploma_reverso_limpio.png' }}" class="img_reverso">
        @endif

        {{-- <img src="{{ $basePath . $tipo_documentos->img_reverso }}" class="img_reverso"> --}}

        <div class="container7">
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

                        <strong class="curso_sm" style="color: red"> {!!  $curso !!}</strong> <br> <br>

                        Este reconocimiento es INVALIDO si no tiene todas las firmas, sellos y QR's que lo acrediten <br>

                    </p>
        </div>

        <div class="container_clave_rfc">
            <p class="clave_rfc">{{ $clave_rfc }}</p>
        </div>

        <div class="qr_container2">
            @php
                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',4,4) . '" style="background: #fff; padding: 5px;"   />';
            @endphp
        </div>

        <div class="container_logo_reverso">
            @if(!isset($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo_reversa">

            @elseif(empty($fileName_logo))
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo_reversa">

            @elseif($fileName_logo == 'Sin Logo')
                <img src="https://plataforma.imnasmexico.com/utilidades_documentos/fondo_sf.png" class="img_logo_reversa">
            @else
                <img src="{{ $basePathUtilidades . $fileName_logo }}" class="img_logo_reversa">
            @endif
        </div>

    </body>
</html>
