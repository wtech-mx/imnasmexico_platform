<!-- Modal -->
<div class="modal fade" id="update_modal_{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="update_modal_{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_modal_{{ $curso->id }}">Link de Meet y recursos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('cursos.update_meet', $curso->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="col-12">
                        <h6 class="">{{ $curso->nombre }}</h6>
                    </div>
                    <div class="col-12 form-group">
                        <label for="name">Clase grabada</label>
                        <input id="clase_grabada" name="clase_grabada" type="text" class="form-control" value="{{ $curso->clase_grabada }}">
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Recurso</label>
                        <input id="recurso" name="recurso" type="text" class="form-control" value="{{ $curso->recurso }}">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
