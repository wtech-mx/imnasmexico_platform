@extends('layouts.app_admin')

@section('template_title')
Productos Autorizadoa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('ordenes_lab_update.update', $pedido->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h2>Productos Autorizados NAS</h2>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="name">Fecha</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha" name="fecha" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->translatedFormat('d F Y h:i a') }}">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <h5 style="color:#836262"><strong>Productos solicitados</strong> </h5>
                                    </div>
                                    @foreach ($pedido_productos as $productos)
                                        <div class="row producto-item" id="producto_{{ $productos->id }}" style="">
                                            <input type="hidden" name="id_pedido[]" value="{{ $productos->id_pedido }}">
                                            <input type="hidden" name="id_producto[]" value="{{ $productos->id_producto }}">

                                            <div class="form-group col-12">
                                                <label>Nombre</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ $productos->Products->imagenes }}" alt="" width="35px">
                                                    </span>
                                                    <input type="text" class="form-control" value="{{ $productos->Products->nombre }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Stock Actual</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/almacenamiento.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="stock_nas[]" name="stock_nas[]" class="form-control" value="{{ $productos->Products->stock_nas }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Cantidad solicitada</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/solicitante.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="cantidad_pedido[]" name="cantidad_pedido[]" class="form-control" value="{{ $productos->cantidad_pedido }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Cantidad que se entrega</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/limpieza.png') }}" alt="" width="35px">
                                                    </span>
                                                    @if ($pedido->estatus_lab == 'Finalizado')
                                                    <input type="number" id="cantidad_entrega[]" name="cantidad_entrega[]" class="form-control" disabled>
                                                    @else
                                                    <input type="number" id="cantidad_entrega[]" name="cantidad_entrega[]" class="form-control" >
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-3 mb-5">
                                                <label>Restantes</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/paquete-o-empaquetar.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input type="number" id="cantidad_entregada_lab[]" name="cantidad_entregada_lab[]" class="form-control" value="{{ $productos->cantidad_entregada_lab }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            @if ($pedido->estatus_lab != 'Finalizado')
                                <div class="modal-footer">
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
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
</script>
@endsection
