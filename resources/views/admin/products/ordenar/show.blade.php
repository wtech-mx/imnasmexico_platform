@extends('layouts.app_admin')

@section('template_title')
Productos solicitados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('notas_productos.update', $pedido->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Fecha</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="datetime" class="form-control" value="{{ $pedido->fecha_pedido }}">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <br>
                                        <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $pedido->id) }}">
                                            <i class="fa fa-file"></i> Descargar PDF
                                        </a>
                                    </div>

                                    <div class="col-2">
                                        <br>
                                        <a class="btn btn-xs btn-warning text-white" target="_blank" href="{{ route('productos_stock.imprimir', $pedido->id) }}">
                                            <i class="fa fa-file"></i> Liga para aprobar
                                        </a>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <h5 style="color:#836262"><strong>Productos solicitados</strong> </h5>
                                    </div>
                                    @foreach ($pedido_productos as  $productos)
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" value="{{ $productos->Products->nombre }}" disabled>
                                            </div>

                                            <div class="form-group col-2">
                                                <label>Stock Actual</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" class="form-control" value="{{ $productos->stock_anterior }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <label>Cantidad solicitada</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" class="form-control" value="{{ $productos->cantidad_pedido }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <label>Cantidad recibida</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="text" id="cantidad_recibido[]" name="cantidad_recibido[]" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group col-2">
                                                <h4 for="name">Quitar</h4>
                                                <div class="input-group mb-3">
                                                    <button type="button" class="btn btn-danger btn-sm eliminarCampo3" data-id="{{ $productos->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
