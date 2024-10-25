<style>
    .productvendidos{
    box-shadow: 6px 6px 15px -10px rgb(220 220 220 / 50%);
    background: #f7f7f7;
    padding: 10px 0 0 0;
    margin: 10px;
    border-radius: 9px;
}
</style>

<div class="row">
    @foreach ($product as $item)
    <div class="card mb-3">


        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Informacion</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Modificaciones</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ventas</button>
            </li>

          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-2">
                        <p class="text-center">
                            <img src="{{ $item->imagenes }}" class="" style="width: 150px">
                        </p>
                    </div>

                    <div class="col-8 col-md-9 col-lg-7 my-auto">
                        <h3>{{ $item->nombre }}</h3>
                        <p class="text-dark">
                            <strong  class="text-dark">Categoria: </strong> {{ $item->categoria }} <br>
                            <strong  class="text-dark">Subcategoria: </strong> {{ $item->subcategoria }} <br>
                            <strong  class="text-dark">Precio: </strong> ${{ $item->precio_normal }} .0<br>
                        </p>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal{{ $item->id }}" title="productoModal">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <div class="col-4 col-md-12 col-lg-3 my-auto">
                        <p class="text-dark">
                            <strong>SKU:</strong> {{ $item->sku }} <br>
                            <strong class="text-dark">Stock Castilla:</strong> {{ $item->stock }} pza <br>
                            @if($item->categoria == 'NAS')
                                <strong class="text-dark">Lab Stock :</strong> {{ $item->stock_nas }} pza <br>
                            @endif
                            @if($item->categoria == 'Cosmica')
                                <strong class="text-dark">Lab Stock :</strong> {{ $item->stock_cosmica }} pza <br>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                @foreach ($historialMods as $itemMods)
                    <div class="row">
                        <div class="col-4">
                            <p class="text-dark">
                                <strong>Fecha:</strong><br>{{ $itemMods->stock }}
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark">
                            <strong>Cantidad:</strong><br>{{ \Carbon\Carbon::parse($itemMods->created_at)->format('d/m/Y g:i A') }}
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark">
                            <strong>Usuario:</strong><br>{{ $itemMods->user }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                @foreach ($HistorialVendidos as $itemVendidos)
                    <div class="row productvendidos">

                        <div class="col-6 col-md-3 col-lg-3">
                            <p class="text-dark">
                            <strong>Stock Viejo:</strong><br>{{ $itemVendidos->stock_viejo }}
                            </p>
                        </div>

                        <div class="col-6 col-md-3 col-lg-3">
                            <p class="text-dark">
                            <strong>Cantidad Restada:</strong><br>{{ $itemVendidos->cantidad_restado }}
                            </p>
                        </div>

                        <div class="col-6 col-md-3 col-lg-3">
                            <p class="text-dark">
                            <strong>Stock Actual:</strong><br>{{ $itemVendidos->stock_actual }}
                            </p>
                        </div>

                        <div class="col-6 col-md-3 col-lg-3">
                            <p class="text-dark">
                            <strong>Fecha:</strong><br>
                            {{ \Carbon\Carbon::parse($itemVendidos->created_at)->format('d/m/Y g:i A') }}
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>
          </div>

    </div>

    @include('admin.scanner.edit')
    <script>
        $(document).ready(function() {
            $('#formProducto_{{ $item->id }}').on('submit', function(e) {
                e.preventDefault();

                // Obtén los datos del formulario
                var formData = new FormData(this);

                // Realiza la petición AJAX
                $.ajax({
                    url: "{{ route('products.update', $item->id) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Cierra el modal si la petición es exitosa
                        $('#productoModal{{ $item->id }}').modal('hide');
                        // Opcional: actualizar la página o mostrar un mensaje de éxito
                        alert("Producto actualizado correctamente");
                    },
                    error: function(xhr) {
                        // Muestra un mensaje de error si ocurre algún problema
                        alert("Hubo un problema al actualizar el producto.");
                    }
                });
            });
        });
    </script>
    @endforeach
</div>
