<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acordcion_mb_clases">
    <div class="accordion-body row" style="background: #cccccc45;padding: 10px;border-radius: 12px;">
        <form method="POST" action="{{ route('notascam.store') }}" enctype="multipart/form-data" role="form">
            @csrf
            <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h4 for="name">Fecha de evaluacion *</h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="fecha" name="fecha" type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <h4 for="name">Hora *</h4>
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
                                <h4 for="name">Tipo</h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                    </span>
                                    <select name="tipo" id="tipo" class="form-select d-inline-block">
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
                                <h4 for="name">Modalidad *</h4>
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
                                <h4 for="name">Alumnos o externos</h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px">
                                    </span>
                                    <select name="tipo_alumno" id="tipo_alumno" class="form-select d-inline-block">
                                        <option value="">Seleccione una opción</option>
                                        <option value="Alumnos Imnas" {{ old('tipo') == 'Alumnos Imnas' ? 'selected' : '' }}>Alumnos Imnas</option>
                                        <option value="Externos" {{ old('tipo') == 'Externos' ? 'selected' : '' }}>Externos</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <h4 for="name">Nombre del Centro</h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="nombre_centro" name="nombre_centro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h3>Datos personales</h3>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <h4 for="name">Nombre(s) *</h4>
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
                                <h4 for="name">Apellidos *</h4>
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
                                <h4 for="name">Telefono *</h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/whatsapp.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" required value="{{old('celular')}}">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-8">
                            <div class="form-group">
                                <h4 for="name">Correo </h4>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{old('email')}}">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                                {{$estandar_cam->estandar}}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <button type="submit" class="btn btn-sm" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                <h4 style="color: #fff"> Guardar </h4>
                             </button>
                        </div>

            </div>

        </form>
    </div>
</div>
