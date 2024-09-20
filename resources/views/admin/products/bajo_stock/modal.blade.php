<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasProduct" aria-labelledby="offcanvasProductLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasProductLabel">Detalles del Producto</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <img id="productImage" src="" alt="Imagen del Producto" class="w-100 mb-3">
      <h6 id="productName"></h6>
      <p><strong>Precio:</strong> $<span id="productPrice"></span></p>
      <p><strong>Stock:</strong> <span id="productStock"></span></p>

        <div class="form-group col-6">
            <p><strong># Cantidad</strong></p>
            <input id="cantidad" name="cantidad" type="number" class="form-control" min="1" value="1">
        </div>

        <div class="col-12">
            <button id="addToCartBtn" class="btn btn-primary mt-3">Agregar al pedido</button>
        </div>
    </div>
</div>
