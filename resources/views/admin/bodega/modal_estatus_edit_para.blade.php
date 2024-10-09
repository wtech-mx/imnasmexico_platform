<div class="modal fade" id="estatus_edit_modal_paradisus{{ $order['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cambio de Estatus Paradisu #{{ $order['id'] }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="myFormEstatus" method="POST" action="{{ route('actualizar.pedido.paradisus', ['id' => $order['id']]) }}" enctype="multipart/form-data" role="form">
            @csrf
            @method('PATCH')
            <!-- Método PATCH para la actualización -->

            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Estatus *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select class="form-select d-inline-block" id="estatus_cotizacion" name="estatus_cotizacion">
                                @if($order['estatus'] == 'Aprobada')
                                    <option value="Preparado">Preparado</option>
                                @elseif($order['estatus'] == 'Preparado')
                                    <option value="Enviado">Enviado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="submitButtonEstatus{{ $order['id'] }}" class="btn btn-success">
                    Actualizar
                    <span id="spinner{{ $order['id'] }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>


      </div>
    </div>
  </div>
