@extends('layouts.app_admin')

@section('template_title')
Productos solicitados Woo Cosmica
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h2 class="mb-3">Folio Woo Cosmica #{{ $order->id }}</h2>
                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Cómo funciona?
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <input class="form-control" type="text" id="scanInput" placeholder="Escanea el código aquí" autofocus>
                        <form method="POST" action="{{ route('bodega.update_guia_woo', $order->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            @method('PUT')
                            @php
                                $domain = parse_url($order->payment_url, PHP_URL_HOST);
                            @endphp
                            <input type="hidden" name="dominio" value="{{ $domain }}">
                            @if ($order->status == 'guia_cargada')
                                <input type="hidden" name="key" value="preparado_hora_y_guia">
                            @endif
                            <input id="status" name="status" value="preparados" style="display: none">
                            <div class="modal-body">
                                <table class="table">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Producto</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($order_online_cosmica as $item)
                                            @php
                                                $nombre_producto = trim($item->nombre);
                                                $producto_nas = App\Models\Products::where('nombre', '=', $nombre_producto)->first();
                                            @endphp
                                            <tr data-id="{{ $item->id }}">
                                                <td>{{ $item->cantidad }}</td>
                                                <td>
                                                    @if ($producto_nas)
                                                        <img src="{{ $producto_nas->imagenes }}" alt="" style="width: 60px"><br>
                                                    @else
                                                        <img src="https://via.placeholder.com/60" alt="No disponible" style="width: 60px"><br>
                                                    @endif
                                                    {{ $item->nombre }}
                                                </td>
                                                <td id="status-{{ $producto_nas ? $producto_nas->sku : 'N/A' }}">
                                                    @if ($item->estatus === 1)
                                                        ✔️
                                                    @else
                                                        Pendiente
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer" id="guardarBtnContainer" style="display: none;">
                                <button type="submit" class="btn close-modal" style="background: {{ $configuracion->color_boton_save }}; color: #ffff">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <audio id="successSound" src="{{ asset('notificaciones/success.mp3') }}" preload="auto"></audio>
    <audio id="errorSound" src="{{ asset('notificaciones/error-8-206492.mp3') }}" preload="auto"></audio>
@endsection

@section('datatable')
<script>
    $('#scanInput').on('change', function() {
        let sku = $(this).val().trim();
        let idNota = "{{ $order->id }}";
        const successSound = document.getElementById("successSound");
        const errorSound = document.getElementById("errorSound");

        if (sku.length === 6) {
            $.ajax({
                url: "{{ route('check_cosmica_online.product') }}",
                type: "POST",
                dataType: "json",
                data: {
                    sku: sku,
                    id_nota: idNota,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('#status-' + sku).html('✔️');
                        checkAllProductsChecked();
                        successSound.play();
                        alert('Producto escaneado');
                    } else {
                        errorSound.play();
                        alert('Producto no encontrado en el pedido.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    errorSound.play();
                }
            });
            $(this).val('');
        } else {
            console.log('El SKU no tiene la longitud correcta.');
        }
    });

    function checkAllProductsChecked() {
        let allChecked = true;
        document.querySelectorAll('tbody tr').forEach(function(row) {
            if (row.querySelector('td:last-child').innerHTML !== '✔️') {
                allChecked = false;
            }
        });
        const guardarBtnContainer = document.getElementById('guardarBtnContainer');
        guardarBtnContainer.style.display = allChecked ? 'block' : 'none';
    }
</script>
@endsection
