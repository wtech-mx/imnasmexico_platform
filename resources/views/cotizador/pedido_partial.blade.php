        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <div class="sidebar">
                <h5 class="mb-4 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    <!-- Aquí se insertan los productos dinámicamente -->
                </ul>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Descuento:</span>
                    <input type="number" placeholder="Ingresa Descuento %" style="border: 1px solid #0b0b0b;border-width: 0px 0px 1px 0px;text-align: end;">
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
