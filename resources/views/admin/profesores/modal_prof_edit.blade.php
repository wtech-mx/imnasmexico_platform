<!-- Modal -->
<div class="modal fade" id="update_user_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="update_user_{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_user_{{ $user->id }}">Crear profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('profesores.update', $user->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control"   value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="num_profesor">Email</label>
                        <input id="email" name="email" type="email" class="form-control"  value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="telefono">telefono</label>
                        <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $user->telefono }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
