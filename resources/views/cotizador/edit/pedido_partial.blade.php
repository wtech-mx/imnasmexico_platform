

<div class="sidebar">
                <h5 class="mb-2 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    @foreach ($cotizacion_productos as $cotizacion_producto)
                        <li class="list-group-item" data-id="{{ $cotizacion_producto->id_producto }}" style="padding: 0!important;border: 0!important;">
                            <div class="d-flex">
                                <div class="me-3">
                                    <img src="{{ $cotizacion_producto->Productos->imagenes }}" alt="{{ $cotizacion_producto->Productos->nombre }}" class="rounded" style="width: 35px; height: 35px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position: relative">
                                    <div>
                                        <div class="fw-semibold" style="color: #6d6d6d;font-size: 15px;">{{ $cotizacion_producto->Productos->nombre }}</div>
                                        <small class="text-muted precio-unitario" style="font-size: 11px;" data-precio="{{ $cotizacion_producto->precio_uni }}">${{ number_format($cotizacion_producto->precio_uni, 2) }}</small>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
                                        <button class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $cotizacion_producto->id_producto }}, -1)">-</button>
                                        <span class="mx-2 cantidad">{{ $cotizacion_producto->cantidad }}</span>
                                        <button class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $cotizacion_producto->id_producto }}, 1)">+</button>

                                        <button class="btn btn-sm ms-2" onclick="eliminarDelCarrito({{ $cotizacion_producto->id_producto }})">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-1">
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="content">
                                        <div style="position: relative; width: 120px;">
                                            <input id="descuento-input" name="descuento[{{ $cotizacion_producto->id_producto }}]"  type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: start; font-size: 13px;" class="descuento-input" value="{{ $cotizacion_producto->descuento }}">
                                            <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                                        </div>
                                    </div>
                                    <span class="total" style="font-size: 13px;">${{ number_format($cotizacion_producto->price, 2) }}</span>
                                </div>

                            </div>
                            <hr style="margin: 0.5rem 0!important">
                                <input type="hidden" name="productos[{{ $cotizacion_producto->id_producto }}][id]" value="{{ $cotizacion_producto->id_producto }}">
                                <input type="hidden" name="productos[{{ $cotizacion_producto->id_producto }}][precio]" value="{{ $cotizacion_producto->precio_uni }}">
                                <input type="hidden" name="productos[{{ $cotizacion_producto->id_producto }}][cantidad]" class="cantidad-input" value="{{ $cotizacion_producto->cantidad }}">
                                <input type="hidden" name="productos[{{ $cotizacion_producto->id_producto }}][descuentoPct]" class="descuento-input-hidden" value="{{ $cotizacion_producto->descuento ?? 0 }}">
                        </li>
                    @endforeach
                </ul>

                <h5 class="mb-3 mt-1 text-center">Informacion del Cliente</h5>

                <div class="row px-3">
                    <!-- Checkbox Facturación -->
                    <div class="form-check mb-2 col-6">
                        @if ($cotizacion->iva_cost >= '0')
                            <input class="form-check-input" type="checkbox" id="chkFacturacion" checked>
                        @else
                            <input class="form-check-input" type="checkbox" id="chkFacturacion">
                        @endif
                        <label class="form-check-label" for="chkFacturacion">
                            Facturación
                        </label>
                    </div>

                    <!-- Checkbox Envío -->
                    <div class="form-check mb-2 col-6">
                        @if ($cotizacion->envio == 'Si')
                            <input class="form-check-input" type="checkbox" id="chkEnvio" checked>
                        @else
                            <input class="form-check-input" type="checkbox" id="chkEnvio">
                        @endif
                        <label class="form-check-label" for="chkEnvio">
                            Agregar envío
                        </label>
                    </div>
                </div>

                <!-- Campos de envío (oculto por defecto) -->
                @include('cotizador.datos_direcion')

                <!-- Método de pago -->
                <div class="mb-3">
                    <label for="metodo_pago_cliente" class="form-label">Método de pago:</label>
                    <select id="metodo_pago_cliente" name="metodo_pago_cliente" class="form-select">
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta crédito">Tarjeta crédito</option>
                        <option value="Tarjeta débito">Tarjeta débito</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="Contraentrega">Contraentrega</option>
                    </select>
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="3" class="form-control">{{$cotizacion->nota}}</textarea>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span>Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-total" name="descuento_total" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;" value="{{$cotizacion->restante}}">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Envío:</span>
                    <span id="envio-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>IVA (16%):</span>
                    <span id="iva-display">$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total-display">$0.00</span>
                </div>
                <input type="hidden" name="subtotal_final" id="subtotal-final-input" value="{{$cotizacion->subtotal}}">
                <input type="hidden" name="envio_final"    id="envio-final-input"    value="{{$cotizacion->envio_cost}}">
                <input type="hidden" name="iva_final"      id="iva-final-input"      value="{{$cotizacion->iva_cost}}">
                <input type="hidden" name="total_final"    id="total-final-input"    value="{{$cotizacion->total}}">
                <!-- Botón -->
                <button type="submit" class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
</div>
