<!-- Modal -->
<div class="modal fade" id="registro_imnas_edit_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="registro_imnas_edit_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar registro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('update_registro.update', $item->User->id) }}" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="name">Nombre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="name" name="name" type="text" class="form-control" value=" {{ $item->User->name }}">
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Telefono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{$item->User->telefono}}">
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Correo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="email" name="email" type="email" class="form-control" value="{{ $item->User->email }}">
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Direccion</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/edificio.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input type="text" class="form-control" value="{{$item->User->direccion}}" readonly>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Ciudad</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/flag.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input type="text" class="form-control" value="{{$item->User->city}}" readonly>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Codigo Postal</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/cp.png') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input type="text" class="form-control" value="{{$item->User->postcode}}" readonly>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Especialidad</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/certificacion.webp') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="especialidad" name="especialidad" type="text" class="form-control"  value="{{ $item->User->especialidad }}">
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Escuela</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/aprender-en-linea.webp') }}" alt="" width="35px" style="margin-right: 1rem">
                                </span>
                                <input id="escuela" name="escuela" type="text" class="form-control" value="{{ $item->User->escuela }}">
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="name">¿Habilitar boton Guardar? *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/pausa.png') }}" alt="" width="35px">
                                </span>
                                <select name="habilitar_btn" id="habilitar_btn" class="form-select d-inline-block">
                                    @if ($item->User->habilitar_btn == 'Si')
                                        <option selected value="Si">Si</option>
                                    @else
                                        <option selected value="No">No</option>
                                    @endif
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Método de Pago *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                </span>
                                <select name="forma_pago" id="forma_pago" class="form-select d-inline-block">
                                    <option selected value="" >{{ $item->forma_pago }}</option>
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
                                <input class="form-control" type="number" id="pago" name="pago" value="{{ $item->pago }}">
                            </div>
                        </div>

                        <div class="form-group col-12 mt-3">
                            <label for="name">Foto (Comprobante)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                </span>
                                <input id="foto" name="foto" type="file" class="form-control" >
                            </div>

                            @if (pathinfo($item->foto, PATHINFO_EXTENSION) === 'pdf')
                                <iframe class="mt-2" src="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto )}}" style="width: 60%; height: auto"></iframe>
                            @else

                            <img id="blah" src="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto )}}" alt="Imagen" style="width: 10%">
                                <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto )}}" download="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto )}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            @endif

                        </div>

                        <div class="form-group col-6 mt-3">
                            <label for="name">Método de Pago 2</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                </span>
                                <select name="forma_pago2" id="forma_pago2" class="form-select d-inline-block">
                                    <option value="" >{{ $item->forma_pago2 }} </option>
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
                                <input class="form-control" type="number" id="pago2" name="pago2" {{ $item->pago2 }}>
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

                            @if (pathinfo($item->foto2, PATHINFO_EXTENSION) === 'pdf')
                                <iframe class="mt-2" src="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto2 )}}" style="width: 60%; height: auto"></iframe>

                            @else
                            <img id="blah" src="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto2 )}}" alt="Imagen" style="width: 10%">
                                <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto2 )}}" download="{{asset('documentos/'. $item->User->telefono . '/' .$item->foto )}}" style="background: #836262; border-radius: 19px;">
                                    Descargar
                                </a>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Clasificacion de Clave</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="35px">
                                </span>
                                <select name="clave_clasificacion" class="form-select d-inline-block clave-clasificacion">

                                    @if($item->User->clave_clasificacion == null)
                                        <option value="">Selecionar una Opcion</option>
                                    @else
                                        <option value="{{ $item->User->clave_clasificacion }}">{{ $item->User->clave_clasificacion }}</option>
                                    @endif

                                    <option value="RIFC680910-879-0013" {{ old('clave_clasificacion') == 'RIFC680910-879-0013' ? 'selected' : '' }}>RIFC680910-879-0013</option>
                                    <option value="HERK000617-BY7-0005" {{ old('clave_clasificacion') == 'HERK000617-BY7-0005' ? 'selected' : '' }}>HERK000617-BY7-0005</option>
                                    <option value="Otra" {{ old('clave_clasificacion') == 'Otra' ? 'selected' : '' }}>Otra</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input dinámico -->
                        <div class="form-group col-6 d-none otra-clave-container">
                            <label for="otra_clave">Especifica otra clave</label>
                            <input type="text" name="otra_clave" class="form-control" placeholder="Ingresa la clave">
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
