<!-- Modal -->
<div class="modal fade" id="pagos_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="registro_imnas_edit_{{ $item->id }}" aria-hidden="true">
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
                        <div class="form-group col-6">
                            <label for="name">Método de Pago *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="35px">
                                </span>
                                <select name="forma_pago" id="forma_pago" class="form-select d-inline-block" red>
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
                    </div>

                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
