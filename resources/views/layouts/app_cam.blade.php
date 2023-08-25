<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">

    <link rel="icon" type="image/png" href="{{asset('assets/user/logotipos/cam.png')}}">

    <title>
        @yield('template_title') -
    </title>

    <link href="{{asset('assets/user/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />

    @yield('css_custom')

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  </head>

  <body class="body">

    @yield('content')
    @yield('datatable')

  </body>

</html>
