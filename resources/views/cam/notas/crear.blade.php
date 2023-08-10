<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
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
                                    <label for="name">Apellido *</label>
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
                                    <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55-55" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Tipo</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                        <option value="Evaluador Independiente">Evaluador Independiente</option>
                                        <option value="Centro Evaluación">Centro Evaluación</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Membresía</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                        <option value="Gold">Gold</option>
                                        <option value="Diamante">Diamante</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Estandares</label><br>
                                        <select name="campo[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                            <option value="EC0859 Diseño de maquillaje profesional." >EC0859 Diseño de maquillaje profesional.</option>
                                            <option value="EC1336 Cosmetológicos faciales y corporales.">EC1336 Cosmetológicos faciales y corporales.</option>
                                            <option value="">EC0900 Aplicación de masaje holístico.</option>
                                            <option value="">EC0019 Tutoría de cursos de formación en línea</option>
                                            <option value="">EC0366 Desarrollo de cursos de formación en línea</option>
                                            <option value="">EC1206 Preparación del servicio de dieta hospitalaria</option>
                                        </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ================ P A G O ================ --}}

                    <div class="modal-body">
                        <div class="row">
                            <h4>Sección de pago</h4>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Monto</label>
                                    <input class="form-control" type="text" id="pago" name="pago">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Método de Pago</label>
                                    <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Nota</label><br>
                                    <textarea class="form-control" name="" id="" cols="20" rows="1"></textarea>
                                </div>
                            </div>

                            <span for="">Método de pago 2</span>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Monto</label>
                                    <input class="form-control" type="text" id="pago" name="pago">
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
                                    <label for="name">Nota</label><br>
                                    <textarea class="form-control" name="" id="" cols="20" rows="1"></textarea>
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
