<!-- Modal -->
<div class="modal fade" id="modal_estatus_{{ $estandar_item->id }}" tabindex="-1" aria-labelledby="modal_estatus_{{ $estandar_item->estandar->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('notascam.store_estatus',$estandar_item->id ) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Estatus *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="estatus" id="estatus" class="form-select d-inline-block" required>
                                            <option value="">Seleccione Estado</option>
                                            <option value="1 Cedula">1 Cedula</option>
                                            <option value="2 Subir Portafolio">2 Subir Portafolio</option>
                                            <option value="3- Crear Lote">3- Crear Lote</option>
                                            <option value="4- Dictamen">4- Dictamen</option>
                                            <option value="5- Certificacion">5- Certificacion</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>

        </div>
    </div>
  </div>
