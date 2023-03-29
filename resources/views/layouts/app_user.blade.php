<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">
    <title>
        @yield('template_title') - {{$configuracion->nombre_sistema}}
    </title>

    <link href="{{ asset('assets/user/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/custom/custom.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/custom/header.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/custom/footer.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/custom/modal_login.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/custom/modal_checkout.css')}}" rel="stylesheet" />

    @yield('css_custom')

    <!-- Font Awesome Icons -->
    {{-- <link href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.cs')}}" rel="stylesheet" /> --}}
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  </head>

  <body class="body">
    @if (session('cart'))
        @php
            // SDK de Mercado Pago
            require base_path('/vendor/autoload.php');
            // Agrega credenciales
            MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

            // Crea un objeto de preferencia
            $preference = new MercadoPago\Preference();

            // Crea un ítem en la preferencia

                foreach (session('cart') as $id => $details) {
                    // dd(session('cart'));
                    $item = new MercadoPago\Item();
                    $item->title = $details['name'];
                    $item->quantity = $details['quantity'];
                    $item->unit_price = $details['price'];
                    $ticketss[] = $item;
                }

            $preference->back_urls = array(
                "success" => route('order.pay'),
                "failure" => "https://www.google.com.mx/",
                "pending" => "http://www.tu-sitio/pending"
            );
            $preference->auto_return = "approved";
                $preference->items = $ticketss;
                $preference->save();
        @endphp
    @endif

    <header class="header">
        @include('user.components.navbar')
    </header>

    <main class="container-fluid secundario" style="margin: 0;padding:0;">
    @yield('content')
    </main>

    {{-- footer --}}
    @include('user.components.footer')
    {{-- footer --}}

    @include('user.components.modal_login')

    @include('user.components.modal_checkout')

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}

    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script> --}}

    @yield('js')

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
                        id: ele.parents("tr").attr("data-id"),
                    },

                    success: function (response) {
                    //  window.location.reload();
                    }
                });
            }
        });
    </script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    @if (session('cart'))
        <script>
            const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-MX'
            });

            mp.checkout({
                preference: {
                id: '{{$preference->id}}'
                },
                render: {
                container: '.cho-container',
                label: 'Comprar ahora',
                }
            });
        </script>
    @endif



  </body>
</html>
