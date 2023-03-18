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
    <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />

  </head>

  <body class="body">

    <header class="header">
        @include('user.components.navbar')
    </header>

    <main class="container-fluid secundario" style="margin: 0;padding:0;">
    @yield('content')
    </main>

    {{-- footer --}}
    @include('admin.users.components.footer')
    {{-- footer --}}

    @include('user.components.modal_login')

    @include('user.components.modal_checkout')


    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    @yield('js')

  </body>
</html>
