@extends('layouts.app_ecommerce')

@section('template_title') Single @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/css/filter.css') }}">
<style>

/* Estilo para el offcanvas (filtro móvil) */
.offcanvas {
    background: rgb(255 255 255 / 80%);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(10px);
    max-width: 70%!important;
}

.offcanvas-backdrop {
    background-color: transparent!important;
}

</style>
@endsection

@section('ecomeerce')

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3 mt-10">

    <div class="row container_categories_grid mt-5">
        <!-- Filtro en escritorio -->
        <div class="col-12 col-sm-3 d-none d-md-block mt-4">
            <h3 class="mb-4 d-none d-md-block">-</h3>
            <div class="container_filtro">
                <h2 class="title_filtro mb-3" style="font-family: 'Roboto_Regular';">Filtro</h2>
                <h3 class="subtitle_filtro" style="font-family: 'Roboto_Regular';">Pasillos</h3>
                <!-- Opciones de categoría -->
                <div class="form-check mt-3">
                    @foreach ($categorias as $categoria)

                    @if (trim($categoria->nombre) === "Lacteos" || trim($categoria->nombre) === "Verduras" || trim($categoria->nombre) === "Sin categoria")
                        @continue
                    @endif
                        <input class="form-check-input categoria-radio" type="radio" name="categoria" value="{{ $categoria->id }}" id="categoria{{ $categoria->id }}">
                        <label class="form-check-label" for="categoria{{ $categoria->id }}">{{ $categoria->nombre }}</label>
                        <br>

                        <div id="subcategorias{{ $categoria->id }}" class="subcategorias" style="display: none;">
                            @foreach ($categoria->subcategorias as $subcategoria)
                                <input class="form-check-input subcategoria-checkbox" type="checkbox" name="subcategoria[]" value="{{ $subcategoria->id }}" id="subcategoria{{ $subcategoria->id }}">
                                <label class="form-check-label" for="subcategoria{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</label>
                                <br>
                            @endforeach
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botón de filtro móvil -->
        <div class="col-12 d-block d-md-none">
            <div class="row">
                <div class="col-10">
                    <h3 class="" data-bs-toggle="offcanvas" data-bs-target="#filtroSidebar">Buscar Productos</h3>
                </div>
                <div class="col-2">
                    <a class="btn btn_filter" data-bs-toggle="offcanvas" data-bs-target="#filtroSidebar">
                        <i class="bi bi-funnel"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar para filtro móvil -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="filtroSidebar" aria-labelledby="filtroSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="filtroSidebarLabel" style="font-family: 'Roboto_Regular';">Filtro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
            </div>
            <div class="offcanvas-body">
                <h3 class="subtitle_filtro" style="font-family: 'Roboto_Regular';">Pasillos</h3>
                <div class="form-check mt-3">
                    @foreach ($categorias as $categoria)

                        @if (trim($categoria->nombre) === "Lacteos" || trim($categoria->nombre) === "Verduras" || trim($categoria->nombre) === "Sin categoria")
                            @continue
                        @endif

                        <input class="form-check-input categoria-radio" type="radio" name="categoria" value="{{ $categoria->id }}" id="categoriaMovil{{ $categoria->id }}">
                        <label class="form-check-label" for="categoriaMovil{{ $categoria->id }}">{{ $categoria->nombre }}</label>
                        <br>

                        <div id="subcategoriasMovil{{ $categoria->id }}" class="subcategorias" style="display: none;">
                            @foreach ($categoria->subcategorias as $subcategoria)
                                <input class="form-check-input subcategoria-checkbox" type="checkbox" name="subcategoria[]" value="{{ $subcategoria->id }}" id="subcategoriaMovil{{ $subcategoria->id }}">
                                <label class="form-check-label" for="subcategoriaMovil{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</label>
                                <br>
                            @endforeach
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-12 col-sm-9 col-lg-9 mt-4">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">-</h3>
                </div>

                {{-- <div id="listaProductos" class="d-flex flex-wrap">
                    @include('shop.filter_show', ['productos' => $productos ?? collect()])
                </div> --}}

                <div id="listaProductos" class="d-flex flex-wrap">
                    @include('shop.filter_show', ['productos' => $productos])
                </div>

                <!-- Más productos... -->
            </div>
        </div>

        <div class="col-12">

            <p class="text-center">
                <a class="btn btn_filter" data-bs-toggle="offcanvas" data-bs-target="#filtroSidebar">
                    Filtrar
                </a>
                <a id="cargarMasProductos" class="btn btn_filter" style="background: #000!important;color:#fff!important;">Cargar más productos</a>

            </p>


        </div>

    </div>
</div>



@endsection

@section('js_custom')

