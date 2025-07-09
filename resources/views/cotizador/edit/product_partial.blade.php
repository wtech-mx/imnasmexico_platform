@php
  // Variables esperadas:
  //   $id, $imagen, $nombre, $precioUnitario, $cantidad, $descuentoPct, $lineTotal
  //   $isKit: boolean
@endphp

<li class="list-group-item" data-id="{{ $id }}" style="padding:0;border:0;">
  <div class="d-flex">
    <div class="me-3">
      <img src="{{ $imagen }}" class="rounded" style="width:35px;height:35px;object-fit:cover;">
    </div>
    <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position:relative">
      <div>
        <div class="fw-semibold" style="color:#6d6d6d;font-size:15px;">
          {{ $nombre }} @if($isKit) <small>(Kit)</small>@endif
        </div>
        <small class="text-muted precio-unitario" style="font-size:11px;" data-precio="{{ $precioUnitario }}">
          ${{ number_format($precioUnitario,2) }}
        </small>
      </div>
      <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
        <button type="button" class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $id }}, -1)">-</button>
        <span class="mx-2 cantidad">{{ $cantidad }}</span>
        <button type="button" class="btn btn-counter btn-sm" onclick="modificarCantidad({{ $id }}, 1)">+</button>
        <button class="btn btn-sm ms-2" onclick="eliminarDelCarrito({{ $id }})">
          <i class="bi bi-trash3"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="text-end mt-1">
    <div class="d-flex justify-content-around align-items-center">
      <div style="position:relative;width:120px;">
        <input
          id="descuento-input"
          name="descuento[{{ $id }}]"
          type="number"
          class="descuento-input"
          placeholder="Descuento"
          value="{{ $descuentoPct }}"
          style="width:100%;padding-right:1.5rem;border:0;border-bottom:1px solid #fff;text-align:start;font-size:13px;"
        >
        <span style="position:absolute;right:0.5rem;top:50%;transform:translateY(-50%);pointer-events:none;color:#555">%</span>
      </div>
      <span class="total" style="font-size:13px;">
        ${{ number_format($lineTotal,2) }}
      </span>
    </div>
  </div>
  <hr style="margin:.5rem 0!important">
  <input type="hidden" name="productos[{{ $id }}][id]"           value="{{ $id }}">
  <input type="hidden" name="productos[{{ $id }}][precio]"       value="{{ $precioUnitario }}">
  <input type="hidden" name="productos[{{ $id }}][cantidad]"     class="cantidad-input" value="{{ $cantidad }}">
  <input type="hidden" name="productos[{{ $id }}][descuentoPct]" class="descuento-input-hidden" value="{{ $descuentoPct }}">
</li>
