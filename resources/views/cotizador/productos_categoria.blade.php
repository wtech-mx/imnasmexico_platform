<div class="row">
    @foreach ($productos as $producto)
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="product-card">
                <img src="{{$producto->imagenes}}" alt="{{ $producto->nombre }}">
                <h6 class="mt-2 mb-1 card_tittle_product">{{ $producto->nombre }}</h6>
                <div class="fw-bold mt-1">${{ number_format($producto->precio_normal, 2) }}</div>
            </div>
        </div>
    @endforeach
</div>

