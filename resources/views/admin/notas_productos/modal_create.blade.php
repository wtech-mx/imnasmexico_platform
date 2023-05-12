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
                                                <label for="">Nombre</label>
                                                <input type="text" name="campo[]" class="form-control d-inline-block" >
                                            </div>
                                            <div class="col-3">
                                                <label for="">Precio</label>
                                                <input type="number" name="campo2[]" class="form-control d-inline-block" >

                                            </div>
                                            <div class="col-3">
                                                <label for="">Cantidad</label>
                                                <input type="number" name="campo3[]" class="form-control d-inline-block" style="width: 65%;">
                                                <button type="button" class="eliminarCampo" style="border-radius: 9px;margin-left: 0.2rem;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <h5>Pago</h5>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Metodo de pago</label>
                                <select class="form-select" name="metodo_pago" id="metodo_pago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Tipo de descuento</label>
                                <select class="form-select" name="tipo" id="tipo">
                                    <option value="Porcentaje">Porcentaje (%)</option>
                                    <option value="Fijo">Fijo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Descuento</label>
                                <input id="restante" name="restante" type="number" class="form-control"  required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Total</label>
                                <input id="total" name="total" type="number" class="form-control"  >
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
