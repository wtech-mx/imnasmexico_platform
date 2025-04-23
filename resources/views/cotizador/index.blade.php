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
            padding: 10px;
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
    </style>

</head>

    <body style="background:#f9f4f4">

        <div class="container">
            <div class="row">

                <!-- Productos -->
                <div class="col-lg-8">

                    <div class="row ">

                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-start mt-3 mb-1 product-navbar my-auto">
                                <p class="p-2 my-auto"><i class="bi bi-calendar3 p-2"></i>Miercoles 30 Abril 2024</p>
                                <p class="p-2 my-auto"><i class="bi bi-clock p-2"></i> 07:35 AM</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="p-2">Categorias</h5>
                            <div class="row">
                                <div class="col-2">
                                    <div class="product_category" >
                                        <img src="https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU" alt="Producto">
                                        <h6 class="mt-3 mb-1 tittle_category">Linea de Apoyo en Casa</h6>
                                        <div class="fw-bold mt-1">
                                            <p class="text_items" style="margin: 0;">
                                                100 Articulos
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <form class="d-flex mt-3 mb-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                              </form>
                        </div>

                        <!-- Repetir este div para cada producto -->
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-card">
                                <img src="https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU" alt="Producto">
                                <h6 class="mt-2 mb-1">Beef Crough</h6>
                                <div class="fw-bold mt-1">$5.50</div>
                            </div>
                        </div>
                        <!-- ... más productos -->
                    </div>

                </div>

                <!-- Orden -->
                <div class="col-lg-4 mt-3">
                    <div class="sidebar">
                        <h5 class="mb-4 mt-1 text-center">Eloise's Order</h5>

                        <!-- Lista de productos -->
                        <ul class="list-group mb-3" >
                            <li class="list-group-item" style="padding: 0!important;border: 0!important;">
                                <div class="d-flex">
                                    <!-- Imagen del producto -->
                                    <div class="me-3">
                                        <img src="https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU" alt="Beef Crough" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>

                                    <!-- Detalles y controles -->
                                    <div class="flex-grow-1 d-flex flex-column justify-content-between" style="position: relative">
                                        <div>
                                            <div class="fw-semibold">Beef Crough</div>
                                            <small class="text-muted">$5.50</small>
                                        </div>

                                        <div class="d-flex justify-content-end align-items-center mt-2 btns_flotantes">
                                            <button class="btn btn-counter btn-sm">-</button>
                                            <span class="mx-2">1</span>
                                            <button class="btn btn-counter btn-sm">+</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </li>
                            <!-- ... más productos -->
                        </ul>


                        <!-- Totales -->
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span>$20.00</span>
                        </div>

                        <div class="mb-2 d-flex justify-content-between">
                            <span>Discount:</span>
                            <span class="text-danger">-$1.00</span>
                        </div>

                        <div class="mb-3 d-flex justify-content-between fw-bold border-top pt-2">
                            <span>TOTAL:</span>
                            <span>$21.00</span>
                        </div>


                        <!-- Botón -->
                        <button class="btn btn-primary w-100">Place Order</button>
                    </div>
                </div>

            </div>
        </div>

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
            $(document).ready(function() {

                $("#loop_ofertasPromos").owlCarousel({
                    loop: true,
                    margin: 15,
                    autoplay: false,
                    autoplayTimeout: 9000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        576: {
                            items: 2
                        },
                        676: {
                            items: 3
                        },
                        768: {
                            items: 3 // 📌 Ajuste en pantallas de 768px
                        },
                        950: {  // 📌 Nuevo breakpoint para pantallas de 900px
                            items: 4
                        },
                        1200: {
                            items: 4
                        }
                    }
                });

            });

        </script>

        @yield('js_custom')
        @yield('js_clientes')
        @yield('js_custom_pdf')
        @yield('js_caja_pass')
        @yield('js_scanner')
        @yield('js_custom_productos')
        @yield('js_custom2_clientes')
        @yield('js_custom2_empleado')
        @yield('js_custom_caja_reg')
        @yield('js_custom_cliente')
        @yield('js_custom_settings')
        @yield('js_custom_licencias')
        @yield('js_alert_key')
        @yield('js_alert_key_aprov')
        @yield('js_update_img_portada')
        @yield('js_proveedor')

</body>

</html>
