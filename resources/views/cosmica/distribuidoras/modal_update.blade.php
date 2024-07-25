
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

                <div class="col-6"></div>

                    <div class="form-group col-6">
                        <label for="name">Tipo Membrecia *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/membrecia.png') }}" alt="" width="35px">
                            </span>
                            <select name="membresia" id="membresia" class="form-select d-inline-block" >
                                <option value="{{$item->membresia}}">{{$item->membresia}}</option>
                                <option value="cosmos" {{ old('membresia') == 'cosmos' ? 'selected' : '' }}>Cosmos</option>
                                <option value="estelar" {{ old('membresia') == 'estelar' ? 'selected' : '' }}>Estelar</option>
                            </select>
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

                    <div class="form-group col-6">
                        <label for="membresia_inicio">Membrecia Inicio*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                            </span>
                            <input id="membresia_inicio" name="membresia_inicio" type="date" class="form-control"  value="{{$item->membresia_inicio}}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="membresia_fin">Membrecia Fin*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                            </span>
                            <input id="membresia_fin" name="membresia_fin" type="date" class="form-control"  value="{{$item->membresia_fin}}">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="meses_acomulados">Meses acomulados*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                            </span>
                            <input id="meses_acomulados" name="meses_acomulados" type="number" class="form-control"  value="{{$item->meses_acomulados}}">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="puntos_acomulados">Puntos Acomulados </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/tarjeta-de-fidelidad.png') }}" alt="" width="35px">
                            </span>
                            <input id="puntos_acomulados" name="puntos_acomulados" type="number" class="form-control"  value="{{$item->puntos_acomulados}}">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="consumido_totalmes">Consumido Total Mes*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                            </span>
                            <input id="consumido_totalmes" name="consumido_totalmes" type="text" class="form-control"  value="{{$item->consumido_totalmes}}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="direccion_local">Direccion del Local</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_local" name="direccion_local" type="text" class="form-control"  value="{{$item->direccion_local}}">
                        </div>
                    </div>


                    <div class="form-group col-6">
                        <label for="direccion_foto">Foto del Local</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_foto" name="direccion_foto" type="file" class="form-control"  value="{{$item->direccion_foto}}">
                        </div>

                        <img id="blah" src="{{asset('utilidades/'.$item->direccion_foto) }}" alt="Imagen" style="width: 100px; height: 100px;"/>

                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_face">RS Facebook</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_face" name="direccion_rs_face" type="text" class="form-control"  value="{{$item->direccion_rs_face}}">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_insta">RS Instagram</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_insta" name="direccion_rs_insta" type="text" class="form-control"  value="{{$item->direccion_rs_insta}}">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <label for="direccion_rs_whats">WhatsApp*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/whatsapp.png') }}" alt="" width="35px">
                            </span>
                            <input id="direccion_rs_whats" name="direccion_rs_whats" type="number" class="form-control"  value="{{$item->direccion_rs_whats}}">
                        </div>
                    </div>

                    <div class="col-6">

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
