<!-- Modal -->
{{-- <div class="modal fade" id="update_product_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="update_product_{{ $product->id }}" aria-hidden="true"> --}}
    <div class="modal fade" id="create_product" tabindex="-1" aria-labelledby="create_productModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_modal">Crear envase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <form method="POST" class="" action="{{ route('envases.store') }}" enctype="multipart/form-data" role="form">
                    @csrf

                    <div class="modal-body row">
                        <div class="row">

                            <div class="form-group col-12">
                                <label for="name">Envase</label>
                                <input id="envase" name="envase" type="text" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="name">Conteo</label>
                                <input id="conteo" name="conteo" type="number" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="name">Cama/Caja</label>
                                <input id="cama" name="cama" type="text" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="name">Categoria</label>
                                <input id="categoria" name="categoria" type="text" class="form-control">
                            </div>

                            <div class="form-group col-6">
                                <label for="imagenes">Link drive img</label>
                                <input id="imagen" name="imagen" type="text" class="form-control">
                            </div>

                            <div class="form-group col-12">
                                <label for="num_estandar">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" ></textarea>
                            </div>

                            <div class="form-group col-12">
                                <label for="name">Productos</label>
                                <select class="form-control js-example-basic-multiple" id="productos[]" name="productos[]" multiple style="width: 70%;!important">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->nombre }}</option>
                                    @endforeach
                                </select>
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
