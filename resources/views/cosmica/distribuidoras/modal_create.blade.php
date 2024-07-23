
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Distribuidora</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">

                <div class="form-group col-12">
                    <label for="name">Nombre(s) *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{old('name')}}">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Tipo Membrecia *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                        </span>
                        <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                            <option value="">Seleccione una opción</option>
                            <option value="cosmos" {{ old('tipo') == 'cosmos' ? 'selected' : '' }}>Cosmos</option>
                            <option value="estelar" {{ old('tipo') == 'estelar' ? 'selected' : '' }}>Estelar</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Estatus Membrecia *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                        </span>
                        <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                            <option value="">Seleccione una opción</option>
                            <option value="Activa" {{ old('tipo') == 'Activa' ? 'selected' : '' }}>Activa</option>
                            <option value="inactiva" {{ old('tipo') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="membresia_inicio">Membrecia Inicio*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                        </span>
                        <input id="membresia_inicio" name="membresia_inicio" type="date" class="form-control" placeholder="Nombre" required value="{{old('membresia_inicio')}}">@error('membresia_inicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="membresia_fin">Membrecia Fin*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                        </span>
                        <input id="membresia_fin" name="membresia_fin" type="date" class="form-control" placeholder="Nombre" required value="{{old('membresia_fin')}}">@error('membresia_fin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="meses_acomulados">Meses acomulados*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="meses_acomulados" name="meses_acomulados" type="number" class="form-control" placeholder="Nombre" required value="{{old('meses_acomulados')}}">@error('meses_acomulados') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="puntos_acomulados">Puntos Acomulados </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="puntos_acomulados" name="puntos_acomulados" type="number" class="form-control" placeholder="Nombre" required value="{{old('puntos_acomulados')}}">@error('puntos_acomulados') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="consumido_totalmes">Consumido Total Mes*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="consumido_totalmes" name="consumido_totalmes" type="text" class="form-control" placeholder="Nombre" required value="{{old('consumido_totalmes')}}">@error('consumido_totalmes') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="direccion_local">Direccion del Local</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="direccion_local" name="direccion_local" type="number" class="form-control" placeholder="Nombre" required value="{{old('direccion_local')}}">@error('direccion_local') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="form-group col-6">
                    <label for="direccion_foto">Foto del Local</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="direccion_foto" name="direccion_foto" type="file" class="form-control" placeholder="Nombre" required value="{{old('direccion_foto')}}">@error('direccion_foto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="direccion_rs_face">RS Facebook</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="direccion_rs_face" name="direccion_rs_face" type="text" class="form-control" placeholder="Nombre" required value="{{old('direccion_rs_face')}}">@error('direccion_rs_face') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="direccion_rs_insta">RS Instagram</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="direccion_rs_insta" name="direccion_rs_insta" type="text" class="form-control" placeholder="Nombre" required value="{{old('direccion_rs_insta')}}">@error('direccion_rs_insta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="direccion_rs_whats">Numero de WhatsApp*</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="direccion_rs_whats" name="direccion_rs_whats" type="number" class="form-control" placeholder="Nombre" required value="{{old('direccion_rs_whats')}}">@error('direccion_rs_whats') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
