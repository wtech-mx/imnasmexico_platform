<div class="modal fade" id="estatus_edit_modal_woo{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cambio de Estatus woo #{{$order->id}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" id="myForm" action="{{ route('bodega.update_guia_woo', $order->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">

                        @php
                            $domain = parse_url($order->payment_url, PHP_URL_HOST);
                        @endphp

                        <input type="hidden" name="dominio" value="{{  $domain  }}">

                        @if($order->status == 'guia_cargada')
                            <input type="hidden" name="key" value="preparado_hora_y_guia">
                        @endif

                        @if($order->status == 'preparados')
                            <input type="hidden" name="key" value="enviado_hora_y_guia">
                        @endif

                        <div class="form-group">
                            <label for="name">Estatus *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block"  data-toggle="select"  name="status">
                                    @if($order->status == 'guia_cargada')
                                        <option value="preparados">Preparado</option>
                                    @endif

                                    @if($order->status == 'preparados')
                                        <option value="enviados">Enviado</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="submitButtonEstatus{{ $order->id }}" class="btn btn-success">
                        Actualizar
                        <span id="spinner{{ $order->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

      </div>
    </div>
  </div>
