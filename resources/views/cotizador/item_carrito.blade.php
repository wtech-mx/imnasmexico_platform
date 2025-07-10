<li class="list-group-item" data-id="{{ $producto['id'] }}" style="padding: 0!important;border: 0!important;">
    <div class="d-flex">
        <div class="me-3">

            {{-- <img src="{{ $producto['imagen'] }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;"> --}}

            @if($producto['subcategoria'] == 'Kit')
                @if ($producto['imagen'] == NULL)
                    <img  class="rounded"src="{{asset('cursos/no-image.jpg') }}" style="width: 50px; height: 50px; object-fit: cover;" />
                @else
                    <img  class="rounded"src="{{asset('products/'.$producto['imagen']) }}" style="width: 50px; height: 50px; object-fit: cover;" />
                @endif
            @else
                @if ($producto['imagen'] == NULL)
                    <img  class="rounded"src="{{asset('cursos/no-image.jpg') }}" style="width: 50px; height: 50px; object-fit: cover;" />
                @else
                    <img  class="rounded"src="{{ $producto['imagen'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                @endif
            @endif

        </div>
        <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position: relative">
            <div>
                <div class="fw-semibold" style="color: #6d6d6d;font-size: 15px;">{{ $producto['nombre'] }}</div>
                <small class="text-muted precio-unitario" style="font-size: 11px;" data-precio="{{ $producto['precio'] }}">${{ number_format($producto['precio'], 2) }}</small>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
                <button type="button" class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $producto['id'] }}, -1)">-</button>
                <span class="mx-2 cantidad">{{ $producto['cantidad'] }}</span>
                <button type="button" class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $producto['id'] }}, 1)">+</button>

                <button type="button" class="btn btn-sm ms-2" onclick="eliminarDelCarrito({{ $producto['id'] }})">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="text-end mt-1">
        <div class="d-flex justify-content-around align-items-center">
            <div class="content">
                <div style="position: relative; width: 120px;">
                    <input id="descuento-input" name="descuento[{{ $producto['id'] }}]"  type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: start;    font-size: 13px;" class="descuento-input">
                    <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                </div>
            </div>
            <span class="total" style="font-size: 13px;">${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</span>
        </div>
    </div>

    {{-- ↓ **Aquí** inyectamos el desglose si es Kit --}}

  @if(!empty($bundleItems))
    <div class="row">
        <div class="col-12">
            <div class="mt-2 ps-4" style="font-size:.9em; color:#555;">
            {{-- 1) El botón que colapsa --}}
            <a style="text-decoration: none;" class=""
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#bundle-{{ $producto['id'] }}"
                    aria-expanded="false"
                    aria-controls="bundle-{{ $producto['id'] }}">
                <i class="bi bi-arrow-bar-down"></i> Ver Productos
            </a>

            {{-- 2) El contenedor colapsable, oculto por defecto --}}
            <div class="collapse mt-2" id="bundle-{{ $producto['id'] }}">
                <ul class="list-unstyled mb-0">
                @foreach($bundleItems as $item)
                    <li>• {{ $item->producto }} @if($item->cantidad>1)x{{ $item->cantidad }}@endif</li>
                @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
  @endif

    <hr style="margin: 0.5rem 0!important">
        <input type="hidden" name="productos[{{ $producto['id'] }}][id]" value="{{ $producto['id'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][precio]" value="{{ $producto['precio'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][cantidad]" class="cantidad-input" value="{{ $producto['cantidad'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][descuentoPct]" class="descuento-input-hidden" value="0">
</li>
