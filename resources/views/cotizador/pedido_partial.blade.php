        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <div class="sidebar">
                <h5 class="mb-2 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    <!-- Aquí se insertan los productos dinámicamente -->
                </ul>

                <h5 class="mb-4 mt-1 text-center">Informacion del Cliente</h5>

                <!-- Checkbox Facturación -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="chkFacturacion">
                    <label class="form-check-label" for="chkFacturacion">
                        Facturación
                    </label>
                </div>

                <!-- Checkbox Envío -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="chkEnvio">
                    <label class="form-check-label" for="chkEnvio">
                        Agregar envío
                    </label>
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
                    <textarea id="observaciones" name="observaciones" rows="3" class="form-control" placeholder="Alguna nota…"></textarea>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span>Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-total" name="descuento-total" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal-display">$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total-display">$0.00</span>
                </div>

                <!-- Botón -->
                <button class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
            </div>
        </div>
