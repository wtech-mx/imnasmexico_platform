<!-- Modal -->
<div class="modal fade" id="modal_estatus{{$cliente->id}}" tabindex="-1" aria-labelledby="modal_estatusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_estatusLabel">Estatus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form role="form" action="{{ route('estatus_update.certificaion', $cliente->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body">

                    <div class="row">

                        <div class="mb-4 col-12">
                            <label for="basic-url" class="form-label" style="font-weight: 700;">Estatus *</label>
                            <div class="input-group">
                                <select name="estatus_constancia" id="estatus_constancia" class="form-select">
                                    <option value="revision de datos">Formualario Realizado</option>
                                    <option value="Seleccion de fecha tentativa">Seleccion de fecha tentativa</option>
                                    <option value="Aprovacion de fecha">Aprovacion de fecha</option>
                                </select>
                            </div>
                        </div>

                    </div>

            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
