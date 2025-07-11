@extends('layouts.app_admin')

@section('template_title')
Conteo de Etiquetas NAS
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
                    <a type="button" class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#alertaModal">
                        <img src="{{ asset('assets/user/icons/bell.png') }}" alt="" width="30px">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $suma }}
                        </span>
                    </a>

                    <h3 class="mb-3">Conteo de Etiquetas NAS</h3>

                    <a class="btn btn-warning" href="{{ route('reporte_etiquetas.pdf') }}" target="_blank">Imprimir reporte</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-around">
                        <span class="badge rounded-pill text-white" style="background: #e74c3c">Bajo stock: 0 - 50</span>
                        <span class="badge rounded-pill text-dark" style="background: #e7dc3c">Medio stock: 51 - 150</span>
                        <span class="badge rounded-pill text-dark" style="background: #72e73c">Alto stock: +151</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive p-4">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>Producto</th>
                            <th>Lateral</th>
                            <th>Tapa</th>
                            <th>Frente</th>
                            <th>Reversa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($products as $product)
                        <tr id="productRow{{ $product->id }}" class="text-center">
                            <th>{{$product->id}}</th>
                            <th>
                                <img id="blah" src="{{$product->imagenes}}" alt="Imagen" style="width: 90px; height: 90px;"/>
                            </th>
                            <td>{{ $product->nombre }}</td>
                            <td>
                                @if ($product->estatus_lateral == 1)
                                    @if ($product->etiqueta_lateral <= 50)
                                        <p style="background-color: #e74c3c; color:#fff">{{ $product->etiqueta_lateral }}</p>
                                    @elseif ($product->etiqueta_lateral > 51 && $product->etiqueta_lateral <= 150)
                                        <p style="background-color: #e7dc3c; color:#fff">{{ $product->etiqueta_lateral }}</p>
                                    @elseif ($product->etiqueta_lateral > 151)
                                        <p style="background-color: #72e73c; color:#fff">{{ $product->etiqueta_lateral }}</p>
                                    @endif
                                @else
                                    <b>No lleva</b>
                                @endif
                            </td>
                            <td>
                                @if ($product->estatus_tapa == 1)
                                    @if ($product->etiqueta_tapa <= 50)
                                        <p style="background-color: #e74c3c; color:#fff">{{ $product->etiqueta_tapa }}</p>
                                    @elseif ($product->etiqueta_tapa > 51 && $product->etiqueta_tapa <= 150)
                                        <p style="background-color: #e7dc3c; color:#fff">{{ $product->etiqueta_tapa }}</p>
                                    @elseif ($product->etiqueta_tapa > 151)
                                        <p style="background-color: #72e73c; color:#fff">{{ $product->etiqueta_tapa }}</p>
                                    @endif
                                @else
                                    <b>No lleva</b>
                                @endif
                            </td>
                            <td>
                                @if ($product->estatus_frente == 1)
                                    @if ($product->etiqueta_frente <= 50)
                                        <p style="background-color: #e74c3c; color:#fff">{{ $product->etiqueta_frente }}</p>
                                    @elseif ($product->etiqueta_frente > 51 && $product->etiqueta_frente <= 150)
                                        <p style="background-color: #e7dc3c; color:#fff">{{ $product->etiqueta_frente }}</p>
                                    @elseif ($product->etiqueta_frente > 151)
                                        <p style="background-color: #72e73c; color:#fff">{{ $product->etiqueta_frente }}</p>
                                    @endif
                                @else
                                    <b>No lleva</b>
                                @endif
                            </td>
                            <td>
                                @if ($product->estatus_reversa == 1)
                                    @if ($product->etiqueta_reversa <= 50)
                                        <p style="background-color: #e74c3c; color:#fff">{{ $product->etiqueta_reversa }}</p>
                                    @elseif ($product->etiqueta_reversa > 51 && $product->etiqueta_reversa <= 150)
                                        <p style="background-color: #e7dc3c; color:#fff">{{ $product->etiqueta_reversa }}</p>
                                    @elseif ($product->etiqueta_reversa > 151)
                                        <p style="background-color: #72e73c; color:#fff">{{ $product->etiqueta_reversa }}</p>
                                    @endif
                                @else
                                    <b>No lleva</b>
                                @endif
                            </td>
                            <td>
                                <a type="button" class="btn btn-sm btn-primary editProductBtn" data-id="{{ $product->id }}">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admin.laboratorio_cosmica.etiqueta.cambio_stock')
                    @endforeach

                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@include('admin.laboratorio_nas.etiqueta.modal_vencer')
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
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

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
        },
        columnDefs: [
            { type: 'num', targets: 0 } // Cambia el 0 por el índice de la columna que deseas ordenar numéricamente
        ]
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
            url: "{{ route('etiqueta.show', ':id') }}".replace(':id', productId),
            type: 'GET',
            success: function(product) {
                // Rellenar los campos del formulario en el modal con los datos obtenidos
                $('#product_id').val(product.id);
                $('#nombre').val(product.nombre);
                $('#etiqueta_lateral').val(product.etiqueta_lateral);
                $('#etiqueta_lateral_uti').val(product.etiqueta_lateral_uti);
                $('#etiqueta_lateral_comp').val(product.etiqueta_lateral_comp);
                $('#etiqueta_tapa').val(product.etiqueta_tapa);
                $('#etiqueta_tapa_uti').val(product.etiqueta_tapa_uti);
                $('#etiqueta_tapa_comp').val(product.etiqueta_tapa_comp);
                $('#etiqueta_frente').val(product.etiqueta_frente);
                $('#etiqueta_frente_uti').val(product.etiqueta_frente_uti);
                $('#etiqueta_frente_comp').val(product.etiqueta_frente_comp);
                $('#etiqueta_reversa').val(product.etiqueta_reversa);
                $('#etiqueta_reversa_uti').val(product.etiqueta_reversa_uti);
                $('#etiqueta_reversa_comp').val(product.etiqueta_reversa_comp);
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
            url: "{{ route('etiqueta.stockHistory', ':id') }}".replace(':id', productId), // Ruta de Laravel para obtener el historial
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
                            <td>${record.stock_etiqueta}</td>
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
            nombre: $('#nombre').val(),
            etiqueta_lateral: $('#etiqueta_lateral').val(),
            etiqueta_lateral_uti: $('#etiqueta_lateral_uti').val(),
            etiqueta_lateral_comp: $('#etiqueta_lateral_comp').val(),
            etiqueta_tapa: $('#etiqueta_tapa').val(),
            etiqueta_tapa_uti: $('#etiqueta_tapa_uti').val(),
            etiqueta_tapa_comp: $('#etiqueta_tapa_comp').val(),
            etiqueta_frente: $('#etiqueta_frente').val(),
            etiqueta_frente_uti: $('#etiqueta_frente_uti').val(),
            etiqueta_frente_comp: $('#etiqueta_frente_comp').val(),
            etiqueta_reversa: $('#etiqueta_reversa').val(),
            etiqueta_reversa_uti: $('#etiqueta_reversa_uti').val(),
            etiqueta_reversa_comp: $('#etiqueta_reversa_comp').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PATCH'
        };

        $.ajax({
            url: "{{ route('etiqueta.update', ':id') }}".replace(':id', productId),
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    alert('Producto actualizado con éxito');
                    $('#productRow' + response.id + ' td:nth-child(4)').text(response.etiqueta_lateral);
                    $('#productRow' + response.id + ' td:nth-child(5)').text(response.etiqueta_tapa);
                    $('#productRow' + response.id + ' td:nth-child(6)').text(response.etiqueta_frente);
                    $('#productRow' + response.id + ' td:nth-child(7)').text(response.etiqueta_reversa);
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
