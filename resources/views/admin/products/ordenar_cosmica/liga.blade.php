<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aprobar pedido para laboratorio</title>
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


            <div class="row">
                <div class="col-12 mt-3">
                    <h2 class="">
                        Aprobar pedido para laboratorio
                    </h2>
                    <hr>


                    <div class="col-12 mt-5">
                        <h5 style="color:#836262"><strong>Productos solicitados</strong> </h5>
                    </div>
                    @foreach ($pedido_productos as  $productos)
                        <div class="row">
                            <div class="col-12">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" value="{{ $productos->Products->nombre }}" disabled>
                            </div>

                            <div class="form-group col-6">
                                <label>Stock Actual</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                    </span>
                                    <input type="number" class="form-control" value="{{ $productos->stock_anterior }}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label>Cantidad solicitada</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                    </span>
                                    <input type="number" class="form-control" value="{{ $productos->cantidad_pedido }}" disabled>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-12">
                           <p class="text-left"> <strong>FIRMA</strong></p>
                        </div>

                        <form method="POST" class="row" action="{{ route('ordenes_nas_update.firma', $pedido->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="col-12">

                            @if($pedido->firma)

                                <p class="text-center">
                                    <img id="blah" src="{{asset('firma_pedidos/' .$pedido->firma   ) }}" alt="Imagen" style="width: 100%;height: auto;"/><br>
                                </p>

                            @else
                                <div id="sig"></div>
                                <textarea id="signed" name="signed" style="display: none"></textarea>
                                <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                                <button class="btn btn-sm btn-success">Aprobar pedido</button>

                            @endif

                            </div>
                        </form>
                    </div>

                </div>
            </div>


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
