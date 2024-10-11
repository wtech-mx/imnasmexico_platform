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
            <h2 class="tiitle_modal_dark text-center mt-3">Buscar Producto</h2>
        </div>

        <div class="col-2">
            <a class="input-group-text span_custom_primary_dark mt-3" data-bs-dismiss="modal" style="margin-right: 0rem!important;">
              <img class="icon_span_form m-auto" src="{{ asset('assets/user/icons/close_white.webp') }}" alt="" width="30px">>
          </a>
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
                          <div class="camscanner" style="" id="reader_search"></div>
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

              <div class="accordion-item acoriden_items mb-2 collapsable">
                  <h2 class="accordion-header accordeon_scanner_header">
                    <button class="accordion-button accordion_scanner d-block collapsed botn_collapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManual" aria-expanded="false" aria-controls="collapseManual">
                        <div class="d-flex justify-content-between">
                            <p style="margin-bottom: 0;">Busqueda Sku</p>
                            <p style="margin-bottom: 0;">
                                <img class="" src="{{ asset('assets/user/icons/buscar.webp') }}" alt="" style="width: 30px">
                            </p>
                        </div>
                    </button>
                  </h2>
                  <div id="collapseManual" class="accordion-collapse collapse" data-bs-parent="#accordionScanner">
                    <div class="accordion-body row">
                      <div class="form-group col-12">
                          <label for="name" class="label_custom_primary_product mb-2">Ingresa SKU : *</label>
                          <div class="input-group ">
                              <span class="input-group-text span_custom_primary_dark" >
                                <img class="" src="{{ asset('assets/user/icons/code_barras.webp') }}" style="width: 30px">
                              </span>
                              <input id="buscar" name="buscar" type="text"  class="form-control input_custom_primary_dark" >
                          </div>
                      </div>

                      <div class="form-group col-12">

                          <p class="text-center">
                              <button type="button" id="btn-buscar" class="btn btn-success mt-3 text-white"> Buscar
                                  <img class="" src="{{ asset('assets/user/icons/buscar.webp') }}" width="30px">
                              </button>
                          </p>
                      </div>


                      <div class="col-12">
                          <div class="d-flex justify-content-center">
                              <div class="spinner-border" role="status" id="loadingSpinner_sku" style="display:none">
                                   <span class="visually-hidden">Loading...</span>
                               </div>
                           </div>
                       </div>

                      <div class="col-12">
                          <div id="input_camera" class=""></div>
                      </div>

                      <div class="d-flex justify-content-center">
                          <a id="resetScannerProduct_input" class="input-group-text bg-dark mt-2 mb-2">
                              <img class="" src="{{ asset('assets/user/icons/reset.webp') }}" style="width: 30px" >
                          </a>
                      </div>

                    </div>
                  </div>
              </div>

              <div class="accordion-item acoriden_items mb-2 collapsable">
                <h2 class="accordion-header accordeon_scanner_header">
                  <button class="accordion-button accordion_scanner d-block collapsed botn_collapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
                      <div class="d-flex justify-content-between">
                          <p style="margin-bottom: 0;">Busqueda palabra clave</p>
                          <p style="margin-bottom: 0;">
                            <img class="" src="{{ asset('assets/user/icons/filtrar.webp') }}" style="width: 30px">
                          </p>
                      </div>
                  </button>
                </h2>
                <div id="collapseFilters" class="accordion-collapse collapse" data-bs-parent="#accordionScanner">
                  <div class="accordion-body row">
                      <div class="form-group col-12">
                          <label for="name" class="label_custom_primary_product mb-2">Ingresa palabra clave : *</label>
                          <div class="input-group ">
                              <span class="input-group-text span_custom_primary_dark" >
                                  <img class="" src="{{ asset('assets/user/icons/una.webp') }}" alt="" width="30px">
                              </span>
                              <input id="buscar_palabra" name="buscar_palabra" type="text" class="form-control input_custom_primary_dark" >
                          </div>
                      </div>

                      <div class="form-group col-12">
                          <p class="text-center">
                              <button type="button" id="btn-buscar-palabra" class="btn btn-success mt-3 text-white"> Buscar
                                  <img class="" src="{{ asset('assets/user/icons/buscar.webp') }}" width="30px">
                              </button>
                          </p>
                      </div>

                      <div class="col-12">
                          <div class="d-flex justify-content-center">
                              <div class="spinner-border" role="status" id="loadingSpinner_bulk" style="display:none">
                                   <span class="visually-hidden">Loading...</span>
                               </div>
                           </div>
                       </div>

                      <div class="col-12">
                          <div id="input_camera_palabra" class=""></div>
                      </div>

                      <div class="d-flex justify-content-center">
                          <a id="resetScannerProductPalabra_input" class="input-group-text bg-dark mt-2 mb-2">
                              <img class="" src="{{ asset('assets/user/icons/reset.webp') }}" style="width: 30px" >
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

         <!-- Select2  -->
          <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
         <script type="text/javascript" src="{{ asset('assets/admin/js/select2.min.js') }}"></script>

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

    $('#btn-buscar-palabra').click(function() {
        buscar_palabra();
        const audio = new Audio("{{ asset('assets/media/audio/barras.mp3')}}");
        audio.play();
    });

    $('#resetScannerProduct').click(function() {
        resetScanner();
    });

    $('#resetScannerProduct_input').click(function() {
        resetScannerInput();
    });

    $('#resetScannerProductPalabra_input').click(function() {
        resetScannerPalabraInput();
    });

    let html5ScannerProdcut = new Html5QrcodeScanner("reader_search", { fps: 15, qrbox: 200 , autostart: false });
    html5ScannerProdcut.render(onScanSuccess);

    function onScanSuccess(result, decodedResult) {
        html5ScannerProdcut.clear().then(_ => {
                $.ajax({
                    type: 'get',
                    url: '{{ route('scanner.buscador') }}',
                    data: {
                    'search': result,
                    '_token': token // Agregar el token CSRF a los datos enviados
                    },
                    success: function (data) {
                        console.log('Skus:', data);
                        $('#product_camera').html(data); // Actualiza la sección con los datos del servicio
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                document.getElementById('resetScannerProduct').classList.remove('no_aparece');
                const audio = new Audio("{{ asset('assets/media/audio/barras.mp3')}}");

                audio.play();
                scanner.clear();
                // Clears scanning instance
                document.getElementById('reader_search').remove();
                // Removes reader element from DOM since no longer needed

        }).catch(error => {
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

    function buscar_palabra() {
        var result = $('#buscar_palabra').val();
        $('#loadingSpinner_bulk').show();

        $.ajax({
            url: '{{ route('scanner.buscador_palabra') }}',
            type: 'get',
            data: {
                'search': result,
                '_token': token // Agregar el token CSRF a los datos enviados
            },
            success: function(data) {
                console.log('Skus:', data);
                $('#input_camera_palabra').html(data); // Actualiza la sección con los datos del servicio
            },
            error: function(error) {
            console.log(error);
        },
            complete: function() {
                // Ocultar el spinner cuando la búsqueda esté completa
                $('#loadingSpinner_bulk').hide();

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

    function resetScannerInput() {
        html5ScannerProdcut.clear();
        html5ScannerProdcut.render(onScanSuccess);
        $('#input_camera').empty();
        $('#buscar').val('');
    }

    function resetScannerPalabraInput() {
        html5ScannerProdcut.clear();
        html5ScannerProdcut.render(onScanSuccess);
        $('#input_camera_palabra').empty();
        $('#buscar_palabra').val('');
    }

});


</script>
@endsection