<script>
$(document).ready(function () {
    let page = 1;

    $('#cargarMasProductos').on('click', function() {
        page++;
        cargarMasProductos(page);
    });

    function cargarMasProductos(page) {
        let query = $('#searchInput').val();
        let categoriaSeleccionada = $('input[name="categoria"]:checked').val();
        let subcategoriasSeleccionadas = $('.subcategoria-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: '{{ route("productos.filtrar") }}',
            type: 'GET',
            data: {
                query: query,
                page: page,
                categoria: categoriaSeleccionada,
                subcategoria: subcategoriasSeleccionadas
            },
            success: function(data) {
                $('#listaProductos').append(data);
                inicializarEventos();
            },
            error: function(xhr, status, error) {
                console.error("Error en AJAX:", error);
                console.error("Detalle:", xhr.responseText);
            }
        });
    }

    // Función para inicializar eventos
    function inicializarEventos() {
        // Evento de compra para los productos filtrados
        $(".agregar-carrito").click(function() {
            var productId = $(this).data("id");
            var cantidadInput = $("#cantidad_" + productId);
            var cantidad = cantidadInput.val() || 1;

            // 🎯 Obtener el botón de compra y su contenedor
            var boton = $(this);
            var spinner = $('<div class="spinner-border spinner-border-sm text-light ms-2" role="status"><span class="visually-hidden">Cargando...</span></div>');

            // 🚀 Ocultar el botón de "Comprar" y mostrar el spinner
            boton.html(spinner);
            boton.prop("disabled", true);

            $.ajax({
                url: "{{ route('carrito.agregar') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    cantidad: cantidad
                },
                success: function(response) {
                    let audio = new Audio("{{ asset('assets/media/audio/save_global_s.mp3') }}");
                    audio.play();

                    mostrarToast("✅ Producto agregado al carrito", "success");

                    // ✅ Actualizar el contador del carrito en tiempo real
                    actualizarContadorCarrito(response.total_productos);
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        mostrarToast(xhr.responseJSON.error, "error");
                    } else {
                        mostrarToast("❌ Hubo un problema al agregar el producto", "error");
                    }
                },
                complete: function() {
                    // 🔄 Restaurar el botón original después de la petición
                    boton.html('Comprar <i class="bi bi-cart-plus icon_comprar"></i>');
                    boton.prop("disabled", false);
                }
            });
        });

        // ✅ Función para actualizar el contador del carrito en tiempo real
        function actualizarContadorCarrito(total) {
            let contador = $("#contador-carrito");

            contador.text(total); // Cambia el número en la burbuja del carrito

            if (total > 0) {
                contador.show(); // Muestra la bolita roja si hay productos
            } else {
                contador.hide(); // Oculta si está vacío
            }
        }

        function mostrarToast(mensaje, tipo) {
            let audioSrc = tipo === "success"
                ? "{{ asset('assets/media/audio/save_global_S.mp3') }}"
                : "{{ asset('assets/media/audio/stock_insuficiente_S.mp3') }}";

            let audio = new Audio(audioSrc);
            audio.play();

            Swal.fire({
                toast: true,
                position: "top-end",
                icon: tipo,
                title: mensaje,
                showConfirmButton: false,
                timer: 2000
            });
        }
    }

    // Inicializar eventos al cargar la página
    inicializarEventos();

    // Mostrar subcategorías cuando se seleccione una categoría
    $('.categoria-radio').on('change', function () {
        page = 1; // Reiniciar la página al cambiar la categoría
        let categoriaSeleccionada = $('input[name="categoria"]:checked').val();

        // Ocultar todas las subcategorías y desmarcar los checkboxes en ambas versiones (escritorio y móvil)
        $('.subcategorias').hide();
        $('.subcategoria-checkbox').prop('checked', false);

        // Mostrar las subcategorías correspondientes a la categoría seleccionada en ambas versiones
        $('#subcategorias' + categoriaSeleccionada).show(); // Escritorio
        $('#subcategoriasMovil' + categoriaSeleccionada).show(); // Móvil

        // Filtrar productos
        filtrarProductos();
    });

    // Filtrar productos cuando se cambien las subcategorías seleccionadas
    $('.subcategoria-checkbox').on('change', function () {
        filtrarProductos();
    });

    // Función para filtrar los productos según la categoría y subcategoría seleccionadas
    function filtrarProductos() {
        let categoriaSeleccionada = $('input[name="categoria"]:checked').val();
        let subcategoriasSeleccionadas = $('.subcategoria-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: '{{ route("productos.filtrar") }}',
            type: 'GET',
            data: {
                categoria: categoriaSeleccionada,
                subcategoria: subcategoriasSeleccionadas
            },
            success: function (data) {
                $('#listaProductos').html(data);
                // Re-inicializar eventos después de actualizar el contenido
                inicializarEventos();
            },
            error: function (xhr, status, error) {
                console.error("Error en AJAX:", error);
                console.error("Detalle:", xhr.responseText);
            }
        });
    }
});

</script>


@endsection
