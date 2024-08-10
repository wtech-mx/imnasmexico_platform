<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formato de Registro para Afiliación a Registro IMNAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">


  </head>
  <body>

    <style>

        body{
            background-color: #5a0421 ;
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

        <div class="col-12 mb-3">
            <h3 class="text-white"> <strong>Formato de Registro para Afiliación a Registro IMNAS</strong> <br>
                Por favor, complete la siguiente información para completar su proceso de afiliación.
            </h3>
        </div>


        <div class="col-12">
            <div class="card p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="row">
                            <h4 class="text-left mt-3 mb-3">Datos Personales del Afiliado</h4>
                            <div class="col-12 form-group">
                                <label for="name">Nombre</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label for="name">Dirección</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="direccion" name="direccion" type="text" class="form-control" value="{{$user->direccion}}">
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="name">Ciudad</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="city" name="city" type="text" class="form-control" value="{{$user->city}}">
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="name">Estado</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="state" name="state" type="text" class="form-control" value="{{$user->state}}">
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="name">Codigo Postal</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="postcode" name="postcode" type="text" class="form-control" value="{{$user->postcode}}">
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="name">Pais</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="country" name="country" type="text" class="form-control" value="{{$user->country}}">
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="name">Telefono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="telefono" name="telefono" type="text" class="form-control" value="{{$user->telefono}}">
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label for="name">Correo Electronico</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="email" name="email" type="email" class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                        </div>
                        <h6 class="text-left">Firma:  </h6>


                            <form method="POST" action="#" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div id="sig"></div>

                                <textarea id="signed" name="signed" style="display: none"></textarea>

                                <h6 class="text-left mt-3 mb-3">Nombre Completo: <br> </h6>

                                <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                                <button class="btn btn-sm btn-success">Guardar</button>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>



	<script type="text/javascript" class="init">

        $(document).ready(function(){
            $('#example').DataTable();
            $('#historial').DataTable();

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
