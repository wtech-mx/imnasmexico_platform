@extends('layouts.app_admin')

@section('template_title')
Cosmica Ecommerce TC{{$nota_scaner->id}}
@endsection
<style>
    #guardarBtn {
        display: none;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Cosmica Ecommerce TC{{$nota_scaner->id}}</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <input class="form-control" type="text" id="scanInput" placeholder="Escanea el código aquí" autofocus>
                        <form method="POST" action="{{ route('ecommerce_cosmica.update_estatus', $nota_scaner->id) }}" enctype="multipart/form-data" role="form"  id="pedidoForm">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="estatus_cotizacion" value="Preparado">

                                <div class="modal-body">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Progreso</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($productos_scaner as $nota_producto)
                                                <tr data-id="{{ $nota_producto->id_order }}"
                                                    style="background-color: {{ $nota_producto->cantidad > 0 ? '#d4edda' : '#f8d7da' }};"> <!-- Verde si >0, naranja si 0 -->
                                                    <td>
                                                        {{ $nota_producto->cantidad }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ $nota_producto->Producto->imagenes }}" alt="" style="width: 60px"><br>
                                                        {{ $nota_producto->Producto->nombre }}
                                                    </td>
                                                    <td data-sku="{{ $nota_producto->Producto->sku ?? '' }}" data-cantidad="{{ $nota_producto->cantidad }}">
                                                        <span class="contador">{{ $nota_producto->escaneados }}/{{ $nota_producto->cantidad }}</span>
                                                    </td>
                                                    <td id="status-{{ $nota_producto->Producto->sku ?? '' }}">
                                                        @if ($nota_producto->estatus === 1)
                                                            ✔️
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                @can('guardar-folio-bodega')
                                    <div class="modal-footer" >
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar Admin</button>
                                    </div>
                                @endcan

                                <a class="text-center text-white btn "
                                    href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'ecommerce_cosmica', 'id' => $nota_scaner->id]) }}"
                                    style="background: #7d2de6;">
                                    <i class="fa fa-qrcode"></i>
                                </a>

                                <div class="modal-footer">
                                    <button type="submit" id="guardarBtn" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                      Guardar
                                    </button>
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
$(document).ready(function () {
    const scanCounts = {};

    // Verifica si todos los productos han sido escaneados
    function checkAllProductsChecked() {
        let allChecked = true;
        $('td[id^="status-"]').each(function () {
            if ($(this).text().trim() !== '✔️') {
                allChecked = false;
            }
        });
        $('#guardarBtn').toggle(allChecked);  // Muestra el botón solo si todos están marcados
    }

    // Inicializa el contador de productos escaneados
    $('td[data-sku]').each(function () {
        const sku = $(this).data('sku');
        const cantidad = parseInt($(this).data('cantidad'));
        const escaneados = parseInt($(this).find('.contador').text().split('/')[0]);

        scanCounts[sku] = escaneados;

        if (escaneados === cantidad) {
            $(`#status-${sku}`).text('✔️');
        }
    });

    // Reproduce sonido dependiendo del éxito o error
    function playSound(success) {
        const successSound = document.getElementById("successSound");
        const errorSound = document.getElementById("errorSound");

        if (success) {
            successSound.play();
        } else {
            errorSound.play();
        }
    }

    // Manejador para escanear el SKU
    $('#scanInput').on('change', function () {
        const sku = $(this).val().trim();

        if (sku.length === 6) {
            const idNotaProducto = $('tr[data-id]').data('id');
            const cantidad = parseInt($(`td[data-sku="${sku}"]`).data('cantidad')) || 0;

            if (!scanCounts[sku]) {
                scanCounts[sku] = 0;
            }

            if (scanCounts[sku] < cantidad) {
                $.ajax({
                    url: "{{ route('check_cosmica_eco.product') }}",
                    method: "POST",
                    data: {
                        sku: sku,
                        id_notas_productos: idNotaProducto,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            scanCounts[sku]++;

                            // Actualiza el contador visible
                            const contadorCell = $(`td[data-sku="${sku}"]`);
                            contadorCell.find('.contador').text(`${scanCounts[sku]}/${cantidad}`);

                            if (scanCounts[sku] === cantidad) {
                                $(`td[id^="status-${sku}"]`).text('✔️');
                                playSound(true);
                                checkAllProductsChecked();
                            } else {
                                console.log(`Escaneos realizados para SKU ${sku}: ${scanCounts[sku]}/${cantidad}`);
                            }
                        } else {
                            playSound(false);
                            console.log(data);
                            alert(data.message);
                        }
                    },
                    error: function (error) {
                        playSound(false);
                        console.error('Error:', error);
                    }
                });
            } else {
                alert(`Ya se han escaneado ${cantidad} productos para el SKU ${sku}.`);
            }

            $(this).val('');
        } else {
            console.log('El SKU no tiene la longitud correcta.');
        }
    });

    $('#pedidoForm').on('submit', function(){
        const $btn = $('#guardarBtn');

        // Deshabilita el botón y cambia el texto
        $btn.prop('disabled', true).text('Guardando…');
    });
    // Verifica los productos escaneados al cargar la página
    checkAllProductsChecked();
});

</script>
@endsection
