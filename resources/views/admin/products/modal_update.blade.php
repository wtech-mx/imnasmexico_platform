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
                    <input type="hidden" id="stock_cosmica" name="stock_cosmica" value="{{ $product->stock_cosmica }}">
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
                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $product->nombre }}" >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Precio normal</label>
                                        <input id="precio_normal" name="precio_normal" type="number" class="form-control" value="{{ $product->precio_normal }}" >
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Marca</label>
                                        <select class="form-control" id="categoria" name="categoria">
                                            <option value="{{ $product->categoria }}">{{ $product->categoria }}</option>
                                            <option value="NAS">NAS</option>
                                            <option value="Cosmica">Cosmica</option>
                                        </select>
                                    </div>

                                    @if(request()->routeIs('products.index'))
                                        <div class="form-group col-6">
                                            <label for="categoria">Categoría</label>
                                            <select class="form-control" id="id_categoria" name="id_categoria">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $product->id_categoria == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="categoria">Categoría 2</label>
                                            <select class="form-control" id="id_categoria2" name="id_categoria2">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $product->id_categoria2 == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group col-6">
                                        <label for="name">Stock</label>
                                        <input id="stock" name="stock" type="number" class="form-control" value="{{ $product->stock}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Stock Salon 1</label>
                                        <input id="stock_salon" name="stock_salon" type="number" class="form-control" value="{{ $product->stock_salon}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Destacar</label>
                                        <select class="form-control" id="favorito" name="favorito">
                                            <option value="{{ $product->favorito }}">{{ $product->favorito }}</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Linea</label>
                                        <select class="form-control" id="linea" name="linea">
                                            <option value="{{ $product->linea }}">{{ $product->linea }}</option>
                                            <option value="Facial">Facial</option>
                                            <option value="Corporal">Corporal</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="name">Sub Linea</label>
                                        <select class="form-control" id="sublinea" name="sublinea">
                                            <option value="{{ $product->sublinea }}">{{ $product->sublinea }}</option>
                                            <option value="Estelar">Linea Corporal - Estelar</option>
                                            <option value="Eclipse">Linea Corporal - Eclipse</option>
                                            <option value="Renacer">Linea Corporal - Renacer</option>
                                            <option value="Flash">Linea Corporal - Flash</option>
                                            <option value="Astros">Linea Corporal - Astros</option>
                                            <option value="Galaxia">Linea Corporal - Galaxia</option>
                                            <option value="Rose Caviar">Linea Corporal - Rose Caviar</option>
                                            <option value="Esencia Vital">Linea Corporal - Esencia Vital</option>
                                            <option value="Pure">Linea Corporal - Pure</option>
                                            <option value="Lips Glow">Linea Facial - Lips Glow</option>
                                            <option value="Constelacion">Linea Facial - Constelacion</option>
                                            <option value="Espectro">Linea Facial - Espectro</option>
                                            <option value="Lunar">Linea Facial - Lunar</option>
                                            <option value="Mascarillas Estelares">Linea Facial - Mascarillas Estelares</option>
                                            <option value="Nebulosa">Linea Facial - Nebulosa</option>
                                            <option value="Pluton">Linea Facial - Pluton</option>
                                            <option value="Solar">Linea Facial - Solar</option>
                                            <option value="Venus">Linea Facial - Venus</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Modo de Empleo</label>
                                        <textarea name="modo_empleo" id="modo_empleo" cols="10" rows="3" class="form-control" >{{ $product->modo_empleo }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Beneficios</label>
                                        <textarea name="beneficios" id="beneficios" cols="10" rows="3" class="form-control" >{{ $product->beneficios }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Ingredientes</label>
                                        <textarea name="ingredientes" id="ingredientes" cols="10" rows="3" class="form-control" >{{ $product->ingredientes }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">Precauciones</label>
                                        <textarea name="precauciones" id="precauciones" cols="10" rows="3" class="form-control" >{{ $product->precauciones }}</textarea>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="num_estandar">descripcion</label>
                                        <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" >{{ $product->descripcion }}</textarea>
                                    </div>

                                    <div class="form-group col-auro">
                                        <label for="imagenes">Link drive img</label>
                                        <input id="imagenes" name="imagenes" type="text" class="form-control" value="{{ $product->imagenes }}" >
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


                    @can('productos-edit')
                        <div class="modal-footer">
                            <button type="submit"  class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                        </div>
                    @endcan
                </form>

            </div>
        </div>
    </div>
