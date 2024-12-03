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

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
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
            <a class="nav-link nav_button active" aria-current="page" href="#inicio">Inicio</a>
          </li>

          <li class="nav-item mb-2 mb-md-b mb-lg-0">
            <a class="nav-link nav_button" href="#nosotros">Nosotros</a>
          </li>

          <li class="nav-item mb-2 mb-md-b mb-lg-0">
            <a class="nav-link nav_button" href="#afiliados">Afiliados</a>
          </li>

          <li class="nav-item mb-2 mb-md-b mb-lg-0">
            <a class="nav-link nav_button" href="#afiliate">Afiliate</a>
          </li>


        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link submit_buttom text-white" href="#">Iniciar Sesion</a>
            </li>
        </ul>

      </div>
    </div>
  </nav>

<body class="bg_body">

    <div class="container">

        <section id="inicio" class="mb-5">

            <div class="row">

                <div class="col-12 col-md-12 col-md-6 col-lg-6">
                    <h3 class="text-center titulo_custom"><strong>BIENVENIDO</strong></h3>
                    <h5  class="text-center texto_pag"> Registro Nacional de Certificación IMNAS</h5>

                    @yield('content')

                </div>

                <div class="col-12 col-md-12 col-md-6 col-lg-6 mt-5 mt-md-0 mt-lg-0 ">
                    <div class="card card_redoundead">
                        <form method="POST" action="{{ route('login_cam.custom') }}">
                            @csrf
                            <div class="row p-3">
                                <div class="col-12">
                                    <h3 class="text-center titulo_custom mt-3 mb-3">Accede</h3>
                                </div>

                                <div class="col-12 text-center">
                                    <input id="username" name="username" type="text" placeholder="Celular" class="input_redoundedos_login w-100 mb-5 @error('username') is-invalid @enderror" value="{{ old('username') }}" required >

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input id="password" type="password" placeholder="*******" class="input_redoundedos_login w-100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 mt-5 mb-4 text-center">
                                    <button type="submit" class="submit_buttom text-white">Iniciar sesión</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-12">
                    @yield('content_result')
                </div>

            </div>



        </section>

        <section id="nosotros" class="row separador_section">

            <div class="col-12">
                <h2 class="titulo_custom_registro">Acerca de <br> <strong>Registro Nacional</strong></h2>
                <p style="position: relative">
                    <img src="{{ asset('assets/user/icons/Documentos-RN_1.webp') }}" alt="" class="img_acerca_de" >
                </p>
            </div>

            <div class="col-12">
                <p class="texto_pag2 mt-4">
                    El Registro Nacional IMNAS Mexico (RIM) , Certificadora Nacional Notariada,
                    es una iniciativa respaldada por la <strong>Secretaría del Trabajo y Previsión Social (STPS)</strong> y el <strong>Registro Nacional</strong> ,
                    diseñada para garantizar que los profesionales y centros educativos cumplan con los más altos estándares de calidad a nivel nacional.
                    Nuestra plataforma, cuenta con una base de datos centralizada y accesible donde se almacenan todos los registros emitidos por nuestra entidad.
                </p>
                <h3 class="titulo_custom mt-4 mb-4">Nuestro objetivo</h3>
                <p class="texto_pag2">
                    Con el respaldo de autoridades oficiales, nuestro objetivo es impulsar la profesionalización y
                    certificación laboral en México, ofreciendo validez y reconocimiento formal para fortalecer el
                    desarrollo profesional en diversos sectores.
                </p>
            </div>

            <div class="col-12 col-md-12 col-lg-6 my-auto">
                <p class="">
                    <img src="{{ asset('assets/user/icons/computer.webp') }}" alt="" class="img_contenedor" >
                </p>
            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <h3  class="titulo_custom3 right_text mb-3">¿Cómo funciona?</h3>
                <h4  class="titulo_custom4 right_text mt-3">1. Emisión de Documentos:</h4>
                <p class="texto_pag2 right_text">
                    Cada certificado emitido por IMNAS incluye un código QR único
                </p>

                <h4  class="titulo_custom4 mt-3 text-left">2. Verificación:</h4>
                <p class="texto_pag2">
                    Al escanear este código QR con cualquier dispositivo móvil,
                    se accede directamente al Registro Nacional de Certificación IMNAS.
                </p>

                <h4  class="titulo_custom4 right_text mt-3">3. Autenticidad:</h4>
                <p class="texto_pag2 right_text">
                    La página de verificación mostrará los detalles del
                    documento, confirmando su autenticidad y validación por
                    parte de IMNAS.
                </p>

                <h4  class="titulo_custom4 mt-3">4. Búsqueda Manual:</h4>
                <p class="texto_pag2">
                    Además del escaneo del QR,
                    también puedes ingresar el código de certificación en nuestro sitio web
                    para verificar la validez del documento.
                </p>
            </div>

            <div class="col-12 col-md-12 col-lg-6 my-auto order-2 order-lg-1">
                <h3  class="titulo_custom4">
                    Registro Nacional y <br> su importancia
                </h3>
                <p class="texto_pag2">
                    El Registro Nacional de Certificación IMNAS
                    asegura que cada documento emitido bajo
                    nuestro aval es genuino y ha sido otorgado de acuerdo
                    con los más altos estándares educativos.
                    Esto protege tanto a los titulares de los certificados
                    como a las instituciones que confían en estas acreditaciones,
                    asegurando la integridad del proceso de certificación.
                </p>
            </div>


            <div class="col-12 col-md-12 col-lg-6 my-auto order-1 order-lg-2">
                <img src="{{ asset('assets/user/icons/diploma-c_sello.webp') }}" alt="" class="img_contenedor" >
            </div>

            <div class="col-12 col-md-12 col-lg-6 my-auto">
                <img src="{{ asset('assets/user/icons/mundial.webp') }}" alt="" class="img_contenedor" >
            </div>

            <div class="col-12 col-md-12 col-lg-6 my-auto">
                <p class="texto_pag2 container_text" style="margin: 0!important;">
                    Gracias a nuestro sistema, garantizamos que los certificados emitidos sean reconocidos a nivel nacional e internacional,
                    brindando una herramienta poderosa para todos aquellos

                </p>
                <p class="texto_pag2 container_text">
                    <img src="{{ asset('assets/user/icons/mundi-birrete.webp') }}" alt="" class="img_contenedor_text" >
                    que buscan la validación de sus competencias  y
                    habilidades  en un entorno  cada vez más exigente y globalizado.
                </p>
            </div>

        </section>

        <section id="afiliados" class="row">


            @yield('registros_emitidos')

            <div class="col-12">
                @yield('content_result2')
            </div>


            @yield('content_dinamico')


        </section>

        <section id="afiliate" class="row separador_section">

            <div class="col-12 col-md-12 col-lg-6 my-auto">
                <h2 class="titulo_custom_registro">Afiliación<br> <strong>Registro IMNAS</strong></h2>
                <p class="texto_pag2 mt-4">
                    Entendemos la importancia de ofrecer programas educativos de calidad que no solo eduquen,
                     sino que también ofrezcan un reconocimiento oficial a tus alumnos. Es por eso que hemos creado <strong>Registro IMNAS,
                    avalado por la STPS e IMNAS</strong>, para brindarte respaldo y valor curricular.
                </p>
            </div>

            <div class="col-12 col-md-12 col-lg-6 my-auto">
                <img src="{{ asset('assets/user/icons/todos-docs.webp') }}" alt="" class="img_contenedor" >
            </div>

            <div class="col-6">
                <h2 class="titulo_custom_registro"> <strong>Beneficios de la</strong> <br> afiliación</h2>
            </div>

            <div class="col-6"></div>


            <div class="col-6">
                <p class="text-center">
                    <img src="{{ asset('assets/user/icons/reconocimiento.webp') }}" alt="" class="img_icon" >
                </p>
                <h4  class="titulo_custom4 mt-3 text-center">Reconocimiento oficial</h4>
                <p class="texto_pag2">
                    Todos los documentos emitidos cuentan con validez nacional,
                    respaldados por Registro IMNAS y la STPS,
                    cumpliendo con los más altos estándares educativos y laborales.
                </p>
            </div>

            <div class="col-6">
                <p class="text-center">
                    <img src="{{ asset('assets/user/icons/Portabilidad.webp') }}" alt="" class="img_icon" >
                </p>
                <h4  class="titulo_custom4 mt-3 text-center">Portabilidad</h4>
                <p class="texto_pag2">
                    Ofrecemos <strong>documentos</strong> en formatos <strong>físicos</strong> y <strong>digitales</strong>,
                    facilitando su manejo y verificación en cualquier lugar
                </p>
            </div>

            <div class="col-6">
                <p class="text-center">
                    <img src="{{ asset('assets/user/icons/empleo.webp') }}" alt="" class="img_icon" >
                </p>
                <h4  class="titulo_custom4 mt-3 text-center">Incremento en oportunidades <br> laborales</h4>
                <p class="texto_pag2">
                    Según datos del INEGI, los profesionales certificados tienen un <strong>30% más de probabilidades de acceder a mejores empleos.</strong>
                </p>
            </div>

            <div class="col-6">
                <p class="text-center">
                    <img src="{{ asset('assets/user/icons/aumento.webp') }}" alt="" class="img_icon" >
                </p>
                <h4  class="titulo_custom4 mt-3 text-center">Aumento salarial</h4>
                <p class="texto_pag2">
                    Estudios internacionales muestran que las certificaciones pueden incrementar el salario hasta un 15%,
                     marcando la diferencia en el mercado laboral.
                </p>
            </div>

            <div class="col-6 my-auto">
                <img src="{{ asset('assets/user/icons/qr_imagen.png') }}" alt="" class="img_contenedor" >
            </div>

            <div class="col-6">
                <p class="text-center">
                    <img src="{{ asset('assets/user/icons/alianza.webp') }}" alt="" class="img_icon" >
                </p>
                <h4  class="titulo_custom4 mt-3 text-center">Credibilidad profesional</h4>
                <p class="texto_pag2">
                    Mejora tu perfil ante empleadores, colaboradores y alumnos,
                    posicionándote como un <strong>profesional altamente preparado.</strong>
                </p>
            </div>


        </section>

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
