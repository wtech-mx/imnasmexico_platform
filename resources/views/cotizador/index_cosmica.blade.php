@extends('layouts.app_cotizador')

@section('template_title')
Cosmica
@endsection

@section('cotizador')

<div class="container-xxl">
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

        <div class="col-lg-4 mt-3">
            <form class="row" action="{{ route('cotizador.store', ['tipo' => 'cosmica']) }}" method="POST" id="formGuardarPedido" enctype="multipart/form-data">
                @csrf
                <!-- Hidden para guardar el id seleccionado -->
                <input type="hidden" name="id_usuario" id="idUsuario">
                <input type="hidden" name="tipo" value="cosmica">
                <input type="hidden" name="tipo_nota" value="Cotizacion">
                @include('cotizador.pedido_partial')
            </form>
        </div>

    </div>
</div>

@endsection


@section('js_custom')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const inputTelefono = document.getElementById('telefono');

        if (inputTelefono) {
            const limpiarTelefono = (valor) => {
                return valor.replace(/\D/g, '').slice(0, 10); // solo 10 dígitos
            };

            inputTelefono.addEventListener('input', function () {
                this.value = limpiarTelefono(this.value);
            });

            inputTelefono.addEventListener('paste', function (e) {
                e.preventDefault();
                const textoPegado = (e.clipboardData || window.clipboardData).getData('text');
                this.value = limpiarTelefono(textoPegado);
            });
        }

        const chkEnv = document.getElementById('chkEnvio');
        const envFields = document.getElementById('envioFields');

        chkEnv.addEventListener('change', () => {
            envFields.style.display = chkEnv.checked ? 'block' : 'none';
        });

        // Usa delegación:
        $(document).on('input', '#postcode', function () {
            const cp = $(this).val();
            if (cp.length !== 5) return;
            // usa la ruta nombrada en lugar de escribir “/buscar-cp” a mano:
            const url = '{{ route("buscarCP") }}?codigo_postal=' + encodeURIComponent(cp);
            $.get(url)
            .done(function (data) {
                const $colonia = $('#country').empty();
                data.colonias.forEach(c => $colonia.append(`<option>${c}</option>`));
                $('#city').val(data.ciudad);
                $('#state').val(data.estado);
                $('#alcaldia').val(data.municipio);
            })
            .fail(function () {
                Swal.fire('Oops','Código postal no encontrado','error');
            });
        });

    });
