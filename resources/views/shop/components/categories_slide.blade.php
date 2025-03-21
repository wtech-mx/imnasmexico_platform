<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4 mt-3"> {{ $producto->categorias->pluck('nombre')->implode(', ') }}</h3>
        </div>

        <div id="meatAndFishCarousel" class="owl-carousel owl-theme">
            @foreach ($productos_categoria as $producto_categoria)
                <div class="container_grid_category row" style="padding: 0px">
                        <div class="col-3 my-auto">
                            <a href="{{ route('tienda_online.single', $producto_categoria->slug) }}">
                                @if ($producto_categoria->imagen_principal == NULL)
                                    <div class="mx-auto img_grid_categorie" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') #ffffff00  50% / contain no-repeat;"></div>
                                @else
                                    <div class="mx-auto img_grid_categorie" style="background: url(&quot;{{ asset('imagen_principal/empresa' . $empresa->id . '/' . $producto_categoria->imagen_principal) }}&quot;) #ffffff00  50% / contain no-repeat;"></div>
                                @endif
                            </a>
                        </div>

                        <div class="col-7">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-left m-1 brand_text_grid_category">{{ $producto_categoria->Marca->nombre ?? 'SM' }}</h5>
                                    <h4 class="text-left m-1 title_product_category">
                                        <a class="title_product_category" href="{{ route('tienda_online.single', $producto_categoria->slug) }}" style="text-decoration: none">
                                        {{$producto_categoria->nombre}}
                                        </a>
                                    </h4>
                                    <p class="text-left m-1 category_text_grid_category">By  {{ $producto->categorias->pluck('nombre')->implode(', ') }}</p>
                                    @if($producto->ProductoStock)

                                    @else
                                    <h6 class="text-left m-1 price_text_grid_category">${{number_format($producto_categoria->ProductoStock->precio_normal, 2, '.', ',')}}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-2 my-auto" style="padding: 0">
                            <a class="btn btn-xs btn_ver_mas_cat tex-white" href="{{ route('tienda_online.single', $producto_categoria->slug) }}"><i class="bi bi-bag-plus"></i></a>
                        </div>
                </div>
            @endforeach
            <!-- Agregar más productos aquí -->
        </div>
    </div>
</div>
