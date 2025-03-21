@if($productos->isEmpty())
    <li class="list-group-item text-muted">No hay resultados</li>
@else
    @foreach ($productos as $producto)
        <li class="list-group-item producto-item d-flex align-items-center"
            data-url="{{ route('tienda_online.single', $producto->slug) }}" style="cursor: pointer;">

            @if ($producto->imagen_principal == NULL)
                <img src="{{ asset('ecommerce/Isotipo_negro.png') }}"
                    alt="{{ $producto->nombre }}"
                    class="img-thumbnail me-2"
                    style="width: 50px; height: 50px;">
            @else
                <img src="{{ asset('imagen_principal/empresa1/' . $producto->imagen_principal) }}"
                    alt="{{ $producto->nombre }}"
                    class="img-thumbnail me-2"
                    style="width: 50px; height: 50px;">
            @endif

            {{ $producto->nombre }}
        </li>
    @endforeach
@endif
