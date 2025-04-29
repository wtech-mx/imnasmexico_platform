<!-- Modal -->
{{-- <div class="modal fade" id="update_product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="update_product_{{ $product->id }}" aria-hidden="true"> --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                        <label for="name">Envase</label>
                                        <input id="envase" name="envase" type="text" class="form-control" value="{{ $product->envase }}" readonly>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Conteo</label>
                                        <input id="conteo" name="conteo" type="number" class="form-control" value="{{ $product->conteo}}" readonly>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Cantidad utilizada</label>
                                        <input id="cantidad_uti" name="cantidad_uti" type="number" class="form-control" style="background-color: rgba(255, 0, 0, 0.39);">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="name">Cantidad compradas</label>
                                        <input id="cantidad_aumentada" name="cantidad_aumentada" type="number" class="form-control" style="background-color: rgba(72, 255, 0, 0.39);">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Descripcion</label>
                                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" readonly>{{ $product->descripcion }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="name">Productos</label>
                                        <select class="form-control " id="productos_edit" name="productos_edit[]" multiple style="width: 70%;!important">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                            @endforeach
                                        </select>
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
