@extends('layouts.app_admin')

@section('template_title')
    Stock Laboratorio NAS
@endsection
@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <a type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#alertaModal">
                        <img src="{{ asset('assets/user/icons/bell.png') }}" alt="" width="30px">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $envases_vencer ? $envases_vencer->count() : 0 }}
                        </span>
                    </a>

                    <h3 class="mb-3">Stock de Envases Laboratorio NAS </h3>

                    <a class="btn btn-warning" href="{{ route('reporte.pdf') }}" target="_blank">Imprimir reporte</a>

                    @can('crear-envase')
                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_product" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear
                        </a>
                    @endcan
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-around">
                        <span class="badge rounded-pill text-white" style="background: #e74c3c">Bajo stock: 0 - 150</span>
                        <span class="badge rounded-pill text-dark" style="background: #e7dc3c">Medio stock: 151 - 200</span>
                        <span class="badge rounded-pill text-dark" style="background: #72e73c">Alto stock: +201</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive p-4">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Acciones</th>
                            <th>Foto</th>
                            <th>Productos</th>
                            <th>Envase</th>
                            <th>Conteo</th>
                            <th>Descripcion</th>
                            <th>Cama/Caja</th>
                        </tr>
                    </thead>
                    @foreach ($envases as $product)
                        @php
                            $palabras = explode(' ', $product->envase);
                            $lineas = array_chunk($palabras, 2);

                            $descripcion = explode(' ', $product->descripcion);
                            $desc_salto = array_chunk($descripcion, 2);
                        @endphp
                        <tr id="productRow{{ $product->id }}">
                            <td>
                                {{-- <a class="btn btn-sm btn-primary" href="{{ route('envases.edit', $product->id) }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a> --}}

                                <a type="button" class="btn btn-sm btn-primary editProductBtn" data-id="{{ $product->id }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                            <th>
                                <img id="blah" src="{{$product->imagen}}" alt="Imagen" style="width: 50px; height: 50px;"/>
                            </th>
                            <td>
                                @foreach ($envases_productos as $envase_producto)
                                    @if ($envase_producto->id_envase == $product->id)
                                        {{ $envase_producto->Product->nombre }} <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($lineas as $linea)
                                    {{ implode(' ', $linea) }}<br>
                                @endforeach
                            </td>
                            <td>
                                @if ($product->conteo <= 150)
                                    <p style="background-color: #e74c3c; color:#fff">{{ $product->conteo }}</p>
                                @elseif ($product->conteo > 150 && $product->conteo <= 200)
                                    <p style="background-color: #e7dc3c; color:#fff">{{ $product->conteo }}</p>
                                @elseif ($product->conteo > 200)
                                    <p style="background-color: #72e73c; color:#131313">{{ $product->conteo }}</p>
                                @endif
                            </td>
                            <td>
                                @foreach ($desc_salto as $salto)
                                    {{ implode(' ', $salto) }}<br>
                                @endforeach
                            </td>
                            <td>{{ $product->cama }}</td>
                        </tr>
                        @include('admin.laboratorio_nas.cambio_stock')
                    @endforeach

                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@include('admin.laboratorio_nas.create')
@include('admin.laboratorio_nas.modal_vencer')
@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
    searchable: true,
    fixedHeight: false
    });
</script>

<script>

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();

    // Evento para abrir el modal y llenar los datos del producto
    $(document).on('click', '.editProductBtn', function() {
        let productId = $(this).data('id');

        // Realizar la solicitud AJAX para obtener los datos del producto
        $.ajax({
            url: "{{ route('envases_nas.show', ':id') }}".replace(':id', productId),
            type: 'GET',
            success: function(product) {
                // Rellenar los campos del formulario en el modal con los datos obtenidos
                $('#product_id').val(product.id);
                $('#envase').val(product.envase);
                $('#conteo').val(product.conteo);
                $('#cantidad_aumentada').val(product.cantidad_aumentada);
                $('#cantidad_uti').val(product.cantidad_uti);
                $('#descripcion').val(product.descripcion);

                // Abrir el modal después de cargar los datos
                $('#editProductModal').modal('show');
                loadStockHistory(productId);
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener el producto:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error al cargar datos',
                    text: 'No se pudieron cargar los datos del producto.'
                });
            }
        });
    });

    // Función para cargar el historial de stock en la pestaña del modal
    function loadStockHistory(productId) {
        $.ajax({
            url: "{{ route('envases_nas.stockHistory', ':id') }}".replace(':id', productId), // Ruta de Laravel para obtener el historial
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

                        historyHtml += `<tr>
                            <td>${formattedDate}</td>
                            <td>Antes: ${record.stock_viejo} -> Ahora: ${record.stock_nuevo}</td>
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

    // Enviar formulario AJAX para actualizar el producto
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío predeterminado del formulario

        let productId = $('#product_id').val();
        let data = {
            envase: $('#envase').val(),
            conteo: $('#conteo').val(),
            cantidad_aumentada: $('#cantidad_aumentada').val(),
            cantidad_uti: $('#cantidad_uti').val(),
            descripcion: $('#descripcion').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PATCH'
        };

        $.ajax({
            url: "{{ route('envases_nas.update', ':id') }}".replace(':id', productId),
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    alert('Envase actualizado con éxito');
                    console.log(response);
                    $('#productRow' + response.id + ' td:nth-child(5)').text(response.conteo);
                    $('#editProductModal').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar',
                    text: 'Hubo un problema al intentar actualizar el Envase.',
                });
            }
        });
    });
});

</script>

@endsection