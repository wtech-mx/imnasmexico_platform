<form method="POST" action="{{ route('peril_cliente.crear_estandares', $cliente->id) }}" enctype="multipart/form-data" role="form" id="miFormulario">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12 mt-2">
                <h4 style="color:#836262"><strong>Datos del cliente</strong> </h4>
            </div>

            <div class="row">
                <div class="form-group col-4">
                    <h4 for="name">Nombre *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->name : $cliente->nombre }}" required>
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Correo</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                        </span>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->email : '' }}">
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Telefono *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                        </span>
                        <input type="number" id="telefono" name="telefono" class="form-control" value="{{$cliente->telefono}}" required>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Seleccionar Estándares *</h3>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <select name="estandares[]" id="estandares[]" class="form-select estandares" multiple="multiple" required style="width: 70%!important;">
                        @foreach ($estandares_cam as $estandar_cam)
                            <option value="{{ $estandar_cam->id }}">
                                {{$estandar_cam->nombre}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
    </div>
</form>
