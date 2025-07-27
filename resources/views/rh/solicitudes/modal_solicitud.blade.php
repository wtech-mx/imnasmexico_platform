<div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear Solicitud</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('store.nominas_solicitudes') }}" id="" enctype="multipart/form-data" role="form">
            @csrf

            <div class="modal-body">
                <div class="row">
                    <input name="id_users" id="id_users" type="text" class="form-control" value="{{ $user->id }}" hidden>
                    <div class="col-6 form-group">
                        <label for="name">Tipo de Permiso *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/t credito.png.webp') }}" alt="" width="25px">
                            </span>
                            <select id="tipo_permiso" name="tipo_permiso" class="form-select" required>
                                <option value="Vacaciones">Vacaciones</option>
                                <option value="Enfermedad">Enfermedad</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Fecha de Inicio *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                            </span>
                            <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Fecha de Fin *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                            </span>
                            <input name="fecha_fin" id="fecha_fin" type="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Motivo </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                            </span>
                            <input name="motivo" id="motivo" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Autorizado por *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/billetera.png') }}" alt="" width="25px">
                            </span>
                            <input name="autorizado_por" id="autorizado_por" type="text" class="form-control" required>
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
