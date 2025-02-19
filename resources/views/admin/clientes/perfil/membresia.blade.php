
<!-- Card Basic Info -->
<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Información Membresia</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-12">
                <label class="form-label">Fecha de registro</label>
                <div class="input-group">
                <p>{{$cosmica_user->created_at}}</p>
                </div>
            </div>
            <div class="col-3">
                <label for="name">Nombre </label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                    </span>
                    <input id="name" name="name" type="text" class="form-control" value="{{ $cliente->name }}">
                </div>
            </div>
            <div class="col-3">
                <label for="name">Correo</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                    </span>
                    <input id="email" name="email" type="email" class="form-control" value="{{ $cliente->email }}">
                </div>
            </div>
            <div class="form-group col-3">
                <label for="name">Telefono *</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                    </span>
                    <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" value="{{ $cliente->telefono }}">
                </div>
            </div>
            <div class="form-group col-3">
                <label for="name">Contraseña Protocolo</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/user/icons/password.png') }}" alt="" width="35px">
                    </span>
                    <input id="claves_protocolo" name="claves_protocolo" type="text" class="form-control"  value="{{ $cosmica_user->claves_protocolo }}" readonly>
                </div>
            </div>
            <div class="col-12">
                <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/web-link.png') }}" alt="" width="35px">
                        </span>
                    <input id="link" name="link" type="text" class="form-control"  value="{{ route('distribuidoras.index_protocolo', $cosmica_user->id) }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label for="name">Tipo Membrecia *</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/membrecia.png') }}" alt="" width="35px">
                    </span>
                    <select name="membresia" id="membresia" class="form-select d-inline-block" >
                        <option value="{{$cosmica_user->membresia}}">{{$cosmica_user->membresia}}</option>
                        <option value="cosmos" {{ old('membresia') == 'cosmos' ? 'selected' : '' }}>Cosmos</option>
                        <option value="estelar" {{ old('membresia') == 'estelar' ? 'selected' : '' }}>Estelar</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-3">
                <label for="name">Estatus Membrecia *</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                    </span>
                    <select name="membresia_estatus" id="membresia_estatus" class="form-select d-inline-block" >
                        <option value="{{$cosmica_user->membresia_estatus}}">{{$cosmica_user->membresia_estatus}}</option>
                        <option value="Activa" {{ old('membresia_estatus') == 'Activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ old('membresia_estatus') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-3">
                <label for="membresia_inicio">Membrecia Inicio*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                    </span>
                    <input id="membresia_inicio" name="membresia_inicio" type="date" class="form-control"  value="{{$cosmica_user->membresia_inicio}}">
                </div>
            </div>

            <div class="form-group col-3">
                <label for="membresia_fin">Membrecia Fin*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                    </span>
                    <input id="membresia_fin" name="membresia_fin" type="date" class="form-control"  value="{{$cosmica_user->membresia_fin}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-4">
                <label for="meses_acomulados">Meses acomulados*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                    </span>
                    <input id="meses_acomulados" name="meses_acomulados" type="number" class="form-control"  value="{{$cosmica_user->meses_acomulados}}">
                </div>
            </div>

            <div class="form-group col-4">
                <label for="puntos_acomulados">Puntos Acomulados </label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/tarjeta-de-fidelidad.png') }}" alt="" width="35px">
                    </span>
                    <input id="puntos_acomulados" name="puntos_acomulados" type="number" class="form-control"  value="{{$cosmica_user->puntos_acomulados}}">
                </div>
            </div>

            <div class="form-group col-4">
                <label for="consumido_totalmes">Consumido Total Mes*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input id="consumido_totalmes" name="consumido_totalmes" type="text" class="form-control"  value="{{$cosmica_user->consumido_totalmes}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="direccion_local">Direccion del Local</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                    </span>
                    <input id="direccion_local" name="direccion_local" type="text" class="form-control"  value="{{$cosmica_user->direccion_local}}">
                </div>
            </div>


            <div class="form-group col-6">
                <label for="direccion_foto">Foto del Local</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                    </span>
                    <input id="direccion_foto" name="direccion_foto" type="file" class="form-control"  value="{{$cosmica_user->direccion_foto}}">
                </div>

                <img id="blah" src="{{asset('utilidades/'.$cosmica_user->direccion_foto) }}" alt="Imagen" style="width: 100px; height: 100px;"/>

            </div>

            <div class="form-group col-4">
                <label for="direccion_rs_face">RS Facebook</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                    </span>
                    <input id="direccion_rs_face" name="direccion_rs_face" type="text" class="form-control"  value="{{$cosmica_user->direccion_rs_face}}">
                </div>
            </div>

            <div class="form-group col-4">
                <label for="direccion_rs_insta">RS Instagram</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                    </span>
                    <input id="direccion_rs_insta" name="direccion_rs_insta" type="text" class="form-control"  value="{{$cosmica_user->direccion_rs_insta}}">
                </div>
            </div>

            <div class="form-group col-4">
                <label for="direccion_rs_whats">WhatsApp*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/whatsapp.png') }}" alt="" width="35px">
                    </span>
                    <input id="direccion_rs_whats" name="direccion_rs_whats" type="number" class="form-control"  value="{{$cosmica_user->direccion_rs_whats}}">
                </div>
            </div>
        </div>
    </div>
</div>

