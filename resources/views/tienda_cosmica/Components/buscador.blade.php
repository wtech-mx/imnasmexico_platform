@if($productos->isEmpty())
    <li class="list-group-item text-muted">No hay resultados</li>
@else
    @foreach ($productos as $producto)
        <li class="list-group-item producto-item d-flex align-items-center"
            data-url="{{ route('tienda.single_product', $producto->slug) }}" style="cursor: pointer;">
            <img src="{{ $producto->imagenes }}"
                 alt="{{ $producto->nombre }}"
                 class="img-thumbnail me-2"
                 style="width: 50px; height: 50px;">
            {{ $producto->nombre }}
        </li>
    @endforeach
@endif
