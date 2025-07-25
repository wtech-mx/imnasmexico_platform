<!DOCTYPE html>
<html lang="en">

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

  <link href="{{asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="{{asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />
  @yield('css')
   <!-- Select2  -->
   <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/admin/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets/admin/css/adaptabilidad.css')}}">
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

        #cerdito {
            transition: top 0.5s ease-in-out;
        }

        .progress {
            background-color: #f5f5f5;
            border-radius: 15px;
            overflow: hidden;
        }

        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>

</head>

<body class="g-sidenav-show   bg-gray-100">
    @php
        if (Request::is('perfil/cliente*')) {
            $backgroundColor = '#344767';
        } elseif (Request::is('cosmica*')) {
            $backgroundColor = '#322338';
        } elseif (Request::is('rh*')) {
            $backgroundColor = '#232a38';
        } else {
            $backgroundColor = $configuracion->color_principal;
        }
    @endphp
  <div class="min-height-300  position-absolute w-100" style="background-color: {{$backgroundColor}};"></div>
    @include('layouts.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        @include('layouts.navbar')
        <div class="container-fluid py-md-0 py-lg-4">
            @include('layouts.simple_alert')
            @yield('content')
            @include('layouts.footer')
            @include('admin.manual.modal_instrucciones')

        </div>
    </main>

    <!-- Modal lateral Congif -->
        {{-- @include('layouts.modal_config') --}}
    <!-- End Modal lateral Congif -->

    <!--   Core JS Files   -->
    {{-- <script src="{{asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script> --}}
    <script src="{{asset('assets/admin/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/datatables.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/jkanban/jkanban.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/chartjs.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/argon-dashboard.min.js')}}"></script>
    {{-- <script src="{{asset('assets/admin/js/plugins/multistep-form.js')}}"></script> --}}
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    @yield('js_custom')
    @yield('datatable')
    @yield('fullcalendar')
    @yield('select2')

    <script>
        document.getElementById('regresar_btn').addEventListener('click', function() {
            history.back();
        });
        // $(function() {
        //     $('form').on('submit', function() {
        //         // Deshabilitar el botón de envío al hacer clic
        //         $(this).find('button[type="submit"]').prop('disabled', true);
        //     });
        // });

        const formContainer = document.getElementById('form-container');
        const openFormButton = document.getElementById('open-form');

        openFormButton.addEventListener('click', () => {
            formContainer.style.display = 'block';
        });

        formContainer.addEventListener('click', (event) => {
            if (event.target === formContainer) {
                formContainer.style.display = 'none';
            }
        });



    </script>


</body>

</html>
