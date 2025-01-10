<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tira </title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/credencial/'
                : 'documentos_nuevos/credencial/';
    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .border {
            border: 1px solid #000;
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
            font-size: 18px;
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

    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-3 text-center border p-2" style="margin-top: 30px">
                <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width: 130px">
            </div>

            <div class="col-3 text-center border p-2" style="margin-top: 30px">
                <img class=" " src="{{ $basePath . 'logo.png'}}" style="width: 100px">
            </div>

            <div class="col-3 text-center border p-2" style="margin-top: 30px">
                <img class=" " src="{{ $basePath . 'stps.webp'}}" style="width: 130px">
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
                    <div class="oval" style="">
                    </div>
                </div>

                <h6 class="azul_claro folio uppercase  p-0" style="margin-top: 20px">
                    folio
                </h6>

                <h6 class="azul_claro folio_num uppercase m-0 p-0">
                    CFC000918771
                </h6>
            </div>

            <div class="col-8 text-start border p-2">
                <h6 class="uppercase titulo_cedula m-0 p-0">
                    REGISTRO NACIONAL
                </h6>
                <h5 class="uppercase subtitulo_cedula  m-0 p-0">
                    INSTITUTO MEXICANO NATURALES AIN SPA
                </h5>
                <p class="texto_principal_cedula" style="margin-bottom: 40px">
                    La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del
                     Registro Nacional Instituto Mexicano Naturales Ain Spa RIIMNAS,
                     con registro <strong class="texto_prinipal_strong"> RIFC-680910-879-0013</strong> en la Secretaría del Trabajo y Previsión
                     Social STPS como Agente Capacitador Externo, hace constar que el/la
                      Alumno(a), con número de folio <strong class="texto_prinipal_strong">CFC000918771</strong> con
                       CURP: <strong class="texto_prinipal_strong">JDAR090213MMCMLTA4</strong> , cursó la especialidad de <strong class="texto_prinipal_strong">Cosmiatría y Cosmetología</strong> ,
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
            <div class="col-12 text-center border p-2">
                Columna 12
            </div>

        </div>

    </div>

</body>
</html>
