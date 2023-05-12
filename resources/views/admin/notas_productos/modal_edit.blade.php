<!-- Modal -->
<div class="modal fade" id="update_nota_{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="update_nota_{{ $nota->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('notas_productos.update', $nota->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>Datos del cliente</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" value="{{ $nota->User->name }}" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Correo</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ $nota->User->email }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Telefono</label>
                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $nota->User->telefono }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $nota->fecha }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <h5>Productos selecionados </h5>
                        </div>

                        @php
                            $total = 0;
                            $totalCantidad = 0;
                        @endphp

                        @foreach ($nota->ProductosNotasId as  $productos)

                        <div class="col-6">
                            <label for="">Nombre</label>
                            <input type="text" name="producto" class="form-control d-inline-block" value="{{ $productos->producto }}">
                        </div>

                        <div class="col-3">
                            <label for="">Precio</label>
                            <input type="number" name="price" class="form-control d-inline-block" value="{{ $productos->price }}">

                        </div>

                        <div class="col-3">
                            <label for="">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control d-inline-block" style="width: 65%;" value="{{ $productos->cantidad }}">
                        </div>
                        @php
                            $precio = $productos->price;
                            $cantidad = $productos->cantidad;
                            $subtotal = $precio * $cantidad;
                            $total += $subtotal;
                        @endphp

                        @endforeach
                        <div class="col-6 mt-3">
                            <p><strong></strong></p>
                        </div>

                        <div class="col-12">
                            <h5 class="mt-5">Seleciona mas productos </h5>
                        </div>

                        <div class="col-1">
                            <div class="form-group">
                                <button class="mt-5" type="button" id="agregarCampo2" style="border-radius: 9px;width: 36px;height: 40px;">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-11">
                            <div class="form-group">
                                <div id="camposContainer2">
                                    <div class="campo2 mt-3">
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
                                                <button type="button" class="eliminarCampo2" style="border-radius: 9px;margin-left: 0.2rem;">
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
                                    <option value="{{ $nota->metodo_pago }}" selected>{{ $nota->metodo_pago }}</option>
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
                                    <option value="{{ $nota->tipo }}" selected>{{ $nota->tipo }}</option>
                                    <option value="Porcentaje">Porcentaje (%)</option>
                                    <option value="Fijo">Fijo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Descuento</label>
                                <input id="restante" name="restante" type="number" class="form-control"  value="{{ $nota->restante }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="name">Total</label>
                                <input id="total" name="total" type="number" class="form-control"  value="{{ $nota->total }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Comentario/nota</label>
                                <textarea class="form-control" name="nota" id="nota" cols="30" rows="3">
                                    {{ $nota->nota }}
                                </textarea>
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
