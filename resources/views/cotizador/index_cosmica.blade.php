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

                <div class="col-12">
                    <h5 class="p-2">Cliente</h5>

                    <input type="text" id="usuarioInput" class="form-control" placeholder="Escribe nombre o teléfono…"/>
                    <!-- Hidden para guardar el id seleccionado -->
                    <input type="hidden" name="id_usuario" id="idUsuario">

                    <div id="reconocimiento-container" class="mt-2">
                        <!-- Este bloque sólo aparece si NO hay reconocimiento -->
                        <div id="reconocimiento-upload" class="d-none">
                            <label for="reconocimiento">Sube tu diploma:</label>
                            <input type="file" name="reconocimiento" id="reconocimiento" accept="image/*,application/pdf" class="form-control"/>
                        </div>

                        <!-- Este bloque sólo aparece si YA hay reconocimiento -->
                        <div id="reconocimiento-message" class="alert alert-info d-none">
                            📄 Ya tiene un diploma cargado.
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h5 class="p-2">Categorías</h5>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" id="categoriaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="corp-tab" data-bs-toggle="tab" data-bs-target="#corp" type="button" role="tab" aria-controls="corp" aria-selected="true">
                                Corporales
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="facial-tab" data-bs-toggle="tab" data-bs-target="#facial" type="button" role="tab" aria-controls="facial" aria-selected="false">
                                Faciales
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Corporales -->
                        <div class="tab-pane fade show active" id="corp" role="tabpanel" aria-labelledby="corp-tab">
                            <div id="loop_categorias_corp" class="owl-carousel">
                                @foreach ($categoriasCorporal as $categoria)
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria('{{ $categoria->nombre }}')">
                                            <h6 class="mt-3 mb-1 tittle_category">Corporal</h6>
                                            <img src="{{ asset('cosmika\inicio\lineas/'.$categoria->nombre.'.png') }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Faciales -->
                        <div class="tab-pane fade" id="facial" role="tabpanel" aria-labelledby="facial-tab">
                            <div id="loop_categorias_facial" class="owl-carousel">
                                @foreach ($categoriasFacial as $categoria)
                                    <div class="item">
                                        <div class="product_category" onclick="cargarProductosPorCategoria('{{ $categoria->nombre }}')">
                                            <h6 class="mt-3 mb-1 tittle_category">Facial</h6>
                                            <img src="{{ asset('cosmika\inicio\lineas/'.$categoria->nombre.'.png') }}" alt="Producto">
                                            <h6 class="mt-3 mb-1 tittle_category">{{ $categoria->nombre }}</h6>
                                            <div class="fw-bold mt-1">
                                                <p class="text_items" style="margin: 0;">
                                                    {{ $categoria->productos_count }} Artículos
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <form class="d-flex mt-3 mb-3" id="formBuscarProductos">
                        <input id="inputBuscarProductos" class="form-control me-2" type="search" placeholder="Buscar producto..." aria-label="Search">
                    </form>

                </div>

                <!-- Repetir este div para cada producto -->
                    <div class="" id="contenedor_productos">
                        <!-- Aquí se insertan los productos dinámicamente -->
                    </div>
                <!-- ... más productos -->
            </div>

        </div>

        @include('cotizador.pedido_partial')

    </div>
</div>

@endsection


@section('js_custom')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chkEnv = document.getElementById('chkEnvio');
        const envFields = document.getElementById('envioFields');

        chkEnv.addEventListener('change', () => {
            envFields.style.display = chkEnv.checked ? 'block' : 'none';
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
</script>
<script>
    let timeout = null;
    let carrito = [];

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

        const input = e.target;
        const descuentoPct = parseFloat(input.value) || 0;

        // Fila del producto
        const fila = input.closest('.list-group-item');
        const idProducto = parseInt(fila.dataset.id, 10);

        // 1) Actualiza el objeto en carrito
        const prod = carrito.find(p => p.id === idProducto);
        if (prod) prod.descuentoPct = descuentoPct;

        // 2) Recalcula el total de esta fila
        const precioUnitario = parseFloat(
            fila.querySelector('.precio-unitario').dataset.precio
        );
        const cantidad = parseInt(
            fila.querySelector('.cantidad').textContent, 10
        );
        const totalSinDesc = precioUnitario * cantidad;
        const totalConDesc = totalSinDesc * (1 - descuentoPct / 100);
        fila.querySelector('.total').textContent = `$${totalConDesc.toFixed(2)}`;

        // 3) Y actualiza el total global
        actualizarTotales();
    });

    document.getElementById('descuento-total').addEventListener('input', actualizarTotales);
    function actualizarTotales() {
        // 1) Suma todos los <span class="total"> del carrito
        let subtotal = 0;
        document.querySelectorAll('.list-group-item .total').forEach(span => {
            // quitamos cualquier carácter no numérico (como '$' o comas)
            const val = parseFloat(
            span.textContent.replace(/[^0-9.-]+/g, '')
            ) || 0;
            subtotal += val;
        });

        // 2) Actualiza el SUBTOTAL (antes de descuento global)
        document.getElementById('subtotal-display')
            .textContent = `$${subtotal.toFixed(2)}`;

        // 3) Lee el descuento global (%) y calcula el TOTAL final
        const descGlobalPct = parseFloat(
            document.getElementById('descuento-total').value
        ) || 0;
        const totalFinal = subtotal * (1 - descGlobalPct / 100);

        // 4) Actualiza el TOTAL (con descuento global)
        document.getElementById('total-display')
            .textContent = `$${totalFinal.toFixed(2)}`;
    }

    async function renderizarCarrito() {
    for (const producto of carrito) {
        const total = producto.precio * producto.cantidad;
        const productoExistente = document.querySelector(`.list-group-item[data-id="${producto.id}"]`);

        if (productoExistente) {
        // Actualiza cantidad y total existentes
        productoExistente.querySelector('.cantidad').textContent = producto.cantidad;
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

            const existente = carrito.find(p => p.id == id);
            if (existente) {
                existente.cantidad++;
                showToast('Cantidad actualizada');
            } else {
                carrito.push({ id, nombre, precio, imagen, cantidad: 1 });
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

    // BUSCADOR CLIENTE
    $(function(){
        $('#usuarioInput').autocomplete({
            source: function(request, response) {
                $.getJSON("{{ route('usuarios.search') }}", { q: request.term }, response);
            },
            minLength: 2,
            select: function(event, ui) {
                $('#idUsuario').val(ui.item.id);

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
            },
            change: function(e, ui) {
                if (!ui.item) {
                    $('#idUsuario').val('');
                    // Al limpiar, oculto ambos
                    $('#reconocimiento-upload, #reconocimiento-message').addClass('d-none');
                }
            }
        });
    });

</script>

@endsection
