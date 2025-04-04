
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Distribuidora</h1>
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
                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
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

                    <div class="form-group col-6">
                        <label for="name">Tipo Membrecia *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/membrecia.png') }}" alt="" width="35px">
                            </span>
                            <select name="membresia" id="membresia" class="form-select d-inline-block" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Cosmos" {{ old('membresia') == 'Cosmos' ? 'selected' : '' }}>Cosmos</option>
                                <option value="Estelar" {{ old('membresia') == 'Estelar' ? 'selected' : '' }}>Estelar</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Estatus Membrecia *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select name="membresia_estatus" id="membresia_estatus" class="form-select d-inline-block" required>
                                <option value="Activa" {{ old('membresia_estatus') == 'Activa' ? 'selected' : '' }} selected>Activa</option>
                                <option value="inactiva" {{ old('membresia_estatus') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="membresia_inicio">Membrecia Inicio *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                            </span>
                            <input id="membresia_inicio" name="membresia_inicio" type="date" class="form-control" required value="{{old('membresia_inicio')}}">@error('membresia_inicio') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="membresia_fin">Membrecia Fin *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                            </span>
                            <input id="membresia_fin" name="membresia_fin" type="date" class="form-control" required value="{{old('membresia_fin')}}">@error('membresia_fin') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="meses_acomulados">Meses acomulados</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                            </span>
                            <input id="meses_acomulados" name="meses_acomulados" type="number" class="form-control" required value="0">@error('meses_acomulados') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="puntos_acomulados">Puntos Acomulados </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/tarjeta-de-fidelidad.png') }}" alt="" width="35px">
                            </span>
                            <input id="puntos_acomulados" name="puntos_acomulados" type="number" class="form-control" required value="0">@error('puntos_acomulados') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="consumido_totalmes">Consumido Total Mes</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                            </span>
                            <input id="consumido_totalmes" name="consumido_totalmes" type="text" class="form-control" required value="0">@error('consumido_totalmes') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="direccion_local">Direccion del Local *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_local" name="direccion_local" type="text" class="form-control" required value="{{old('direccion_local')}}">@error('direccion_local') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="direccion_local">Estado *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/skyscraper.png') }}" alt="" width="35px">
                            </span>
                            <select class="form-select d-inline-block" data-toggle="select" id="state" name="state" required>
                                {{-- <option value="{{ $item->User->state  }}">{{ $item->User->state  }}</option> --}}
                                <option value="">Seleciona Estado</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Durango">Durango</option>
                                <option value="Estado de Mexico">Estado de Mexico</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Michoacán">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-6">
                        <label for="direccion_foto">Foto del Local</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_foto" name="direccion_foto" type="file" class="form-control" value="{{old('direccion_foto')}}">@error('direccion_foto') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_face">RS Facebook</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_face" name="direccion_rs_face" type="text" class="form-control" value="{{old('direccion_rs_face')}}">@error('direccion_rs_face') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_insta">RS Instagram</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_insta" name="direccion_rs_insta" type="text" class="form-control" value="{{old('direccion_rs_insta')}}">@error('direccion_rs_insta') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_whats">WhatsApp *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/whatsapp.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_whats" name="direccion_rs_whats" type="number" class="form-control" required value="{{old('direccion_rs_whats')}}">@error('direccion_rs_whats') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-6">

                    </div>

                    {{-- <div class="form-group col-6">
                        <label for="direccion_foto">Foto del pago</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                            </span>
                            <input id="foto_pago" name="foto_pago" type="file" class="form-control" value="{{old('foto_pago')}}">@error('foto_pago') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div> --}}

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
