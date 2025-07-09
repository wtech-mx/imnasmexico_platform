<div class="row">
    @foreach ($productos as $producto)
        <div class="col-4 col-sm-3 col-md-2 col-lg-2 mb-2">
            <div class="product-card agregar-carrito"
                data-id="{{ $producto->id }}"
                data-nombre="{{ $producto->nombre }}"
                data-precio="{{ $producto->precio_normal }}"
                data-subcategoria="{{ $producto->subcategoria == '' }}"
                data-img="{{ $producto->imagenes }}">

                @if($producto->subcategoria == 'Kit')
                    @if ($producto->imagenes == NULL)
                        <img src="{{asset('cursos/no-image.jpg') }}" />
                    @else
                        <img src="{{asset('products/'.$producto->imagenes) }}" />
                    @endif
                @else
                    @if ($producto->imagenes == NULL)
                        <img src="{{asset('cursos/no-image.jpg') }}" />
                    @else
                         <img src="{{ $producto->imagenes }}">
                    @endif
                @endif

                {{-- <img src="{{ $producto->imagenes }}" alt="{{ $producto->nombre }}"> --}}
                <h6 class="mt-2 mb-1 card_tittle_product text-start">{{ $producto->nombre }}</h6>
                <div class="fw-bold text-start mt-1">${{ number_format($producto->precio_normal, 2) }}</div>
            </div>
        </div>
    @endforeach
</div>
