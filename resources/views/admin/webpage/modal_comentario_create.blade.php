<!-- Modal -->
<div class="modal fade" id="create_comentario" tabindex="-1" role="dialog" aria-labelledby="create_comentario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_comentario">Crear Comentario</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('comentarios.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control"  required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="num_estandar">Mensaje</label>
                        <textarea name="mensaje" id="mensaje" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">foto</label>
                        <input id="foto" name="foto" type="file" class="form-control">@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
