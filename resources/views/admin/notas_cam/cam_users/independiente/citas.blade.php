<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checklist Evaluador Indepedneinte</title>
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

    </style>

    <section class="row">

            <div class="row">
                <div class="col-0 col-md-3 col-lg-3"></div>
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="row">
                        <div class="col-4 mb-5">
                            <h5 class="">
                                <img src="{{asset('assets/user/logotipos/cam.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                            </h5>
                        </div>

                        <div class="col-8 mt-4 text-center">
                            <h4 class=""><b>PROGRAMA DE CITAS</b></h4> <br>
                            <h4 style="color: #009ee3">EVALUADOR INDEPENDIENTE</h4>
                        </div>

                        <form method="POST" class="row" action="{{ route('independiente.citas', $cliente->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="col-6">
                                <label for="name"><b>Nombre *</b></label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{$cliente->name}}" readonly>

                                <label for="name"><b>Telefono *</b></label>
                                <input id="telefono" name="telefono" type="text" class="form-control" placeholder="Telefono" required value="{{$cliente->telefono}}" readonly>
                            </div>

                            <div class="col-6 mt-5 text-center">
                                <h4><b>FECHA PROGRAMADA</b></h4>
                            </div>

                            <div class="col-8 mt-5">

                                <p>
                                    •	1. Evaluación del EC0076.<br><br>
                                    •	2. Evaluación de los Estándares afines.<br><br>
                                    •	3. Refuerzo de transferencia de conocimiento
                                    y operatividad.<br><br>
                                    •	4. Refuerzo de llenado de formato.<br><br>
                                    Nota: Se puede agendar una sola fecha para
                                    que se imparta el punto 3 y 4.<br><br>
                                    •	5. Coaching empresarial.<br><br>
                                    •	6. Entrega de carpeta CAM y formatos
                                    (Fecha sujeta a avance de alineaciones y
                                    evaluaciones).<br><br>
                                </p>

                            </div>

                            <div class="col-4 mt-5">
                                <input id="evaluacion_ec0076" name="evaluacion_ec0076" type="date" class="form-control" value="{{$cita_cam->evaluacion_ec0076}}" required><br>

                                <input id="evaluacion_afines" name="evaluacion_afines" type="date" class="form-control" value="{{$cita_cam->evaluacion_afines}}" required><br>

                                <input id="refuerzo_conocimiento" name="refuerzo_conocimiento" type="date" class="form-control" value="{{$cita_cam->refuerzo_conocimiento}}" required><br>

                                <input id="refuerzo_formatos" name="refuerzo_formatos" type="date" class="form-control" value="{{$cita_cam->refuerzo_formatos}}" required><br>

                                <input id="coaching_empresarial" name="coaching_empresarial" type="date" class="form-control" value="{{$cita_cam->coaching_empresarial}}" required><br>

                                <input id="carpeta_cam" name="carpeta_cam" type="date" class="form-control" value="{{$cita_cam->carpeta_cam}}" required><br>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <p class="text-left"> <strong>FIRMA</strong></p>
                                </div>
                            </div>

                            <div class="col-6">
                                @if ($cita_cam->firma == NULL)
                                    <div id="sig"></div>
                                    <textarea id="signed" name="signed" style="display: none"></textarea>

                                    <button id="clear" class="btn btn-sm btn-danger ">Repetir Firma</button>
                                @else
                                    <img src="{{asset('documentos/'. $cliente->telefono . '/' .$cita_cam->firma) }}" alt="" width="50%">
                                @endif

                                @if ($cita_cam->firma == NULL)
                                     <button type="submit" class="btn btn-sm btn-success">Guardar firma</button>
                                @endif
                            </div>


                        </form>

                        </div>
                    </div>

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
            var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});

            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signed").val('');
            });
        });

    </script>

  </body>
</html>
