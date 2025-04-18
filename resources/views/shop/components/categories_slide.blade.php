@php
    $categorias = $productos_categoria->pluck('Categoria.nombre')->unique();
@endphp

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
                <h3 class="mb-4 mt-3">
                    @if ($categorias->count() == 1)
                        Categoria:  {{ $categorias->first() }}
                    @else
                        Productos de varias categorías
                    @endif
                </h3>
        </div>

        <div id="meatAndFishCarousel" class="owl-carousel owl-theme">
            @foreach ($productos_categoria as $producto_categoria)
            @if ($producto_categoria->slug)
                <div class="container_grid_category row" style="padding: 0px">
                    <div class="col-3 my-auto">
                        <a href="{{ route('tienda_online.single', $producto_categoria->slug) }}">
                            @if ($producto_categoria->imagenes == NULL)
                                <div class="mx-auto img_grid_categorie" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') #ffffff00  50% / contain no-repeat;"></div>
                            @else
                                <div class="mx-auto img_grid_categorie" style="background: url(&quot;{{$producto_categoria->imagenes}}&quot;) #ffffff00  50% / contain no-repeat;"></div>
                            @endif
                        </a>
                    </div>

                                <div class="col-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-left m-1 brand_text_grid_category">NAS</h5>
                                            <h4 class="text-left m-1 title_product_category">
                                                <a class="title_product_category" href="{{ route('tienda_online.single', $producto_categoria->slug) }}" style="text-decoration: none">
                                                {{$producto_categoria->nombre}}
                                                </a>
                                            </h4>
                                            <p class="text-left m-1 category_text_grid_category">By {{ $categorias->first() }}</p>

                                            @if($producto_categoria->precio_rebajado == NULL)
                                                @if(date('N') == 1 && $producto_categoria->id_categoria == 26)
                                                    <h6 class="text-left m-1 price_text_grid_category">
                                                        <strong class="precio_reaja">de <s>${{ number_format($producto_categoria->precio_original, 2, '.', ',') }}</s></strong>
                                                        a ${{ number_format($producto_categoria->precio_normal, 2, '.', ',') }}
                                                    </h6>
                                                @else
                                                    <h6 class="price_text_grid">${{ number_format($producto_categoria->precio_normal, 2) }}</h6>
                                                @endif
                                            @else
                                                @if(strtotime($producto_categoria->fecha_fin) >= strtotime(date('Y-m-d')))
                                                    <h6 class="text-left m-1 price_text_grid_category">
                                                        <strong class="precio_reaja">de <s>${{ number_format($producto_categoria->precio_normal, 2, '.', ',') }}</s></strong>
                                                        a ${{ number_format($producto_categoria->precio_rebajado, 2, '.', ',') }}
                                                    </h6>
                                                @else
                                                    <h6 class="price_text_grid">${{ number_format($producto_categoria->precio_normal, 2) }}</h6>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>

                    <div class="col-2 my-auto" style="padding: 0">
                        <a class="btn btn-xs btn_ver_mas_cat tex-white" href="{{ route('tienda_online.single', $producto_categoria->slug) }}"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            @endif
        @endforeach

            <!-- Agregar más productos aquí -->
        </div>
    </div>
</div>
