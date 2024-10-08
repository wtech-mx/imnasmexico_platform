@extends('layouts.app_admin')

@section('template_title')
    Products
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

                    <h3 class="mb-3">Products</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                   <!-- <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Importar Products</button>
                    </form>-->
                    @can('productos-create')
                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan

                    {{-- <form action="{{ route('products.generateSkus') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Generar SKUs</button>
                    </form>

                    <a href="{{ route('products.generateAllPDF') }}" class="btn btn-primary">
                        Generar PDF de Todos los Productos
                    </a> --}}


                </div>
            </div>

            <div class="d-flex justify-content-around">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-producto-tab" data-bs-toggle="pill" data-bs-target="#pills-producto" type="button" role="tab" aria-controls="pills-producto" aria-selected="true">
                                Producto  <img src="{{ asset('assets/user/icons/limpieza.png') }}" alt="" width="35px">
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-tiendita-tab" data-bs-toggle="pill" data-bs-target="#pills-tiendita" type="button" role="tab" aria-controls="pills-tiendita" aria-selected="false" style="background: #6ec7d1a3">
                                Tiendita  <img src="{{ asset('assets/user/icons/marketplace.png') }}" alt="" width="35px">
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-kits-tab" data-bs-toggle="pill" data-bs-target="#pills-kits" type="button" role="tab" aria-controls="pills-kits" aria-selected="false" style="background: #86ff61a3">
                                Kits  <img src="{{ asset('assets/user/icons/productos.png') }}" alt="" width="35px">
                            </button>
                        </li>
                </ul>
            </div>


              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-producto" role="tabpanel" aria-labelledby="pills-producto-tab" tabindex="0">

                    <div class="table-responsive p-4">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Precio Normal</th>
                                    <th>Categoria</th>
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
                                <td>{{ $product->nombre }}</td>
                                <td>${{ $precio_normal }}</td>
                                <td>{{ $product->categoria }}</td>
                                <td>{{ $product->stock }}</td>
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
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-tiendita" role="tabpanel" aria-labelledby="pills-tiendita-tab" tabindex="0">

                    <div class="table-responsive p-4" style="border:solid 5px #6ec7d1a3">
                        <table class="table table-flush" id="datatable-search2">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Precio Normal</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            @foreach ($productsTiendita as $product)
                            @php
                                $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                                $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                            @endphp
                            <tr id="productRow{{ $product->id }}">
                                <td>{{ $product->id }}</td>
                                <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                <td>{{ $product->nombre }}</td>
                                <td>${{ $precio_normal }}</td>
                                <td>{{ $product->categoria }}</td>
                                <td>{{ $product->stock }}</td>
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
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-kits" role="tabpanel" aria-labelledby="pills-kits-tab" tabindex="0">

                    <div class="table-responsive p-4" style="border:solid 5px #86ff61a3">
                        <table class="table table-flush" id="datatable-search3">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Precio Normal</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            @foreach ($productsKit as $product)
                            @php
                                $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                                $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                            @endphp
                            <tr id="productRow{{ $product->id }}">
                                <td>{{ $product->id }}</td>
                                <th><img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                <td>{{ $product->nombre }}</td>
                                <td>${{ $precio_normal }}</td>
                                <td>{{ $product->categoria }}</td>
                                <td>{{ $product->stock }}</td>
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
                    </div>

                </div>

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
    $('#datatable-search2').DataTable({
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

    $('#datatable-search3').DataTable({
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
            $('#precio_normal').val(product.precio_normal);
            $('#stock').val(product.stock);
            $('#stock_cosmica').val(product.stock_cosmica);
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
              categoria: $('#categoria').val(),
              stock_cosmica: $('#stock_cosmica').val(),
              stock_nas: $('#stock_nas').val(),
              stock: $('#stock').val(),
              descripcion: $('#descripcion').val(),
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

                      $('#productRow' + response.id + ' td:nth-child(2)').text(response.imagenes);
                      $('#productRow' + response.id + ' td:nth-child(3)').text(response.nombre);
                      $('#productRow' + response.id + ' td:nth-child(4)').text(response.precio_normal);
                      $('#productRow' + response.id + ' td:nth-child(5)').text(response.categoria);
                      $('#productRow' + response.id + ' td:nth-child(6)').text(response.stock);

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
