<!-- Modal -->
<div class="modal fade" id="update_comenatario_{{ $comentario->id }}" tabindex="-1" role="dialog" aria-labelledby="update_comenatario_{{ $comentario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_comenatario_{{ $comentario->id }}">Crear Comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('comentarios.update', $comentario->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $comentario->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="num_estandar">Mensaje</label>
                        <textarea name="mensaje" id="mensaje" cols="10" rows="3" class="form-control">
                            {{ $comentario->mensaje }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">foto</label>
                        <input id="foto" name="foto" type="file" class="form-control">
                        <img id="blah" src="{{asset('comentarios/'.$comentario->foto) }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
