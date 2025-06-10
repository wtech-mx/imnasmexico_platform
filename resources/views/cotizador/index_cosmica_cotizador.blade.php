@extends('layouts.app_cotizador')

@section('template_title')
Cosmica
@endsection

<style>
    .img_header{
        width: 250px;
    }

    .h3_subtitulos{
        font-size: 10px;
        color: #E3B6A1;
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
        border: 1px solid #E3B6A1;
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

    .ul_estilos{
        list-style: none;
        padding: 0;
        margin: 0;
    }

    @media only screen and (max-width: 760px) {
        .img_header{
            width: 150px;
        }
    }

    @media only screen and (max-width: 400px) {
        .ul_estilos{
            font-size: 11px
        }

        .descripcion-cell{
            font-size: 11px
        }

        .name_producto{
            font-size: 11px
        }
    }

    /* Por defecto en móvil (<760px): preview activo, full oculto */
    @media (max-width: 759px) {
    .descripcion-cell .preview { display: block; }
    .descripcion-cell .full    { display: none; }
    .toggle-desc               { display: inline; }
    }

    /* En escritorio (>=760px): full siempre visible, preview oculto y sin toggles */
    @media (min-width: 760px) {
    .descripcion-cell .preview { display: none !important; }
    .descripcion-cell .full    { display: block !important;font-size: 14px; }
    .toggle-desc               { display: none !important; }

    }
    /* ----------------------------------------------------
    Sticky footer dentro del container
    ----------------------------------------------------- */
    .footer-sticky {
    position: sticky;    /* se “pega” al hacer scroll */
    bottom: 0;           /* en el fondo del contenedor */
    background: #fff;    /* fondo blanco para cubrir la tabla */
    padding: 1rem;
    border-top: 1px solid #ddd;
    z-index: 10;
    }

    .container_footer{
        background: #FADACF;
        border-radius: 13px;
        border: solid 2px #3F303E;
        padding: 10px;
    }

    .btn_guardar{
        background: #3F303E;
        border: solid 1px #3F303E;
        color: #fff;
        border-radius: 13px;
    }

    .highlighted-row {
        background-color: rgba(255, 255, 0, 0.5);
    }

    .footer-sticky {
    position: sticky;
    bottom: 0;
    background-color: white;
    /* …otros estilos… */
    }


</style>

@section('cotizador')
    <link rel="icon" type="image/x-icon" href="https://plataforma.imnasmexico.com/cosmika/menu/logo.png">

<div class="container-xxl">
    <form id="cotizaForm">
            @csrf
        <div class="row mt-5">
            <div class="col-6">
                <img class="img_header" src="https://plataforma.imnasmexico.com/cosmika/menu/logo.png" alt="">
            </div>

            <div class="col-6">
                <img class="img_header" src="{{ asset('cosmika/lista_img_negativa.png') }}" alt="">
            </div>

        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 mt-3 mb-3">
                <p class="d-inline mr-5" style="color:#2D2432;font-weight: 600;margin-right: 2rem;">
                    Nombre :
                </p>
                <input value="" type="text" name="name" class="form-control" required style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #E3B6A1;border-radius: 0;" >
            </div>

            <div class="col-12 col-md-6 col-lg-6 mt-3 mb-3">
                <p class="d-inline mr-5" style="color:#2D2432;font-weight: 600;margin-right: 2rem;">
                    WhatasApp :
                </p>
                <input value="" type="number" name="telefono" class="form-control"required  style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #E3B6A1;border-radius: 0;" >
            </div>

        </div>

        {{-- Una sola tabla para todos los grupos --}}
        <table class="table table-custom mt-4">
            <thead>
                <tr>
                    {{-- <th>Línea</th> --}}
                    <th>Producto</th>
                    {{-- <th>Precio</th> --}}
                    <th>Descripción</th>
                    <th>Cantidad deseada</th>
                    <th>Total</th> {{-- nueva columna --}}
                </tr>
            </thead>
            <tbody>

            @php
                use Carbon\Carbon;
                // define fecha de inicio fija o dinámica
                $discountStart = Carbon::parse('2025-05-19');
                $today = Carbon::today();
            @endphp

            @foreach($productosPorSublinea as $sublinea => $lista)

                <tr class="sublinea-row">
                    <td colspan="6">{{ $sublinea ?: 'Sin sublínea' }}</td>
                </tr>

                @foreach($lista as $producto)
                @php
                    // calculamos si aplica descuento
                    $hasDiscount = $producto->fecha_fin
                        && $producto->precio_rebajado
                        && $today->between($discountStart, Carbon::parse($producto->fecha_fin));

                    // escogemos el precio que usaremos en los cálculos
                    $applicablePrice = $hasDiscount
                        ? $producto->precio_rebajado
                        : $producto->precio_normal;
                @endphp

                    <tr data-precio="{{ $applicablePrice }}">
                        {{-- <td>{{ $producto->linea }}</td> --}}
                        <td>
                            <img src="{{ $producto->imagenes }}" alt="" style="width:40px"> <br>
                            <p class="name_producto">
                                {{ $producto->nombre }} /
                                {{ $producto->linea }}
                            </p>

                            @if($hasDiscount)
                                {{-- precio normal tachado --}}
                                <small class="text-muted">
                                    <s>${{ number_format($producto->precio_normal, 2, '.', ',') }}</s>
                                </small>
                                {{-- precio rebajado --}}
                                <span class="text-danger fw-bold">
                                    ${{ number_format($producto->precio_rebajado, 2, '.', ',') }}
                                </span>
                                <br>
                                {{-- fecha fin descuento --}}
                                <small class="text-secondary">
                                    hasta {{ Carbon::parse($producto->fecha_fin)->format('d/m/y') }}
                                </small>
                            @else
                                <p class="text-muted">
                                    Precio ${{ number_format($producto->precio_normal, 2, '.', ',') }}
                                </p>
                            @endif

                        </td>
                        {{-- <td class="unit-price">
                            ${{ number_format($producto->precio_normal,2,'.',',') }}
                        </td> --}}
                        <td class="descripcion-cell">
                            @php
                                // 1) Partimos todas las palabras
                                $descWords    = explode(' ', trim($producto->descripcion ?? ''));
                                // 2) Preview: primeras 30 palabras, en tramos de 8
                                $previewWords = array_slice($descWords, 0, 5);
                                $previewChunks= array_chunk($previewWords, 8);
                                // 3) Full: todo en tramos de 8
                                $fullChunks   = array_chunk($descWords, 8);
                            @endphp

                            {{-- Vista previa --}}
                            <div class="preview">
                                @foreach($previewChunks as $chunk)
                                {{ implode(' ', $chunk) }}<br>
                                @endforeach

                                @if(count($descWords) > 5)
                                <a href="#" class="toggle-desc">Ver más</a>
                                @endif
                            </div>

                            {{-- Texto completo, oculto --}}
                            @if(count($descWords) > 5)
                            <div class="full" style="display: none;">
                                @foreach($fullChunks as $chunk)
                                {{ implode(' ', $chunk) }}<br>
                                @endforeach
                                <a href="#" class="toggle-desc">Ver menos</a>
                            </div>
                            @endif
                        </td>

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


            {{-- --- Sección de Kits --- --}}
            @if($kits->isNotEmpty())
                <tr class="sublinea-row">
                    <td colspan="6">Kits</td>
                </tr>
                @foreach($kits as $kit)
                <tr data-precio="{{ $kit->precio_normal }}">
                    <td>
                        <img src="{{asset('products/'.$kit->imagenes) }}" alt="" style="width:40px"><br>
                        {{ $kit->nombre }} / {{ $kit->linea }}<br><br>
                        <p class="text-muted">Precio ${{ number_format($kit->precio_normal,2,'.',',') }}</p>
                    </td>
                    {{-- <-- AÑADIMOS LA CLASE descripcion-cell AQUÍ --}}
                    <td class="descripcion-cell">
                        @php
                            $items = $kit->bundleItems->toArray();
                        @endphp

                        {{-- Vista previa (móvil) --}}
                        <div class="preview">
                            <ul style="" class="ul_estilos">
                                @foreach(array_slice($items, 0, 3) as $item)
                                    <li>
                                    {{ $item['cantidad'] }} × {{ $item['producto'] }}
                                    </li>
                                @endforeach
                            </ul>
                            @if(count($items) > 3)
                            <a href="#" class="toggle-desc">Ver más</a>
                            @endif
                        </div>

                        {{-- Texto completo (desktop siempre, móvil oculto hasta hacer click) --}}
                        @if(count($items) > 3)
                        <div class="full" style="display: none;">
                            <ul style="" class="ul_estilos">
                                @foreach($items as $item)
                                    <li>
                                    {{ $item['cantidad'] }} × {{ $item['producto'] }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="#" class="toggle-desc">Ver menos</a>
                        </div>
                        @endif
                    </td>
                    <td>
                        <input type="number"
                            name="cantidad[{{ $kit->id }}]"
                            class="form-control qty-input"
                            min="0"
                            value="0"/>
                    </td>
                    <td class="row-total">$0.00</td>
                </tr>
                @endforeach
            @endif

            </tbody>
        </table>

        <!-- Sticky footer -->
        <div class="footer-sticky d-flex justify-content-between align-items-center container_footer">
            <div>
                <input type="text" id="buscarProducto"  class="form-control" placeholder="Buscar Producto">
                <strong class="text-dark">Total General: </strong>
                <span id="grandTotal">$0.00</span>

                {{-- Aquí irá la lista de productos seleccionados --}}
                <div id="selected-list" class="mt-0">
                <strong>Tu selección:</strong>
                <ul id="selectedProducts" class="mb-0 ps-3" style="font-size: 12px;"></ul>
                </div>
            </div>
            <button type="submit" class="btn" style="background: #3F303E;border: solid 1px #3F303E;color: #fff;border-radius: 13px;">Guardar Cotización</button>
        </div>
    </form>
</div>

@endsection

@section('js_custom')


<script>
  $(document).on('click', '.toggle-desc', function(e) {
    e.preventDefault();
    // buscamos el td contenedor
    const $cell = $(this).closest('td.descripcion-cell');
    // alternamos preview/full
    $cell.find('.preview, .full').toggle();
  });

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
    url: '{{ route("store_cosmica_cotizacion") }}',
    method: 'POST',
    data: $(this).serialize(),
    success: function(response){
        $btn.prop('disabled', false).text('Guardar Cotización');

        Swal.fire({
            title: '¡Cotización guardada!',
            text: `Folio: ${response.folio}`,
            icon: 'success',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Comprar ahora',
            denyButtonText: 'Contactar agente',
            cancelButtonText: 'Generar y Otra Cotización',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: true,
            preConfirm: () => {
                // 👉 Comprar ahora
                const linkPago = `{{ route('cotizacion_cosmica.link_pago', ['id' => '__ID__']) }}`.replace('__ID__', response.id);
                window.open(linkPago, '_blank');
                return false; // 🔒 No cerrar alerta
            },
            preDeny: () => {
                // 👉 Contactar agente
                const pdfUrl = `{{ url('cosmica/cotizacion/imprimir') }}/${response.id}`;
                const msg = encodeURIComponent(
                    `Hola, realicé una cotización (Folio: ${response.folio}). Puedes verla aquí: ${pdfUrl}`
                );
                window.open(
                    `https://api.whatsapp.com/send/?phone=525637540093&text=${msg}&type=phone_number&app_absent=0`,
                    '_blank'
                );
                return false; // 🔒 No cerrar alerta
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.cancel) {
                // 👉 Generar y Otra Cotización
                const pdfUrl = `{{ url('cosmica/cotizacion/imprimir') }}/${response.id}`;
                Swal.fire({
                    title: 'Descargando PDF…',
                    text: 'Espere un momento, por favor.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();

                        // Descargar con nombre personalizado
                        const a = document.createElement('a');
                        a.href = pdfUrl;
                        a.download = `Cotizacion-${response.folio}.pdf`;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);

                        // Espera y recarga
                        setTimeout(() => {
                            Swal.close();
                            window.location.reload();
                        }, 1500);
                    }
                });
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
        // Array para ir guardando los productos con qty>0
        const selected = [];

        $('tr[data-precio]').each(function(){
            const $row  = $(this);
            const precio = parseFloat($row.data('precio')) || 0;
            const qty    = parseFloat($row.find('.qty-input').val()) || 0;
            const total  = precio * qty;

            // actualiza la celda de total de línea
            $row.find('.row-total').text(
            new Intl.NumberFormat('es-MX',{
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            }).format(total)
            );

            // si qty > 0, lo añadimos al array con el nombre
        if (qty > 0) {
            // 1) Intentamos pillar el <p.name_producto>
            let $p = $row.find('p.name_producto');
            let nombre;
            if ($p.length) {
            // fila de producto normal
            nombre = $p.text().split('/')[0].trim();
            } else {
            // fila de kit: sacamos el texto del primer td (antes del /)
            let text = $row.children('td').first().text().trim();
            nombre = text.split('/')[0].trim();
            }
            selected.push({ nombre, qty });
        }


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

        // Rellenar la lista de productos seleccionados
        const $list = $('#selectedProducts').empty();
        if (selected.length === 0) {
            $list.append('<li>(Sin productos seleccionados)</li>');
        } else {
            selected.forEach(item => {
            $list.append(`<li>${item.nombre} × ${item.qty}</li>`);
            });
        }

        // ——————————————————————————————————
        // 5) NUEVA LÓGICA para quitar sticky si hay > 13 ítems
        // ——————————————————————————————————
        const footer = document.querySelector('.footer-sticky');
        if (!footer) return; // por si algo no existe

        // Contamos cuántos <li> hay en #selectedProducts:
        const numItemsSeleccionados = selected.length;

        if (numItemsSeleccionados > 15) {
          // Cambiamos position a static para “despegar” el footer
          footer.style.position = 'static';
          footer.style.bottom = 'auto';
        } else {
          // Volvemos a ponerlo sticky si hay 13 o menos
          footer.style.position = 'sticky';
          footer.style.bottom = '0';
        }

        const buscador = document.getElementById('buscarProducto');
let ultimaFilaResaltada = null;

buscador.addEventListener('input', function() {
  const termino = this.value.trim().toLowerCase();

  // Si el campo está vacío, quitamos resaltado y no scroll
  if (termino === '') {
    if (ultimaFilaResaltada) {
      ultimaFilaResaltada.classList.remove('highlighted-row');
      ultimaFilaResaltada = null;
    }
    return;
  }

  // Quitamos resaltado anterior
  if (ultimaFilaResaltada) {
    ultimaFilaResaltada.classList.remove('highlighted-row');
    ultimaFilaResaltada = null;
  }

  // Recorremos cada fila <tr data-precio="...">
  const filas = document.querySelectorAll('tr[data-precio]');
  for (const fila of filas) {
    const etiquetaNombre = fila.querySelector('p.name_producto');
    if (!etiquetaNombre) continue;

    const textoCompleto  = etiquetaNombre.textContent.trim().toLowerCase();
    const nombreProducto = textoCompleto.split('/')[0].trim();

    if (nombreProducto.includes(termino)) {
      // 1) Scroll suave hasta esa fila
      fila.scrollIntoView({ behavior: 'smooth', block: 'center' });
      // 2) Aplicar resaltado
      fila.classList.add('highlighted-row');
      ultimaFilaResaltada = fila;
      break; // Primer match
    }
  }
});

        }

    });




</script>
@endsection

