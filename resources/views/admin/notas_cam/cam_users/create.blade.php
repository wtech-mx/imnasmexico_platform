<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleNuevoModal" tabindex="-1" role="dialog" aria-labelledby="exampleNuevoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Nota CAM</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('cam_users.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Tipo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="Evaluador Independiente" {{ old('tipo') == 'Evaluador Independiente' ? 'selected' : '' }}>Evaluador Independiente</option>
                                            <option value="Centro Evaluación" {{ old('tipo') == 'Centro Evaluación' ? 'selected' : '' }}>Centro Evaluación</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="opcionesCentro" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Membresía *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/membership.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="membresia" id="centroTipo" class="form-select d-inline-block">
                                            <option value="">Seleccione una opción</option>
                                            <option value="Gold" {{ old('membresia') == 'Gold' ? 'selected' : '' }}>Gold</option>
                                            <option value="Diamante" {{ old('membresia') == 'Diamante' ? 'selected' : '' }}>Diamante</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre completo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{old('name')}}">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Celular *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/whatsapp.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required value="{{old('celular')}}">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Correo *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{old('email')}}">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
