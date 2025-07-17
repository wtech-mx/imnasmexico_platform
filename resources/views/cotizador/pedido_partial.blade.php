

<div class="sidebar">
                <h5 class="mb-2 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    <!-- Aquí se insertan los productos dinámicamente -->
                </ul>

                <h5 class="mb-3 mt-1 text-center">Informacion del Cliente</h5>

                <div class="row px-3">
                    <!-- Checkbox Facturación -->
                    <div class="form-check mb-2 col-6">
                        <input class="form-check-input" type="checkbox" id="chkFacturacion">
                        <label class="form-check-label" for="chkFacturacion">
                            Facturación
                        </label>
                        <img src="{{ asset('assets/cam/carta_res.png') }}" style="width:17px;">
                    </div>

                    <!-- Checkbox Envío -->
                    <div class="form-check mb-2 col-6">
                        <input class="form-check-input" type="checkbox" id="chkEnvio">
                        <label class="form-check-label" for="chkEnvio">
                            Agregar envío
                        </label>
                        <img src="{{ asset('assets/cam/delivery.png') }}" style="width:17px;">
                    </div>
                </div>

                <!-- Campos de envío (oculto por defecto) -->
                @include('cotizador.datos_direcion')

                @if(Route::currentRouteName() == 'index_cosmica.cotizador')
                    <!-- Método de pago -->
                    <div class="mb-3">
                        <img src="{{ asset('assets/cam/dar-dinero.png') }}" style="width:17px;"><label for="metodo_pago_cliente" class="form-label">Método de pago:</label>
                        <select id="metodo_pago_cliente" name="metodo_pago_cliente" class="form-select">
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta crédito">Tarjeta crédito</option>
                            <option value="Tarjeta débito">Tarjeta débito</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Mercado Pago">Mercado Pago</option>
                            <option value="Contraentrega">Contraentrega</option>
                        </select>
                    </div>
                @endif

                <!-- Observaciones -->
                <div class="mb-3">
                    <img src="{{ asset('assets/user/icons/buscar.webp') }}" style="width:17px;"><label for="observaciones" class="form-label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="1" class="form-control" placeholder="Alguna nota…"></textarea>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span><img src="{{ asset('assets/user/icons/descuento.png') }}" style="width:17px;"> Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-total" name="descuento_total" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span><img src="{{ asset('assets/user/icons/money.png') }}" style="width:17px;"> Subtotal:</span>
                    <span id="subtotal-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span><img src="{{ asset('assets/cam/dar-dinero.png') }}" style="width:17px;"> Envío:</span>
                    <span id="envio-display">$0.00</span>
                </div>

                 @if(Route::currentRouteName() == 'index_cosmica.cotizador')
                    <div class="mb-2 d-flex justify-content-between">
                        <span><img src="{{ asset('assets/user/icons/por-ciento.png') }}" style="width:17px;"> IVA (16%):</span>
                        <span id="iva-display">$0.00</span>
                    </div>
                    @else
                    <span id="iva-display" class="d-none"></span>
                @endif

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span><img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" style="width:17px;"> TOTAL:</span>
                    <span id="total-display">$0.00</span>
                </div>

                <input type="hidden" name="subtotal_final" id="subtotal-final-input">
                <input type="hidden" name="envio_final"    id="envio-final-input">
                <input type="hidden" name="iva_final"      id="iva-final-input">
                <input type="hidden" name="total_final"    id="total-final-input">
                <!-- Botón -->
                <button type="submit" class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
</div>
