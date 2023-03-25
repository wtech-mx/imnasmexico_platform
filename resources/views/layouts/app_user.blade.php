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
    <link href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.cs')}}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  </head>

  <body class="body">

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>

    @yield('js')

  </body>
</html>
