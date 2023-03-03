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

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />


  </head>
  <body>

    <main class="container-fluid secundario" style="margin: 0;padding:0;">

    @yield('content')

    </main>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}
    <link href="{{ asset('assets/user/bootstrap/js/bootstrap.js')}}" rel="stylesheet" />
  </body>
</html>
