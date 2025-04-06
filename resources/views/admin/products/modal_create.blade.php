<!-- Modal -->
<div class="modal fade" id="create_product" tabindex="-1" role="dialog" aria-labelledby="create_product" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_product">Crear Prodcuto</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body row">
                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Precio normal</label>
                        <input id="precio_normal" name="precio_normal" type="number" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Stock</label>
                        <input id="stock" name="stock" type="number" class="form-control" >
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Categoria</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="">Seleciona una opcion</option>
                            <option value="NAS">NAS</option>
                            <option value="Cosmica">Cosmica</option>
                            <option value="Insumos Bodega">Insumos Bodega</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Subcategoria</label>
                        <select class="form-control" id="subcategoria" name="subcategoria" required>
                            <option value="">Seleciona una opcion</option>
                            <option value="Tiendita">Tiendita</option>
                            <option value="Producto">Producto</option>
                            <option value="Muestras">Muestras</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="num_estandar">descripcion</label>
                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control">
                        </textarea>
                    </div>

                    <div class="form-group col-12">
                        <label for="imagenes">Link drive img</label>
                        <input id="imagenes" name="imagenes" type="text" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
