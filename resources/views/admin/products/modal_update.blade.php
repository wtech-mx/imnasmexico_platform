<!-- Modal -->
<div class="modal fade" id="update_product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="update_product_{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_product_{{ $product->id }}">Crear product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" class="" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $product->nombre }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Precio normal</label>
                        <input id="precio_normal" name="precio_normal" type="number" class="form-control" value="{{ $product->precio_normal }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Stock</label>
                        <input id="stock" name="stock" type="number" class="form-control" value="{{ $product->stock }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Categoria</label>
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="{{ $product->categoria }}">{{ $product->categoria }}</option>
                            <option value="NAS">NAS</option>
                            <option value="Cosmica">Cosmica</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="num_estandar">descripcion</label>
                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control">{{ $product->descripcion }}</textarea>
                    </div>

                    <div class="form-group col-12">
                        <label for="imagenes">Link drive img</label>
                        <input id="imagenes" name="imagenes" type="text" class="form-control" value="{{ $product->imagenes }}">
                        <img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 150px; height: 150px;"/>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
