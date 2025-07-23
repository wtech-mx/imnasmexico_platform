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
                <h5 class="mb-2 mt-1 text-center">Cotiza tu pedido
                    Folio #{{ $cotizacion->folio }}
                </h5>

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
                        @if ($cotizacion->factura == '1')
                            <input class="form-check-input" type="checkbox" id="chkFacturacion" name="btn_facturacion" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" id="chkFacturacion" name="btn_facturacion" value="1">
                        @endif
                        <label class="form-check-label" for="chkFacturacion">
                            Facturación
                        </label>
                        <img src="{{ asset('assets/cam/carta_res.png') }}" style="width:17px;">
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
                        <img src="{{ asset('assets/cam/delivery.png') }}" style="width:17px;">
                    </div>
                </div>

                <!-- Campos de envío (oculto por defecto) -->
                @include('cotizador.datos_direcion')

                @if(Route::currentRouteName() == 'edit_nas.tiendita')
                    <!-- Método de pago -->
                    <div class="mb-3">
                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" style="width:17px;"><label for="metodo_pago_cliente" class="form-label">Método de pago:</label>
                        <select id="metodo_pago_cliente" name="metodo_pago" class="form-select">
                            <option value="{{$cotizacion->metodo_pago}}">{{$cotizacion->metodo_pago}}</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta crédito">Tarjeta crédito</option>
                            <option value="Tarjeta débito">Tarjeta débito</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>

                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <span><img src="{{ asset('assets/cam/dar-dinero.png') }}" style="width:17px;"> Dinero recibido:</span>
                        <div style="position: relative; width: 120px;">
                            <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">$</span>
                            <input id="monto" name="monto" type="number" value="{{$cotizacion->monto}}" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;">
                        </div>
                    </div>

                    {{-- <a class=" btn-primary mb-3" data-bs-toggle="collapse" href="#metodo2" aria-expanded="false" aria-controls="metodo2">Método de pago 2</a> --}}

                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <a class="text-dark" data-bs-toggle="collapse" href="#metodo2" aria-expanded="false" aria-controls="metodo2" style="text-decoration: none;"><img src="{{ asset('assets/cam/anadir.webp') }}" style="width:17px;"> Agregar Otro metodo de pago</a>
                    </div>

                    <div class="row collapse multi-collapse mt-3 mb-2" id="metodo2">
                        <div class="col-6">
                            <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" style="width:17px;"><label for="metodo_pago_cliente" class="form-label">Método de pago 2:</label>
                            <select id="metodo_pago_cliente" name="metodo_pago2" class="form-select">
                                <option value="{{$cotizacion->metodo_pago2}}">{{$cotizacion->metodo_pago2}}</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta crédito">Tarjeta crédito</option>
                                <option value="Tarjeta débito">Tarjeta débito</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <span><img src="{{ asset('assets/cam/dar-dinero.png') }}" style="width:17px;"> Dinero recibido 2:</span>
                            <div style="position: relative; width: 120px;">
                                <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">$</span>
                                <input id="monto" name="monto2" type="number" value="{{$cotizacion->monto2}}" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Observaciones -->
                <div class="mb-3">
                    <img src="{{ asset('assets/user/icons/buscar.webp') }}" style="width:17px;"><label for="observaciones" class="form-label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="1" class="form-control">{{$cotizacion->nota}}</textarea>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between align-items-center">
                <span><img src="{{ asset('assets/user/icons/descuento.png') }}" style="width:17px;"> Descuento:</span>
                    <div style="position: relative; width: 120px;">
                        <input id="descuento-total" name="descuento_total" type="number" placeholder="Descuento" style="width: 100%;padding-right: 1.5rem;border: 0;border-bottom: 1px solid #ffffff;text-align: end;" value="{{$cotizacion->restante}}">
                        <span style="position: absolute;right: 0.5rem;top: 50%;transform: translateY(-50%);pointer-events: none;color: #555;">%</span>
                    </div>
                </div>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span><img src="{{ asset('assets/user/icons/money.png') }}" style="width:17px;"> Subtotal:</span>
                    <span id="subtotal-display">$0.00</span>
                </div>

                <div class="mb-2 d-flex justify-content-between">
                    <span><img src="{{ asset('assets/user/icons/paquete-o-empaquetar.png') }}" style="width:17px;"> Envío:</span>
                    <span id="envio-display">$0.00</span>
                </div>

                 @if(Route::currentRouteName() == 'edit_cosmica.cotizador')
                    <div class="mb-2 d-flex justify-content-between">
                        <span><img src="{{ asset('assets/user/icons/por-ciento.png') }}" style="width:17px;"> IVA (16%):</span>
                        <span id="iva-display">$0.00</span>
                    </div>
                    @else
                    <span id="iva-display" class="d-none"></span>
                @endif

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span><img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" style="width:17px;"> TOTAL:</span>
                    <span id="total-display">$0.00</span>
                </div>
                <input type="hidden" name="subtotal_final" id="subtotal-final-input" value="{{$cotizacion->subtotal}}">
                <input type="hidden" name="envio_final"    id="envio-final-input"    value="{{$cotizacion->envio_cost}}">
                <input type="hidden" name="iva_final"      id="iva-final-input"      value="{{$cotizacion->iva_cost}}">
                <input type="hidden" name="total_final"    id="total-final-input"    value="{{$cotizacion->total}}">
                <!-- Botón -->
                <button type="submit" class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
</div>
