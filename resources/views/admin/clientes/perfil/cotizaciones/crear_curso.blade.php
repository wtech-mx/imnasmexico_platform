<form id="myForm" method="POST" action="{{ route('notas_cursos.store') }}" enctype="multipart/form-data" role="form">
    @csrf
    <div class="modal-body">
        <div class="row">

            <div class="col-12 mt-2">
                <h2 style="color:#836262"><strong>Datos del cliente</strong> </h2>
            </div>

            <div class="row">
                <div class="form-group col-4">
                    <h4 for="name">Nombre *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                        </span>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->name : $cliente->nombre }}" required>
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Correo</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="35px">
                        </span>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $tipo == 'Usuario' ? $cliente->email : '' }}">
                    </div>
                </div>

                <div class="form-group col-4">
                    <h4 for="name">Telefono *</h4>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="35px">
                        </span>
                        <input type="number" id="telefono" name="telefono" class="form-control" value="{{$cliente->telefono}}" required>
                    </div>
                </div>
            </div>

            <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fechaPerfil}}" style="display: none">

            <div class="col-12 mt-5">
                <h2 style="color:#836262"><strong>Seleciona el/los Curso(s)</strong> </h2>
            </div>

            <div class="col-11">
                <div id="formulario" class="mt-4">
                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                    <div class="clonars">
                        <div class="row">
                            <div class="col-10">
                                <label for="">Curso</label>
                                <div class="form-group">
                                    <select name="concepto[]" class="form-select d-inline-block select2">
                                        <option value="">Seleccione curso</option>
                                        @foreach ($cursos_compra as $curso)
                                        <option value="{{ $curso->id }}" data-precio_normal="{{ $curso->precio }}">{{ $curso->nombre }} - {{ $curso->Cursos->modalidad }} / {{ $curso->Cursos->fecha_inicial }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="num_sesion">Subtotal</label>
                                    <input  id="importe[]" name="importe[]" type="number" class="form-control importe" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2 mb-3">
                <h2 style="color:#836262"><strong>Pago</strong> </h2>
            </div>

            <div class="col-4 ">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="toggleFactura" name="factura" value="1">
                    <h4 class="form-check-h4" for="flexCheckDefault">
                        <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Factura?)</strong>
                    </h4>
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Descuento %</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input class="form-control descuento" type="text" id="descuento" name="descuento">
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Total</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Restante</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input type="text" class="form-control" id="restante" name="restante" value="0" readonly>
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Monto 1 *</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input type="text" class="form-control" id="monto1" name="monto1" required>
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

            <div class="form-group col-4 ">
                <label for="name">Foto (Comprobante)</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                    </span>
                    <input id="foto" name="foto" type="file" class="form-control" placeholder="foto">
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Monto 2 *</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input type="text" class="form-control" id="monto2" name="monto2">
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="name">Metodo de Pago 2</label>
                    <select name="metodo_pago2" id="metodo_pago2" class="form-select d-inline-block">
                        <option value="">Selecciona una opcion</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                    </select>
                </div>
            </div>

            {{-- <div id="divFactura" style="display: none;">
                <div class="row">
                    <h4>Factura</h4>

                    <div class="form-group col-4">
                        <h4 for="name">Situacion Fiscal</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="file" id="situacion_fiscal" name="situacion_fiscal">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <h4 for="name">Nombre / Razon Social</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/firma-digital.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="text" id="razon_social" name="razon_social">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <h4 for="name">RFC</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/carta.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="text" id="rfc" name="rfc">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <h4 for="name">CFDI</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/monetary-policy.png') }}" alt="" width="35px">
                            </span>
                            <select class="form-select" name="cfdi" id="cfdi">
                                <option value="">Seleccione CFDI</option>
                                <option value="G01 Adquisicion de Mercancias">G01 Adquisicion de Mercancias</option>
                                <option value="G02 Devoluciones, Descuentos o Bonificaciones">G02 Devoluciones, Descuentos o Bonificaciones</option>
                                <option value="G03 Gastos en General">G03 Gastos en General</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <h4 for="name">Correo</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/email.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="text" id="correo_fac" name="correo_fac">
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <h4 for="name">Telefono</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="number" id="telefono_fac" name="telefono_fac">
                        </div>
                    </div>

                    <div class="col-12">
                        <h4 for="name">Direccion de Factura</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/cp.png') }}" alt="" width="35px">
                            </span>
                            <input class="form-control" type="text" id="direccion_fac" name="direccion_fac">
                        </div>
                    </div>

                </div>
            </div> --}}

            <div class="col-12">
                <div class="form-group">
                    <h4 for="name">Comentario/nota</h4>
                    <textarea class="form-control" name="nota" id="nota" cols="30" rows="3"></textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn close-modal" id="saveButton" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
    </div>
</form>
