@extends('layouts.app_ecommerce')
@section('template_title') {{$categoria->nombre}} @endsection

@section('css_custom')
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/categories.css') }}">
@endsection

@section('ecomeerce')
@php
    if ($categoria->frase == NULL) {
        $nombre = 'Todo lo que necesitas para una vida saludable.';
    }else{
        $nombre = $categoria->frase;
    }
    $partes = explode(' ', $nombre, 3);
    $primeraPalabra = $partes[0];
    $segundaPalabra = $partes[1];
    $restoDelTexto = $partes[2] ?? '';
@endphp

<section class="category-banner d-flex align-items-center mt-6"
         style="background-image: url('{{ asset($categoria->portada ? '/categorias/' . $categoria->portada : '/ecommerce/categoria1.jpg') }}')">

    <div class="overlay"></div>
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">{{$categoria->nombre}}</h1>
        <p class="text-white fs-5">{{$primeraPalabra}} {{$segundaPalabra}} <strong>{{$restoDelTexto}}</strong></p>
    </div>
</section>

<div class="container">
    <div class="row container_categories_grid">
        <!-- Filtro en escritorio -->
        <div class="col-12 col-sm-3 d-none d-md-block mt-4">
            <h3 class="mb-4 d-none d-md-block">-</h3>
            <div class="container_filtro">
                <h3 class="subtitle_filtro" style="font-family: 'Roboto_Regular';">Corporal</h3>
                <!-- Opciones de categoría -->
                <div class="form-check mt-3">
                    @foreach ($categorias as $cat)
                        @if (trim($cat->linea) === "corporal")
                            <label class="form-check-label" for="categoria{{ $cat->id }}">{{ $cat->nombre }}</label>
                            <input class="form-check-input categoria-radio" type="radio" name="categoria" value="{{ $cat->id }}" id="categoria{{ $cat->id }}" {{ $cat->id == $categoria->id ? 'checked' : '' }}>
                        @endif
                    @endforeach
                </div>

                <h3 class="subtitle_filtro mt-3" style="font-family: 'Roboto_Regular';">Facial</h3>
                <div class="form-check mt-3">
                    @foreach ($categorias as $cat)
                        @if (trim($cat->linea) === "facial")
                            <label class="form-check-label" for="categoria{{ $cat->id }}">{{ $cat->nombre }}</label>
                            <input class="form-check-input categoria-radio" type="radio" name="categoria" value="{{ $cat->id }}" id="categoria{{ $cat->id }}" {{ $cat->id == $categoria->id ? 'checked' : '' }}>
                        @endif
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

                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-12 col-sm-9 col-lg-9 mt-4">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">-</h3>
                </div>

                <div id="listaProductos" class="d-flex flex-wrap">
                    @foreach ($productos as $producto)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <div class="container_grid row mx-auto">
                                @if($producto->precio_rebajado == NULL)
                                @else
                                    @if(strtotime($producto->fecha_fin) >= strtotime(date('Y-m-d')))
                                    <div class="etiqueta_grid_product">
                                        <p class="text-center texto_etiqueta_grid">Promo</p>
                                    </div>
                                    @endif
                                @endif
                                <div class="col-12 my-auto">
                                    @if ($producto->imagenes == NULL)
                                    <a href="{{ route('tienda_online.single', $producto->slug) }}">
                                        <div class="mx-auto img_grid" style="background: url('{{ asset('ecommerce/Isotipo_negro.png') }}') #ffffff00  50% / contain no-repeat;"></div>
                                    </a>
                                    @else
                                        <a href="{{ route('tienda_online.single', $producto->slug) }}">
                                            <div class="mx-auto img_grid" style="background: url(&quot;{{$producto->imagenes}}&quot;) #ffffff00 50% / contain no-repeat;"></div>
                                        </a>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <h5 class="text-left m-1 brand_text_grid">NAS</h5>
                                    <h4 class="text-left m-1 title_product">{{$producto->nombre}}</h4>
                                    <p class="text-left m-1 category_text_grid">By  {{ $producto->Categoria->nombre ?? 'Sin categoría' }}</p>
                                    @if($producto->precio_rebajado == NULL)
                                        @if(date('N') == 1 && $producto->id_categoria == 26)
                                            <h6 class="price_text_grid_desc">
                                                <strong class="precio_reaja">de <s>${{number_format($producto->precio_original, 2, '.', ',');}}</s></strong>
                                                a ${{number_format($producto->precio_original, 2, '.', ',');}}
                                            </h6>
                                        @else
                                            <h6 class="price_text_grid">${{ number_format($producto->precio_normal, 2) }}</h6>
                                        @endif
                                    @else
                                        @if(strtotime($producto->fecha_fin) >= strtotime(date('Y-m-d')))
                                            <h6 class="price_text_grid_desc">
                                                <strong class="precio_reaja">de <s>${{number_format($producto->precio_original, 2, '.', ',');}}</s></strong>
                                                a ${{number_format($producto->precio_rebajado, 2, '.', ',');}}
                                            </h6>
                                        @else
                                            <h6 class="price_text_grid">${{ number_format($producto->precio_normal, 2) }}</h6>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-6 p-0">
                                    <p class="text-center">
                                        <a class="btn btn-xs btn_comprar tex-white mb-1 agregar-carrito"
                                        href="javascript:void(0);"
                                        data-id="{{ $producto->id }}">
                                         Comprar <i class="bi bi-cart-plus icon_comprar"></i>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-6 p-0">
                                    <p class="text-center">
                                        <a class="btn btn-xs btn_ver_mas tex-white " href="{{ route('tienda_online.single', $producto->slug) }}">Ver más <i class="bi bi-basket3 icon_vermas"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_custom')
<script>
$(document).ready(function () {
    let page = 1;

    // Mostrar subcategorías cuando se seleccione una categoría
    $('.categoria-radio').on('change', function () {
        page = 1; // Reiniciar la página al cambiar la categoría
        let categoriaSeleccionada = $('input[name="categoria"]:checked').val();
        // Filtrar productos
        filtrarProductos();
    });

    // Función para filtrar los productos según la categoría y subcategoría seleccionadas
    function filtrarProductos() {
        let categoriaSeleccionada = $('input[name="categoria"]:checked').val();

        $.ajax({
            url: '{{ route("productos.filtrar") }}',
            type: 'GET',
            data: {
                categoria: categoriaSeleccionada,
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

    // Inicializar eventos al cargar la página
    inicializarEventos();

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
                url: "{{ route('carrito.agregarNas') }}",
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

    // Preseleccionar la categoría actual y mostrar sus subcategorías
    let categoriaActual = '{{ $categoria->id }}';
    $('#categoria' + categoriaActual).prop('checked', true).trigger('change');
    $('#categoriaMovil' + categoriaActual).prop('checked', true).trigger('change');
});
</script>
@endsection
