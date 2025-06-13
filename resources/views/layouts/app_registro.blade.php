<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/user/logotipos/registro_nmacional.png')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{asset('assets/user/custom/custom.css')}}" rel="stylesheet" />

  <title>
    @yield('template_title') - {{$configuracion->nombre_sistema}}
  </title>

  @yield('css_custom')

  <style>

    @font-face {
        font-family: LibreBaskerville;
        src: url('{{ asset('assets/user/fonts/LibreBaskerville-Regular.ttf') }}') format('truetype');
    }

    @font-face {
        font-family: Montserrat;
        src: url('{{ asset('assets/user/fonts/Montserrat-VariableFont_wght.ttf') }}') format('truetype');
    }

    .bg_body{
        background: #ecfdff
    }
    .input_redoundedos{
        border-radius: 19px;
        border: solid 1px #ccc;
        padding: 5px 20px 5px 20px;
    }

    .input_redoundedos_login{
        border-radius: 19px;
        border: solid 1px #ccc;
        padding: 15px 20px 15px 20px;
    }

    .btn_navbar{
        background-color: transparent;
        border-radius: 19px;
        border: solid 1px #5bb4c2;
        padding: 5px 20px 5px 20px;
        font-weight: bold;
    }

    .submit_buttom{
        background-color: #5bb4c2;
        border-radius: 19px;
        border: solid 1px #5bb4c2;
        padding: 5px 20px 5px 20px;
        font-weight: bold;
    }

    .card_redoundead{
        box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);
        border-radius: 16px;
        border: solid 3px transparent;
    }

    .nav_button{
        background-color: transparent;
        border-radius: 19px;
        border: solid 1px #5bb4c2;
        padding: 5px 20px 5px 20px;
        color:#5bb4c2;
        margin: 0px 10px 0 10px;
    }

    .navbar-nav .nav-link.active, .navbar-nav .nav-link.show {
        color: #fff!important;
        background: #2c6d77!important;
    }

    .titulo_custom{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 40px;
    }

    .titulo_custom2{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 30px;
    }

    .titulo_custom3{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 25px;
        font-weight: 600;
    }

    .titulo_custom4{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 20px;
        font-weight: 600;
    }

    .titulo_custom_registro{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 55px;

    }

    .texto_pag{
        font-family: 'LibreBaskerville';
        color: #2c6d77;
        font-size: 20px;
    }

    .texto_pag2{
        font-family: 'Montserrat';
        color: #000;
        font-size: 19px;
        font-weight: 300;
    }

    .right_text{
        text-align: right;
    }

    .img_acerca_de{
        position: absolute;
        width: 500px;
        right: 0;
        top: -380px;
    }

    .separador_section{
        margin-top: 10rem;
    }

    .img_contenedor{
        width: 100%;
    }

    .container_text{
        max-width: 100%;
    }

    .img_contenedor_text{
        float:right;
        width: 250px;
    }

    .img_icon{
        width: 60px
    }

    .img_logo_footer{
        width: 40%;
    }
    .iframe{
        width: 600px;
        height: 450px;
    }

    .title_escuela_slide{
        position: absolute;
        top: 30px;
        left: 29px;
        color: #fff;

    }

    @media screen and (max-width: 992px) {
        .img_acerca_de {
            width: 330px;
            right: 0;
            top: -276px;
        }
    }

    @media screen and (max-width: 767px) {
        .img_acerca_de {
            width: 250px;
            right: -20px;
            top: -240px;
        }
    }

    @media screen and (max-width: 500px) {
        .img_acerca_de {
            width: 250px;
            right: 0;
            top: 0;
            position: relative;
        }

        .separador_section{
            margin-top: 3rem;
        }

        .iframe{
            width: 400px;
            height: 300px;
        }
    }

  </style>

</head>

