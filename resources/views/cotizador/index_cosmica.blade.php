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
                                            <img src="{{ asset('cosmika\lineas\lineas/'.$categoria->nombre.'.png') }}" alt="Producto">
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
                                            <img src="{{ asset('cosmika\INICIO\lineas/'.$categoria->nombre.'.png') }}" alt="Producto">
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

        <!-- Orden -->
        <div class="col-lg-4 mt-3">
            <div class="sidebar">
                <h5 class="mb-4 mt-1 text-center">Cotiza tu pedido</h5>

                <!-- Lista de productos -->
                <ul class="list-group mb-3" id="contenedor_carrito" style="max-height: 600px; overflow-y: auto;">
                    <!-- Aquí se insertan los productos dinámicamente -->
                </ul>

                <!-- Totales -->
                <div class="mb-2 d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <span id="subtotal">$0.00</span>
                </div>

                <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                    <span>TOTAL:</span>
                    <span id="total">$0.00</span>
                </div>

                <!-- Botón -->
                <button class="btn btn-xs btn-success w-100"><i class="bi bi-cart3"></i> Realizar pedido </button>
            </div>
        </div>

    </div>
</div>

@endsection


@section('js_custom')

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

    function actualizarTotales() {
            let subtotal = 0;

            carrito.forEach(producto => {
                subtotal += producto.precio * producto.cantidad;
            });

            const total = subtotal; // puedes restar descuento si lo usas

            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
    }

    function renderizarCarrito() {
        carrito.forEach(async producto => {
            const total = producto.precio * producto.cantidad;

            // Verificar si el producto ya está en el DOM
            const productoExistente = document.querySelector(`.list-group-item[data-id="${producto.id}"]`);

            if (productoExistente) {
                // Si ya existe, solo actualizamos la cantidad y el total
                productoExistente.querySelector('.cantidad').textContent = producto.cantidad;
                productoExistente.querySelector('.total').textContent = `$${total.toFixed(2)}`;
            } else {
                // Si no existe, lo agregamos al carrito
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
            }
        });

        // Actualizar los totales después de procesar todos los productos
        actualizarTotales();
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
        const owlSettings = {
            loop: true,
            margin: 15,
            autoplay: false,
            dots:false,
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            nav: true,
            responsive: {
                0: { items: 3 },
                420: { items: 3 },
                576: { items: 4 },
                676: { items: 5 },
                768: { items: 5 },
                950: { items: 6 },
                1200: { items: 6 }
            }
        };

        $("#loop_categorias_corp").owlCarousel(owlSettings);
        $("#loop_categorias_facial").owlCarousel(owlSettings);

        function actualizarHora() {
            const ahora = new Date();
            let horas = ahora.getHours();
            const minutos = ahora.getMinutes().toString().padStart(2, '0');
            const segundos = ahora.getSeconds().toString().padStart(2, '0');
            const ampm = horas >= 12 ? 'PM' : 'AM';

            horas = horas % 12;
            horas = horas ? horas : 12; // hora 0 debe ser 12

            const horaFormateada = `${horas}:${minutos}:${segundos} ${ampm}`;
            document.getElementById('hora-actual').textContent = horaFormateada;
        }

        // Actualizar al cargar y luego cada segundo
        actualizarHora();
        setInterval(actualizarHora, 1000);

        document.addEventListener('click', function(e) {
            const target = e.target.closest('.agregar-carrito');
            if (target) {
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
            }
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

</script>

@endsection
