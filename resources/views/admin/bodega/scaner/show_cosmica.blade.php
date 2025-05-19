@extends('layouts.app_admin')

@section('template_title')
Escaner #{{ $nota_scaner->id }} cosmica
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
                            <h2 class="mb-3">Cotizacion Cosmica Folio #{{$nota_scaner->folio}}</h2>
                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <input class="form-control" type="text" id="scanInput" placeholder="Escanea el código aquí" autofocus>
                        <form method="POST" action="{{ route('distribuidoras.update_estatus', $nota_scaner->id) }}" enctype="multipart/form-data" role="form" id="pedidoForm">
                            @csrf
                            <input type="hidden" name="estatus_cotizacion" value="Preparado">
                            <input type="hidden" name="_method" value="PATCH">
                                <div class="modal-body" id="productTableContainer">
                                    @include('admin.bodega.scaner.product_table', ['productos_scaner' => $productos_scaner])
                                </div>

                                @can('guardar-folio-bodega')
                                    <div class="modal-footer">
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar Admin</button>
                                    </div>
                                @endcan

                                <a class="text-center text-white btn"
                                    href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_cosmica_productos', 'id' => $nota_scaner->id]) }}"
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

    // Verifica si todos los productos han sido escaneados
    function checkAllProductsChecked() {
        let allChecked = true;
        $('td[data-sku]').each(function () {
            const cantidad = parseInt($(this).data('cantidad'));
            const escaneados = parseInt($(this).find('.contador').text().split('/')[0]);
            if (escaneados < cantidad) {
                allChecked = false;
            }
        });
        $('#guardarBtn').toggle(allChecked);  // Muestra el botón solo si todos están marcados
    }

    // Manejador para escanear el SKU
    $('#scanInput').on('change', function () {
        const sku = $(this).val().trim();

        if (sku.length === 6) {
            const idNotaProducto = $('tr[data-id]').data('id');

            $.ajax({
                url: "{{ route('check_cosmica.product') }}",
                method: "POST",
                data: {
                    sku: sku,
                    id_notas_productos: idNotaProducto,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    if (data.status === 'success') {
                        $('#productTableContainer').html(data.view);
                        playSound(true);
                        checkAllProductsChecked();
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
