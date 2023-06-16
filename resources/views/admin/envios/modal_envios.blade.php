<!-- Modal -->
<div class="modal fade" id="update_envios_{{ $envio->id }}" tabindex="-1" role="dialog" aria-labelledby="update_envios_{{ $envio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_envios_{{ $envio->id }}">{{ $envio->User->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('envios.update_eestatus', $envio->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body row">
                        <div class="col-12 form-group">
                            <label for="rfc">Estatus</label>
                            <select class="form-select" name="estatus" id="estatus">
                                <option selected>{{ $envio->estatus }}</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Realizado">Realizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
