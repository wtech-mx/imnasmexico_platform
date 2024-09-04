<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contrato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://paradisus.mx/assets/css/jquery.signature.css">


  </head>
  <body>

    <style>

        body{
            background-color: #fff;
            padding: 30px;
        }

        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}

        .tab-pane{
            padding: 15px 15px 15px 15px;
        }
        .custom_col{

        }
        .icon-bar {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 10;
        right: 0;
        }

        .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        }

        .icon-bar a:hover {
        background-color: #000;
        }
        .content {
        margin-left: 75px;
        font-size: 30px;
        }

        .facebook {
        background: #D7819D;
        color: white;
        }

        @media only screen and (max-width: 450px) {
            .text-res {
            font-size: 12px
        }
        }

        .underline-input {
            border: none; /* Elimina el borde del input */
            border-bottom: 1px solid black; /* Agrega una línea inferior */
            width: 300px; /* Ajusta el ancho del input, cámbialo según lo necesites */
            outline: none; /* Elimina el contorno al hacer clic */
            padding: 5px 0; /* Ajusta el espacio interior */
            font-size: 16px; /* Tamaño de la fuente */
            background: none; /* Elimina el fondo */
            display: inline-block; /* Asegura que el input esté en línea con el texto */
            vertical-align: middle; /* Alinea el input verticalmente al medio del texto */
        }

        .underline-input::placeholder {
            color: grey; /* Cambia el color del texto del placeholder */
        }
    </style>

    <section class="row">

            <div class="row">
                <div class="col-0 col-md-2 col-lg-3"></div>
                <div class="col-12 col-md-8 col-lg-6">

                <form method="POST" class="row" action="{{ route('independiente.contrato', $cliente->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="row">

                        <div class="col-12">

                            <h6 class="text-justify" style="">
                                CONTRATO DE ACREDITACIÓN DEL “EVALUADOR INDEPENDIENTE”, QUE CELEBRAN POR UNA
                                PARTE, EL INSTITUTO MEXICANO NATURALES AIN SPA S. C., A QUIEN EN LO SUCESIVO SE
                                DENOMINARÁ <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, REPRESENTADO POR LA
                                LIC. CLAUDIA CARLA RIZO FLORES, EN SU CARÁCTER DE APODERADO GENERAL, Y POR LA OTRA PARTE, A QUIÉN EN LO SUCESIVO SE DENOMINARÁ EL “EVALUADOR INDEPENDIENTE”
                                REPRESENTADA POR EL C. <input id="nombre" name="nombre" type="text" class="form-control underline-input" placeholder="Nombre" required value="{{$contrato_cam->nombre}}">, EN SU CARÁCTER DE
                                PERSONA JURIDICA, AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:
                            </h6>

                            <h4 class="text-center">D E C L A R A C I O N E S</h4>

                            <p class="text-justify">
                                <strong> 1	DECLARA LA <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> QUE: </strong>
                                <br><br> 1.1	Es una Sociedad Civil constituida de conformidad con las leyes mexicanas, según consta en la Escritura Pública Libro Mil noventa y dos, Instrumento Treinta y cuatro mil quinientos, otorgada ante la fe del Titular de la Notaría Pública No. 244 de la Ciudad de México, el Licenciado Celso de Jesús Pola Castillo.
                                <br><br> 1.2	Su representante, en su carácter de representante legal, cuenta con facultades suficientes para obligarse en los términos del presente Contrato, mismas que a la fecha no le han sido revocadas ni limitadas en forma alguna, lo que acredita con la Escritura Pública Libro Mil noventa y dos, Instrumento Treinta y cuatro mil quinientos, otorgada ante la fe del Titular de la Notaría Pública No. 244 de la Ciudad de México, el Licenciado Celso de Jesús Pola Castillo. (O en cualquier otro instrumento jurídico).
                                <br><br> 1.3	Conoce las Reglas Generales y Criterios para la Integración y Operación del Sistema Nacional de Competencias vigentes, en lo sucesivo “Reglas Generales”, y demás disposiciones que de ellas se derivan, las cuales se agregan al presente Contrato para formar parte de este como Anexo I; las funciones y objetivos del “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, y en su caso los Estándares de Competencia en los que tiene interés de acreditarse. En tal virtud es una Entidad de Certificación e imparte cursos de capacitación con base a Estándares de Competencia inscritos en el Registro Nacional de Estándares de Competencia.
                                <br><br> 1.4	Tiene su domicilio para los efectos legales que se deriven del presente instrumento, en Sur 109-A No. 260. Col. Héroes de Churubusco. Alcaldía Iztapalapa, Ciudad de México, México. CP 09090, previamente verificada su existencia por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.
                                <br><br>
                                <strong>2	DECLARA EL “EVALUADOR INDEPENDIENTE” QUE:</strong>

                                2.1	Es una persona física con datos generales: <input id="dato_general" name="dato_general" type="text" class="form-control underline-input" required value="{{$contrato_cam->dato_general}}">, <strong>CON RFC</strong> <input id="rfc" name="rfc" type="text" class="form-control underline-input" required value="{{$contrato_cam->rfc}}"> <strong>con vigencia 2024-2025.  CON IDENTIFICACIÓN OFICIAL</strong> <input id="identificacion_ofi" name="identificacion_ofi" type="text" class="form-control underline-input" required value="{{$contrato_cam->identificacion_ofi}}">.
                                <br><br>
                                2.2	Se representa a sí mismo en pleno uso de sus facultades mentales y capacidades de respuesta legal.
                                <br><br>
                                2.3	Conoce las Reglas Generales y Criterios para la Integración y Operación del Sistema Nacional de Competencias vigentes, en lo sucesivo “Reglas Generales”, y demás disposiciones que de ellas se derivan, las cuales se agregan al presente Contrato para formar parte de este como Anexo I; las funciones y objetivos del Consejo Nacional de Certificación de Competencias Laborales, en lo sucesivo el “CONOCER”, y en su caso los “Estándares de Competencia” en los que está acreditado. En tal virtud se encuentra acreditada como “EVALUADOR INDEPENDIENTE”a efecto de apoyar y auxiliar al “CONOCER” en evaluar y certificar la competencia de las personas con base a Estándares de Competencia inscritos en el Registro Nacional de Estándares de Competencia.
                                <br><br>
                                2.4	Tiene su domicilio para los efectos legales que se deriven del presente instrumento, en <input id="domicilio" name="domicilio" type="text" class="form-control underline-input" required value="{{$contrato_cam->domicilio}}">.
                                <br><br>
                                3.1	<strong>DECLARAN AMBAS PARTES QUE:</strong> La suscripción del presente Contrato no es garantía alguna sobre el nivel de ingresos del “EVALUADOR INDEPENDIENTE”, el cual acepta desde ahora que esto será de su única y exclusiva responsabilidad.
                                <br> 3.2	De conformidad con las declaraciones anteriores se reconocen la personalidad jurídica y la capacidad legal que ostentan, y con fundamento en los artículos 47, 48 Fracción III, y 66 de las “Reglas Generales”, de común acuerdo convienen en suscribir el presente Contrato, al tenor de las siguientes:
                                <br>
                            </p>

                            <h4 class="text-center">D E C L A R A C I O N E S</h4>

                            <p>
                                <strong>PRIMERA. DEFINICIONES:</strong> Para todos los efectos legales derivados del presente Contrato, las partes se apegarán a las definiciones establecidas en las "Reglas Generales" vigentes y demás disposiciones que de ellas se deriven y resulten aplicables vigentes.

                                <strong>SEGUNDA. OBJETO.</strong><br><br>

                                2.1	La <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> otorga en este acto al
                                <strong>“EVALUADOR INDEPENDIENTE”</strong> la acreditación para fungir como <strong>“EVALUADOR INDEPENDIENTE”</strong> del
                                Sistema Nacional de Competencias que promueve, coordina y regula a nivel nacional el “CONOCER”, lo
                                que faculta contractualmente al “EVALUADOR INDEPENDIENTE” para evaluar, con fines de certificación,
                                las competencias de las personas y en su caso impartir cursos de capacitación con base en un determinado
                                Estándar de Competencia inscrito en el Registro Nacional de Estándares de Competencia del “CONOCER”,
                                de conformidad con las “Reglas Generales” y demás disposiciones que de ellas se deriven.
                                En caso de cualquier acreditación y/o renovación en Estándares de Competencia posteriores a la firma del presente
                                Contrato, la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, de conformidad con las
                                “Reglas Generales” y demás disposiciones que de ellas se deriven, solicitará al CONOCER la autorización
                                de la acreditación y/o renovación del “EVALUADOR INDEPENDIENTE”, la cual quedará en su caso
                                formalizado mediante la emisión de la cédula de acreditación correspondiente que emita la propia <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.
                                <br><br>
                                2.2	El “EVALUADOR INDEPENDIENTE” tendrá derechos y obligaciones derivados de su acreditación, conforme a lo estipulado en el presente Contrato, así como lo establecido en las “Reglas Generales” y demás disposiciones que de ellas se deriven.
                                <br><br>
                                <strong>3	TERCERA. CONTRAPRESTACIONES </strong>
                                <br><br>
                                3.1	Como contraprestación por las cuotas que el “EVALUADOR INDEPENDIENTE” pague por sus
                                acreditaciones y durante su operación de acuerdo con los montos establecidos por la <strong>“ECE356-18
                                INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, y descritos en el ANEXO III del presente contrato
                                se proporcionará, de conformidad con las “Reglas Generales” y demás disposiciones que de ellas se deriven,
                                los servicios que de manera enunciativa más no limitativa, se mencionan en el Numeral 4.1 de la Cláusula
                                Cuarta de este Contrato, y le otorgará el uso de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO),
                                lo que da derecho a utilizar la denominación <strong>“EVALUADOR INDEPENDIENTE”</strong>, de conformidad con el “Manual de
                                Identidad Institucional Red CONOCER de Prestadores de Servicios”, el cual se adjunta como <strong>Anexo II</strong> a este Contrato
                                formando parte integral del mismo.
                                <br><br>
                                3.2	El “EVALUADOR INDEPENDIENTE” cubrirá a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>,
                                a la fecha de la suscripción del presente Contrato, su Cuota de Acreditación Inicial. Los demás pagos
                                por conceptos de cuotas descritas en el ANEXO III del presente contrato se cubrirán de manera anticipada
                                a la  de acuerdo con lo establecido en las disposiciones
                                y procedimientos previsto por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.
                                <br><br>
                                3.3	Los productos y servicios que ofrezca la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>
                                podrán ser objeto del pago de cuotas, previa notificación y acuerdo de dicha circunstancia al
                                “EVALUADOR INDEPENDIENTE”.
                                <br><br>
                                3.4	Ninguno de los pagos que en virtud del presente Contrato realice el “EVALUADOR INDEPENDIENTE”
                                a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, serán reembolsables por ninguna causa o circunstancia.
                                <br><br>
                                3.5	El “EVALUADOR INDEPENDIENTE” no está facultado para retener por ninguna causa o circunstancia pagos
                                a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>
                                <br><br>
                                3.6	El “EVALUADOR INDEPENDIENTE” deberà presentar la auditoría anual obligada por el conocer y prevista en
                                las reglas generales de operaciòn y auditorías internas realizadas por
                                <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con el fin de garantizar los estàndares de Calidad inherentes al ejercicio referido en el Anexo III.

                            </p>

                            <h4 class="text-center">ANEXO III CONTRAPRESTACIONES AL CONTRATO</h4>

                            <table class="table">

                                <tbody>
                                <tr>
                                    <td>CONCEPTO</td>
                                    <td>COSTO</td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            RENOVACIÓN ANUAL DE “EVALUADOR INDEPENDIENTE”DIAMANTE
                                        </p>
                                    </td>
                                    <td>$9,750.00</td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            EMISIÓN DEL CERTIFICADO
                                        </p>
                                    </td>
                                    <td>
                                        $900,00
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            COSTO DE ESTÁNDAR 1 A 5
                                        </p>
                                    </td>

                                    <td>
                                        $3,000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            AUDITORÍA CONOCER DENTRO DE CDMX
                                        </p>
                                    </td>
                                    <td>
                                        $1,000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            AUDITORÍA AL INTERIOR DE LA REPÚBLICA
                                        </p>
                                    </td>
                                    <td>
                                        $3,000,00 + VIÁTICOS POR CADA REPRESENTANTE DE LA ENTIDAD QUE ASISTA
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="text-left">
                                            RENOVACION DE ESTANDARES
                                        </p>
                                    </td>

                                    <td>
                                        BENEFICIO NO HAY PAGO
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <h4 class="text-center">CUARTA. OBLIGACIONES DE LA <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong></h4>

                            <p>

                                4.1	Son obligaciones de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> las siguientes: <br>
                                <br><br>a)	Proporcionar los Estándares de Competencia relacionados con las acreditaciones que se otorguen al “EVALUADOR INDEPENDIENTE” y, en su caso, los Instrumentos de Evaluación de Competencias correspondientes, para su uso y aprovechamiento en la forma convenida en este Contrato, mediante la entrega de un ejemplar contenido en medio escrito o electrónico; <br>
                                <br><br>b)	Poner a disposición del “EVALUADOR INDEPENDIENTE”, las herramientas tales como: manuales de operación y mecanismos de capacitación, que lo apoyen en los procesos de inducción y capacitación sobre la operación del Sistema Nacional de Competencias, así como la normatividad que establezca el "CONOCER" y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> para asegurar la calidad de operación y servicio a usuarios; <br>
                                <br><br>c)	Proporcionar, a solicitud expresa del “EVALUADOR INDEPENDIENTE”, asesoría para su adecuada operación en el Sistema Nacional de Competencias; <br>
                                <br><br>d)	Supervisar y/o auditar la operación y servicio a usuarios del “EVALUADOR INDEPENDIENTE”, con base en los lineamientos que establezca el “CONOCER” y la propia <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con base en las "Reglas Generales" y normatividad derivada y, para que se mantengan las condiciones que dieron lugar a la acreditación inicial, y
                                <br><br>e)	Hacer del conocimiento del “EVALUADOR INDEPENDIENTE”, los sistemas de cómputo y los aspectos técnicos requeridos para la adecuada operación y conexión con la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y el “CONOCER”.<br>
                                <br><br>
                                <strong>QUINTA. OBLIGACIONES DEL “EVALUADOR INDEPENDIENTE”.</strong>
                                <br><br>
                                5.1.	El “EVALUADOR INDEPENDIENTE” reconoce y acepta que está obligado a operar de acuerdo con lo dispuesto en este Contrato, las “Reglas Generales”, y demás disposiciones vigentes que de ellas se deriven y que sean establecidos por el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en el ámbito del Sistema Nacional de Competencias, los cuales forman parte integrante de este acuerdo de voluntades.
                                <br><br>
                                5.2.	El “EVALUADOR INDEPENDIENTE” también se obliga a:<br>
                                <br><br> a)	Cumplir con todas las obligaciones que establecen las “Reglas Generales” y demás disposiciones que de ellas se deriven, en caso de terminación sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> o de rescisión del presente Contrato;
                                <br><br> b)	Abstenerse de realizar conductas, acciones o cualquier acto doloso o ilícito que dañen la imagen del “CONOCER”, del Sistema Nacional de Competencias, de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) o de la Marca CONOCER (Y DISEÑO), así como de la Marca <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> (Y DISEÑO);
                                <br><br> c)	Cumplir con el pago de las cuotas descritas en el ANEXO III del presente contrato a que esté obligado , conforme a lo establecido en las disposiciones y procedimientos previstos por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y la Cláusula Tercera de este Contrato;
                                <br><br> d)	Tramitar ante la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, conforme a lo establecido en las “Reglas Generales” y demás disposiciones que de ellas se deriven, el registro de sus Evaluadores que tenga acreditados;
                                <br><br> e)	Atender los aspectos de equipamiento e imagen del “EVALUADOR INDEPENDIENTE”, relacionados en el Manual de Identidad Institucional Red CONOCER de Prestadores de Servicios proporcionado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br> f)	Informar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> la actualización del registro de sus Evaluadores cuando la acreditación en Estándares de Competencia de éstos se renueve o sean diferentes a los acreditados inicialmente. Asimismo, cuando el “EVALUADOR INDEPENDIENTE” solicite nuevas acreditaciones o renueve la acreditación de Estándares de Competencia, deberá informar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> los cambios, movimientos y sustitución del personal vinculado con las funciones de evaluación, verificación y con todas aquellas relacionadas con el aseguramiento de la calidad en la operación y servicio a usuarios, de conformidad con lo establecido en las “Reglas Generales” y demás disposiciones que de ellas se deriven;
                                <br><br> g)	Informar a sus Evaluadores respecto de las nuevas acreditaciones, renovaciones y vencimientos de acreditaciones, en Estándares de Competencia, en un periodo máximo de 10 (diez) días hábiles después de que hayan ocurrido;
                                <br><br> h)	Realizar ante la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> todos los trámites derivados de la terminación anticipada de la acreditación de sus Evaluadores, de conformidad con lo establecido en las “Reglas Generales” y demás disposiciones que de ellas se deriven;
                                <br><br> i)	Guardar y proteger, los Instrumentos de Evaluación de Competencia que le entregue la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y verificar su correcta aplicación;
                                <br><br> j)	Llevar a cabo los actos necesarios para lograr su vinculación, con los sistemas del “CONOCER” y la red informática de operación del Sistema Nacional de Competencias conforme se vayan desarrollando y actualizando;
                                <br><br> k)	Informar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, así como actualizar y resguardar con confidencialidad, seguridad y control a través del “”, en cumplimiento a la normatividad en materia de transparencia e información vigente, los registros de las personas en proceso de evaluación y de aquellas que lo hayan concluido independientemente del juicio de competencia obtenido (competente o todavía no competente), así como de las que hayan obtenido su certificado de competencia. El “EVALUADOR INDEPENDIENTE” deberá mantener siempre un respaldo actualizado de esta información en sus instalaciones;


                                <br><br>l)	Cumplir con los niveles de servicio para atención a los usuarios del Sistema Nacional de Competencias y sus Evaluadores, de acuerdo con los estándares de operación y servicio que el “CONOCER” y al <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> establezcan en la normatividad vigente;
                                <br><br>m)	Informar a los usuarios del derecho a que tienen para comunicarse directamente con el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, a través de los canales de comunicación establecidos por el mismo;
                                <br><br>n)	Cumplir con todos los mecanismos que el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> establezcan para garantizar la calidad y la estandarización de la operación y servicio a usuarios del “EVALUADOR INDEPENDIENTE” (tales como supervisiones y/o auditorías anuales realizadas por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y en su caso por el “CONOCER”), de conformidad con lo establecido en las “Reglas Generales” y demás disposiciones que de ellas se deriven.
                                <br><br>o)	Asegurar y garantizar la correcta operación de sus funciones como que acrediten, conforme a lo que establezca el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br>p)	Contar con canales abiertos de comunicación para consultar y permitir opinar a los usuarios del Sistema Nacional de Competencias tanto en el “EVALUADOR INDEPENDIENTE”. Estos canales de comunicación deben también permitir la interacción directa de los usuarios con el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, y q) Permitir a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y en su caso al “CONOCER” la realización de supervisiones y/o auditorías conforme a lo que se establece en las “Reglas Generales” y demás disposiciones que de ellas se deriven.

                                <br><br> 5.3.	“EVALUADOR INDEPENDIENTE” deberá abstenerse de realizar las prohibiciones señaladas en las “Reglas Generales”.

                                <br><br> 5.4.	El “EVALUADOR INDEPENDIENTE” acepta que las funciones de capacitación y evaluación de la competencia de un usuario, referidas a un mismo Estándar de Competencia inscrito en el Registro Nacional de Estándares de Competencia del “CONOCER”, serán realizadas por personas físicas diferentes en relación con un mismo usuario.

                                <br><br> 5.5.	El “EVALUADOR INDEPENDIENTE”, manifiesta que es legítimo titular de su Nombre, Marca y/o Diseño y acepta que la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> pueda usarlos en forma gratuita para que ser publicados en el sitio de internet de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con el objeto de dar cumplimiento a los fines del Sistema Nacional de Competencias. Debiendo el “EVALUADOR INDEPENDIENTE” informar por escrito a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, de cualquier procedimiento que en su momento el primero decida iniciar ante el Instituto Mexicano de la Propiedad Industrial (IMPI) para el registro de su Nombre, Marca y/o Diseño. Por lo que el “EVALUADOR INDEPENDIENTE” exenta a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> de cubrir al primero alguna contraprestación, obligándose el primero a salir en defensa de este último para el caso de que algún tercero pretenda disputar la titularidad de dicho Registro de Nombre, Marca y/o Diseño o en el evento de algún procedimiento de carácter judicial o administrativo.



                                <br><br>
                                <strong>SEXTA. USO DE LA MARCA.</strong>
                                <br><br>

                                6.1.	El “CONOCER”, otorgó a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> mediante el contrato de acreditación como Entidad de Certificación y Evaluación suscrito en Noviembre del 2018 y durante su vigencia, a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> una licencia no exclusiva para usar la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO)”, con número de Registro 1239212 inscrito ante el Instituto Mexicano de la Propiedad Industrial (IMPI). La licencia de uso de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) otorgada en el contrato de acreditación mencionado en el párrafo anterior autoriza a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y a sus “EVALUADOR INDEPENDIENTE”acreditado a utilizarla conforme a las siguientes especificaciones:
                                <br><br> 6.1.1.	La licencia de uso de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) que se otorga en virtud del presente Contrato, se refiere exclusivamente a que el “EVALUADOR INDEPENDIENTE” la utilice de conformidad a los términos, lineamientos y especificaciones establecidas en el Manual de Identidad Institucional Red CONOCER de Prestadores de Servicios, expedido por el “CONOCER”.
                                <br><br> 6.1.2.	El “EVALUADOR INDEPENDIENTE” tiene estrictamente prohibido utilizar y explotar de cualquier manera la Marca CONOCER (Y DISEÑO), excepto para los fines de evaluación de las competencias de las personas de conformidad con lo establecido en las Cláusulas Segunda y Quinta del presente contrato y artículo 13 de la Ley de la Propiedad Industrial.
                                <br><br> 6.1.3.	 El “CONOCER”, en su calidad de único titular de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO), asume toda la responsabilidad en caso de que ésta o su uso llegara a invadir o violar derechos de propiedad industrial de terceros.
                                <br><br> 6.1.4.	Con respecto al uso de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO), el “EVALUADOR INDEPENDIENTE” se obliga a:
                                <br><br> a)	Utilizar la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) de la manera establecida en el Manual de Identidad Institucional Red CONOCER de Prestadores de Servicios;
                                <br><br> b)	Utilizar la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) sólo en relación con la acreditación otorgada, así como con fines publicitarios del mismo y su uso no podrá extenderse más allá de la duración del presente Contrato. Expresamente conviene en cesar de inmediato el uso de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) a la conclusión del presente Contrato por cualquier causa;
                                <br><br> c)	Notificar de inmediato al “CONOCER” de cualquier infracción o uso no autorizado de la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) o de cualquier demanda por parte de alguna persona física o moral, con relación a cualquier derecho sobre ésta, y
                                <br><br> 6.1.5.	El “EVALUADOR INDEPENDIENTE” expresamente acepta que no podrá, directa o indirectamente, disputar la validez o el título de propiedad del “CONOCER” sobre la Marca CONOCER (Y DISEÑO) y la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO) en México y en ninguna parte del mundo, por lo que tampoco podrá intentar su registro en ningún país.
                                <br><br> 6.1.6.	El “CONOCER”, se reserva el derecho de sustituir o modificar la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO), así como en cualquier momento podrá desarrollar nuevas marcas, por lo que una vez que obtenga su registro correspondiente ante el IMPI, si así lo considera conveniente, las nuevas marcas las hará del conocimiento de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y esta a su vez al “EVALUADOR INDEPENDIENTE” quedando obligado a aplicarlas, para lo cual el “CONOCER”, en su caso, otorgará a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> la licencia de uso correspondiente; asimismo, el “EVALUADOR INDEPENDIENTE” cumplirá con todas las obligaciones relativas al uso de la Marca y Diseño previstas en este Contrato. En el caso de sustitución o modificación de marca la asumirá el “EVALUADOR INDEPENDIENTE” en un plazo de 60 (sesenta) días naturales, contados a partir de la notificación hecha por el “CONOCER” a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.

                                <br><br> 6.7.	El “EVALUADOR INDEPENDIENTE” se obliga a que concluida la relación contractual con la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> por cualquier causa, se abstendrá de utilizar y/o comercializar servicios a través de marcas similares a las utilizadas por el “CONOCER”.
                                <br><br>
                                <strong>SÉPTIMA. INFORMACIÓN CONFIDENCIAL.</strong>
                                <br><br>
                                <br> 7.1.	Toda la información confidencial a que se refiere la presente Cláusula constituye secreto industrial, en términos de lo dispuesto por la Ley de la Propiedad Industrial.
                                <br><br>
                                <br> 7.2.	El “EVALUADOR INDEPENDIENTE” deberá tomar las medidas que aseguren el cumplimiento de la normatividad en materia de transparencia e información vigente, respecto a la información derivada de los procesos de acreditación inicial, acreditación de Evaluadores, evaluación, verificación, aseguramiento de la calidad en la operación y servicio a usuarios, dictamen y la información sobre otras Entidades de Certificación y Evaluación, Organismos Certificadores, Centros de Evaluación y Evaluadores, así como toda aquella que tenga que ver con la operación del Sistema Nacional de Competencias sean de carácter estrictamente confidencial. La confidencialidad antes citada también será aplicable a los procesos de capacitación y evaluación de competencias de personas que se lleven a cabo en el “EVALUADOR INDEPENDIENTE”.
                                <br>
                                <br><br> 7.3.	El “EVALUADOR INDEPENDIENTE” se obliga a guardar estricta confidencialidad respecto a toda la documentación o información que reciba de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y/o el “CONOCER” los cuales deberán ser conservados por éste en la más estricta confidencialidad, y solamente podrá divulgar a cualquier tercero, con el previo consentimiento de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y/o el “CONOCER”.
                                <br><br>
                                7.4.	Si el “EVALUADOR INDEPENDIENTE” se viese obligado a divulgar dicha información y documentos por disposición de ley y ordenamiento judicial, podrá hacerlo después de:
                                <br><br>a)	Notificar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> a la brevedad posible la necesidad de revelación de dicha información, la naturaleza de la misma y las personas a las que será divulgada
                                <br><br>b)	Entregar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> un escrito en el que se identifique la información y documentos requeridos y la amplitud de la divulgación exigida;
                                <br><br>c)	Otorgar al “CONOCER” a través de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> la oportunidad para obtener una orden preventiva de dispensa, a su costa, o hacer comentarios a la misma, con el propósito de adecuar la información y documentos que deban de ser divulgados en forma satisfactoria a lo establecido en la ley aplicable y en su caso permitirle tomar al “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> las medidas que considere conducentes, y
                                <br><br>d)	El “EVALUADOR INDEPENDIENTE”, una vez compelido judicialmente a efectuar dicha revelación, deberá coadyuvar con el “CONOCER” y en su caso la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> ya sea judicialmente o por cualquier otro medio que éste considere necesario, para la debida protección de los intereses involucrados en dicha información confidencial y que pudieran ser perjudicados de alguna manera.

                                <br><br>7.5.	La información y documentos confidenciales que se proporcionen al “EVALUADOR INDEPENDIENTE” por el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> seguirán siendo propiedad según corresponda del “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>; El “EVALUADOR INDEPENDIENTE” no adquirirá derecho alguno sobre dicha información y documentos, lo anterior, no obstante, las obligaciones y responsabilidades que contrae por medio del presente Contrato.
                                <br><br>
                                <br><br>7.6.	Para efectos del presente acuerdo de confidencialidad, los términos información y documentos confidenciales significarán aquella información escrita, gráfica o contenida en medios electrónicos, incluyendo de manera enunciativa más no limitativa, información jurídica, técnica, financiera, económica y de cualquier otra índole o propuestas de operaciones de negocios, reportes, planes, proyectos, datos y cualquier otra información transmitida directa o indirectamente por el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, o su personal, así como análisis, documentos de trabajo, compilaciones, comparaciones, estudios u otros documentos preparados por el “CONOCER”, la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> o por terceras partes para el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>. Los términos, información y documentos confidenciales no incluirán información que pasen a ser información normalmente disponible al público en general siempre y cuando no haya sido producto de una divulgación no autorizada al “EVALUADOR INDEPENDIENTE”,; sea o haya sido independientemente desarrollada o adquirida por alguna parte sin violar la presente Cláusula; que sea expresamente autorizada por escrito por el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, y la información oral que no esté de otra forma transcrita e identificada expresamente por escrito como confidencial por la parte que la proporcione.
                                <br>
                                <br><br>7.7.	Las partes acuerdan expresamente que a partir de la fecha de firma del presente Contrato, toda la información que la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> proporcionó al “EVALUADOR INDEPENDIENTE” para la tramitación de su acreditación, se considerará también como información y documentos confidenciales.
                                <br>

                                <br><br>
                                <strong>OCTAVA. PUBLICIDAD.</strong>
                                <br><br>

                                8.1.	Además de la publicidad o promoción que el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> realicen para la difusión del Sistema Nacional de Competencias, el “EVALUADOR INDEPENDIENTE” desarrollará, conforme a sus posibilidades, periódicamente programas y campañas de publicidad, promoción y difusión a su cargo, dirigidos a dar a conocer los distintos servicios que ofrece en materia de evaluación y certificación de competencias, así como los que hagan referencia a la Marca Red CONOCER de Prestadores de Servicios (Y DISEÑO), deberán cumplir con la normatividad interna aplicable del "CONOCER" y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y serán por cuenta del “EVALUADOR INDEPENDIENTE”
                                <br><br>
                                <strong>NOVENA. VIGENCIA.</strong>
                                <br><br>
                                9.1.	El presente Contrato entrará en vigor en la fecha de su firma.
                                <br>    <br>9.2.	Las partes acuerdan que el presente Contrato tendrá una vigencia de 1 (un) año, contados a partir del día de su firma. Asimismo, se conviene que, al término del año de vigencia de este Contrato, éste se podrá renovar automáticamente sin necesidad de suscribirlo de nueva cuenta, salvo que el “EVALUADOR INDEPENDIENTE” solicite por escrito la no renovación del mismo. En el caso de que la renovación del contrato se proceda el “EVALUADOR INDEPENDIENTE” tendrá la obligación de cubrir la Cuota Acreditación Inicial descrita en el ANEXO III del presente contrato que corresponda según lo establezca la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>. La renovación automática del Contrato de acreditación sólo podrá realizarse si el “EVALUADOR INDEPENDIENTE” no cuenta con hallazgos derivados de supervisiones y/o auditorías realizadas a las mismas o en proceso de atención de los mismos, así como cumple con todos los requerimientos que para estos efectos establezca el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en la normatividad correspondiente.
                                <br><br>9.3.	La vigencia de la acreditación en Estándares de Competencia será hasta por un año y en caso de que el “EVALUADOR INDEPENDIENTE” decida renovarla, deberá cubrir las cuotas que establezca la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> descritas en el ANEXO III del presente contrato  y cumplir con los requisitos previstos en las “Reglas Generales” y demás disposiciones que de ellas se deriven, así como con todos los requerimientos que para estos efectos establezca el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en la normatividad correspondiente.
                                <br><br>
                                <strong>DÉCIMA. PENAS CONVENCIONALES.</strong>
                                <br>

                                <br><br>10.1.	En caso de incumplimiento de su parte, el “EVALUADOR INDEPENDIENTE” reconoce y acepta expresamente el derecho de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> para imponer las penas convencionales y las medidas correctivas estipuladas en la presente Cláusula.
                                <br><br>10.2.	Para el caso de que el “EVALUADOR INDEPENDIENTE” incurra en algún incumplimiento no grave sujeto a pena convencional, la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> emitirá por escrito una amonestación describiendo el incumplimiento y fijándole un plazo para la atención y solución del mismo, el cual será determinado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con base en la naturaleza del incumplimiento y los tiempos de resolución descritos en el ANEXO IV del presente contrato. En caso de que el “EVALUADOR INDEPENDIENTE” acredite fehacientemente ante la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> que ha solucionado debidamente el incumplimiento no grave en el plazo fijado, no se le aplicará ninguna pena convencional económica. En caso de que el “EVALUADOR INDEPENDIENTE” no solucione el incumplimiento no grave en el plazo fijado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, en el ANEXO IV del presente contrato se le aplicará una pena convencional equivalente al 10% del total de las cuotas pagadas por contraprestación descritas en el presente contrato y sus respectivos anexos que el “EVALUADOR INDEPENDIENTE” hubiera realizado a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en los últimos 12 meses anteriores a la fecha de la amonestación y se le fijará un nuevo plazo, el cual será determinado de acuerdo al ANEXO IV del presente contrato por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con base en la naturaleza del incumplimiento. En caso de que el “EVALUADOR INDEPENDIENTE” no solucione el incumplimiento en el segundo plazo fijado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, y descrito en el ANEXO IV del presente contrato se le aplicará adicionalmente al 10% señalado en el párrafo anterior, una pena convencional equivalente al 15% del total de los pagos que el “EVALUADOR INDEPENDIENTE” hubiera realizado a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en los últimos 12 meses anteriores a la fecha de la amonestación y quedarán suspendidas sus operaciones hasta que solucione debidamente el incumplimiento que haya dado origen a la suspensión, siempre y cuando la suspensión no exceda de 3 (tres) meses, de lo contrario, si excediera de dicho plazo, dará lugar a la terminación inmediata del presente Contrato, operando ésta de pleno derecho y sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.
                                Se consideran incumplimientos no graves sujetos a penas convencionales los siguientes:
                                <br><br>a)	Continuar operando como “EVALUADOR INDEPENDIENTE”, sin haber recibido por escrito por parte de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, la renovación anual de su acreditación correspondiente a cada uno de los Estándares de Competencia que tenga acreditados;
                                <br><br>b)	La violación al Numeral 5.4 de la Cláusula Quinta del presente Contrato, por sí mismo o por sus Evaluadores;
                                <br><br>c)	La violación a las fracciones I, II, III, IV, V y VI del Artículo 50 de las “Reglas Generales”, por sí mismo;
                                <br><br>d)	No aplicar los mecanismos de aseguramiento de la calidad en la operación y servicio a usuarios establecidos por el “CONOCER” y la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, así como omitir vigilar o supervisar su aplicación;
                                <br><br>e)	Que el “EVALUADOR INDEPENDIENTE” realice funciones de evaluación de competencias con Evaluadores que no cumpla con los requerimientos establecidos en la Fracción V del artículo 45 de las “Reglas Generales”;
                                <br><br>f)	No atender y resolver las quejas de los usuarios;
                                <br><br>g)	No cumplir con los mecanismos de aseguramiento de la calidad en la operación y servicio a usuarios que establezca el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, así como omitir vigilar o supervisar su aplicación por el “EVALUADOR INDEPENDIENTE”, y;
                                <br><br>h)	No desarrollar periódicamente programas y campañas de publicidad, promoción y difusión a su cargo en términos del Contrato y normatividad aplicable.
                                <br><br>
                                <br>10.3.	Para el caso de que el “EVALUADOR INDEPENDIENTE” incurra en algún incumplimiento grave por primera vez, la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> emitirá por escrito una amonestación describiendo el incumplimiento grave y fijando un plazo para la atención y solución del mismo, el cual será determinado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> con base en la naturaleza del incumplimiento y con base en lo descrito en el ANEXO IV del presente contrato. En caso de que el “EVALUADOR INDEPENDIENTE” acredite fehacientemente ante la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> que ha solucionado el incumplimiento grave en el plazo fijado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, no se le aplicará ninguna pena convencional económica. En caso de que el “EVALUADOR INDEPENDIENTE” no solucione el incumplimiento grave en el plazo fijado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> descrito en el ANEXO IV del presente contrato, se le aplicará una pena  equivalente al 25% del total de las cuotas pagadas por contraprestación descritas en el presente contrato y sus respectivos anexos que el “EVALUADOR INDEPENDIENTE” hubiera realizado a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en los últimos 12 meses anteriores a la fecha de la amonestación y dará lugar a la terminación inmediata del presente Contrato, operando ésta de pleno derecho y sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.

                                <br><br>10.4.	Se consideran incumplimientos graves por parte del “EVALUADOR INDEPENDIENTE” cuando se encuentre en los supuestos siguientes:
                                <br><br>a)	Cuando el "CONOCER" y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> detecten que durante los trámites para su acreditación inicial, renovación de acreditación, acreditación y renovación de estándares de competencia, así como lo relacionado con la acreditación de Evaluadores, el “EVALUADOR INDEPENDIENTE” haya proporcionado o proporcione información y/o documentación falsa;
                                <br><br>b)	En caso de que el “EVALUADOR INDEPENDIENTE” ceda, transmita, enajene, venda, done, grave o de cualquier otra forma afecte sus obligaciones y/o derechos derivados directa o indirectamente del presente Contrato;
                                <br><br>c)	Sublicenciar a terceros el uso de la MARCA Red CONOCER de Prestadores de Servicios (Y DISEÑO) materia del presente Contrato;
                                <br><br>d)	No contar con las autorizaciones que le sean requeridas por el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> en términos de este Contrato y de las “Reglas Generales” y demás disposiciones que de ellas se deriven o de cualquier otra disposición legal aplicable, para la operación como “EVALUADOR INDEPENDIENTE”;
                                <br><br>e)	La violación a la Cláusula de Información Confidencial por sí;
                                <br><br>f)	Si el “EVALUADOR INDEPENDIENTE” hace uso no autorizado o indebido de las MARCAS, y/o de la imagen institucional del “CONOCER” y/o <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, que en su caso se le proporcionen en relación con su operación como “EVALUADOR INDEPENDIENTE”, sin contar para ello con la aprobación previa, expresa y por escrito del “CONOCER” y/o <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br>g)	Si el “EVALUADOR INDEPENDIENTE” realiza cualquier conducta, acción o acto doloso o ilícito que dañe la imagen del “CONOCER”, del Sistema Nacional de Competencias, de las Marcas CONOCER (Y DISEÑO), Red CONOCER de Prestadores de Servicios (Y DISEÑO) y la Marca <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> (Y DISEÑO);
                                <br><br>h)	Dar un uso o destino distinto al autorizado al “EVALUADOR INDEPENDIENTE” o comercializar indebidamente los servicios referidos en este Contrato aprovechando su calidad de “EVALUADOR INDEPENDIENTE”;
                                <br><br>i)	Iniciar la operación como “EVALUADOR INDEPENDIENTE” sin haber recibido por escrito la Acreditación Inicial y la correspondiente al estándar o estándares correspondientes por parte de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br>j)	La reincidencia en la omisión en el pago de las cuotas que se establezca la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br>k)	Si el “EVALUADOR INDEPENDIENTE” impide o intenta impedir de cualquier manera la realización de alguna auditoría y/o supervisión por parte del “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, ya sea al “EVALUADOR INDEPENDIENTE” o a cualquiera de los Evaluadores acreditados por el mismo, y
                                <br><br>l)	Cuando socios, directivos o personal del “EVALUADOR INDEPENDIENTE” intente realizar o realicen actos constitutivos de delitos o que vayan en contra de la moral o buenas costumbres en las instalaciones del “CONOCER” y/o <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>. Por cada incumplimiento o incumplimientos graves o no graves que se refieran a una misma causal y que sean, o no, originados por hechos distintos será aplicada la misma pena convencional que corresponda. Se aplicarán diferentes penas convencionales al “EVALUADOR INDEPENDIENTE” cuando incurra en incumplimientos diversos aún y cuando deriven de un mismo hecho. La <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> podrá realizar las notificaciones al “EVALUADOR INDEPENDIENTE”, relativas a la presente Cláusula por la vía judicial a través de los Tribunales competentes.

                                <br><br>
                                <strong>DÉCIMA PRIMERA. TERMINACIÓN ANTICIPADA POR PARTE DE LA <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>. </strong>
                                <br><br>

                                <br>11.1.	La <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> podrá dar por terminado el presente Contrato sin responsabilidad alguna de su parte, en los siguientes casos:
                                <br><br>a)	Por mutuo consentimiento de las partes;
                                <br><br>b)	Por la falta del pago de la cuota de renovación de la acreditación como “EVALUADOR INDEPENDIENTE”y/o de Estándares de competencia, y
                                <br><br>c)	En caso de liquidación o extinción de cualquiera de las partes, con excepción del caso de quiebra.

                                <br><br>
                                <strong>DÉCIMA SEGUNDA. RESCISIÓN POR PARTE DEL <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>.</strong>
                                <br><br>

                                12.1.	La <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, sin responsabilidad alguna y sin necesidad de declaración judicial, podrá, asimismo, rescindir o terminar este Contrato sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> cuando el “EVALUADOR INDEPENDIENTE” se coloque en alguno de los siguientes supuestos:

                                <br><br>a)	Si cualquiera de sus accionistas o directivos fuera condenado penalmente por autoridad competente por delito grave;
                                <br><br>b)	Si fuere declarado en suspensión de pagos, concurso mercantil o liquidación;
                                <br><br>c)	En caso de que su domicilio social o centro de servicios sea clausurado, embargado o intervenido por cualquier autoridad administrativa o jurisdiccional, con motivo de la comisión de irregularidades graves que afecten la operación del “EVALUADOR INDEPENDIENTE” o deterioren el prestigio del “CONOCER”, la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y/o del Sistema Nacional de Competencias;
                                <br><br>d)	Pierda por cualquier causa, la posesión o el dominio del inmueble donde se ubica su domicilio social o centro de servicios;
                                <br><br>e)	Si por cualquier causa se diese por terminado en forma anticipada el contrato de arrendamiento del local en el que se instale su domicilio social o centro de servicios por causas imputables al “EVALUADOR INDEPENDIENTE” y en un plazo de 60 (sesenta) días hábiles éste no encuentre un nuevo establecimiento aprobado por la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, ya sea por razones operativas o de propiedad del inmueble;
                                <br><br>f)	En caso de que al surgir legal o ilícitamente una huelga de sus trabajadores o al concluir ésta, no informe a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> dentro del término que se establece en el Numeral 13.3 de la Cláusula Décima Tercera de este Contrato, y
                                <br><br>g)	En caso de que el “EVALUADOR INDEPENDIENTE” sea sancionado por la autoridad administrativa correspondiente o condenada por la autoridad jurisdiccional competente, por utilizar programas de cómputo en violación a lo dispuesto por la Ley Federal de Derechos de Autor.

                                <br><br>12.2.	En caso de rescisión o terminación sin responsabilidad para <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> del presente Contrato por parte de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, el “EVALUADOR INDEPENDIENTE” se obliga a:
                                <br><br>a)	No operar procedimientos de evaluación y/o capacitación inherente a evaluación con fines de Certificación a partir de la fecha en que tenga conocimiento de la determinación de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>:de recesión del presente contrato sin responsabilidad para  <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>Todos aquellos que se encuentren en curso deberá, si son derivados de procesos de evaluación y/o capacitación realizados por el “EVALUADOR INDEPENDIENTE”, asignarlos a otro “EVALUADOR INDEPENDIENTE”; si derivan de procesos de evaluación llevados a cabo por sus Evaluadores acreditados, asignarlos, con acuerdo de éstos, a otro “EVALUADOR INDEPENDIENTE” previa autorización de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>;
                                <br><br>b)	Elaborar un informe de entrega;
                                <br><br>c)	Entregar a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> los registros documentales o electrónicos de las acreditaciones y evaluaciones por el “EVALUADOR INDEPENDIENTE” durante todos sus años de operación;
                                <br><br>d)	Liquidar, en su caso, los pagos pendientes en favor de la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>; sobre las cuotas descritas en el ANEXO III del presente contrato.
                                <br><br>e)	Cesar de inmediato el uso de la Marca Red “CONOCER” de Prestadores de Servicios (Y DISEÑO), retirando en un plazo que no exceda de 48 (cuarenta y ocho) horas, cualquier señalamiento que la contenga, a excepción de los procedimientos en trámite o la publicidad previa a ésta fecha;
                                <br><br>f)	Notificar a los Evaluadores acreditados, la rescisión o terminación sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> del presente Contrato e informar de esta notificación a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> dentro de los 5 (cinco) días hábiles posteriores;
                                <br><br>g)	Responsabilizarse ante sus usuarios, por los daños y perjuicios ocasionados por la rescisión o terminación sin responsabilidad para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> del presente Contrato.

                                <br>12.3.	El “EVALUADOR INDEPENDIENTE” permitirá el acceso a sus instalaciones a personal del “CONOCER” y/o <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>, así como a personal de apoyo externo contratado por el “CONOCER” y/o " <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong>; para que comprueben el adecuado cumplimiento de todas las obligaciones estipuladas en el presente Contrato.
                                <br><br>
                                <strong>DÉCIMA TERCERA. CONFLICTOS DE INTERÉS.</strong>
                                <br><br>

                                13.1.	El “EVALUADOR INDEPENDIENTE”, acuerda que es de su entera responsabilidad establecer los procesos y/o sistemas necesarios para prevenir conflictos de interés en la prestación de sus servicios dentro del Sistema Nacional de Competencias, de tal suerte que en este acto se obliga a resolver cualquier conflicto de esa naturaleza que su actuar provoque y pagar los daños y perjuicios que ello genere. Esa responsabilidad, incluye de manera enunciativa pero no limitativa su conducta en todo lo relacionado con: libre acceso, calidad en el servicio, transparencia, imparcialidad, objetividad u algún otro factor que afecte a cualquier participante del Sistema Nacional de Competencias y/o a los usuarios a través de los servicios que proporciona en el marco del Sistema Nacional de Competencias.

                                <br><br>
                                <strong>DÉCIMA CUARTA. INDEPENDENCIA DE LOS CONTRATANTES.</strong>
                                <br>

                                <br><br>14.1.	Ambas partes aceptan que son contratantes independientes y que la celebración del presente Contrato no convierte a ninguna de las partes en agente, representante, mandatario, socio, empleado o dependiente de la otra. Por lo que ninguna de las partes tendrá ninguna responsabilidad laboral frente a los trabajadores de la otra parte.

                                <br><br>14.2.	Ninguna de las partes tendrá la facultad de contratar, obligarse o de cualquier forma involucrar a la otra en ningún tipo de operación, excepto en los casos de programas de publicidad, en los cuales el “CONOCER” y/o la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> actuarán en su nombre y en el de todas las Entidades de Certificación y Evaluación, Organismos Certificadores, Centros de Evaluación y Evaluadores del Sistema Nacional de Competencias y previo acuerdo mutuo por escrito de las partes.

                                <br><br>14.3.	Ninguna de las partes podrá utilizar el nombre de la otra a fin de garantizar el cumplimiento de sus propias obligaciones, a no ser que medie consentimiento previo, expreso y por escrito de ambas partes.

                                <br><br>14.4.	Los pagos de todos los gastos que se generen por la operación del “EVALUADOR INDEPENDIENTE”, así como todos los impuestos que se deriven del presente Contrato, serán responsabilidad exclusiva del mismo y no podrá deducir de los pagos que deba hacer a la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> ninguna cantidad que haya pagado o que deba pagar a terceros, incluyendo impuestos.

                                <br><br>14.5.	Las partes serán responsables de todas y cada una de sus respectivas obligaciones fiscales, mercantiles, civiles, penales y en relación con las leyes de protección al consumidor que se deriven de la operación del mismo en materia de este Contrato, así como de cualquier otro concepto relacionado con éste.

                                <strong>DÉCIMA QUINTA. NOTIFICACIONES.</strong>

                                <br><br>15.1.	Toda notificación que deba enviar una parte a la otra deberá ser por escrito con el acuse de recibo correspondiente y dirigirse a los domicilios señalados en el Numeral 1.4 para la <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> y en el Numeral 2.4 para el “EVALUADOR INDEPENDIENTE”, del apartado de Declaraciones. En caso de que alguna de las partes cambie de domicilio y no lo informe a la otra parte, la notificación se realizará en el último que tengan registrado.

                                <br><br>15.2.	Se considerará hecha toda notificación que por escrito se entregue en los domicilios indicados y que sea recibida en el área de recepción de documentación de las

                                <br><br>15.3.	La <strong>“ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”</strong> podrá llevar a cabo las notificaciones por la vía judicial a través de los Tribunales competentes.

                                <strong>DÉCIMA SEXTA. CASO FORTUITO O FUERZA MAYOR.</strong>

                                <br><br>16.1.	Queda expresamente pactado que las partes no tendrán responsabilidad alguna por daños o perjuicios que pudieran causarse por el incumplimiento total o parcial del presente Contrato, como consecuencia de caso fortuito o de fuerza mayor, entendiéndose por ello todo acontecimiento presente o futuro, ya sea fenómeno de la naturaleza o hecho del hombre, que esté fuera del dominio de la voluntad o que no pueda preverse y aun previéndolo, no se pueda evitar, en tanto persista la causa que la motivó.

                                <br><br>16.2.	Ante la presencia de un caso fortuito o de fuerza mayor, que impida el cumplimiento de obligaciones que deriven del presente Contrato, las partes convienen no responsabilizarse mutuamente, para lo cual la parte que se encuentre en este supuesto, deberá dar aviso a la otra a la brevedad que la situación generada por el hecho fortuito o de fuerza mayor se lo permita, sin que exceda de 30 (treinta) días naturales posteriores a la presentación del caso fortuito o de fuerza mayor. En caso de que las partes no den aviso de la existencia de un caso fortuito o de fuerza mayor, su omisión equivaldrá a la aceptación expresa de su responsabilidad en términos de lo dispuesto por el artículo 2111 del Código Civil Federal.

                                <br><br>
                                <strong>DÉCIMA SÉPTIMA. LEGISLACIÓN APLICABLE, JURISDICCIÓN Y REGISTRO.</strong>
                                <br>
                                <br>17.1.	Las partes manifiestan que el presente Contrato es producto de su buena fe, por lo que realizarán todas las acciones posibles para su acatamiento y los casos no previstos en el mismo se resolverán conforme a lo establecido en las “Reglas Generales”, pero en caso de presentarse alguna discrepancia sobre su interpretación o cumplimiento, se someterán a la jurisdicción de los Tribunales Federales de la Ciudad de México, Distrito Federal, renunciando desde ahora a cualquier otro fuero que por razón de su domicilio presente o futuro, les pudiera corresponder.
                            </p>

                            <h6 class="text-justify" style="">
                                EN TESTIMONIO DE LO CUAL LAS PARTES:
                                POR LA “ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.”LA C. CLAUDIA CARLA RIZO FLORES Y  POR EL “EVALUADOR INDEPENDIENTE” C.<input id="nombre" name="nombre" type="text" class="form-control underline-input" required value="{{$contrato_cam->nombre}}">.

                                <br>ENTERADAS DEL CONTENIDO Y ALCANCE LEGAL DEL PRESENTE CONTRATO, LO FIRMAN POR DUPLICADO EN LA CIUDAD DE MÉXICO, DISTRITO FEDERAL, EL DÍA <input id="fecha" name="fecha" type="date" class="form-control underline-input" required value="{{$contrato_cam->fecha}}">.
                                INSTITUTO MEXICANO NATURALES AIN SPA S. C.”LA C. CLAUDIA CARLA RIZO FLORES Y  POR EL “EVALUADOR INDEPENDIENTE” C. <input id="nombre" name="nombre" type="text" class="form-control underline-input" required value="{{$contrato_cam->nombre}}">.
                            </h6>

                        </div>

                        <div class="row">
                            <div class="col-12">
                               <p class="text-left"> <strong>FIRMAS</strong></p>
                            </div>

                            <form method="POST" class="row" action="" enctype="multipart/form-data" role="form">
                                @csrf


                                </div>

                                <div class="col-6">
                                    @if ($contrato_cam->firma == NULL)
                                        <div id="sig2"></div>
                                        <textarea id="signed2" name="signed2" style="display: none"></textarea>
                                        <h6 class="text-left mt-3 mb-3">
                                            FIRMA <br>
                                            “EVALUADOR INDEPENDIENTE”
                                        </h6>
                                        <button id="clear2" class="btn btn-sm btn-danger ">Repetir Firma</button>
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                    @else
                                        <img src="{{asset('documentos/'. $cliente->telefono . '/' .$contrato_cam->firma) }}" alt="" width="50%">
                                        <h6 class="text-left mt-3 mb-3">
                                            FIRMA <br>
                                            “EVALUADOR INDEPENDIENTE”
                                        </h6>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <img src="" alt="">
                                    <h6 class="text-left mt-3 mb-3">
                                        LIC. CLAUDIA CARLA RIZO FLORES <br>
                                        TITULAR ECE356-18 INSTITUTO MEXICANO NATURALES AIN SPA S. C.
                                    </h6>
                                </div>

                            </form>
                            <div class="col-12">
                                {{-- <p class="mt-4"><strong>Fecha:</strong></p> --}}
                            </div>
                        </div>
                    </div>
                </form>

                </div>
                <div class="col-0 col-md-2 col-lg-3"></div>
            </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://paradisus.mx/assets/js/jquery.signature.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

	<script type="text/javascript" class="init">

        $(document).ready(function(){
            $('#example').DataTable();
            $('#historial').DataTable();

            var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});
            var sig2 = $('#sig2').signature({syncField: '#signed2', syncFormat: 'PNG'});

            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signed").val('');
            });

            $('#clear2').click(function (e) {
                e.preventDefault();
                sig2.signature('clear');
                $("#signed2").val('');
            });


        });

    </script>

  </body>
</html>
