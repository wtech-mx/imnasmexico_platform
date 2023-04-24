<!-- Modal -->
<div class="modal fade" id="update_revoe_{{ $revoe->id }}" tabindex="-1" role="dialog" aria-labelledby="update_revoe_{{ $revoe->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_revoe_{{ $revoe->id }}">Crear REVOE</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('revoes.update', $revoe->id) }}" enctype="multipart/form-data" role="form">

                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $revoe->name }}"  required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="num_revoe">num_revoe</label>
                        <input id="num_revoe" name="num_revoe" type="text" class="form-control" value="{{ $revoe->num_revoe }}" >@error('num_revoe') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <input id="image" name="image" type="file" class="form-control">@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                        <img id="blah" src="{{asset('revoes/'.$revoe->image) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
