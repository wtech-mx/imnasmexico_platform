<li class="list-group-item" data-id="{{ $producto['id'] }}" style="padding: 0!important;border: 0!important;">
    <div class="d-flex">
        <div class="me-3">
            <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
        </div>
        <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position: relative">
            <div>
                <div class="fw-semibold">{{ $producto['nombre'] }}</div>
                <small class="text-muted">${{ number_format($producto['precio'], 2) }}</small>
            </div>
            <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
                <button class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $producto['id'] }}, -1)">-</button>
                <span class="mx-2 cantidad">{{ $producto['cantidad'] }}</span>
                <button class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $producto['id'] }}, 1)">+</button>
                <button class="btn btn-sm ms-2" onclick="eliminarDelCarrito({{ $producto['id'] }})">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="text-end mt-2">
        <span class="total">${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</span>
    </div>
    <hr>
</li>
