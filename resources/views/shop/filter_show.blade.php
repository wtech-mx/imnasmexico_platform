<style>

.container_grid {
    width: 95%!important;
}

</style>

@forelse ($productos as $producto)
    <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="container_grid" id="">
            <!-- Fondo blanco que sube desde abajo -->
            <div class="card_base_white"></div>

            <!-- Contenido encima del fondo blanco -->
            <div class="card_content position-relative row">
                @if($producto->precio_rebajado == NULL)
                @else

                    @if(strtotime($producto->fecha_fin) >= strtotime(date('Y-m-d')))

                    <div class="etiqueta_grid_product">
                        <p class="text-center texto_etiqueta_grid">Promo</p>
                    </div>

                    @else
                    @endif
                @endif

                <div class="col-12 my-auto">
                    <a href="{{ route('tienda_online.single', $producto->slug) }}">
                        @if ($producto->imagenes == NULL)
                            <div class="img_grid" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') center/contain no-repeat;"></div>
                        @else
                            <div class="mx-auto img_grid" style="background: url(&quot;{{$producto->imagenes}}&quot;) #ffffff00 50% / contain no-repeat;"></div>
                        @endif
                    </a>
                </div>

                <div class="col-12">
                    <h5 class="brand_text_grid">NAS</h5>
                    <h4 class="title_product">{{ $producto->nombre }}</h4>
                    <p class="category_text_grid">By {{ $producto->Categoria->nombre ?? 'Sin categoría' }}</p>

                    @if($producto->precio_rebajado == NULL)
                        <h6 class="price_text_grid">${{ number_format($producto->precio_normal, 2) }}</h6>
                    @else

                        @if(strtotime($producto->fecha_fin) >= strtotime(date('Y-m-d')))
                            <h6 class="price_text_grid_desc">
                                <strong class="precio_reaja">de ${{number_format($producto->precio_original, 2, '.', ',');}}</strong>
                                a ${{number_format($producto->precio_rebajado, 2, '.', ',');}}
                            </h6>
                        @else
                            <h6 class="price_text_grid">${{ number_format($producto->precio_normal, 2) }}</h6>
                        @endif

                    @endif
                </div>

                <div class="col-6 p-0">
                    <p class="text-center">
                        <a class="btn btn-xs btn_comprar tex-white mb-1 agregar-carrito"
                           href="javascript:void(0);"
                           data-id="{{ $producto->id }}">
                            Comprar <i class="bi bi-cart-plus icon_comprar"></i>
                        </a>
                    </p>
                </div>

                <div class="col-6 p-0">
                    <p class="text-center">
                        <a class="btn btn-xs btn_ver_mas tex-white " href="{{ route('tienda_online.single', $producto->slug) }}">Ver más <i class="bi bi-basket3 icon_vermas"></i></a>
                    </p>
                </div>

        </div>
    </div>
    </div>
@empty
    <p>No se encontraron productos.</p>
@endforelse
