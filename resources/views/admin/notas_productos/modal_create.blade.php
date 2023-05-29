<!-- Modal -->
<div class="modal fade" id="create_notas_productos" tabindex="-1" role="dialog" aria-labelledby="create_notas_productos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('notas_productos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>Datos del cliente</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Correo</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Correo">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Telefono</label>
                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Telefono" pattern="[0-9]{10}" required>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" value="{{$fecha}}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5>Seleciona los productos </h5>
                        </div>

                        <div class="col-1">
                            <div class="form-group">
                                <button class="mt-5" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-11">
                            <div class="form-group">
                                <div id="camposContainer">
                                    <div class="campo mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="">Producto</label>
                                                <div class="form-group">
                                                    <select name="campo[]" class="form-select d-inline-block producto">
                                                        <option value="">Seleccione products</option>
                                                        @foreach ($products as $product)
                                                        <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                              <div class="col-3">
                                                <label for="">Cantidad</label>
                                                <div class="form-group">
                                                    <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" >
                                                </div>
                                              </div>
                                              <div class="col-3">
                                                <label for="">Subtotal</label>
                                                <div class="form-group">
                                                    <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <h5>Pago</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Subtotal</label>
                                <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Descuento</label>
                                <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Total</label>
                                <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" readonly>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Metodo de pago</label>
                                <select class="form-select" name="metodo_pago" id="metodo_pago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Monto</label>
                                <input class="form-control" type="text" id="monto" name="monto" value="0">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Foto Pago</label>
                                <input class="form-control" type="file" id="foto_pago2" name="foto_pago2">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Metodo de pago 2</label>
                                <select class="form-select" name="metodo_pago2" id="metodo_pago2">
                                    <option value="">Seleccione metodo de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Monto 2</label>
                                <input class="form-control" type="text" id="monto2" name="monto2">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Comentario/nota</label>
                                <textarea class="form-control" name="nota" id="nota" cols="30" rows="3"></textarea>
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
