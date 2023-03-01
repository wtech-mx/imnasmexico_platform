<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <title>
    @yield('template_title') - {{$configuracion->nombre_sistema}}
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/admin/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />
  @yield('css')
   <!-- Select2  -->
   <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/admin/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />

   {{-- <link src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
--}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <style>
        input:before {
            content: attr(data-date);
            display: inline-block;
            color: black;
        }
    </style>
  @livewireStyles
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background-color: {{$configuracion->color_principal}}!important;"></div>

   <!-- Sidenav -->
    @include('layouts.sidebar')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->

    <div class="container-fluid py-4">

        {{-- @include('layouts.header') --}}
        @include('layouts.simple_alert')
        @yield('content')


       <!-- Modal lateral Congif -->
        @include('layouts.footer')
      <!-- End Modal lateral Congif -->

    </div>
  </main>


   <!-- Modal lateral Congif -->
    {{-- @include('layouts.modal_config') --}}
  <!-- End Modal lateral Congif -->



  <!--   Core JS Files   -->
  {{-- <script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script> --}}

  <script src="{{ asset('assets/admin/js/core/popper.min.js')}}"></script>

  <script src="{{ asset('assets/admin/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <script src="{{ asset('assets/admin/js/plugins/datatables.js')}}"></script>

  <script src="{{ asset('assets/admin/js/plugins/fullcalendar.min.js')}}"></script>
  <!-- Kanban scripts -->

  <script src="{{ asset('assets/admin/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{ asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{ asset('assets/admin/js/argon-dashboard.min.js')}}"></script>

  @yield('js_custom')

  @yield('datatable')

  @yield('fullcalendar')


  <!-- Github buttons -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

  @yield('select2')



  @livewireScripts
</body>

</html>
