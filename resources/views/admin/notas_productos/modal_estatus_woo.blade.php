<!-- Modal -->
<div class="modal fade" id="estatus_woo_{{ $order->id }}" tabindex="-1" aria-labelledby="estatus_woo_{{ $order->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="estatus_woo_{{ $order->id }}Label">Editar Pedido #{{ $order->id }} de {{ $order->billing->first_name }} {{ $order->billing->last_name }}</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <form action="{{ route('orders.updateStatuWoo', $order->id) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <select name="status" id="estatus_woo_{{ $order->id }}" class="form-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completado</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                        <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Fallido</option>
                            <!-- Nuevos estados personalizados -->
                        <option value="guia_cargada" {{ $order->status == 'guia_cargada' ? 'selected' : '' }}>Guía Cargada</option>
                        <option value="en_preparacion" {{ $order->status == 'en_preparacion' ? 'selected' : '' }}>En Preparación</option>
                        <option value="preparados" {{ $order->status == 'preparados' ? 'selected' : '' }}>Preparados</option>
                        <option value="enviados" {{ $order->status == 'enviados' ? 'selected' : '' }}>Enviados</option>
                    </select>
                </div>
                <!-- Campo de archivo oculto inicialmente -->
                <div class="col-12 mt-3 mb-3" id="file-upload" >
                    <label for="attachment">Cargar archivo (guía, documento, etc.):</label>
                    <input type="file" name="guia_de_envio" class="form-control">
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-success">Actualizar Estado</button>
                    </div>
                </div>

                @if(isset($order->meta_data))
                @foreach($order->meta_data as $meta)
                    @if($meta->key == 'guia_de_envio')
                    <div class="col-12  mt-3">
                        <iframe src="{{asset('guias/'.$meta->value) }}" frameborder="0" style="width: 100%;"></iframe> <br>
                        <a target="_blank" href="{{asset('guias/'.$meta->value) }}">ver/Descargar</a>
                    </div>
                    @endif
                @endforeach
            @endif


            </form>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
  </div>
