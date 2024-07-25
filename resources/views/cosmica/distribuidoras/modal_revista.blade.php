<!-- Modal -->
<div class="modal fade" id="exampleRevista_{{ $item->id }}" tabindex="-1" aria-labelledby="exampleRevista_{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleRevista_{{ $item->id }}Label"> {{ $item->User->name }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">

        <form method="POST" action="{{ route('distribuidoras.update_protocolo',$item->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">

            <div class="form-group col-12">
                <label for="name">Crear Contraseña *</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/user/icons/password.png') }}" alt="" width="35px">
                    </span>
                    <input id="claves_protocolo" name="claves_protocolo" type="text" class="form-control"  value="{{ $item->claves_protocolo }}">@error('pass') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-success w-100" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
