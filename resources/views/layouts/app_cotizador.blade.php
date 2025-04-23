<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Cotizador - @yield('template_title')
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="google-site-verification" content="xjOUgezOv03ht4XdfShswB0Hh-49H_WsaM6Cx9GIR6A" />
    <!-- Bootstrap -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('ecommerce/logo_nas.png') }}">

     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/twitter-bootstrap.css') }}">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- css custom -->

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/sweetalert2.css') }}">

    <!-- Select2  -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/select2.css') }}">

    <!-- ligthbox  -->
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/lightbox.min.css') }}">

    <link href="{{ asset('assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">


    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    @yield('css_custom')
    <style>
        body {
            background: #f8f9fa;
        }

        .product-navbar {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            text-align: left;
        }

        .product-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 5px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            max-height: 80px;
            object-fit: contain;
        }

        .product_category {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 10px;
            text-align: left;
        }

        .product_category img {
            width: 100%;
            max-height: 80px;
            object-fit: contain;
            border-radius: 6px;
        }

        .sidebar {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .badge-category {
            font-size: 12px;
            color: #888;
        }
        .btn-counter {
            border: 1px solid #ccc;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            line-height: 1;
        }

        .tittle_category{
            font-size: 9px;
            font-weight: bold;
        }

        .text_items{
            font-size: 9px;
            font-weight: normal;
        }


        .btns_flotantes{
            position: absolute;
            top: 25px;
            right: 0;
        }

        .card_tittle_product{
            font-size: 12px;
        }

    </style>

</head>

    <body style="background:#f9f4f4">


        @yield('cotizador')

        <!-- Bootstrap -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/bootstrap_bundle.js') }}"></script>

        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/popper.js') }}"></script>

        <!-- jquery -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/jquery-3.7.0.js') }}"></script>

        <!-- dataTables -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- js custom -->

        <!-- Sweetalert2 -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/sweetalert2.all.min.js') }}"></script>

        <!-- Select2  -->
        <script type="text/javascript" src="{{ asset('assets/ecommerce/js/select2.min.js') }}"></script>

        <!-- jQuery (necesario para Owl Carousel) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            let timeout = null;
            let carrito = [];

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
                fetch(`/cotizador/categoria/${idCategoria}`)
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
                        }

                        renderizarCarrito();
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
                // Buscar el índice del producto en el carrito
                const index = carrito.findIndex(p => p.id == idProducto);

                if (index !== -1) {
                    // Eliminar el producto del array del carrito
                    carrito.splice(index, 1);

                    // Eliminar el elemento del DOM
                    const productoElemento = document.querySelector(`.list-group-item[data-id="${idProducto}"]`);
                    if (productoElemento) {
                        productoElemento.remove();
                    }

                    // Actualizar los totales
                    actualizarTotales();
                }
            }

            // Inicialización de los carouseles corporales y faciales
            $(document).ready(function() {
                const owlSettings = {
                    loop: true,
                    margin: 15,
                    dots: false,
                    autoplay: false,
                    responsive: {
                        0: { items: 5 },
                        576: { items: 5 },
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
                        } else {
                            carrito.push({ id, nombre, precio, imagen, cantidad: 1 });
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


        @yield('js_custom')

</body>

</html>
