<div class="modal fade" id="aprobarModal" tabindex="-1" aria-labelledby="aprobarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Solicitud</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('update.solicitudes', $solicitud->id) }}" id="" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="name">Tipo de Permiso *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/t credito.png.webp') }}" alt="" width="25px">
                            </span>
                            <input type="text" class="form-control" name="tipo_permiso" id="tipo_permiso" value="{{ $solicitud->tipo_permiso }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Fecha de Inicio *</label>
                        <div class="input-group mb-3">
                            <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" value="{{ $solicitud->fecha_inicio }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Fecha de Fin *</label>
                        <div class="input-group mb-3">
                            <input name="fecha_fin" id="fecha_fin" type="date" class="form-control" value="{{ $solicitud->fecha_fin }}" readonly>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Motivo </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                            </span>
                            <input name="motivo" id="motivo" type="text" class="form-control" value="{{ $solicitud->motivo }}" readonly>
                        </div>
                    </div>

                    <input name="autorizado_por" id="autorizado_por" type="hidden" class="form-control" value="{{ auth()->user()->name }}">

                    <div class="col-12 form-group">
                        <label for="name">¿Autorizar?</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/billetera.png') }}" alt="" width="25px">
                            </span>
                            <select id="estatus" name="estatus" class="form-select" required>
                                <option value="Autorizar">Autorizar</option>
                                <option value="Rechazar">Rechazar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
        </form>
      </div>
    </div>
  </div>
