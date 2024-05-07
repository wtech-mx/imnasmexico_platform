<div id="rightPanel" class="right-panel">
    <!-- Contenido del panel derecho -->
    <div class="close-btn" onclick="closeRightPanel()">Cerrar</div>
    <div class="panel-content">

            <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data" role="form" id="tuFormulario">
                @csrf

                <input id="fecha_hora_1" name="fecha_hora_1" type="hidden"  value="{{ $fechaActual }}">
                <input id="usuario" name="usuario" type="hidden"  value="{{ Auth::user()->name }}">

                    <div class="modal-body">
                        <div class="row">

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


                            <div class="col-6 mt-3">
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#clienteExample" aria-expanded="false" aria-controls="clienteExample">
                                    Agregar otra persona
                                </button>
                            </div>

                            <div class="col-12">
                                <div class="collapse" id="clienteExample">
                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label for="name">Apellido(s) </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="name2" name="name2" type="text" class="form-control" placeholder="Nombre">
                                            </div>
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="name">Apellido(s) </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="apellido2" name="apellido2" type="text" class="form-control" placeholder="Apellido">
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Correo 2 </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="email2" name="email2" type="email" class="form-control" placeholder="Correo">
                                            </div>
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="name">Telefono 2 </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                                </span>
                                                <input id="telefono2" name="telefono2" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="mt-2">Curso</label> <br>
                                <select name="campo1" class="form-select d-inline-block curso" style="width: 70%!important;">
                                    <option value="">Seleccione Curso</option>
                                    @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar otro curso
                                </button>
                            </div>

                            <div class="col-12">
                                <div class="collapse " id="collapseExample">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="mt-2">Curso 2</label> <br>
                                                <select name="campo2" class="form-select d-inline-block curso2" style="width: 70%!important;">
                                                    <option value="">Seleccione Curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="mt-2">Curso 3</label> <br>
                                                <select name="campo3" class="form-select d-inline-block curso3" style="width: 70%!important;">
                                                    <option value="">Seleccione Curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="mt-2">Curso 4</label> <br>
                                                <select name="campo4" class="form-select d-inline-block curso4" style="width: 70%!important;">
                                                    <option value="">Seleccione Curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="mt-2">Clase grabada</label> <br>
                                <select name="clase_grabada" class="form-select d-inline-block curso" style="width: 70%!important;">
                                    <option value="">Seleccione Curso</option>
                                    @foreach ($clases_grabadas as $clase_grabada)
                                    <option value="{{ $clase_grabada->id }}">{{ $clase_grabada->nombre }} - {{ $clase_grabada->Cursos->modalidad }} / {{ $clase_grabada->Cursos->fecha_inicial }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6 mt-3">
                                <label for="name">Método de Pago *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                    </span>
                                    <select name="forma_pago" id="forma_pago" class="form-select d-inline-block">
                                        <option value="" >Selecione una opcion</option>
                                        <option value="Efectivo" {{ old('forma_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                        <option value="Tarjeta" {{ old('forma_pago') == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                        <option value="Nota" {{ old('forma_pago') == 'Nota' ? 'selected' : '' }}>Nota Fisica</option>
                                        <option value="transferencia inbursa" {{ old('forma_pago') == 'transferencia inbursa' ? 'selected' : '' }}>Transferencia Inbursa</option>
                                        <option value="transferencia bancomer" {{ old('forma_pago') == 'transferencia bancomer' ? 'selected' : '' }}>Transferencia BBVA Bancomer</option>
                                        <option value="deposito inbursa" {{ old('forma_pago') == 'deposito inbursa' ? 'selected' : '' }}>Deposito Inbursa</option>
                                        <option value="deposito bancomer" {{ old('forma_pago') == 'deposito bancomer' ? 'selected' : '' }}>Deposito BBVA Bancomer</option>
                                        <option value="oxxo inbursa" {{ old('forma_pago') == 'oxxo inbursa' ? 'selected' : '' }}>OXXO Inbursa</option>
                                        <option value="oxxo bancomer" {{ old('forma_pago') == 'oxxo bancomer' ? 'selected' : '' }}>OXXO Bancomer</option>
                                        <option value="Mercado Pago" {{ old('forma_pago') == 'Mercado Pago' ? 'selected' : '' }}>Mercado Pago</option>
                                        <option value="otro" {{ old('forma_pago') == 'otro' ? 'selected' : '' }}>Otro</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-6 mt-3">
                                <label for="name">Foto (Comprobante) *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="foto" name="foto" type="file" class="form-control" placeholder="foto" required>@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group col-6 mt-3">
                                <label for="name">Monto *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                    </span>
                                    <input class="form-control" type="number" id="pago" name="pago" placeholder="Ingresa el total del/de cursos" required>
                                </div>
                            </div>


                            <div class="form-group col-1 mt-3">
                                <label>Deudor</label>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="deudor" name="deudor" value="1" id="flexCheckChecked">
                                </div>
                            </div>

                            <div class="form-group col-5 mt-3" id="abono-container">
                                <label for="name">Abono *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                    </span>
                                    <input id="abono" name="abono" type="number" class="form-control" placeholder="Abono">@error('abono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                  <label for="comentario">Comentarios y/o Nota</label>
                                  <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff" id="btnGuardar">Guardar</button>


            </form>

        </div>
    </div>
