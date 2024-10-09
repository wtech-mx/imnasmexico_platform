<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasProduct" aria-labelledby="offcanvasProductLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasProductLabel">SKU : <strong id="productSku"></strong> </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
    </div>
    <div class="offcanvas-body">
      <img id="productImage" src="" alt="Imagen del Producto" class="w-100 mb-3">
      <h4 id="productName"></h4>
      <p><strong>Precio:</strong> $<span id="productPrice"></span></p>
      <p><strong>Stock:</strong> <span id="productStock"></span></p>

      <div class="row">
        <div class="form-group col-6 my-auto">
            <p><strong># Cantidad</strong></p>
        </div>

        <div class="form-group col-6 ">
            <input id="cantidad" name="cantidad" type="number" class="form-control" min="1" value="1">
        </div>

        <div class="col-12">
            <button id="addToCartBtn" class="btn btn-success btn-md w-100 mt-3">
                <i class="fa fa-shopping-cart text-sm opacity-10"></i>
                Agregar al pedido
            </button>
        </div>
      </div>

    </div>
</div>
