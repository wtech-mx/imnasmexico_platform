@extends('layouts.app_admin')

@section('template_title')
    Products cosmica
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            @include('admin.products.botones')

            <div class="table-responsive p-4">
                <form id="barcodeForm">

                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th><input type="checkbox" id="selectAllProducts"></th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Precio Normal</th>
                                        <th>Stock</th>
                                        <th>Stock Salon</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                @foreach ($products as $product)
                                @php
                                    $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                                    $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                                @endphp
                                <tr id="productRow{{ $product->id }}">
                                    <td>{{ $product->id }}
                                    </td>

                                    <td>
                                        <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="form-check-input">
                                    </td>

                                    <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                    <td>
                                        {{ $product->nombre }} <br>
                                        SKU: {{ $product->sku }} <br>
                                    </td>
                                    <td>${{ $precio_normal }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->stock_salon }}</td>

                                    <td>

                                            <a type="button" class="btn btn-sm btn-primary editProductBtn d-inline" data-id="{{ $product->id }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                        @can('productos-edit')
                                            <form class="OcultarProductForm d-inline" data-id="{{ $product->id }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="hidden" name="categoria" value="Ocultar">

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>

                                        @endcan
                                    </td>
                                </tr>
                                @include('admin.products.modal_update')
                                @endforeach

                            </table>
                            <button type="button" class="btn btn-success" id="generateBarcodeBtn">Generar Códigos de Barra</button>
                </form>
            </div>

          </div>
        </div>
      </div>
</div>
@include('admin.products.modal_create')
@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $('#datatable-search').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'excel',
            'pdf',
            'colvis'
        ],
        responsive: true,
        stateSave: true,

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        }
    });
</script>

