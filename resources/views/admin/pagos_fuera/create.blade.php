<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear pago externo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data" role="form">
                @csrf

                <input id="fecha_hora_1" name="fecha_hora_1" type="hidden"  value="{{ $fechaActual }}">
                <input id="usuario" name="usuario" type="hidden"  value="{{ Auth::user()->name }}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre *</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Apellido *</label>
                                    <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido" required>@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Correo *</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Telefono *</label>
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Nombre 2</label>
                                                <input id="name2" name="name2" type="text" class="form-control" placeholder="Nombre">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Apellido 2</label>
                                                <input id="apellido2" name="apellido2" type="text" class="form-control" placeholder="Apellido">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Correo 2</label>
                                                <input id="email2" name="email2" type="email" class="form-control" placeholder="Correo">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Telefono 2</label>
                                                <input id="telefono2" name="telefono2" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label class="mt-2">Curso *</label> <br>
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
                                                <select name="campo2" class="form-select d-inline-block" style="width: 70%!important;">
                                                    <option value="">Seleccione Curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="mt-2">Curso 3</label> <br>
                                                <select name="campo3" class="form-select d-inline-block" style="width: 70%!important;">
                                                    <option value="">Seleccione Curso</option>
                                                    @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <div class="form-group">
                                    <label for="foto">Forma de pago *</label>
                                    <input id="forma_pago" name="forma_pago" type="text" class="form-control" placeholder="forma pago" required>@error('forma_pago') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="foto">Foto *</label>
                                    <input id="foto" name="foto" type="file" class="form-control" placeholder="foto" required>@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <label>Monto *</label>
                                <div class="form-group">
                                    <input class="form-control" type="number" id="pago" name="pago" placeholder="Ingresa el total del/de cursos" required>
                                </div>
                            </div>

                            <div class="col-1">
                                <label>Deudor</label>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="deudor" name="deudor" value="1" id="flexCheckChecked">
                                </div>
                            </div>

                            <div class="col-3" id="abono-container">
                                <div class="form-group">
                                  <label for="abono">Abono</label>
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

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
