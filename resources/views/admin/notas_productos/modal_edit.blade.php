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
                        @if ($nota->id_usuario == NULL)
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="name" name="name" type="text" class="form-control" value="{{ $nota->nombre }}" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Telefono</label>
                                    <input id="telefono" name="telefono" type="number" class="form-control" value="{{ $nota->telefono }}">
                                </div>
                            </div>
                        @else
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
                        @endif


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
                        @php
                            $precio = number_format($productos->price, 0, '.', ',');
                        @endphp
                        <div class="col-6">
                            <label for="">Nombre</label>
                            <input type="text"  class="form-control d-inline-block" value="{{ $productos->producto }}" disabled>
                        </div>

                        <div class="col-3">
                            <label for="">Precio</label>
                            <input type="text"  class="form-control d-inline-block" value="${{ $precio }}" disabled>

                        </div>

                        <div class="col-3">
                            <label for="">Cantidad</label>
                            <input type="number"  class="form-control d-inline-block" style="width: 65%;" value="{{ $productos->cantidad }}" disabled>
                        </div>
                        @php
                            $subtotal = $productos->price;
                            $total += $subtotal;
                            $precio = number_format($total, 2, '.', ',');
                        @endphp

                        @endforeach
                        <div class="col-6 mt-3">
                            <p><strong>Total</strong></p>
                        </div>
                        <div class="col-6 mt-3">
                            <p><strong>${{ $precio }}</strong></p>
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
                                                <label for="">Producto</label>
                                                <select id="campo[]" name="campo[]" class="form-select d-inline-block producto2">
                                                    <option value="">Seleccione products</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->nombre }}" data-precio_normal2="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="">Cantidad</label>
                                                <div class="form-group">
                                                    <input type="number" name="campo3[]" class="form-control d-inline-block cantidad2" >
                                                </div>
                                              </div>

                                              <div class="col-3">
                                                <label for="">Subtotal</label>
                                                <div class="form-group">
                                                    <input type="text" name="campo4[]" class="form-control d-inline-block subtotal2" readonly>
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
                                <label for="name">Descuento</label>
                                <input id="restante" name="restante" type="number" class="form-control"  value="{{ $nota->restante }}" disabled>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Subtotal</label>
                                <input id="subtotal" name="subtotal" type="text" class="form-control"  value="{{ $precio }}" disabled>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Total</label>
                                @php
                                    $total_formateado = number_format($nota->total, 2, '.', ',');
                                @endphp
                                <input type="text" class="form-control"  value="{{ $total_formateado }}" disabled>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Metodo de pago</label>
                                <select class="form-select" name="metodo_pago" id="metodo_pago">
                                    <option value="{{ $nota->metodo_pago }}">{{ $nota->metodo_pago }}</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Monto</label>
                                <input class="form-control" type="text" id="monto" name="monto" value="{{ $nota->monto }}">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Foto Pago</label>
                                <input class="form-control" type="file" id="foto_pago2" name="foto_pago2" value="{{ $nota->foto_pago2 }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Metodo de pago 2</label>
                                <select class="form-select" name="metodo_pago2" id="metodo_pago2">
                                    <option value="{{ $nota->metodo_pago2 }}">{{ $nota->metodo_pago2 }}</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta Credito/debito">Tarjeta Credito/debito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Monto 2</label>
                                <input class="form-control" type="text" id="monto2" name="monto2" value="{{ $nota->monto2 }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Comentario/nota</label>
                                <textarea class="form-control" name="nota" id="nota" cols="30" rows="3">
                                    {{ $nota->nota }}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="name">Foto Pago</label>
                            <div class="form-group">
                                @if ($nota->foto_pago2 == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 250px; height: 300px;"/>
                                @else
                                    <img id="blah" src="{{asset('pagos/'.$nota->foto_pago2) }}" alt="Imagen" style="width: 250px; height: 300px;"/>
                                @endif
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