<script>

    $(document).ready(function() {
        var activeTab;

        let table = $('#datatable-search').DataTable();

        // Seleccionar/Deseleccionar todos
        $('#selectAllProducts').on('click', function () {
            let isChecked = $(this).is(':checked');

            // Usa el API de DataTables para marcar todos los checkboxes en todas las páginas
            table.rows().every(function () {
                $(this.node()).find('input[name="selected_products[]"]').prop('checked', isChecked);
            });
        });

        // Generar códigos de barra (como antes, pero mejorado)
        $('#generateBarcodeBtn').on('click', function (e) {
            e.preventDefault();

            let selectedProducts = [];

            // Recorre TODAS las filas (incluso no visibles)
            table.$('input[name="selected_products[]"]:checked').each(function () {
                selectedProducts.push($(this).val());
            });

            if (selectedProducts.length === 0) {
                alert('Por favor selecciona al menos un producto.');
                return;
            }

            $.ajax({
                url: "{{ route('generateBarcodes') }}",
                type: 'POST',
                data: {
                    selected_products: selectedProducts,
                    _token: '{{ csrf_token() }}'
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    let blob = new Blob([response], { type: 'application/pdf' });
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'codigos_barras.pdf';
                    link.click();
                },
                error: function (xhr, status, error) {
                    console.error('Error al generar el PDF:', error);
                    alert('Error al generar el PDF.');
                }
            });
        });


      // Función para abrir el modal y llenar los datos del producto
      $(document).on('click', '.editProductBtn', function() {
          let productId = $(this).data('id');
          activeTab = $('.nav-tabs .active').attr('id');

        // Rellena los campos del formulario con los datos del producto
        $.ajax({
          // url: `/cosmica/admin/products/${productId}`,
          url: "{{ route('products.show', ':id') }}".replace(':id', productId), // Usar la ruta de Laravel
          type: 'GET',
          success: function(product) {
            $('#product_id').val(product.id);
            $('#nombre').val(product.nombre);
            $('#titulo_modal').val(product.nombre);
            $('#descripcion').val(product.descripcion);
            $('#categoria').val(product.categoria);

            $('#linea').val(product.linea);
            $('#sublinea').val(product.sublinea);
            $('#modo_empleo').val(product.modo_empleo);
            $('#beneficios').val(product.beneficios);
            $('#ingredientes').val(product.ingredientes);
            $('#precauciones').val(product.precauciones);
            $('#favorito').val(product.favorito);
            $('#precio_normal').val(product.precio_normal);
            $('#fecha_fin').val(product.fecha_fin);
            $('#stock').val(product.stock);
            $('#stock_cosmica').val(product.stock_cosmica);
            $('#stock_salon').val(product.stock_salon);
            $('#stock_nas').val(product.stock_nas);
            $('#precio_rebajado').val(product.precio_rebajado);
            $('#imagenes').val(product.imagenes);
            // Llena los otros campos si es necesario
            // Actualiza la imagen en el modal
            $('#editProductModal #blah').attr('src', product.imagenes);

                // Reiniciar las pestañas activas, siempre mostrar la pestaña "Producto"
                $('#pills-producto-tab').addClass('active').attr('aria-selected', true);
                $('#pills-tiendita-tab').removeClass('active').attr('aria-selected', false);
                $('#pills-kits-tab').removeClass('active').attr('aria-selected', false);

                $('#pills-producto').addClass('show active');
                $('#pills-tiendita, #pills-kits').removeClass('show active');

                // Abrir el modal
                $('#editProductModal').modal('show');

                // Cargar historial de stock en la pestaña correspondiente
                loadStockHistory(productId);
          }
        });
      });

          // Función para cargar el historial de stock en la pestaña del modal
        function loadStockHistory(productId) {
            $.ajax({
                url: "{{ route('products.stockHistory', ':id') }}".replace(':id', productId), // Ruta de Laravel para obtener el historial
                type: 'GET',
                success: function(history) {
                        console.log('Historial recibido:', history); // Añadir esto para verificar los datos recibidos
                        $('#pills-profile .row').empty();

                        let historyHtml = '<table class="table table-bordered">';
                        historyHtml += '<thead><tr><th>Fecha</th><th>Cantidad</th><th>Usuario</th></tr></thead><tbody>';

                        $.each(history, function(index, record) {
                            console.log('Registro individual:', record); // Verificar el contenido de cada registro
                            let date = new Date(record.created_at);

                            // Si la fecha no se puede interpretar, este punto es donde podrías ver si hay algún error con el contenido.
                            if (isNaN(date.getTime())) {
                                console.error('Fecha inválida:', record.created_at);
                            }

                            let formattedDate = date.toLocaleDateString('es-ES', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });
                            let formattedTime = date.toLocaleTimeString('es-ES', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            historyHtml += `<tr>
                                <td>${formattedDate} a las ${formattedTime}</td>
                                <td>${record.stock}</td>
                                <td>${record.user}</td>
                            </tr>`;
                    });

                    historyHtml += '</tbody></table>';
                    $('#pills-profile .row').html(historyHtml);
                },

                error: function(xhr, status, error) {
                    console.error('Error al cargar el historial:', error);
                    alert('Error al cargar el historial');
                }
            });
        }

                // Al cerrar el modal, restauramos la pestaña que estaba activa antes
        $('#editProductModal').on('hidden.bs.modal', function() {
            if (activeTab) {
                $('#' + activeTab).tab('show');
            }
        });


      // Abrir modal y establecer el ID del producto
      $(document).on('click', '.edit-product-btn', function() {
          let productId = $(this).data('id');
          $('#product_id').val(productId); // Establecer el ID en un campo oculto
          $('#editProductModal').modal('show');
      });

      // Enviar formulario AJAX
      $('#editProductForm').on('submit', function(e) {
          e.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada

          let productId = $('#product_id').val();
          let data = {
              nombre: $('#nombre').val(),
              precio_normal: $('#precio_normal').val(),
              precio_rebajado: $('#precio_rebajado').val(),
              fecha_fin: $('#fecha_fin').val(),
              categoria: $('#categoria').val(),
              stock_cosmica: $('#stock_cosmica').val(),
              stock_nas: $('#stock_nas').val(),
              stock_salon: $('#stock_salon').val(),
              stock: $('#stock').val(),
              descripcion: $('#descripcion').val(),
              linea: $('#linea').val(),
              sublinea: $('#sublinea').val(),
              modo_empleo: $('#modo_empleo').val(),
              beneficios: $('#beneficios').val(),
              ingredientes: $('#ingredientes').val(),
              precauciones: $('#precauciones').val(),
              favorito: $('#favorito').val(),

              imagenes: $('#imagenes').val(),
              _token: $('meta[name="csrf-token"]').attr('content'), // Token CSRF
              _method: 'PATCH' // Especificamos el método PATCH para Laravel
          };

          $.ajax({
              // url: '/admin/products/update/' + productId, // Ajusta la URL para el controlador adecuado
              url: "{{ route('products.update', ':id') }}".replace(':id', productId), // Usando la ruta de Laravel
              type: 'POST', // Se envía como POST debido al _method: PATCH
              data: data,
              dataType: 'json',
              success: function(response) {
                  if (response) {
                      alert('Producto actualizado con éxito');

                      // Actualizar solo los campos necesarios en la fila del producto
                      $('#productRow' + response.id + ' td:nth-child(3)').html(`
                          ${response.nombre} <br>
                          SKU: ${response.sku}
                      `);
                      $('#productRow' + response.id + ' td:nth-child(4)').text(`$${response.precio_normal}`);
                      $('#productRow' + response.id + ' td:nth-child(5)').text(response.stock);
                      $('#productRow' + response.id + ' td:nth-child(6)').text(response.stock_salon);

                      // Mantener los botones de acciones
                      let actions = $('#productRow' + response.id + ' td:nth-child(6)').html();
                      $('#productRow' + response.id + ' td:nth-child(6)').html(actions);

                      // Cerrar modal
                      $('#editProductModal').modal('hide');
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
                  console.error('Response:', xhr.responseText);
                  Swal.fire({
                      icon: 'error',
                      title: 'Error al actualizar',
                      text: 'Hubo un problema al intentar actualizar el producto.',
                  });
              }
          });
      });

      $(document).on('submit', '.OcultarProductForm', function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado del formulario

        let productId = $(this).data('id'); // Obtener el ID del producto
        let form = $(this); // Referencia al formulario
        let url = "{{ route('products.update_ocultar', ':id') }}".replace(':id', productId); // Ruta con el ID del producto

        $.ajax({
            url: url,
            type: 'PATCH',
            data: form.serialize(), // Serializar los datos del formulario
            success: function(response) {
            // Si la respuesta es exitosa, elimina la fila del producto de la tabla
            $('#productRow' + response.id).fadeOut(300, function() {
                $(this).remove(); // Eliminar la fila después de que desaparezca
            });

            // Opcional: Mostrar mensaje de éxito
            alert('Eliminado con exito');
            },
            error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Error:', error);
            }
        });
     });

    });

  </script>

@endsection
