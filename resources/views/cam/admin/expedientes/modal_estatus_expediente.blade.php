    <!-- Modal -->
    <div class="modal fade" id="modal_estatus" tabindex="-1" aria-labelledby="modal_estatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">


            <form method="POST" action="{{ route('estatus_expediente.update', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
                @csrf

                <input type="hidden" name="_method" value="PATCH">


                <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_estatusLabel">Cambiar Estatus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                <div class="col-12 form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets\cam\gestion-del-cambio.png') }}" alt="" width="35px">
                        </span>
                        <select class="form-select" name="estatus_exp" id="estatus_exp">
                            <option value="">Selciona un opcion</option>
                            <option value="">Pendiente</option>
                            <option value="1">Listo para Evaluar</option>
                        </select>
                    </div>
                </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

            </form>

          </div>
        </div>

      </div>
