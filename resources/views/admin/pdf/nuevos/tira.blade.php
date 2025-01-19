<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tira </title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/tira/'
                : 'documentos_nuevos/tira/';

        $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                    : 'utilidades_documentos/';

    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .border {
            border: 0px solid #000;
        }

        .container {
            position: relative;
            width: 812px;
            height:1280px;
            margin: 0 auto; /* Centrar el contenedor */
        }


        [class^="col-"] {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 12.70%; } /* 16.66% - 4.64% */
        .col-3 { width: 21.00%; } /* 25% - 4.64% */
        .col-4 { width: 29.30%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.90%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 95.80%; } /* 100% - 4.64% */

        .tipo{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 0px;
            font-size: 15px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 0;
         }

        .cea{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 40px;
            margin: 0;
            padding: 0;
            line-height: 35px;
        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 80%;
            background-color: transparent;
            background-size: cover;
            background-position: center center;
            background-image: url('{{ $basePath . 'foto.jpeg'}}');
        }

        .oval-container {
            margin-left: 10px;
            width: 230px;
            height: 290px;
            overflow: hidden;
            background: transparent;
            /* Ajuste condicional de top */
        }

        .titulo_cedula{
            font-size: 26px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height:45px;
            color: #545454;
        }

        .subtitulo_cedula{
            font-size: 15px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:10px;
            color: #545454;
        }

        .texto_principal_cedula{
            font-size: 16px;
            font-family: 'Montserrat_Light';
            font-weight: 'regular';
            line-height: 19px; color: #545454;
        }

        .texto_prinipal_strong{
            font-size: 18px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 19px; color: #545454;
        }

        .folio{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 10px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 0;
         }

        .folio_num{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 20px;
            margin: 0;
            padding: 0;
            line-height: 25px;
        }

        .col_izquierda{
            color: #545454;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 13px;
            line-height: 10px;

        }

        .col_derecha_texto{
            color: #2c6d77;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            font-size: 13px;
            line-height: 10px;

        }

        .col_derecha{
            color: #2c6d77;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            font-size: 17px;
        }

        .contenedor_materia{
            border: solid 1px #5bb4c2;
            border-radius: 50%;
            padding: 5px;
            color: #545454;
            font-size: 14px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .certificado_titulo{
            font-size: 16px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height: 15px;
            color: #2c6d77;
            margin-left: 40px;
        }

        .titulo_name{
            font-size: 37px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }


        .texto_trasero{
            font-size:11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            line-height: 14px;
            color: #3d3b3a;
        }

        .texto_trasero3{
            font-size:11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #3d3b3a;
        }

        .texto_trasero4{
            font-size:10px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            color: #2c6d77;
        }

        .img_firmas_delanteras{
            width: 160px;
        }

        /* .img_logo{
            width: 110px;
            height: 110px;
            margin-left: auto;
            margin-right: auto;
        } */

        .img_logo {
            width: 110px;  /* Tamaño máximo permitido */
            height: 110px;
            margin-left: auto;
            margin-right: auto;
        }

        .img_logo img {
            max-width: 100%;  /* Evita que la imagen se estire */
            max-height: 100%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
        }

    </style>
</head>
<body>

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
                @php
                    echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',3.8,3.8) . '" style=""   />';
                @endphp
            </div>

            <div class="row">
                <div class="col-12  border ">
                    <p class="certificado_titulo text-end">
                        CERTIFICADO ANTE EL REGISTRO NACIONAL <br>
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-8 text-center border ">
                    <h1 class="azul_fuerte titulo_name p-0" style="margin-top: 20px;margin-left:150px;">  ACUERDO LEGAL
                    </h1>
                </div>

                <div class="col-4 text-center border ">

                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border" >
                    <p class="texto_trasero uppercase" style="padding:0px 45px 0px 45px;">
                        <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                        <br><br>
                        Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                        <br><br>
                        Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                        <br><br>
                        Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro:{{ $clave_rfc }}
                        <br><br>
                        XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016, mismo momento en que lo autorizo definitivamente.- Doy fe.
                        <br><br>
                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border  m-0"  >
                    <h1 class="azul_fuerte titulo_especialidad_trasero " style="padding:0px 45px 0px 45px;">
                        {{ ucwords(strtolower($curso)) }}
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border m-0 p-0" >
                    <p class="texto_trasero3 uppercase m-0" style="padding:0px 45px 0px 45px;">
                        este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

            <div class="row">

                <div class="row">
                    <div class="col-4 text-center border ">
                        <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras" style="margin-top: 30px">
                        <h3 class="h3_nomre_firmas uppercase m-0 p-0">Juan Pablo Soto</h3>
                        <h5 class="texto_emosires m-0 p-0">Comite Dictaminador <br> RNIMNAS</h5>
                    </div>

                    <div class="col-4 text-center border ">
                        <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                        <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                        <h5 class="texto_emosires m-0 p-0">Directora General <br> IMNAS</h5>
                    </div>

                    <div class="col-4 text-center border ">
                        <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras" style="margin-top: 30px">
                        <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Ma. Luisa Flores</h3>
                        <h5 class="texto_emosires m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border  m-0"  >
                    <p class="texto_trasero4" style="padding:0px 45px 0px 45px;">
                        CALLE SUR 109-A No. 260, COL. HEROES DE CHURUBUSCO. DEL. IZTAPALAPA. CIUDAD DE MEXICO. CP.09090 <br>
                        (55) 54459315, (55) 56468832, (55) 43367085, (55) 43367086, (55) 55323297, (55) 55329757 <br>
                        www.imnasmexico.com <br>
                        ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                </div>
            </div>

        </div>
    </div>

</body>
</html>
