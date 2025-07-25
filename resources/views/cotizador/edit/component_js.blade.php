<script>
    document.addEventListener('DOMContentLoaded', () => {
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

    let timeout = null;
    let carrito = [];
    let membershipType = null;     // ‘Estelar’, ‘Cosmos’ o null
    let membershipActive = false;  // true si tiene membresía activa
    const tipo = document.getElementById('cotizadorApp').dataset.tipo;

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
    fetch(`/cotizador/buscar?query=${encodeURIComponent(valor)}&tipo=${tipo}`)
        .then(r => r.text())
        .then(html => {
        document.getElementById('contenedor_productos').innerHTML = html;
        document.getElementById('inputBuscarProductos').value = '';
        });
    }

    // Cargar productos por categoría (usado al hacer clic en una categoría)
    function cargarProductosPorCategoria(idCategoria) {
        fetch(`/cotizador/${tipo}/categoria/${encodeURIComponent(idCategoria)}`)
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
    fetch(`/cotizador/${tipo}/kits`)
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

        let iva = 0;
        if (tipo !== 'nas') {
            // Sólo para Cosmica (u otros) usamos el checkbox
            const chk = document.getElementById('chkFacturacion');
            const aplicaIva = chk ? chk.checked : false;
            iva = aplicaIva ? baseParaIVA * 0.16 : 0;
        }
        window.cachedIVA = iva;
        document.getElementById('iva-display').textContent      = `$${iva.toFixed(2)}`;
        document.getElementById('iva-final-input').value        = iva.toFixed(2);

        // 7) Total final = baseParaIVA + iva
        const totalFinal = baseParaIVA + iva;
        document.getElementById('total-display').textContent    = `$${totalFinal.toFixed(2)}`;
        document.getElementById('total-final-input').value      = totalFinal.toFixed(2);
    }

    async function renderizarCarrito() {
        for (const producto of carrito) {
            const total = producto.precio * producto.cantidad * (1 - (producto.descuentoPct || 0) / 100);
            const productoExistente = document.querySelector(`.list-group-item[data-id="${producto.id}"]`);

            if (productoExistente) {
                // Actualiza cantidad y total existentes
                productoExistente.querySelector('.cantidad').textContent = producto.cantidad;
                productoExistente.querySelector('.cantidad-input').value = producto.cantidad;
                productoExistente.querySelector('.descuento-input').value = producto.descuentoPct;
                productoExistente.querySelector('.total').textContent    = `$${total.toFixed(2)}`;
                productoExistente.querySelector('.descuento-input-hidden').value = producto.descuentoPct;
                console.log(producto);
                // Recalcula totales con la fila ya actualizada
                recalcEnvio();
                recalcIVA();
                actualizarTotales();
            } else {
                // Inserta la fila nueva
                const response = await fetch('/admin/cotizador/edit/render-item-carrito', {
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

            const existente = carrito.find(p => p.id == id);
            if (existente) {
                existente.cantidad++;
                showToast('Cantidad actualizada');
            } else {
                carrito.push({ id, nombre, precio, imagen, cantidad: 1, descuentoPct: 0 });
                showToast('Producto agregado al carrito');
            }

            renderizarCarrito();
        }, 500); // medio segundo

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

    //CALCULOS PARA EL ENVIO
    document.getElementById('chkEnvio')
    .addEventListener('change', () => {
        recalcEnvio();
        // Y luego el total final, que incluye envío
        actualizarTotales();
    });

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

        const subtotal = parseFloat(
            document.getElementById('subtotal-final-input').value
        ) || 0;

        const envio = parseFloat(
            document.getElementById('envio-final-input').value
        ) || 0;

        const base = subtotal + envio;

        const iva = base * 0.16;
        window.cachedIVA = iva;

        ivaDisplay.textContent = `$${iva.toFixed(2)}`;
        document.getElementById('iva-final-input').value = iva.toFixed(2);
    }

    // 1.1. Inicializa carrito leyendo cada <li> existente
    document.querySelectorAll('#contenedor_carrito li[data-id]').forEach(li => {
        const id = parseInt(li.dataset.id, 10);
        const precio = parseFloat(li.querySelector('.precio-unitario').dataset.precio);
        const cantidad = parseInt(li.querySelector('.cantidad').textContent, 10);
        const descuentoPct = parseFloat(
        li.querySelector('.descuento-input-hidden').value
        ) || 0;

        console.log(descuentoPct);
        const nombre = li.querySelector('.fw-semibold').textContent.trim();
        const imagen = li.querySelector('img').src;

        carrito.push({ id, nombre, precio, imagen, cantidad, descuentoPct });
    });
</script>
