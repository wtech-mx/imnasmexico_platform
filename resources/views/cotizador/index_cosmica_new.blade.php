@extends('layouts.app_cotizador')

@section('template_title')
Cosmica
@endsection

<style>
    .img_header{
        widows: 150px;
    }

    .h3_subtitulos{
        font-size: 10px;
        color: #BB2E32;
    }
        /* color de fondo de toda la tabla */
    .table-custom {
        width: 100%;
        background: #F9F4F4;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* bordes rojos y redondeados en cada celda */
    .table-custom th,
    .table-custom td {
        border: 1px solid #C2393B;
        border-radius: 9px;
        vertical-align: middle;
    }

    /* fila de sublínea: sin bordes laterales y con un poco de espacio */
    .sublinea-row td {
        background: transparent;
        border: none;
        font-weight: bold;
        padding-top: 1rem;
        padding-bottom: .5rem;
    }

    /* opcional: resaltar el thead */
    .table-custom thead th {
        background: #F9F4F4;
    }

    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        color: var(--bs-table-color-state, var(--bs-table-color-type, var(--bs-table-color)));
        background-color: #F9F4F4!important;
        border-bottom-width: var(--bs-border-width);
        box-shadow: inset 0 0 0 9999px var(--bs-table-bg-state, var(--bs-table-bg-type, var(--bs-table-accent-bg)));
    }
</style>

@section('cotizador')

<div class="container-xxl">
<form id="cotizaForm">
        @csrf
    <div class="row mt-5">
        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/logo_cosmica_cotizador.png') }}" alt="">
        </div>

        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/lista_img.png') }}" alt="">
        </div>

        <div class="col-4">
            <img class="img_header" src="{{ asset('cosmika/duo_amor.png') }}" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                Nombre :
            </p>
            <input value="" type="text" name="name" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" >
        </div>

        <div class="col-6">
            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                WhatasApp :
            </p>
            <input value="" type="number" name="telefono" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" >
        </div>
    </div>

    {{-- Una sola tabla para todos los grupos --}}
    <table class="table table-custom mt-4">
        <thead>
            <tr>
                <th>Línea</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Cantidad deseada</th>
                <th>Total</th> {{-- nueva columna --}}
            </tr>
        </thead>
        <tbody>
        @foreach($productosPorSublinea as $sublinea => $lista)
            <tr class="sublinea-row">
                <td colspan="6">{{ $sublinea ?: 'Sin sublínea' }}</td>
            </tr>
            @foreach($lista as $producto)
            <tr data-precio="{{ $producto->precio_normal }}">
                <td>{{ $producto->linea }}</td>
                <td>
                    <img src="{{ $producto->imagenes }}" alt="" style="width:45px">
                    {{ $producto->nombre }}
                </td>
                <td class="unit-price">
                    ${{ number_format($producto->precio_normal,2,'.',',') }}
                </td>
                <td>{{ Str::limit($producto->descripcion,180) }}</td>
                <td>
                    <input
                    type="number"
                    name="cantidad[{{ $producto->id }}]"
                    class="form-control qty-input"
                    min="0"
                    value="0"
                    />
                </td>
                <td class="row-total">$0.00</td>
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    {{-- debajo de la tabla, mostramos el Total Global --}}
    <div class="text-end mt-3">
        <strong>Total General: </strong>
        <span id="grandTotal">$0.00</span>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cotización</button>
</form>

</div>

@endsection


@section('js_custom')
<script>
$(function(){
  // 1) Preparamos el token para todas las llamadas AJAX
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  // 2) Capturamos el submit
  $('#cotizaForm').on('submit', function(e){
    e.preventDefault();
    const $btn = $(this).find('button[type="submit"]');
    // opcional: deshabilitar botón mientras enviamos
    $btn.prop('disabled', true).text('Enviando…');

    // 3) Enviamos por AJAX
    $.ajax({
    url: '{{ route("cotizacion.store") }}',
    method: 'POST',
    data: $(this).serialize(),
    success: function(response){
        $btn.prop('disabled', false).text('Guardar Cotización');

        Swal.fire({
        title: '¡Cotización guardada!',
        text: '¿Qué quieres hacer ahora?',
        icon: 'success',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Generar PDF',
        denyButtonText: 'Contactar agente',
        cancelButtonText: 'Otra Cotización',
        allowOutsideClick: false,
        allowEscapeKey: false,

        preConfirm: () => {
            window.open(`{{ url('cosmica/cotizacion/imprimir') }}/${response.id}`, '_blank');
            return false; // mantiene la alerta abierta
        },

        preDeny: () => {
            const msg = encodeURIComponent(
            `Hola, realicé una cotización con el Folio: ${response.folio}`
            );
            // abre WhatsApp en pestaña nueva
            window.open(
            `https://api.whatsapp.com/send/?phone=525637540093&text=${msg}&type=phone_number&app_absent=0`,
            '_blank'
            );
            return false; // mantiene la alerta abierta
        }

        }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = '{{ route("index_cosmica_new.cotizador") }}';
        }
        });
    },
    error: function(xhr){
        $btn.prop('disabled', false).text('Guardar Cotización');
        Swal.fire('Error','No se pudo guardar la cotización.','error');
        console.error(xhr.responseText);
    }
    });

  });

});

$(function(){
  // 1) Cada vez que cambie una cantidad...
  $(document)
    .on('input', '.qty-input', updateTotals)
    // inicializa al cargar
    .ready(updateTotals);

  function updateTotals(){
    let grand = 0;
    $('tr[data-precio]').each(function(){
      const precio = parseFloat($(this).data('precio')) || 0;
      const qty    = parseFloat($(this).find('.qty-input').val()) || 0;
      const total  = precio * qty;
      // actualiza la celda de total de línea
      $(this).find('.row-total').text(
        new Intl.NumberFormat('es-MX',{
          style: 'currency',
          currency: 'MXN',
          minimumFractionDigits: 2
        }).format(total)
      );
      grand += total;
    });
    // actualiza el total general
    $('#grandTotal').text(
      new Intl.NumberFormat('es-MX',{
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2
      }).format(grand)
    );
  }
});
</script>
@endsection

