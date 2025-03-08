<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}"> --}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">

    <link rel="shortcut icon" href="{{ asset('cosmika/menu/logo.png') }}" type="image/png">

    <script src="https://www.google.com/recaptcha/api.js?render=6LflbR0qAAAAADzEpS4m9oo_7Mftvt7K1OPHjC-D"></script>


    <title>
        @yield('template_title') - {{$configuracion->nombre_sistema}}
    </title>

    <link href="{{asset('assets/user/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/custom.css')}}" rel="stylesheet" />
    {{-- <link href="{{asset('assets/user/custom/header.css')}}" rel="stylesheet" /> --}}
    <link href="{{asset('assets/user/custom/footer.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/modal_login.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/modal_checkout.css')}}" rel="stylesheet" />
    {{-- <link href="{{asset('assets/user/custom/preloader.css')}}" rel="stylesheet" /> --}}
    <link href="{{asset('assets/user/custom/btn_flotante.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/user/custom/ecomeerce_cosmica.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/custom/ecomeerce_fuentes.css')}}" rel="stylesheet" />

    @yield('css_custom')

    <!-- Font Awesome Icons -->
    {{-- <link href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.cs')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @php
        echo $webpage->wb_all_pixel;
        echo $webpage->wb_all_analitics;
    @endphp

  </head>

  <style>

    #searchForm {
        transition: opacity 0.3s ease-in-out;
    }
    @font-face {
            font-family: "Avenir";
            src: url('{{asset('cosmika/tipografia/Avenir.ttc')}}');
        }

        @font-face {
            font-family: "Christmas";
            src: url('{{asset('cosmika/tipografia/Christmas.otf')}}');
        }

        @font-face {
            font-family: "Quinsi";
            src: url('{{asset('cosmika/tipografia/Quinsi.ttf')}}');
        }

        @font-face {
            font-family: "SwilyBright_Italic";
            src: url('{{asset('cosmika/tipografia/SwilyBright_Italic.otf')}}');
        }

        .Avenir{
            font-family: 'Avenir';
        }

        .Christmas{
            font-family:'Christmas';
        }

        .Quinsi{
            font-family:'Quinsi';
        }

        .SwilyBright_Italic{
            font-family:'SwilyBright_Italic';
        }
</style>

  <body class="body">
    {{-- <div id="page-loader"><span class="preloader-interior"></span></div> --}}

    <header class="header">
        @include('tienda_cosmica.Components.header')
    </header>


    <main class="container-fluid secundario" style="margin: 0;padding:0;">
        @yield('content')
        @include('layouts.alertas')
    </main>

    @include('tienda_cosmica.Components.btn_flotante')
    {{-- footer --}}
    @include('tienda_cosmica.Components.footer')

    @include('user.components.modal_preguntas');
    {{-- footer --}}

    @include('user.components.modal_login')

    @include('user.components.modal_checkout')

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    {{-- <script type="text/javascript" src="{{asset('assets/user/custom/preloader.js')}}"></script> --}}

    <script type="text/javascript">

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                 'input[type=text]', 'input[type=file]',
                                 'textarea'].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                  var $input = $(el);
                  if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                  }
                });

                if (!$form.data('cc-on-file')) {
                  e.preventDefault();
                  Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                  Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                  }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
        </script>

    @yield('js')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchIcon = document.getElementById("toggleForm"); // Icono de la lupa
            const searchForm = document.getElementById("searchForm"); // Formulario de búsqueda
            const navbarBrand = document.querySelector(".navbar-brand"); // Logo
            const searchInput = document.getElementById("buscador"); // Input de búsqueda

            // Mostrar/Ocultar el formulario al hacer clic en la lupa
            searchIcon.addEventListener("click", function () {
                searchForm.classList.toggle("d-none");

                // Ocultar el logo en móvil cuando se muestre el buscador
                if (!searchForm.classList.contains("d-none") && window.innerWidth <= 992) {
                    navbarBrand.classList.add("d-none");
                }
            });

            // Ocultar el logo si el usuario hace clic dentro del input en móvil
            searchInput.addEventListener("focus", function () {
                if (window.innerWidth <= 992) {
                    navbarBrand.classList.add("d-none");
                }
            });

            // Ocultar el buscador si se hace clic fuera
            document.addEventListener("click", function (event) {
                if (!searchForm.contains(event.target) && !searchIcon.contains(event.target)) {
                    searchForm.classList.add("d-none");

                    if (window.innerWidth <= 992) {
                        navbarBrand.classList.remove("d-none"); // Mostrar el logo nuevamente
                    }
                }
            });

            // Evitar que se cierre si el usuario hace clic dentro del buscador
            searchForm.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            // Detectar Enter en el buscador para redirigir a la vista de resultados
            searchInput.addEventListener("keypress", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Evita el envío normal del formulario
                    let query = searchInput.value.trim();
                    if (query.length > 1) {
                        window.location.href = `/tienda/busqueda?query=${encodeURIComponent(query)}`;
                    }
                }
            });
        });

        $(document).ready(function () {
            $('#buscador').on('keyup', function () {
                let query = $(this).val();

                if (query.length > 1) {
                    $.ajax({
                        url: '{{ route("productos.buscar") }}',
                        type: 'GET',
                        data: { query: query },
                        success: function (data) {
                            $('#resultadoBusqueda').html(data);
                        }
                    });
                } else {
                    $('#resultadoBusqueda').empty();
                }
            });

            // Redireccionar al hacer clic en un producto
            $(document).on('click', '.producto-item', function () {
                let url = $(this).data('url');
                window.location.href = url;
            });
        });
    </script>

    <!-- Función jQuery para cerrar el navbar automáticamente -->
    <script>
        $('.navbar-nav>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });
    </script>

    <script type="text/javascript">
        $(".update-cart").change(function (e) {
            e.preventDefault();
            var ele = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",

                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },

                success: function (response) {
                   window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("¿Seguro que quieres eliminar?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    </script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

  </body>
</html>
