@extends('layouts.app_admin')

@section('template_title')
Productos solicitados Cosmica
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="mi-formulario" method="POST" action="{{ route('ordenes_cosmica_update.orden', $pedido->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>Productos solicitados Cosmica</h2>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6">
                                        <label for="name">Fecha</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->translatedFormat('d F Y h:i a') }}">
                                        </div>
                                    </div>

                                    @if ($pedido->estatus != 'Realizado')
                                        <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                            <br>
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock_cosmica.imprimir', $pedido->id) }}">
                                                <i class="fa fa-file"></i> Descargar PDF
                                            </a>
                                        </div>
                                    @endif
                                    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                        <br>
                                        <a class="btn my-auto btn-success text-white" target="_blank" href="{{ route('ordenes_cosmica.firma', $pedido->id) }}">
                                            <i class="fa fa-file"></i> Liga para aprobar
                                        </a>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <h5 style="color:#836262"><strong>Productos solicitados</strong> </h5>
                                    </div>
                                    @foreach ($pedido_productos as $productos)
                                        <div class="row producto-item" id="producto_{{ $productos->id }}" style="background: #f9f9f9;border-radius: 10px;margin: 5px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);margin-bottom: 1rem !important;padding: 10px 0 0 0;">
                                            <input type="hidden" name="id_pedido[]" value="{{ $productos->id_pedido }}">
                                            <input type="hidden" name="id_producto[]" value="{{ $productos->id_producto }}">
                                            <input type="hidden" name="eliminar_producto[]" value="0" id="eliminar_producto_{{ $productos->id }}">

                                            <div class="form-group col-12 col-sm-4 col-md-3 col-lg-3">
                                                <label>Nombre</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ $productos->Products->imagenes }}" alt="" width="35px">
                                                    </span>
                                                    <input type="text" class="form-control" value="{{ $productos->Products->nombre }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-6 col-sm-4 col-md-3 col-lg-2">
                                                <label>Stock Actuals</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/almacenamiento.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" class="form-control" value="{{ $productos->Products->stock }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-6 col-sm-4 col-md-3 col-lg-2">
                                                <label>Cantidad solicitada</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/solicitante.png') }}" alt="" width="35px">
                                                    </span>
                                                    @if ($pedido->estatus == 'Realizado')
                                                        <input type="number" id="cantidad_pedido[]" name="cantidad_pedido[]" class="form-control" value="{{ $productos->cantidad_pedido }}">
                                                    @else
                                                        <input type="number" id="cantidad_pedido[]" name="cantidad_pedido[]" class="form-control" value="{{ $productos->cantidad_pedido }}" readonly>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-6 col-sm-4 col-md-3 col-lg-2">
                                                <label>Restantes</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/paquete-o-empaquetar.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" class="form-control" value="{{ $productos->cantidad_restante }}" readonly>
                                                </div>
                                            </div>

                                            @if ($pedido->estatus == 'Confirmado')
                                            <div class="form-group col-6 col-sm-4 col-md-3 col-lg-2">
                                                <label>Laboratorio Restantes</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/limpieza.png') }}" alt="" width="35px">
                                                        </span>
                                                            <input type="text" id="cantidad_entregada_lab[]" name="cantidad_entregada_lab[]" class="form-control" value="{{ $productos->cantidad_entregada_lab }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($pedido->estatus != 'Finalizado')
                                            <div class="form-group col-5  col-sm-4 col-md-3 col-lg-2">
                                                <label>Cantidad recibida</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/cajas-de-carga-de-trabajador.png') }}" alt="" width="35px">
                                                        </span>
                                                        @if ($pedido->estatus == 'Realizado')
                                                            <input type="text" id="cantidad_recibido[]" name="cantidad_recibido[]" class="form-control" readonly>
                                                        @else
                                                            <input type="text" id="cantidad_recibido[]" name="cantidad_recibido[]" class="form-control">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($pedido->estatus == 'Realizado')
                                                <div class="form-group col-1">
                                                    <h4 for="name">-</h4>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-danger btn-sm eliminarCampo3" data-id="{{ $productos->id }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            @if ($pedido->estatus != 'Finalizado')
                                <div class="modal-footer">
                                    <button type="submit" class="btn close-modal" id="guardar-btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script>
    $(document).ready(function() {
        $('.eliminarCampo3').on('click', function() {
            var productoId = $(this).data('id');

            // Oculta la fila del producto
            $('#producto_' + productoId).hide();

            // Marca el producto como "eliminado" para que se procese al guardar
            $('#eliminar_producto_' + productoId).val(1);
        });
    });

    document.getElementById('guardar-btn').addEventListener('click', function() {
        // Cambiar el texto y deshabilitar el botón
        this.disabled = true;
        this.style.backgroundColor = '#ccc';
        this.innerText = 'Guardando...';

        // Enviar el formulario
        document.getElementById('mi-formulario').submit();
    });
</script>
@endsection