</script>
<script>
    let timeout = null;
    let carrito = [];
    let membershipType = null;     // ‘Estelar’, ‘Cosmos’ o null
    let membershipActive = false;  // true si tiene membresía activa

    function showToast(mensaje, icono = 'success') {
        Swal.fire({
            toast: true,
            position: 'bottom-start',
            icon: icono,
            title: mensaje,
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true
        });
    }

    // Evitar que el formulario recargue la página al hacer submit
    document.getElementById('formBuscarProductos').addEventListener('submit', function(e) {
        e.preventDefault(); // Evita recargar el formulario
    });

    // Evento de escritura en el input de búsqueda
    document.getElementById('inputBuscarProductos').addEventListener('keyup', function(e) {
        const valor = this.value;

        // Si presiona Enter
        if (e.key === 'Enter') {
            e.preventDefault(); // Evita recargar
            buscarProductos(valor);
        }

        // Esperar 2 segundos después de escribir
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            if (valor.trim() !== '') {
                buscarProductos(valor);
            }
        }, 2000);
    });

    // Función que realiza la búsqueda y carga la vista parcial
    function buscarProductos(valor) {
        fetch(`/cotizador/buscar?query=${encodeURIComponent(valor)}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('contenedor_productos').innerHTML = html;

                // 🧼 Limpiar campo de búsqueda después de la búsqueda
                document.getElementById('inputBuscarProductos').value = '';
            });
    }
    // Cargar productos por categoría (usado al hacer clic en una categoría)
    function cargarProductosPorCategoria(idCategoria) {
        fetch(`/cotizador/categoria/cosmica/${idCategoria}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('contenedor_productos').innerHTML = html;
            });
    }

    // 1) Al hacer clic en la pestaña Kits
    document.getElementById('kits-tab')
    .addEventListener('click', function() {
        // desactivar otras pestañas (Bootstrap lo hace para el contenido)
        cargarKits();
    });

    // 2) Función que carga los kits
    function cargarKits() {
    fetch('{{ route("cotizador.kits") }}')
        .then(response => response.text())
        .then(html => {
        document.getElementById('contenedor_productos').innerHTML = html;
        })
        .catch(err => {
        console.error('Error al cargar kits:', err);
        Swal.fire('Error','No fue posible cargar los kits','error');
        });
    }

    function modificarCantidad(idProducto, cambio) {
        const index = carrito.findIndex(p => p.id == idProducto);

        if (index !== -1) {
            carrito[index].cantidad += cambio;

            if (carrito[index].cantidad <= 0) {
                carrito.splice(index, 1);
                eliminarDelCarrito(idProducto); // Ya elimina del DOM
                showToast('Producto eliminado del carrito', 'info');
            } else {
                renderizarCarrito();
                showToast('Cantidad actualizada', 'info');
            }
        }
    }

    //DESCUENTO
    document.getElementById('contenedor_carrito')
    .addEventListener('input', function(e) {
        if (!e.target.classList.contains('descuento-input')) return;

        const fila = e.target.closest('.list-group-item');
        const pct  = parseFloat(e.target.value) || 0;

        // 1) Sincroniza el hidden de esa fila
        fila.querySelector('.descuento-input-hidden').value = pct;

        // 2) Recalcula el span .total de esa fila
        const precio = parseFloat(fila.querySelector('.precio-unitario').dataset.precio);
        const cantidad = parseInt(fila.querySelector('.cantidad').textContent, 10);
        const tot = precio * cantidad * (1 - pct/100);
        fila.querySelector('.total').textContent = `$${tot.toFixed(2)}`;

        // 3) Ahora recalcule todo (envío e IVA incluidos)
        recalcEnvio();
        recalcIVA();
        actualizarTotales();
    });

    document.getElementById('descuento-total').addEventListener('input', actualizarTotales);
    function actualizarTotales() {
        // 1) Sumar todos los "total" de cada fila (ya contemplan descuento individual)
        let subtotal = 0;
        document.querySelectorAll('.list-group-item .total').forEach(span => {
            const val = parseFloat(span.textContent.replace(/[^0-9.-]+/g,'')) || 0;
            subtotal += val;
        });

        // 2) Mostrar y guardar subtotal
        document.getElementById('subtotal-display').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('subtotal-final-input').value   = subtotal.toFixed(2);

        // 3) Descuento global (%)
        const descGlobalPct = parseFloat(document.getElementById('descuento-total').value) || 0;
        const totalDespuesDescGlobal = subtotal * (1 - descGlobalPct/100);

        // 4) Envío (usamos el mismo cachedEnvioCost que ya calculas en recalcEnvio)
        const envio = window.cachedEnvioCost || 0;
        document.getElementById('envio-display').textContent = `$${envio.toFixed(2)}`;
        document.getElementById('envio-final-input').value   = envio.toFixed(2);

        // 5) Base para IVA
        const baseParaIVA = totalDespuesDescGlobal + envio;

        // 6) IVA 16% si hay checkbox marcado
        const aplicaIva = document.getElementById('chkFacturacion').checked;
        const iva = aplicaIva ? baseParaIVA * 0.16 : 0;
        window.cachedIVA = iva;
        document.getElementById('iva-display').textContent = `$${iva.toFixed(2)}`;
        document.getElementById('iva-final-input').value   = iva.toFixed(2);

        // 7) Total final = baseParaIVA + iva
        const totalFinal = baseParaIVA + iva;
        document.getElementById('total-display').textContent = `$${totalFinal.toFixed(2)}`;
        document.getElementById('total-final-input').value   = totalFinal.toFixed(2);
    }

    async function renderizarCarrito() {
        for (const producto of carrito) {
            const total = producto.precio * producto.cantidad;
            const productoExistente = document.querySelector(`.list-group-item[data-id="${producto.id}"]`);

            if (productoExistente) {
            // Actualiza cantidad y total existentes
            productoExistente.querySelector('.cantidad').textContent = producto.cantidad;
            productoExistente.querySelector('.cantidad-input').value = producto.cantidad;
            productoExistente.querySelector('.total').textContent    = `$${total.toFixed(2)}`;

            // Recalcula totales con la fila ya actualizada
            actualizarTotales();
            } else {
            // Inserta la fila nueva
            const response = await fetch('/cotizador/render-item-carrito', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ producto })
            });
            const html = await response.text();
            document.querySelector('.list-group').insertAdjacentHTML('beforeend', html);

            // **Aquí** recalculamos totales ya con la fila nueva en el DOM
            actualizarTotales();
            }
        }
    }

    function eliminarDelCarrito(idProducto) {
        const index = carrito.findIndex(p => p.id == idProducto);

        if (index !== -1) {
            carrito.splice(index, 1); // ❌ eliminar del array

            const productoElemento = document.querySelector(`.list-group-item[data-id="${idProducto}"]`);
            if (productoElemento) {
                productoElemento.remove(); // ❌ eliminar del DOM
            }

            actualizarTotales();
            showToast('Producto eliminado del carrito', 'error');
        }
    }

    // Inicialización de los carouseles corporales y faciales
    $(document).ready(function() {

        function throttle(fn, delay) {
            let lastCall = 0;
            return function(...args) {
                const now = Date.now();
                if (now - lastCall < delay) return;
                lastCall = now;
                return fn.apply(this, args);
            };
        }

        // Envuelves tu función de agregar
        const manejarAgregar = throttle(function(target) {
            const id = target.dataset.id;
            const nombre = target.dataset.nombre;
            const precio = parseFloat(target.dataset.precio);
            const imagen = target.dataset.img;
            const subcategoria = target.dataset.subcategoria;

            // Buscar si ya existe en el carrito
            const existente = carrito.find(p => p.id == id);
            if (existente) {
                existente.cantidad++;
                showToast('Cantidad actualizada');
                renderizarCarrito(); // <-- ¡Asegúrate de actualizar la vista!
            } else {
                carrito.push({ id, nombre, precio, imagen,subcategoria, cantidad: 1 });
                showToast('Producto agregado al carrito');
                renderizarCarrito(); // <-- ¡Renderiza el nuevo producto!
            }
        }, 500);

        // Y tu listener queda así:
        document.addEventListener('click', function(e) {
            const target = e.target.closest('.agregar-carrito');
            if (!target) return;
            manejarAgregar(target);
        });

        function agregarAlCarrito(producto) {
            const existente = carrito.find(p => p.id === producto.id);

            if (existente) {
                existente.cantidad++;
                renderizarCarrito();
            } else {
                producto.cantidad = 1;
                carrito.push(producto);

                // Solo renderizar 1 nuevo producto y agregarlo al contenedor
                fetch('/cotizador/render-item-carrito', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ producto })
                })
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.list-group').insertAdjacentHTML('beforeend', html);
                    actualizarTotales();
                });
            }
        }

    });

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
                        const descuentoGlobalInput = document.getElementById('descuento-total');
                        descuentoGlobalInput.value = pct;

                        // 3) Recalcula totales con ese % global
                        actualizarTotales();

                        $('#membership-message')
                        .removeClass('d-none alert-secondary')
                        .addClass('alert-success')
                        .text(`🎉 Tiene membresía Estatus: ${data.membresia}. Descuento aplicado: ${pct}%`);
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

    //CALCULOS PARA EL ENVIO
    document.getElementById('chkEnvio')
    .addEventListener('change', () => {
        recalcEnvio();
        // Y luego el total final, que incluye envío
        actualizarTotales();
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

        if (!membershipActive) {
            costoEnvio = 180;
        } else if (membershipType === 'Cosmos') {
            costoEnvio = totalSinEnvio < 1500 ? 126 : 90;
        } else if (membershipType === 'Estelar') {
            costoEnvio = totalSinEnvio < 2500 ? 90 : 0;
        }

        envioDisplay.textContent = `$${costoEnvio.toFixed(2)}`;
        window.cachedEnvioCost = costoEnvio;
    }

    //CALCULOS PARA FACTURA
    window.cachedEnvioCost = window.cachedEnvioCost || 0;
    window.cachedIVA = 0;

    document.getElementById('chkFacturacion')
        .addEventListener('change', () => {
            recalcIVA();
            actualizarTotales();
        });

        function recalcIVA() {
        const chk = document.getElementById('chkFacturacion').checked;
        const ivaDisplay = document.getElementById('iva-display');

        if (!chk) {
            window.cachedIVA = 0;
            ivaDisplay.textContent = '$0.00';
            return;
        }

        // Total antes de IVA = subtotal con descuento global + envío
        // Para evitar recursión, calcula directamente:
        let subtotal = carrito.reduce((acc, p) => {
            const totItem = p.precio * p.cantidad * (1 - (p.descuentoPct||0)/100);
            return acc + totItem;
        }, 0);
        const descGlobalPct = parseFloat(
            document.getElementById('descuento-total').value
        ) || 0;
        const totalSinEnvio = subtotal * (1 - descGlobalPct/100);
        const envio = window.cachedEnvioCost || 0;
        const base = totalSinEnvio + envio;

        // IVA 16%
        const iva = base * 0.16;
        window.cachedIVA = iva;
        ivaDisplay.textContent = `$${iva.toFixed(2)}`;
    }

    document.getElementById('formGuardarPedido').addEventListener('submit', function(e){
        e.preventDefault();
        const form = this;
        const data = new FormData(form);

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
                confirmButtonText: 'Descargar PDF',
                cancelButtonText: 'Seguir cotizando'
            }).then(result => {
                if (result.isConfirmed) {
                    window.open(`/cosmica/cotizacion/imprimir/${json.order_id}`, '_blank');
                    location.reload();
                } else {
                    location.reload();
                }
            });
            }
        })
        .catch(err => {
            Swal.fire('Error', 'No se pudo guardar el pedido.', 'error');
        });
    });

    $(document).on('click', '.btn-agregar-carrito', function() {
        const btn = $(this);
        btn.prop('disabled', true); // Deshabilita el botón

        const id = btn.data('id');
        const nombre = btn.data('nombre');
        const subcategoria = btn.data('subcategoria');
        const precio = parseFloat(btn.data('precio'));
        const imagen = btn.data('img');

        // Busca el producto en el carrito
        const existente = carrito.find(p => p.id == id);
        if (existente) {
            existente.cantidad++;
            showToast('Cantidad actualizada');
        } else {
            carrito.push({ id, nombre, precio,subcategoria, imagen, cantidad: 1 });
            showToast('Producto agregado al carrito');
        }
        renderizarCarrito();

        setTimeout(() => btn.prop('disabled', false), 300); // Habilita después de 300ms
    });

    function agregarAlCarrito(id, nombre, precio,subcategoria, imagen) {
        // Busca el producto en el array actualizado
        let existente = carrito.find(p => p.id == id);
        if (existente) {
            existente.cantidad++;
            showToast('Cantidad actualizada');
        } else {
            carrito.push({ id, nombre, precio, imagen,subcategoria, cantidad: 1 });
            showToast('Producto agregado al carrito');
        }
        renderizarCarrito();
    }

</script>

@endsection
