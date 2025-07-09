@php
  // Colección de todos los productos de la cotización
  $items = collect($cotizacion_productos);

  // 1) Agrupamos los bundle-items por num_kit
  $kitGroups = $items
    ->where('kit', 1)           // solo los items que vienen de un kit
    ->groupBy('num_kit');       // agrupados por ID de kit

  // 2) Productos sueltos
  $singles = $items->where('kit', 0);
@endphp
<div class="sidebar">
                <h5 class="mb-2 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height:600px;overflow-y:auto;">
                    {{-- Kits --}}
                    @foreach($kitGroups as $numKit => $group)
                        @php
                            // Calcula el sufijo para id_kitN, cantidad_kitN, descuento_kitN
                            $i      = $loop->iteration;            // 1,2,3...
                            $suffix = $i > 1 ? $i : '';

                            // Ahora recupera los datos del kit en la cabecera
                            $kitId    = $cotizacion->{"id_kit{$suffix}"};
                            $kitQty   = $cotizacion->{"cantidad_kit{$suffix}"};
                            $kitDisc  = $cotizacion->{"descuento_kit{$suffix}"};

                            // Producto “cabecera” del kit
                            $kitProd  = \App\Models\Products::find($kitId);

                            // Total de línea con descuento
                            $lineTotal = $kitProd->precio_normal * $kitQty * (1 - $kitDisc/100);
                        @endphp

                        @include('cotizador.edit.product_partial', [
                        'id'             => $kitProd->id,
                        'imagen'         => $kitProd->imagenes,
                        'nombre'         => $kitProd->nombre,
                        'precioUnitario' => $kitProd->precio_normal,
                        'cantidad'       => $kitQty,
                        'descuentoPct'   => $kitDisc,
                        'lineTotal'      => $lineTotal,
                        'isKit'          => true,
                        ])
                    @endforeach

                    {{-- Productos sueltos --}}
                    @foreach($singles as $item)
                        @php
                        $prod      = $item->Productos;
                        $lineTotal = $item->price;
                        @endphp
                        @include('cotizador.edit.product_partial', [
                        'id'             => $prod->id,
                        'imagen'         => $prod->imagenes,
                        'nombre'         => $prod->nombre,
                        'precioUnitario' => $prod->precio_normal,
                        'cantidad'       => $item->cantidad,
                        'descuentoPct'   => $item->descuento,
                        'lineTotal'      => $lineTotal,
                        'isKit'          => false,
                        ])
                    @endforeach
                </ul>

                <h5 class="mb-3 mt-1 text-center">Informacion del Cliente</h5>

                <div class="row px-3">
                    <!-- Checkbox Facturación -->
                    <div class="form-check mb-2 col-6">
                        @if ($cotizacion->iva_cost >= '0')
                            <input class="form-check-input" type="checkbox" id="chkFacturacion" checked>
                        @else
                            <input class="form-check-input" type="checkbox" id="chkFacturacion">
                        @endif
                        <label class="form-check-label" for="chkFacturacion">
                            Facturación
                        </label>
                    </div>

                    <!-- Checkbox Envío -->
                    <div class="form-check mb-2 col-6">
                        @if ($cotizacion->envio == 'Si')
                            <input class="form-check-input" type="checkbox" id="chkEnvio" checked>
                        @else
                            <input class="form-check-input" type="checkbox" id="chkEnvio">
                        @endif
                        <label class="form-check-label" for="chkEnvio">
                            Agregar envío
                        </label>
                    </div>
                </div>

                <!-- Campos de envío (oculto por defecto) -->
                @include('cotizador.datos_direcion')

                <!-- Método de pago -->
                <div class="mb-3">
                    <label for="metodo_pago_cliente" class="form-label">Método de pago:</label>
                    <select id="metodo_pago_cliente" name="metodo_pago_cliente" class="form-select">
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta crédito">Tarjeta crédito</option>
                        <option value="Tarjeta débito">Tarjeta débito</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="Contraentrega">Contraentrega</option>
                    </select>
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="3" class="form-control">{{$cotizacion->nota}}</textarea>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span>Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-total" name="descuento_total" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;" value="{{$cotizacion->restante}}">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>Envío:</span>
                    <span id="envio-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span>IVA (16%):</span>
                    <span id="iva-display">$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total-display">$0.00</span>
                </div>
                <input type="hidden" name="subtotal_final" id="subtotal-final-input" value="{{$cotizacion->subtotal}}">
                <input type="hidden" name="envio_final"    id="envio-final-input"    value="{{$cotizacion->envio_cost}}">
                <input type="hidden" name="iva_final"      id="iva-final-input"      value="{{$cotizacion->iva_cost}}">
                <input type="hidden" name="total_final"    id="total-final-input"    value="{{$cotizacion->total}}">
                <!-- Botón -->
                <button type="submit" class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
</div>
