<!-- Modal -->
<div class="modal fade" id="modal_productos_{{ $order->id }}" tabindex="-1" aria-labelledby="modal_productosLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_productosLabel">Productos de la orden woo #{{ $order->id }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">

            <div class="col-12">

                <ul class="">
                    @foreach ($order->line_items as $item)
                    <li class="">
                        {{ $item->name }} - {{ $item->quantity }}
                    </li>
                    @endforeach
                </ul>

            </div>

        </div>

      </div>
    </div>
  </div>
