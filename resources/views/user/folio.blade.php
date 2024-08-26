<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/user/logotipos/registro_nmacional.png')}}">
  <title>
    Registro Nacional
  </title>
  <!--     Fonts and icons     -->
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/admin/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/admin/css/nucleo-svg.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/user/custom/instalaciones.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/user/custom/custom.css')}}" rel="stylesheet" />

<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/admin/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
</head>

<body class="">

    <style>
        .card_colapsable_comprar {
            border: solid 3px #66C0CC;
            border-radius: 19px;
            box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);
        }
        .bg-gradient-dark {
            opacity: 0.5!important;
        }
        .titulo{
            color: #000;
            font-family: "Montserrat", Sans-serif;
            font-size: 25px;
            font-weight: 500;
        }
    </style>

  <section class="">

    <div class="row " style="background-color: #66C0CC">
        <div class="col-12 col-sm-12 col-md-6 my-auto">

            <h3 class="text-white text-center mt-5 mt-md-0 mt-lg-0" style="">
                Bienvenidos al Registro Nacional <br> de Certificación IMNAS
            </h3>

        </div>

        <div class="col-12 col-sm-12 col-md-6 mt-5">
            <p class="text-center">
                <img src="{{asset('assets/user/logotipos/registro_nacional.png')}}" alt=""style="width: 30%;background:#fff;border-radius: 9px;margin-left: 3rem;">
                <img src="{{asset('assets/user/logotipos/stps.png')}}" alt="" style="width: 30%;background:#fff;border-radius: 9px;margin-left: 3rem;">
            </p>

        </div>
    </div>

    <div class="page-header min-vh-100" style="background-image: url('{{asset('assets/user/utilidades/portada_cam.webp')}}');">
        <span class="mask  opacity-6" style="background-image: linear-gradient(310deg, #66C0CC 0%, #373e3b 100%) !important;"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7">

              <div class="card border-0 mb-0" style="border-style: solid!important;border-width: 0px 9px 9px 0px!important;border-color: #66C0CC!important;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);">
                <div class="card-header bg-transparent">
                  <p class="text-center">
                      <img src="{{asset('assets/user/logotipos/registro_nacional.png')}}" alt=""  style="width: 90px;">
                  </p>
                  <h5 class="text-dark text-center mt-2 mb-3">Bienvenido </h5>
                </div>

                <div class="card-body px-lg-5 pt-0">
                  <div class="text-center text-muted mb-4">
                    <small>Ingresa tus accesos</small>
                  </div>

                  {{-- <form method="POST" action="{{ route('login') }}"> --}}
                  <form method="POST" action="{{ route('login.custom') }}">
                    @csrf

                    <div class="mb-3">
                      <input id="username" name="username" type="text" placeholder="Celular" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required >
                          @error('username')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>

                    <div class="mb-3">
                      <input id="password" type="password" placeholder="*******" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary w-100 my-4 mb-2" style="background-color: #66C0CC  !important"> Ingresar</button>
                    </div>

                  </form>

                </div>

              </div>
            </div>

          </div>
        </div>
      </div>


    <div class="row " style="background-color: #fff">
        <div class="col-12 col-sm-12 col-md-12 my-auto">

            <h2 class="text-dark text-center mt-5" style="">
                Explora el Registro Nacional de Certificación IMNAS
            </h2>

            <p class="text-dark text-center mb-5" style="">
                verifica la autenticidad de los  registros  emitidas. <br> Tu confianza y respaldo es nuestra prioridad.
            </p>
        </div>

        <div class="col-2"></div>

        <div class="col-8">

            <form id="searchForm" class="d-flex" role="search">
                <input class="form-control me-2" placeholder="Ingresa Folio" name="folio" id="folio">
                <button class="btn btn-success" type="submit" style="background: #66C0CC">Buscar</button>
            </form>

        </div>

        <div class="col-2">

        </div>

        <div class="col-12 mt-4">

            @if(Route::currentRouteName() != 'folio.index')
                @if ($tickets == NULL && $tickets_generador == "")
                    <div class="card card-body card_colapsable_comprar">
                        <h6><strong>{{$folio}}</strong></h6>
                    </div>
                @else
                    @if ($tickets_generador == "")
                        <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>


                        <div class="row card card-body card_colapsable_comprar">
                            <div class="col-12">
                                <h3 class="text-center mb-3 mt-3">REGISTRO NACIONAL IMNAS</h3>
                            </div>

                            <div class="col-12">

                                <div class="row">

                                    <div class="col-4">
                                        <p class="text-center">
                                            <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/stps.png" class="img_card_certificaciones" >
                                        </p>
                                    </div>

                                    <div class="col-4">
                                        <p class="text-center">
                                            <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" class="img_card_certificaciones" style="width: 80px!important">
                                        </p>
                                    </div>

                                    <div class="col-4">
                                        <p class="text-center">
                                            <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" class="img_card_certificaciones" >
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <p class="text-center">
                                           <strong> Registro Nacional IMNAS</strong> tiene la finalidad de llevar un padrón detallado de cada uno de
                                            los alumnos que han acreditado carreras, diplomados y certificaciones de acuerdo a los
                                            estatutos requeridos en cada uno de ellos.
                                        </p>
                                        <p class="text-center mt-4">
                                            <strong>Nombre del Alumno:</strong> {{$tickets->User->name}} <br>
                                            <strong>Especialidad:</strong> {{$tickets->Cursos->nombre}} <br>
                                            <strong>Escuela donde estudió:</strong> INSTITUTO MEXICANO NATURALES AIN SPA <br>
                                            <strong>Fecha que estudió del:</strong> {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_inicial)->isoFormat('DD [de] MMMM [del] YYYY') }} al: {{ \Carbon\Carbon::parse($tickets->Cursos->fecha_final)->isoFormat('DD [de] MMMM [del] YYYY') }}<br>
                                        </p>
                                        <p class="text-center mt-4">
                                            La coordinación de asuntos escolares del Registro Nacional IMNAS con registro en la
                                            Secretaría del Trabajo y Previsión Social (STPS) como agente capacitador externo
                                            RIFC680910-879-0013 hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                                            ha terminado satisfactoriamente la especialidad <strong>{{$tickets->Cursos->nombre}}</strong> con los créditos honoríficos
                                            requeridos respecto al plan de estudios vigente.
                                        </p>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 my-auto">
                                        <a href="{{ route('folio.index_cedula',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                                        <a href="{{ route('folio.index_crednecial',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                        <a href="{{ route('folio.index_diploma',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                                        <a href="{{ route('folio.index_titulo',$tickets->id) }}" class="text-center btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                                        {{-- <a href="{{ route('folio.index_tira',$tickets->id) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a> --}}
                                    </div>

                                </div>

                            </div>
                        </div>

                    @endif
                @endif

                @if ($tickets == NULL && $tickets_generador == "")

                @else
                    @if ($tickets == NULL)
                    <h5 class="text-left mt-5 mb-3"><strong>Resultado de Busqueda del Folio : {{ $folio}}</strong></h5>

                    <div class="row card card-body card_colapsable_comprar">
                        <div class="col-12">
                            <h3 class="text-center mb-3 mt-3">REGISTRO NACIONAL IMNAS</h3>
                        </div>

                        <div class="col-12">

                            <div class="row">

                                <div class="col-4">
                                    <p class="text-center">
                                        <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/stps.png" class="img_card_certificaciones" >
                                    </p>
                                </div>

                                <div class="col-4">
                                    <p class="text-center">
                                        <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" class="img_card_certificaciones" style="width: 80px!important">
                                    </p>
                                </div>

                                <div class="col-4">
                                    <p class="text-center">
                                        <img src="https://plataforma.imnasmexico.com/assets/user/logotipos/registro_nacional.png" class="img_card_certificaciones" >
                                    </p>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                    <p class="text-center">
                                       <strong> Registro Nacional IMNAS</strong> tiene la finalidad de llevar un padrón detallado de cada uno de
                                        los alumnos que han acreditado carreras, diplomados y certificaciones de acuerdo a los
                                        estatutos requeridos en cada uno de ellos.
                                    </p>
                                    <p class="text-center mt-4">
                                        <strong>Nombre del Alumno:</strong> {{$tickets_generador->nombre}} <br>
                                        <strong>Especialidad:</strong> {{$tickets_generador->nom_curso}} <br>
                                        <strong>Escuela donde estudió:</strong>  {{$tickets_generador->User->escuela}} <br>
                                        <strong>Fecha que estudió :</strong> {{ \Carbon\Carbon::parse($tickets_generador->fecha_curso)->isoFormat('DD [de] MMMM [del] YYYY') }} <br>
                                    </p>
                                    <p class="text-center mt-4">
                                        La coordinación de asuntos escolares del Registro Nacional IMNAS con registro en la
                                        Secretaría del Trabajo y Previsión Social (STPS) como agente capacitador externo
                                        RIFC680910-879-0013 hace constar que el alumno con número de FOLIO <strong>{{ $folio}}</strong>
                                        ha terminado satisfactoriamente la especialidad <strong>{{$folio}}</strong> con los créditos honoríficos
                                        requeridos respecto al plan de estudios vigente.
                                    </p>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6 my-auto">
                                    <a href="{{ route('folio.index_cedula',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DDD78D">Cedulda de Identidad de Papel</a>
                                    <a href="{{ route('folio.index_crednecial',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-dark" style="background-color: #DCBF85">Credencial Plastificada</a>
                                    <a href="{{ route('folio.index_diploma',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #8B635C">Diploma Imnnas</a>
                                    <a href="{{ route('folio.index_titulo',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #60594D">Titulo Honorifico</a>
                                    <a href="{{ route('folio.index_tira',$tickets_generador->folio) }}" class="btn btn-xs mt-3 w-100 text-white" style="background-color: #93A29B">Tira de Materias</a>
                                </div>

                            </div>

                        </div>
                    </div>

                    @endif
                @endif
            @endif

        </div>

    </div>

    <div class="row">
        <div class="col-12 m-auto">
            <h1 class="text-white text-center titulo mt-5 " style="color:#000!important;">Una Plataforma innovadora </h1>
            <p class="text-center " style="color:#000!important;">
                Una plataforma innovadora y de confianza diseñada para garantizar la autenticidad y validez de las registros emitidas por nuestra entidad, avalada por la STPS y Certificadora nacional registro IMNAS.
                <br><br>
                En el Registro Nacional, cada certificado emitido por IMNAS viene con un código QR único, lo que proporciona una capa adicional de seguridad y transparencia. Este código QR permite que cualquier persona, institución o empresa pueda verificar en tiempo real la validez y legitimidad del documento, asegurando que la certificación ha sido otorgada conforme a los estándares oficiales.

            </p>

            <h1 class="text-white text-center titulo mt-5 " style="color:#000!important;">¿Qué es el Registro Nacional de Certificación?</h1>
            <p class="text-center " style="color:#000!important;">
                El Registro Nacional de Certificación IMNAS es una base de datos centralizada y accesible en línea donde se almacenan todos los registros emitidos por nuestra entidad. Cada vez que un alumno recibe su tira de materias, cédula de identidad (plástica y de papel), diploma o título honorífico.

            </p>

            <h1 class="text-white text-center titulo mt-5" style="color:#000!important;">¿Cómo Funciona?</h1>
            <p class="text-left p-3" style="color:#000!important;">
                <strong>1. *Emisión de Documentos:* </strong> <br> Cada certificado emitido por IMNAS incluye un código QR exclusivo. <br>
                <strong>2. *Verificación:* </strong> <br> Al escanear este código QR con cualquier dispositivo móvil, se accede directamente al Registro Nacional de Certificación IMNAS. <br>
                <strong>3. *Autenticidad:* </strong> <br> La página de verificación mostrará los detalles del documento, confirmando su autenticidad y validación por parte de IMNAS. <br>
                <strong>4. *Búsqueda Manual:* </strong> <br> Además del escaneo del QR, también puedes ingresar el código de certificación en nuestro sitio web para verificar la validez del documento. <br>
            </p>

            <h1 class="text-white text-center titulo mt-5 " style="color:#fff!important;">¿Por Qué es Importante?</h1>
            <p class="text-center " style="color:#fff!important;">
                El Registro Nacional de Certificación IMNAS asegura que cada documento emitido bajo nuestro aval es genuino y ha sido otorgado de acuerdo con los más altos estándares educativos. Esto protege tanto a los titulares de los certificados como a las instituciones que confían en estas acreditaciones, asegurando la integridad del proceso de certificación.
                <br><br>
                Gracias a este sistema, garantizamos que los certificados emitidos son reconocidos no solo a nivel nacional sino también internacionalmente, brindando una herramienta poderosa para todos aquellos que buscan la validación de sus competencias y habilidades en un entorno cada vez más exigente y globalizado.
            </p>
        </div>

    </div>




  </section>


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


</script>


</script>

</body>

</html>
