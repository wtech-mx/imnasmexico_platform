        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <div class="sidebar">
                <h5 class="mb-4 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    <!-- Aquí se insertan los productos dinámicamente -->
                </ul>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span>Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-input" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal">$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total">$0.00</span>
                </div>

                <!-- Botón -->
                <button class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
            </div>
        </div>
