<!-- Modal -->
<div class="modal fade" id="modal_productos_paradisus_{{ $order['id'] }}" tabindex="-1" aria-labelledby="modal_productosLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_productosLabel">Productos de la orden Paradisus #{{ $order['id'] }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">

            <div class="col-12">

                <ul>
                    @forelse($order['pedidos'] as $pedido)
                    <li>
                        <strong>Producto:</strong> {{ $pedido['concepto'] }} <br> <strong>Cantidad:</strong> {{ $pedido['cantidad'] }} <br> <strong> Importe:</strong> ${{ $pedido['importe'] }}
                    </li> <br>

                @empty
                    <li>No hay productos en esta orden.</li>
                @endforelse
                </ul> <br>

            </div>

        </div>

      </div>
    </div>
  </div>
