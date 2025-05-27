<!-- Modal -->
<div class="modal fade" id="modal_productos_{{ $item->id }}" tabindex="-1" aria-labelledby="modal_productosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_productosLabel">Productos de la orden {{ $item->folio }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('index_recepcion_update_expo.cotizador', $item->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="col-12">
                        <input type="hidden" name="estatus_cotizacion" value="Entregado">
                        <ul class="">
                            @foreach ($item->ProductosNotasId as $item)
                            <li class="">
                                @if ($item->Productos->subcategoria == 'Kit' || $item->Productos->subcategoria == 'kit')
                                    <b>{{ $item->cantidad }}</b> - {{ $item->producto }}
                                    <ul>
                                        @foreach ($item->Productos->bundleItems as $producto)
                                            <li>{{ $producto->cantidad }} - {{ $producto->producto }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <b>{{ $item->cantidad }}</b> - {{ $item->producto }}
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="guardarBtn" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                        Guardar
                    </button>
                </div>
        </form>
      </div>
    </div>
  </div>
