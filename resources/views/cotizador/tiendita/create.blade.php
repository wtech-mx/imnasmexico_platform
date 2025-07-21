@extends('layouts.app_cotizador')

@section('template_title')
Tiendita
@endsection
@section('css_custom')
    <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}">

    <style>
        body{
             background: #cce0e5 !important;
        }
    </style>

@endsection

@section('cotizador')

<div class="container-xxl" id="cotizadorApp" data-tipo="nas">
    <div class="row">

        <!-- Productos -->
        <div class="col-lg-8">

            <div class="row ">

                @include('cotizador.barr_superior')

                @include('cotizador.componente_cliente')

                @include('cotizador.component_categorias')

                @include('cotizador.compnent_buscador_productos')

            </div>

        </div>

        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <form class="row" action="{{ route('cotizador.store', ['tipo' => 'tiendita']) }}" method="POST" id="formGuardarPedido" enctype="multipart/form-data">
                @csrf
                <!-- Hidden para guardar el id seleccionado -->
                <input type="hidden" name="id_usuario" id="idUsuario">
                <input type="hidden" name="tipo" value="tiendita">
                <input type="hidden" name="tipo_nota" value="Venta Presencial">
                @include('cotizador.pedido_partial')
            </form>
        </div>

    </div>
</div>

@endsection


@section('js_custom')
 @include('cotizador.component_js')
<script>

    // BUSCADOR CLIENTE, RECONOCIMIENTO Y DISTRIBUIDORA
    $(function(){
        $('#usuarioInput').autocomplete({
            source: function(request, response) {
                $.getJSON("{{ route('usuarios.search') }}", { q: request.term }, response);
            },
            minLength: 2,
            select: function(event, ui) {
                $('#idUsuario').val(ui.item.id);
                console.log(ui.item);
                // Si no tiene reconocimiento, muestro el upload y oculto el mensaje
                if (!ui.item.reconocimiento) {
                    $('#reconocimiento-upload').removeClass('d-none');
                    $('#reconocimiento-message').addClass('d-none');
                }
                // Si ya tiene, muestro el mensaje y oculto el upload
                else {
                    $('#reconocimiento-upload').addClass('d-none');
                    $('#reconocimiento-message').removeClass('d-none');
                }

                // Ahora consultamos membresía
                $('#membership-message').removeClass('alert-success alert-danger alert-secondary').addClass('d-none').text('Cargando estado de membresía…');

                $('#postcode').val(ui.item.postcode);
                $('#state').val(ui.item.state);
                $('#city').val(ui.item.city);
                $('#direccion').val(ui.item.direccion);
                $('#referencia').val(ui.item.referencia);
                $('#country').val(ui.item.country);

                $.getJSON(`/cosmikausers/${ui.item.id}/membership`).done(function(data) {
                    if (data.activa) {
                        // 1) Determina el % según el tipo de membresía
                        let pct = 0;
                        membershipActive = true;
                        membershipType   = data.membresia; // “Estelar” o “Cosmos”
                        if (data.membresia === 'Estelar') pct = 60;
                        else if (data.membresia === 'Cosmos') pct = 40;

                        // 2) Aplica al input global de descuento
                        // const descuentoGlobalInput = document.getElementById('descuento-total');
                        // descuentoGlobalInput.value = pct;

                        // 3) Recalcula totales con ese % global
                        actualizarTotales();

                        $('#membership-message')
                        .removeClass('d-none alert-secondary')
                        .addClass('alert-success')
                        .text(`🎉 Tiene membresía Estatus: ${data.membresia}. Descuento para cosmica: ${pct}%`);
                    }
                    else {
                        membershipActive = false;
                        membershipType   = null;
                        $('#membership-message')
                        .removeClass('d-none alert-success')
                        .addClass('alert-secondary')
                        .text('ℹ️ No tiene membresía activa');
                    }
                        recalcEnvio();
                        actualizarTotales();
                })
                .fail(function() {
                    membershipActive = false;
                    membershipType   = null;
                    $('#membership-message')
                    .removeClass('d-none')
                    .addClass('alert-danger')
                    .text('⚠️ Error al consultar membresía');
                });

            },
            change: function(e, ui) {
                if (!ui.item) {
                    $('#idUsuario').val('');
                    // Al limpiar, oculto ambos
                    $('#reconocimiento-upload, #reconocimiento-message, #membership-message').addClass('d-none');
                }
            }
        });
    });

    function recalcEnvio() {
        const checked = document.getElementById('chkEnvio').checked;
        const envioDisplay = document.getElementById('envio-display');

        // Si no está seleccionado, tarifa 0
        if (!checked) {
            envioDisplay.textContent = '$0.00';
            window.cachedEnvioCost = 0; // <-- ¡AQUÍ!
            actualizarTotales();        // <-- ¡Y AQUÍ!
            return;
        }

        // ... resto de tu lógica ...
        // Leemos el total SIN envío (descuento global ya aplicado)
        const totalSinEnvio = parseFloat(
            document.getElementById('total-display')
            .textContent.replace(/[^0-9.-]+/g,'')
        ) || 0;

        let costoEnvio = 0;

        costoEnvio = 250;

        envioDisplay.textContent = `$${costoEnvio.toFixed(2)}`;
        window.cachedEnvioCost = costoEnvio;
    }

    document.getElementById('formGuardarPedido').addEventListener('submit', function(e){
        e.preventDefault();
        const val = validarClienteAntesDeGuardar();
        if (!val.ok) {
            Swal.fire({
                icon: 'warning',
                title: 'Datos incompletos',
                text: val.mensaje,
            });
            return; // NO envía
        }

        const form = this;
        const data = new FormData(form);

        if (val.tipo === 'nuevo') {
            data.set('id_usuario', '');  // para que el backend sepa que es nuevo
            data.set('name', val.nombre);
            data.set('telefono', val.telefono);
        }

        fetch(form.action, {
            method: form.method,
            body: data,
            headers: {
            'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(json => {
            if (json.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Pedido guardado!',
                    text: json.message,
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonText: 'Descargar PDF',
                    cancelButtonText: 'Seguir cotizando',
                    denyButtonText: 'Ver todas las cotizaciones',
                    preDeny: () => {
                        window.open("{{ route('notas_cotizacion.index') }}", '_blank');
                        return false; // Evita que se cierre la alerta
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        window.open(`/admin/notas/cotizacion/imprimir/${json.order_id}`, '_blank');
                        location.reload();
                    } else if (result.isDismissed) {
                        location.reload();
                    }
                });
            }
        })
        .catch(err => {
            Swal.fire('Error', 'No se pudo guardar el pedido.', 'error');
        });
    });
</script>

@endsection
