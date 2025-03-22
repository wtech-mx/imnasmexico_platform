<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">Productos Populares</h3>
        </div>

        <div id="popularProductsCarousel" class="owl-carousel owl-theme">
            @foreach ($productos_populares as $producto_popular)
            <div class="container_grid row" id="producto-{{ $producto_popular->id }}">
                <div class="col-12 my-auto">
                    <a href="">
                        @if ($producto_popular->imagen_principal == NULL)
                        <div class="mx-auto img_grid" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') #ffffff00 50% / contain no-repeat;"></div>
                        @else
                        <div class="mx-auto img_grid" style="background: url(&quot;{{ asset('imagen_principal/empresa' . $empresa->id . '/' . $producto_popular->imagen_principal) }}&quot;) #ffffff00 50% / contain no-repeat;"></div>
                        @endif
                    </a>
                </div>
                <div class="col-12">
                    <h5 class="text-left m-1 brand_text_grid">NAS</h5>
                    <h4 class="text-left m-1 title_product">
                        <a class="title_product" href="" style="text-decoration: none">
                            {{ $producto_popular->nombre }}
                        </a>
                    </h4>
                    <p class="text-left m-1 category_text_grid">By {{ $producto_popular->Categoria->nombre ?? 'Sin categoría' }}</p>
                    @if($producto_popular->precio_rebajado == NULL)
                        @if(date('N') == 1 && $producto_popular->id_categoria == 26)
                            <h6 class="price_text_grid_desc">
                                <strong class="precio_reaja">de <s>${{ number_format($producto_popular->precio_original, 2, '.', ',') }}</s></strong>
                                a ${{ number_format($producto_popular->precio_normal, 2, '.', ',') }}
                            </h6>
                        @else
                            <h6 class="price_text_grid">${{ number_format($producto_popular->precio_normal, 2) }}</h6>
                        @endif
                    @else
                        @if(strtotime($producto_popular->fecha_fin) >= strtotime(date('Y-m-d')))
                            <h6 class="price_text_grid_desc">
                                <strong class="precio_reaja">de <s>${{ number_format($producto_popular->precio_normal, 2, '.', ',') }}</s></strong>
                                a ${{ number_format($producto_popular->precio_rebajado, 2, '.', ',') }}
                            </h6>
                        @else
                            <h6 class="price_text_grid">${{ number_format($producto_popular->precio_normal, 2) }}</h6>
                        @endif
                    @endif
                </div>
                <div class="col-6 p-0">
                    <p class="text-center">
                        <a class="btn btn-xs btn_comprar tex-white mb-1 agregar-carrito" href="javascript:void(0);" data-id="{{ $producto_popular->id }}">
                            Comprar <i class="bi bi-cart-plus icon_comprar"></i>
                        </a>
                    </p>
                </div>
                <div class="col-6 p-0">
                    <p class="text-center">
                        <a class="btn btn-xs btn_ver_mas tex-white mb-1" href="">Ver más <i class="bi bi-basket3 icon_vermas"></i></a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productos = @json($productos_populares);

        productos.forEach(producto => {
            fetch(`/odoo/stock/${producto.id_woocommerce}`)
                .then(response => response.json())
                .then(data => {
                    const productoElement = document.getElementById(`producto-${producto.id}`);
                    if (data.stock <= 0) {
                        const agotadoDiv = document.createElement('div');
                        agotadoDiv.classList.add('etiqueta_grid_product');
                        agotadoDiv.innerHTML = '<p class="text-center texto_etiqueta_grid">Agotado</p>';
                        productoElement.prepend(agotadoDiv);
                    }
                })
                .catch(error => console.error('Error fetching stock:', error));
        });
    });
</script>
