
<!-- Modal -->
<div class="modal fade" id="staticBackdrop_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop_{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdrop_{{ $item->id }}Label">Crear Distribuidora</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: #000;"></button>
        </div>

        <form method="POST" action="{{ route('distribuidoras.update',$item->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">

            <div class="modal-body row">
                <div class="form-group col-6">
                    <label for="name">Nombre *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $item->User->name }}">
                    </div>
                </div>


                <div class="form-group col-6">
                    <label for="name">Correo *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                        </span>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $item->User->email }}">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="name">Telefono *</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                        </span>
                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" value="{{ $item->User->telefono }}">
                    </div>
                </div>

                    <div class="form-group col-6">
                        <label for="name">Estatus Membrecia *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select name="membresia_estatus" id="membresia_estatus" class="form-select d-inline-block" >
                                <option value="">{{$item->membresia_estatus}}</option>
                                <option value="Activa" {{ old('membresia_estatus') == 'Activa' ? 'selected' : '' }}>Activa</option>
                                <option value="inactiva" {{ old('membresia_estatus') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <button type="submit" class="btn btn-success w-100" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div>

            </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
