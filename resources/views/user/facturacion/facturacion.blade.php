@extends('layouts.app_user')

@section('template_title')
   Facturacion Cosmica
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/nosotros.css')}}" rel="stylesheet" />
{{-- css carrusel --}}

@endsection

@section('content')


<section class="primario bg_overley margin_home_nav" style="background-color:#F5ECE4;" id="cafeteria">
    <div class="row">


        <div class="col-12 col-md-12  m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#836262!important;">Facturacion Cosmica</h1>
            <p class="text-center text-white mt-auto parrafo_instalaciones" style="color:#836262!important;">
                Realiza tu facuracion dentro del mes que hiciste tu compra.
            </p>

            <div class="container py-4">
                <div class="row justify-content-center mb-4">
                  <div class="col-md-6">
                    <div class="input-group">
                      <input type="text" id="inputFolio" class="form-control" placeholder="Ingresa tu folio" />
                      <button class="btn btn-primary" id="btnBuscarFolio">Buscar</button>
                    </div>
                  </div>
                </div>

                <!-- Aquí inyectaremos el partial completo -->
                <div id="resultadoFolio" style="display: none;"></div>
              </div>

        </div>

    </div>
</section>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function(){
  $('#btnBuscarFolio').on('click', function(){
    const folio = $('#inputFolio').val().trim();
    if (!folio) {
      return Swal.fire('Oops','Ingresa un folio para buscar','warning');
    }

    $.ajax({
      url: '{{ route("facturacion.search") }}',
      data: { folio },
      success(response) {
        // Inyecta el HTML que vino del servidor
        $('#resultadoFolio').html(response.html).fadeIn();
      },
      error(xhr) {
        let msg = 'No se encontró ninguna nota con ese folio.';
        if (xhr.responseJSON?.message) msg = xhr.responseJSON.message;
        Swal.fire('Aviso', msg, 'error');
        $('#resultadoFolio').hide();
      }
    });
  });

  $('#inputFolio').on('keypress', function(e){
    if (e.key === 'Enter') {
      e.preventDefault();
      $('#btnBuscarFolio').click();
    }
  });


  // Usa delegación:
  $(document).on('input', '#codigo_postal', function () {
    const cp = $(this).val();
    if (cp.length !== 5) return;
    // usa la ruta nombrada en lugar de escribir “/buscar-cp” a mano:
    const url = '{{ route("buscarCP") }}?codigo_postal=' + encodeURIComponent(cp);
    $.get(url)
      .done(function (data) {
        const $colonia = $('#colonia').empty();
        data.colonias.forEach(c => $colonia.append(`<option>${c}</option>`));
        $('#ciudad').val(data.ciudad);
        $('#estado').val(data.estado);
        $('#municipio').val(data.municipio);
      })
      .fail(function () {
        Swal.fire('Oops','Código postal no encontrado','error');
      });
  });
});


$(function(){
// Delegamos el submit al document, filtrando por el selector.
$(document).on('submit', '#facturaForm', function(e){
  e.preventDefault(); // Detenemos el comportamiento por defecto del formulario
  const form = this;
  const url  = $(form).attr('action');
  const data = new FormData(form);

  $.ajax({
    url: url,
    method: 'POST',
    data: data,
    processData: false,
    contentType: false,
    success(response) {
      Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: response.message || 'Factura emitida correctamente.'
      });
      // Opcional: limpiar o esconder el bloque de facturación
      $('#FacturaContainer').fadeOut();
    },
    error(xhr) {
      let msg = 'Ocurrió un error al emitir la factura.';
      if (xhr.responseJSON) {
        if (xhr.responseJSON.errors) {
          msg = Object.values(xhr.responseJSON.errors)
                      .flat()
                      .join('<br>');
        } else if (xhr.responseJSON.message) {
          msg = xhr.responseJSON.message;
        }
      }
      Swal.fire({
        icon: 'error',
        title: 'Error',
        html: msg
      });
    }
  });
});
});

</script>
@endsection




