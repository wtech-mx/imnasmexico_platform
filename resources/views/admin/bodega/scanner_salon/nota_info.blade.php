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
    <div class="card mb-3">
          <div class="tab-content" id="pills-tabContent">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-2">
                    <p class="text-center">
                        <img src="" class="" style="width: 150px">
                    </p>
                </div>

                {{-- <div class="col-8 col-md-9 col-lg-7 my-auto">
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
                </div> --}}
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
</div>
