@extends('layouts.app_admin')

@section('template_title')
Productos solicitados Paradisus
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <h2 class="mb-3">Folio Paradisus #{{$ApiFiltradaCollectAprobado['id']}}</h2>

                                <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                    ¿Como funciona?
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <input class="form-control" type="text" id="scanInput" placeholder="Escanea el código aquí" autofocus>
                                <form method="POST" action="{{ route('actualizar.pedido.paradisus', $ApiFiltradaCollectAprobado['id']) }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input  id="estatus_cotizacion" name="estatus_cotizacion" value="Preparado" style="display: none">
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
                                                    @foreach($productos_scaner as $producto)
                                                    @php
                                                        $producto_nas = App\Models\Products::where('nombre', '=',  $producto['concepto'])->first();
                                                    @endphp
                                                    <tr data-id="{{ $producto['id'] }}"
                                                        style="background-color: {{ $producto['cantidad'] > 0 ? '#d4edda' : '#f8d7da' }};"> <!-- Verde para mayor a 0, naranja para 0 -->
                                                        <td>{{ $producto['cantidad'] }}</td>
                                                        <td>
                                                            <img src="{{ $producto_nas->imagenes }}" alt="" style="width: 60px"><br>
                                                            {{ $producto['concepto'] }}
                                                        </td>
                                                        <td id="status-{{ $producto_nas->sku }}">
                                                            @if($producto['estatus'] === 1)
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
                                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
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
        let sku = $(this).val().trim(); // Eliminar espacios en blanco
        let idNota = "{{ $ApiFiltradaCollectAprobado['id'] }}"; // ID de la nota que estás mostrando
        const successSound = document.getElementById("successSound");
        const errorSound = document.getElementById("errorSound");

        if (sku.length === 6) {
            $.ajax({
                url: "{{ route('check_paradisus.product') }}",
                type: "POST",
                dataType: "json",
                data: {
                    sku: sku,
                    id_nota: idNota,
                    _token: "{{ csrf_token() }}" // Incluir el token CSRF
                },
                success: function(data) {
                    console.log(data);
                    if (data.status === 'success') {
                        // Actualizar el campo correspondiente usando el SKU como ID
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

            $(this).val(''); // Limpiar el campo de entrada después de procesar el SKU
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

        // Mostrar u ocultar el botón según el estado de `allChecked`
        const guardarBtnContainer = document.getElementById('guardarBtnContainer');
        if (allChecked) {
            guardarBtnContainer.style.display = 'block'; // Mostrar el botón
        } else {
            guardarBtnContainer.style.display = 'none'; // Ocultar el botón
        }
    }

    function playSound(success) {
        if (success) {
            successSound.play();
        } else {
            errorSound.play();
        }
    }
</script>
@endsection
