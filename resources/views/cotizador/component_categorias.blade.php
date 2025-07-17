
                <div class="col-12">
                    <h5 class="p-2">Categorías</h5>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" id="categoriaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="corp-tab" data-bs-toggle="tab" data-bs-target="#corp" type="button" role="tab" aria-controls="corp" aria-selected="true">
                                Corporales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="facial-tab" data-bs-toggle="tab" data-bs-target="#facial" type="button" role="tab" aria-controls="facial" aria-selected="false">
                                Faciales
                            </button>
                        </li>
                        <!-- NUEVA pestaña Kits -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kits-tab" type="button" role="tab">Kits</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Corporales -->
                        <div class="tab-pane fade show active" id="corp" role="tabpanel" aria-labelledby="corp-tab">
                            <div id="loop_categorias_corp" class="owl-carousel">
                                @foreach ($categoriasCorporal as $categoria)
                                    @php
                                        if (Route::currentRouteName() == 'index_cosmica.cotizador') {
                                            $src = 'cosmika\inicio\lineas/'. $categoria->nombre.'.png';
                                        }else{
                                            $src = 'categorias/'.$categoria->imagen;
                                        }
                                    @endphp
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria('{{ $categoria->nombre }}')">
                                            <h6 class="mt-3 mb-1 tittle_category">Corporal</h6>
                                            <img src="{{ asset($src) }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Faciales -->
                        <div class="tab-pane fade" id="facial" role="tabpanel" aria-labelledby="facial-tab">
                            <div id="loop_categorias_facial" class="owl-carousel">
                                @foreach ($categoriasFacial as $categoria)
                                    @php
                                        if (Route::currentRouteName() == 'index_cosmica.cotizador') {
                                            $src = 'cosmika\inicio\lineas/'. $categoria->nombre.'.png';
                                        }else{
                                            $src = 'categorias/'.$categoria->imagen;
                                        }
                                    @endphp
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria('{{ $categoria->nombre }}')">
                                            <h6 class="mt-3 mb-1 tittle_category">Facial</h6>
                                            <img src="{{ asset($src) }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
