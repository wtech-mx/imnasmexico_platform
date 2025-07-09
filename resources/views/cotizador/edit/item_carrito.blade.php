
<li class="list-group-item" data-id="{{ $producto['id'] }}" style="padding: 0!important;border: 0!important;">
    <div class="d-flex">
        <div class="me-3">
            <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="rounded" style="width: 35px; height: 35px; object-fit: cover;">
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

                <button class="btn btn-sm ms-2" onclick="eliminarDelCarrito({{ $producto['id'] }})">
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
    <hr style="margin: 0.5rem 0!important">
        <input type="hidden" name="productos[{{ $producto['id'] }}][id]" value="{{ $producto['id'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][precio]" value="{{ $producto['precio'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][cantidad]" class="cantidad-input" value="{{ $producto['cantidad'] }}">
        <input type="hidden" name="productos[{{ $producto['id'] }}][descuentoPct]" class="descuento-input-hidden" value="0">
</li>
