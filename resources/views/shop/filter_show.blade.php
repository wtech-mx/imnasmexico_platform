<style>

.container_grid {
    width: 95%!important;
}

</style>

@forelse ($productos as $producto)
    <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="container_grid row mx-auto">


                @if($producto->ProductoStock->precio_descuento == NULL)
                @else

                    @if(strtotime($producto->ProductoStock->fecha_fin_desc) >= strtotime(date('Y-m-d')))

                    <div class="etiqueta_grid_product">
                        <p class="text-center texto_etiqueta_grid">Promo</p>
                    </div>

                    @else
                    @endif
                @endif

                <div class="col-12 my-auto">
                    <a href="{{ route('tienda_online.single', $producto->slug) }}">
                        @if ($producto->imagen_principal == NULL)
                            <div class="img_grid" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') center/contain no-repeat;"></div>
                        @else
                            <div class="img_grid" style="background: url(&quot;{{ asset('imagen_principal/empresa1/' . $producto->imagen_principal) }}&quot;) center/contain no-repeat;"></div>
                        @endif
                    </a>
                </div>

                <div class="col-12">
                    <h5 class="brand_text_grid">{{ $producto->Marca->nombre ?? 'SM' }}</h5>
                    <h4 class="title_product">{{ $producto->nombre }}</h4>
                    <p class="category_text_grid">By {{ $producto->categorias->pluck('nombre')->implode(', ') }}</p>

                    @if($producto->ProductoStock->precio_descuento == NULL)
                        <h6 class="price_text_grid">${{ number_format($producto->ProductoStock->precio_normal, 2) }}</h6>
                    @else

                        @if(strtotime($producto->ProductoStock->fecha_fin_desc) >= strtotime(date('Y-m-d')))
                            <h6 class="price_text_grid_desc">
                                <strong class="precio_reaja">de ${{number_format($producto->ProductoStock->precio_normal, 2, '.', ',');}}</strong>
                                a ${{number_format($producto->ProductoStock->precio_descuento, 2, '.', ',');}}
                            </h6>
                        @else
                            <h6 class="price_text_grid">${{ number_format($producto->ProductoStock->precio_normal, 2) }}</h6>
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
@empty
    <p>No se encontraron productos.</p>
@endforelse
