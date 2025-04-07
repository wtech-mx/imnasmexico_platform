@extends('layouts.app_admin')

@section('template_title')
    Stock de Productos Laboratorio Cosmica
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
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <a type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#alertaModal">
                        <img src="{{ asset('assets/user/icons/bell.png') }}" alt="" width="30px">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $products_cosmica ? $products_cosmica->count() : 0 }}
                        </span>
                    </a>

                    <h3 class="mb-3">Stock de Productos Laboratorio Cosmica </h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                    @can('productos-create')
                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan
                </div>
            </div>

            <div class="table-responsive p-4">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio Normal</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                    @php
                        $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                        $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                    @endphp
                    <tr id="productRow{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                        <td>
                            {{ $product->nombre }} <br>
                            SKU: {{ $product->sku }}
                        </td>
                        <td>${{ $precio_normal }}</td>
                        <td>{{ $product->stock_cosmica }}</td>
                        <td>
                            @can('productos-edit')
                                <a type="button" class="btn btn-sm btn-primary editProductBtn" data-id="{{ $product->id }}">

                                {{-- <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_product_{{ $product->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff"> --}}
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @include('admin.laboratorio.modal_update_lab_cosmica')
                    @endforeach

                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@include('admin.products.modal_create')
@include('admin.laboratorio.modal_cosmica_vencer')
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
    // Función para abrir el modal y llenar los datos del producto
    $(document).on('click', '.editProductBtn', function() {
        let productId = $(this).data('id');

      // Rellena los campos del formulario con los datos del producto
      $.ajax({
        // url: `/cosmica/admin/products/${productId}`,
        url: "{{ route('cosmica_products.show', ':id') }}".replace(':id', productId), // Usar la ruta de Laravel
        type: 'GET',
        success: function(product) {
          $('#product_id').val(product.id);
          $('#nombre').val(product.nombre);
          $('#titulo_modal').val(product.nombre);
          $('#descripcion').val(product.descripcion);
          $('#cantidad_aumentada').val(product.cantidad_aumentada);
          $('#precio_normal').val(product.precio_normal);
          $('#stock').val(product.stock);
          $('#stock_cosmica').val(product.stock_cosmica);
          $('#stock_nas').val(product.stock_nas);
          $('#precio_rebajado').val(product.precio_rebajado);
          $('#imagenes').val(product.imagenes);
          $('#stock_salon').val(product.stock_salon);
          // Llena los otros campos si es necesario
        // Actualiza la imagen en el modal
        $('#editProductModal #blah').attr('src', product.imagenes);
        $('#editProductModal').modal('show');

        // Cargar historial de stock en la pestaña correspondiente
        loadStockHistory(productId);

        }
      });
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
            stock_cosmica: $('#stock_cosmica').val(),
            stock_nas: $('#stock_nas').val(),
            stock: $('#stock').val(),
            descripcion: $('#descripcion').val(),
            stock_salon: $('#stock_salon').val(),
            cantidad_aumentada: $('#cantidad_aumentada').val(),
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

                    $('#productRow' + response.id + ' td:nth-child(5)').text(response.stock_cosmica);

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


    // Función para cargar el historial de stock en la pestaña del modal
    function loadStockHistory(productId) {
        $.ajax({
            url: "{{ route('products.stockHistoryCosmica', ':id') }}".replace(':id', productId), // Ruta de Laravel para obtener el historial
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
                            <td>${record.stock_cosmica}</td>
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

  });


</script>

@endsection
