
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Protocolo permanente</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: #000;"></button>
        </div>

        <form method="POST" action="{{ route('distribuidoras.store') }}" enctype="multipart/form-data" role="form">
            @csrf

            <div class="modal-body row">
                <div class="form-group col-6">
                    <label for="name">Nombre(s) *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Apellido(s) *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido" required>@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Correo *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                        </span>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" require>@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Telefono *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                        </span>
                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <input id="membresia" name="membresia" type="hidden" class="form-control" value="Permanente">
                <input id="membresia_estatus" name="membresia_estatus" type="hidden" class="form-control" value="Activa">

                <div class="col-6">
                    <button type="submit" class="btn btn-success w-100" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                </div>

            </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
