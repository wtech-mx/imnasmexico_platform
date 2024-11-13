<!-- Modal -->
{{-- <div class="modal fade" id="update_product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="update_product_{{ $product->id }}" aria-hidden="true"> --}}
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <form id="editProductForm">
            {{-- <form method="POST" class="" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" role="form"> --}}
                @csrf
                <input type="hidden" id="product_id">

                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" id="stock" name="stock" value="{{ $product->stock }}">
                <input type="hidden" id="stock_nas" name="stock_nas" value="{{ $product->stock_nas }}">

                <div class="modal-body row">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Editar
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Historial
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="name">Nombre</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $product->nombre }}" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label for="name">Precio normal</label>
                                    <input id="precio_normal" name="precio_normal" type="number" class="form-control" value="{{ $product->precio_normal }}" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label for="name">Stock Actual</label>
                                    <input id="stock_cosmica" name="stock_cosmica" type="number" class="form-control" value="{{ $product->stock_cosmica}}" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label for="name">Cantidad aumentada</label>
                                    <input id="cantidad_aumentada" name="cantidad_aumentada" type="number" class="form-control" value="0">
                                </div>

                                <div class="form-group col-12">
                                    <label for="num_estandar">descripcion</label>
                                    <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" readonly>{{ $product->descripcion }}</textarea>
                                </div>

                                <div class="form-group col-auro">
                                    <label for="imagenes">Link drive img</label>
                                    <input id="imagenes" name="imagenes" type="text" class="form-control" value="{{ $product->imagenes }}" readonly>
                                    <img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit"  class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
