<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel"># Nota:{{$siguienteId}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('crear.notas') }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">

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
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellidos" required>@error('apellido') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Correo *</label>
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
                                    <label for="name">Celular *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/foldable-phone.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="celular" name="celular" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="5500550055" required>@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <h5>Redes Sociales</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Facebook</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/facebook.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="facebook" name="facebook" type="text" class="form-control" placeholder="naturalesainspa">@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="tiktok" name="tiktok" type="text" class="form-control" placeholder="@imnasmexico">@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
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
                                        <input id="instagram" name="instagram" type="text" class="form-control" placeholder="naturalesainspaoficial">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos de Direccion</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Estado/ciudad</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/skyscraper.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="estado" name="estado" type="text" class="form-control" placeholder="">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Direccion (Opcional)</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/streets.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="direccion" name="direccion" type="text" class="form-control" placeholder="">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Alcaldia / municipio (Opcional)</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/ecuador.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="alcaldia" name="alcaldia" type="text" class="form-control" placeholder="">@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Datos de evaluador o centro</h5>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Fecha *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="fecha" name="fecha" type="text" class="form-control" value="{{$fecha}}" disabled>
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
                                    <label for="">Seleccione estandares *</label><br>
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{$estandar_cam->id}}">{{$estandar_cam->estandar}}</option>
                                            @endforeach
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
                                        <input class="form-control" type="number" id="monto1" name="monto1">
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
                                    <input id="comprobante" name="comprobante" type="file" class="form-control" placeholder="foto">
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
                                                    <input class="form-control" type="number" id="monto2" name="monto2">
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
                                                <input id="comprobante2" name="comprobante2" type="file" class="form-control" placeholder="foto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">Nota</label><br>
                                    <textarea class="form-control" name="nota" id="nota" cols="20" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Referencia *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/refer.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="referencia" name="referencia" type="text" class="form-control" placeholder="Referencia" required>@error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
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
