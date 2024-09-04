<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carta Compromiso Evaluador Indepedneinte</title>
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
                <div class="col-0 col-md-3 col-lg-3"></div>
                <div class="col-12 col-md-6 col-lg-6">

                    <form method="POST" class="row" action="{{ route('independiente.carta', $cliente->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">

                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <p>Ciudad de México a <input id="fecha_carta" name="fecha_carta" type="date" class="form-control underline-input" required value="{{$notas_cam->fecha_carta}}"></p>
                                </div>

                            </div>

                            <div class="col-12">

                                <h5 class="">
                                    LIC. CARLA RIZO FLORES <br>
                                    ENCARGADA DE LA ENTIDAD <br>
                                    ECE356-18 <br> <br>
                                    CARTA COMPROMISO
                                </h5>

                                <h4>Presente</h4>

                                <p>
                                    Por este conducto manifiesto que yo <input id="nombre" name="nombre" type="text" class="form-control underline-input" required value="{{$cliente->name}}">, <br>
                                    me comprometo a establecer los siguientes mecanismos para asegurar la excelencia en la atención  y servicio a usuarios:
                                </p>

                                <p>
                                    •	Contar con los precios diferenciados de capacitación, evaluación y certificación, de manera clara. <br> <br><br>
                                    •	Tener en redes sociales de manera clara y visible para los usuarios, la dirección de la página de internet, número telefónico de Evaluador Independiente, la Entidad de Certificación y Evaluación Instituto Mexicano Naturales Ain Spa y del CONOCER. <br> <br><br>
                                    •	Brindar información detallada, suficiente, clara y veraz de cada fase del proceso de evaluación – certificación. <br> <br><br>
                                    •	Brindar un trato respetuoso y digno a los usuarios, a la Entidad de Certificación y Evaluación Instituto Mexicano Naturales Ain Spa y al CONOCER. <br> <br><br>
                                    •	Dar respuesta a las dudas de los usuarios, así como a las quejas y sugerencias en un plazo no mayor de 3 días naturales. <br> <br><br>
                                    •	Las asesorías y diagnósticos serán gratuitos y no condicionaran la contratación de servicio alguno. <br> <br><br>
                                    •	Mantener estricta confidencialidad de la información otorgada por los usuarios. <br> <br><br>
                                    •	Mantener registros de la información de los usuarios, de los procesos de evaluación realizados, en trámite y finalizados. <br> <br><br>
                                    •	Contar con procedimientos de atención, resolución y documentación de quejas. <br> <br><br>
                                    •	Atender las observaciones realizadas por la ECE y el CONOCER. <br> <br><br>
                                    •	Mantener firme observancia de los estatutos tanto de la Entidad de Certificación y Evaluación Instituto Mexicano Naturales Ain Spa y del CONOCER. <br> <br><br>
                                    •	Una vez acreditado como Evaluador Independiente no podré, utilizar el logo de CONOCER, ni el logo de CONOCER para Evaluador Independiente, ni mi clave de registro CONOCER para realizar reconocimientos o Certificados, ya que la única dependencia que expide con estas características CERTIFICADOS OFICIALES es el CONOCER. <br> <br>
                                    <br>
                                    Sin otro particular por el momento, aprovecho la ocasión para enviarle un cordial saludo.

                                </p>

                            </div>

                            <div class="row">

                                <div class="col-12">
                                <p class="text-left"> <strong>FIRMA</strong></p>
                                </div>

                                    </div>

                                    <div class="col-6">
                                        @if ($notas_cam->firma_carta == NULL)
                                            <div id="sig2"></div>
                                            <textarea id="signed2" name="signed2" style="display: none"></textarea>
                                            <button id="clear2" class="btn btn-sm btn-danger ">Repetir Firma</button>
                                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                        @else
                                            <img src="{{asset('documentos/'. $cliente->telefono . '/' .$notas_cam->firma_carta) }}" alt="" width="50%">
                                        @endif
                                    </div>

                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-0 col-md-3 col-lg-3"></div>
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
