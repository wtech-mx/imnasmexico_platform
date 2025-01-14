<!-- Modal -->
<div class="modal fade" id="registro_imnas" tabindex="-1" role="dialog" aria-labelledby="registro_imnas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear registro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('registro_imnas.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="name">Nombre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="name" name="name" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Telefono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="telefono" name="telefono" type="number" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Correo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="email" name="email" type="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Tipo de precio Emisión</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                </span>
                                <select name="costos_diferentes" id="costos_diferentes" class="form-select d-inline-block">
                                    @foreach ($cursos_tickets as $curso_ticket)
                                        <option value="{{$curso_ticket->costos_diferentes}}">{{$curso_ticket->nombre}} - ${{$curso_ticket->precio}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <label for="name">Monto *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input class="form-control" type="number" id="pago" name="pago" placeholder="Ingresa el total" required>
                            </div>
                        </div>

                        <div class="form-group col-12 mt-3">
                            <label for="name">Foto (Comprobante)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                </span>
                                <input id="foto" name="foto" type="file" class="form-control" placeholder="foto">
                            </div>
                        </div>

                        <div class="form-group col-6 mt-3">
                            <label for="name">Método de Pago 2</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                </span>
                                <select name="forma_pago2" id="forma_pago2" class="form-select d-inline-block">
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
                            <label for="name">Monto 2</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input class="form-control" type="number" id="pago2" name="pago2" placeholder="Ingresa el total">
                            </div>
                        </div>

                        <div class="form-group col-12 mt-3">
                            <label for="name">Foto (Comprobante) 2</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                </span>
                                <input id="foto2" name="foto2" type="file" class="form-control" placeholder="foto2">
                            </div>
                        </div>

                        <!-- Select Clasificación de Clave -->
                        <div class="form-group col-6">
                            <label for="name">Clasificación de Clave</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                </span>
                                <select name="clave_clasificacion" class="form-select d-inline-block clave-clasificacion">
                                    <option value="">Seleccionar una opción</option>
                                    <option value="RIFC680910-879-0013" {{ old('clave_clasificacion') == 'RIFC680910-879-0013' ? 'selected' : '' }}>RIFC680910-879-0013</option>
                                    <option value="HERK000617-BY7-0005" {{ old('clave_clasificacion') == 'HERK000617-BY7-0005' ? 'selected' : '' }}>HERK000617-BY7-0005</option>
                                    <option value="Otra Clave" {{ old('clave_clasificacion') == 'Otra Clave' ? 'selected' : '' }}>Otra Clave</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input dinámico: Otra Clave -->
                        <div class="form-group col-6 d-none otra-clave-container-create">
                            <label for="otra_clave">Especifica otra clave</label>
                            <input type="text" name="otra_clave" class="form-control" placeholder="Ingresa la clave" value="{{ old('otra_clave') }}">
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
