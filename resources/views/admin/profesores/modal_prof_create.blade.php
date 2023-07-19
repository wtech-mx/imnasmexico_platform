<!-- Modal -->
<div class="modal fade" id="create_profesor" tabindex="-1" role="dialog" aria-labelledby="create_profesor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_profesor">Crear profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('profesores.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control"  required>
                    </div>

                    <div class="form-group">
                        <label for="num_profesor">Email</label>
                        <input id="email" name="email" type="text" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">telefono</label>
                        <input id="telefono" name="telefono" type="tel" pattern="[0-9]{10}" class="form-control" minlength="10" maxlength="10" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
