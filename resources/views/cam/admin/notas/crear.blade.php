<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota de cam</h5>

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
                                    <label for="name">Nombre(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Apellido(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/etiqueta.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellidos" required>@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Correo(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Telefono</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Celular</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required>@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Facebook</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="facebook" name="facebook" type="text" class="form-control" required>@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">TikTok</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/tiktok.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="tiktok" name="tiktok" type="text" class="form-control" required>@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Instagram</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/instagram.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="instagram" name="instagram" type="text" class="form-control" required>@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <select name="tipo" id="tipo" class="form-select d-inline-block">
                                            <option value="Evaluador Independiente">Evaluador Independiente</option>
                                            <option value="Centro Evaluación">Centro Evaluación</option>
                                            <option value="Externo">Externo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="membresiaContainer" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Membresía *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/membership.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="membresia" id="membresia" class="form-select d-inline-block">
                                            <option value="Gold">Gold</option>
                                            <option value="Diamante">Diamante</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Estandares</label><br>
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
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
                                    <label for="name">Monto *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                        </span>
                                        <input class="form-control" type="text" id="pago" name="pago">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Método de Pago *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="metodo_pago" id="metodo_pago" class="form-select d-inline-block">
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                            <option value="Transferencia">Transferencia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4" id="fotoContainer" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Foto</label><br>
                                    <input id="foto" name="foto" type="file" class="form-control" placeholder="foto" required>
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Agregar otro metodo de pago
                                </button>
                            </div>

                            <div class="col-12">
                                <div class="collapse " id="collapseExample">
                                    <div class="row">
                                        <span for="">Método de pago 2</span>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Monto *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                                    </span>
                                                    <input class="form-control" type="text" id="pago2" name="pago2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name">Método de Pago *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                                    </span>
                                                    <select name="metodo_pago2" id="metodo_pago2" class="form-select d-inline-block">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4" id="fotoContainer2" style="display: none;">
                                            <div class="form-group">
                                                <label for="name">Foto</label><br>
                                                <input id="foto2" name="foto2" type="file" class="form-control" placeholder="foto" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nota</label><br>
                                    <textarea class="form-control" name="nota" id="nota" cols="20" rows="1"></textarea>
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
