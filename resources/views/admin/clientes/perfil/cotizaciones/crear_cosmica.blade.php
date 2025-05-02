

<form method="POST" action="{{ route('cotizacion_cosmica.store') }}" enctype="multipart/form-data" role="form" id="miFormulario">
    @csrf
    <input id="tipo_cotizacion" name="tipo_cotizacion" type="hidden" class="form-control" value="Perfil Alumno">
    <div class="modal-body">
        <div class="row">
            @if ($tipo == 'Usuario')
                <input id="id_cliente" name="id_cliente" type="hidden" value="{{$cliente->id}}" >
            @endif
            <div class="col-12 mt-2">
                <h4 style="color:#783E5D"><strong>Datos del cliente</strong> </h4>
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

            <div class="col-12">
                <h4 style="color:#783E5D"><strong>Seleciona los productos</strong> </h4>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <div id="camposContainer">
                        <div class="campo mt-3">
                            <div class="row">
                                <div class="col-7">
                                    <h4 for="">Producto</h4>
                                    <div class="form-group">
                                        <select name="campo[]" class="form-select d-inline-block producto">
                                            <option value="">Seleccione products</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-5">
                                    <h4 for="name">Cantidad *</h4>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                                        </span>
                                        <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" value="0">
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <h4 for="name">Des. (%)</h4>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                                        </span>
                                        <input type="number" id="descuento_prod" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <h4 for="name">Subtotal *</h4>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                        </span>
                                        <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <h4 for="name">Quitar</h4>
                                    <div class="input-group mb-3">
                                        <button type="button" class="btn btn-danger btn-sm eliminarCampo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <button class="mt-5" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 mt-2 mb-3">
                <h4 style="color:#783E5D"><strong>Pago</strong> </h4>
            </div>

            <div class="col-4 ">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkboxEnvio" name="envio">
                    <h4 class="form-check-h4" for="flexCheckDefault">
                        <p class="" style="display: inline-block;font-size: 20px;padding: 5px;color: #3b8b00;">Si</p> <strong> (¿Agregar envio?)</strong>
                    </h4>
                </div>
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
                <h4 for="name">Fecha *</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                    </span>
                    <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fechaPerfil}}" required>
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Subtotal *</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                    </span>
                    <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Descuento</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="35px">
                    </span>
                    <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                </div>
            </div>

            <div class="form-group col-4">
                <h4 for="name">Total</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                    </span>
                    <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                </div>
            </div>

            {{-- <div id="divFactura" style="display: none;">
                <div class="row">
                    <h2 style="color: #783E5D">Factura</h2>

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
        <button type="submit" class="btn close-modal" style="background: #322338; color: #ffff; font-size: 17px;">Guardar</button>
    </div>
</form>