<nav class="navbar navbar-expand-lg sticky-top" style="background: transparent;">
    <div class="container" style="max-width: 1200px;"> <!-- Cambiado a container y límite máximo -->
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/user/logotipos/registro_nacional.png')}}" style="width: 130px">
            <img src="{{asset('assets/user/logotipos/stps.png')}}" style="width: 130px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mb-2 mb-md-b mb-lg-0">
                    <a class="nav-link nav_button {{ (Request::is('/registro') ? 'active' : '') }}" aria-current="page" href="{{ route('folio_registro.index') }}">Inicio</a>
                </li>
                <li class="nav-item mb-2 mb-md-b mb-lg-0">
                    <a class="nav-link nav_button {{ (Request::is('/registro/nosotros') ? 'active' : '') }}" href="{{ route('index_nosotros.registro') }}">Nosotros</a>
                </li>
                <li class="nav-item mb-2 mb-md-b mb-lg-0">
                    <a class="nav-link nav_button {{ (Request::is('/registro/Afiliados') ? 'active' : '') }}" href="{{ route('index_afiliados.registro') }}">Afiliados</a>
                </li>
                <li class="nav-item mb-2 mb-md-b mb-lg-0">
                    <a class="nav-link nav_button {{ (Request::is('/registro/Afiliate') ? 'active' : '') }}" href="{{ route('index_afiliate.registro') }}">Afiliate</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link submit_buttom text-white  {{ (Request::is('/registro') ? 'active' : '') }}" href="{{ route('folio_registro.index') }}">Iniciar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<body class="bg_body">

    <div class="container">

        @yield('section_pag')

        <section id="contacto" class="row container">

            <div class="col-12 col-md-12 col-lg-6 ">
                <p class="text-left">
                    <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" alt="" class="img_logo_footer" >
                </p>
                <h4  class="titulo_custom mt-3 text-left">Contáctanos</h4>
                <p class="texto_pag2">
                    <a href="tel:+525534316258 ">525534316258</a> <br><br>

                    <strong>Horario de Atención:</strong> Lunes a Viernes, de 9:00
                    a 18:00 hrs. <br><br>


                    <strong>Oficinas Centrales:</strong> Castilla 136, Álamos, Benito
                    Juárez, 03400 Ciudad de México, CDMX.
                </p>
            </div>

            <div class="col-12 col-md-12 col-lg-6  my-auto">
                <h4  class="titulo_custom mt-3 text-center mb-5">
                    Tu confianza y respaldo es <br> nuestra prioridad
                </h4>
                <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2729.233774551032!2d-99.14414318667393!3d19.397370201598285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1733157802734!5m2!1ses-419!2smx" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-12">
                <p class="mt-5 mb-4 text-center" >
                    <a class="titulo_custom4" href="www.plataforma.imnasmexico.com/registro">
                        <strong>www.plataforma.imnasmexico.com/registro</strong>
                    </a>
                </p>
                <p class="texto_pag2 text-center">
                    Este programa opera bajo el marco legal establecido por la Ley General de Educación, el Acuerdo Secretarial
                    286, y los lineamientos de STPS, proporcionando a las instituciones educativas y a los individuos acceso a
                    estándares de calidad laboral reconocidos a nivel nacional.
                </p>
                <p class="text-center">
                    <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/stps.png " alt="" style="width: 10%">
                </p>
            </div>

        </section>


    </div>

      <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{asset('assets/admin/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/core/bootstrap.min.js')}}"></script>

  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/admin/js/argon-dashboard.min.js?v=2.0.4')}}"></script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>

  @yield('js')

    <script>
        $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault(); // Evita que se recargue la página

            var folio = $('#folio').val();

            $.ajax({
                url: '{{ route("folio_registro.buscador") }}',
                method: 'GET',
                data: { folio: folio },
                success: function(response) {
                    // Aquí puedes manejar la respuesta del servidor
                    // Por ejemplo, mostrar los datos en un div:
                    $('#resultsContainer').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejar errores aquí
                    console.error('Error: ', textStatus, errorThrown);
                }
            });
            });

            $('#searchForm2').on('submit', function(e) {
            e.preventDefault(); // Evita que se recargue la página

            var folio = $('#folio').val();

            $.ajax({
                url: '{{ route("folio_registro.buscador") }}',
                method: 'GET',
                data: { folio: folio },
                success: function(response) {
                    // Aquí puedes manejar la respuesta del servidor
                    // Por ejemplo, mostrar los datos en un div:
                    $('#resultsContainer2').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejar errores aquí
                    console.error('Error: ', textStatus, errorThrown);
                }
            });
            });
        });

    </script>


</body>

</html>
