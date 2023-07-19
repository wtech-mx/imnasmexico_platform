<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="examplePaquete" tabindex="-1" role="dialog" aria-labelledby="examplePaquete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Paquete</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('notas_cursos.store_paquete') }}" enctype="multipart/form-data" role="form">
                @csrf
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
                                    <label for="name">Correo</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Telefono *</label>
                                    <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55" pattern="[0-9]{10}" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nota</label>
                                    <textarea name="nota" id="nota" class="form-control" cols="5" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Curso</label>

                                    <div id="camposContainer">
                                        <div class="campo mt-3">
                                            <select name="campo[]" class="form-select d-inline-block cliente2" style="width: 70%!important;" multiple="multiple">
                                                <option value="">Seleccione Curso</option>
                                                @foreach ($cursos_paquetes as $curso)
                                                <option value="{{ $curso->id }}">{{ $curso->nombre }}  / {{ $curso->Cursos->fecha_inicial }}</option>
                                                @endforeach
                                            </select>

                                            {{-- <input type="text" name="precio[]" class="form-control" style="width: 20%!important;margin-left: 0.2rem;" readonly> --}}

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- ================ P A G O ================ --}}
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <select name="paquete" class="form-select d-inline-block" style="width: 70%!important;">
                                    <option value="">Seleccione Paquete</option>
                                    <option value="Paquete1">Paquete 1 - $6,000</option>
                                    <option value="Paquete2">Paquete 2 - $8,000</option>
                                    <option value="Paquete3">Paquete 3 - $11,000</option>
                                    <option value="Paquete4">Paquete 4 - $13,000</option>
                                    <option value="Paquete5">Paquete 5 - $14,500</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Monto</label>
                                    <input class="form-control" type="number" id="monto" name="monto" value="$">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Metodo de Pago</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <input id="created_at" name="created_at" type="datetime-local" class="form-control" value="{{$fechaHoraActualFormateada}}" required>
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
