@extends('layouts.app_admin')

@section('template_title')
    Scanner
@endsection
@section('css')

<style>

    .botn_collapse{
        background: #836262!important;
        border-radius: 10px;
        color: #fff !important;
    }

    .collapsable{
        background: #d9cac4!important;
    }

    .img_scanner_dropdown{
        width: 30px;
    }

</style>

@endsection
@section('content')

<div class="container-fluid mt-3 bg-white">
    <div class="row" style="margin: 0!important;padding: 0!important;z-index: 10;">
        <div class="col-10">
            <h2 class="tiitle_modal_dark text-center mt-3">Enviar Pedido</h2>
        </div>

        <div class="col-2">
            <a class="input-group-text span_custom_primary_dark mt-3" data-bs-dismiss="modal" style="margin-right: 0rem!important;">X</a>
        </div>

        <div class="col-12"  style="margin: 0!important;padding: 0!important;">

          <div class="accordion accoirdion_scanner " id="accordionScanner" style="padding-right: 1rem !important;padding-left: 1rem !important;">

              <div class="accordion-item acoriden_items mb-2 collapsable">
                <h2 class="accordion-header accordeon_scanner_header">
                  <button class="accordion-button accordion_scanner d-block botn_collapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
                      <div class="d-flex justify-content-between">
                          <p style="margin-bottom: 0;">Scanner</p>
                          <p style="margin-bottom: 0;">
                              <img class="" src="{{ asset('assets/user/icons/scanner.webp') }}" style="width: 30px">
                          </p>
                      </div>
                  </button>
                </h2>

                <div id="collapseProducts" class="accordion-collapse collapse show" data-bs-parent="#accordionScanner">
                  <div class="accordion-body row" style="margin: 0!important;padding: 0!important;">

                      <div class="d-flex justify-content-center mt-3 mb-3">
                          <div class="camscanner" style="width: 300px; height: 300px;" id="reader"></div>
                      </div>

                      <div class="col-12">
                          <div id="product_camera" class=""></div>

                      </div>

                      <div class="d-flex justify-content-center">
                          <a id="resetScannerProduct" class="input-group-text bg-dark mt-2 mb-2">
                              <img class="" src="{{ asset('assets/user/icons/reset.webp') }}" style="width: 30px">
                          </a>
                      </div>

                  </div>
                </div>
              </div>

          </div>
        </div>

    </div>
</div>

@endsection

@section('js_custom')
        <!-- Sweetalert2 -->
         <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>-->
         <script type="text/javascript" src="{{ asset('assets/admin/js/sweetalert2.all.min.js') }}"></script>

         <!-- Scanner  -->
          <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
         <script type="text/javascript" src="{{ asset('assets/admin/js/html5-qrcode.min.js') }}"></script>
<script>

$(document).ready(function() {

    var token = $('meta[name="csrf-token"]').attr('content');

    $('#btn-buscar').click(function() {
        buscar();
        const audio = new Audio("{{ asset('assets/media/audio/barras.mp3')}}");
        audio.play();
    });

    $('#resetScannerProduct').click(function() {
        resetScanner();
    });

    let html5ScannerProdcut = new Html5QrcodeScanner("reader", { fps: 15, qrbox: 200 , autostart: false });
    html5ScannerProdcut.render(onScanSuccess);

    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Código escaneado: ${decodedText}`);

        // Determinar la tabla basada en el prefijo
        let table = null;
        let id = null;

        if (decodedText.startsWith('NP_')) {
            table = 'NotasProductos';
            id = decodedText.replace('NP_', '');
        } else if (decodedText.startsWith('NC_')) {
            table = 'NotasProductosCosmica';
            id = decodedText.replace('NC_', '');
        } else {
            alert('Código QR no válido.');
            return;
        }

        // Enviar solicitud AJAX al backend con la tabla e ID
        $.ajax({
            url: '{{ route('nota.actualizar_estatus') }}',
            method: 'POST',
            data: {
                table: table, // Tabla identificada
                id: id,       // ID del registro
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Estatus actualizado:', response);
                alert('Estatus de la nota actualizado correctamente.');
            },
            error: function(error) {
                console.error('Error al actualizar estatus:', error);
                alert('Hubo un problema al actualizar el estatus.');
            }
        });
    }


    function buscar() {
        var result = $('#buscar').val();

        $('#loadingSpinner_sku').show();

        $.ajax({
            url: '{{ route('scanner.buscador') }}',
            type: 'get',
            data: {
                'search': result,
                '_token': token // Agregar el token CSRF a los datos enviados
            },
            success: function(data) {
                console.log('Skus:', data);
                $('#input_camera').html(data); // Actualiza la sección con los datos del servicio
            },
            error: function(error) {
            console.log(error);
        },
            complete: function() {
                // Ocultar el spinner cuando la búsqueda esté completa
                $('#loadingSpinner_sku').hide();

            }

        });

    }


    function onScanFailure(error) {
    }

    function resetScanner() {
        html5ScannerProdcut.clear();
        html5ScannerProdcut.render(onScanSuccess);
        $('#product_camera').empty();
    }

});


</script>
@endsection
