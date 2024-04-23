<!-- Modal -->
<div class="modal fade" id="modal_estandares_create" tabindex="-1" aria-labelledby="modal_estandares_createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('notascam.crear') }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha de evaluacion *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Hora *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/reloj.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="time" name="time" type="time" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Numero de Portafolio *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="num_portafolio" name="num_portafolio" type="number" class="form-control" >
                                    </div>
                                </div>
                            </div>

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
                                            <option value="Externo" {{ old('tipo') == 'Externo' ? 'selected' : '' }}>Externo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Modalidad *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="tipo_modalidad" id="tipo_modalidad" class="form-select d-inline-block" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="Presencial" {{ old('tipo') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                            <option value="Online" {{ old('tipo') == 'Online' ? 'selected' : '' }}>Online</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Alumnos o externos *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="tipo_alumno" id="tipo_alumno" class="form-select d-inline-block" required>
                                            <option value="">Seleccione una opción</option>
                                            <option value="Alumnos Imnas" {{ old('tipo') == 'Alumnos Imnas' ? 'selected' : '' }}>Alumnos Imnas</option>
                                            <option value="Externos" {{ old('tipo') == 'Externos' ? 'selected' : '' }}>Externos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Centro</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="nombre_centro" name="nombre_centro" type="number" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{old('name')}}">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Apellidos *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/etiqueta.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellidos" required value="{{old('apellido')}}">@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Celular (WhatasApp) *</label>
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
                                    <label for="name">Correo </label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{old('email')}}">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Seleccionar Estándares *</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple" required>
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares', [])) ? 'selected' : '' }}>
                                                    {{$estandar_cam->estandar}}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Estándares operables *</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                        <select name="estandares_operables[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple" required>
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares_operables', [])) ? 'selected' : '' }}>
                                                    {{$estandar_cam->estandar}}
                                                </option>
                                            @endforeach
                                        </select>
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
