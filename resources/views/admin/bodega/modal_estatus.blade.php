<div class="modal fade" id="estatusModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cambio de Estatus C#{{$item->id}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="{{ route('notas_cotizacion.update_estatus', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group">
                            <label for="name">Estatus *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block"  data-toggle="select" id="estatus_cotizacion" name="estatus_cotizacion">
                                    @if($item->estatus_cotizacion == 'Aprobada')
                                        <option value="Preparado">Preparado</option>
                                    @elseif($item->estatus_cotizacion == 'Preparado')
                                        <option value="Enviado">Enviado</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="submitButtonEstatus{{ $item->id }}" class="btn btn-success">
                        Actualizar
                        <span id="spinner{{ $item->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

      </div>
    </div>
  </div>
