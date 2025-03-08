@extends('layouts.app_user_cosmica')

@section('template_title')
    Cosmica {{$curso->nombre}}
@endsection

@section('css_custom')
<meta property="og:image" content="https://plataforma.imnasmexico.com{{asset('curso/'. $curso->foto) }}">
<meta property="og:title" content=" {{$curso->nombre}}">
<meta property="og:description" content=" {{$curso->descripcion}}">
<meta property="og:image:alt" content=" {{$curso->nombre}}">

<link href="{{asset('assets/user/custom/grid_cursos.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/calendario.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/single_course_horizon.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />

{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<link href="{{asset('assets/user/custom/lightbox.min.css')}}" rel="stylesheet" />
<style>
    .secundario {
        background-color: #CCABBE;
    }

    #registroBtn[disabled] {
        background-color: #ccc; /* Cambia el color de fondo */
        cursor: not-allowed; /* Cambia el cursor al estilo "no permitido" */
        color: #666; /* Cambia el color del texto */
    }

    .icon_nav_course{
        background-color: #2D2432!important;
    }
    .btn-primario {
        background-color: #2D2432!important;
        color: #CCABBE!important;
    }

    .border_row {
        background-color: #2D2432!important;
    }

    .btn_ticket_comprar {
        background-color: #2D2432!important;
    }

    .btn-secundario_grid {
        background-color: #CCABBE;
        color: #2D2432!important;
    }

    .card_bg_btn {
        background-color: #CCABBE;
    }

    .btn-secundario {
        background-color: #CCABBE;
        color: #2D2432;
    }
    .card_colapsable_comprar {
        border: solid 3px #2D2432;

    }

    .title_curso {
        color: #2D2432;

    }

    .card_certificaciones {
        border-color: #2D2432;
    }

    .card_bg_btn_secundario {
        background-color: #2D2432;
    }

    .card_icon_btn {
        color: #2D2432;
    }

</style>
@endsection
    @php
        use Carbon\Carbon;
        $fecha_ini = $curso->fecha_inicial;
        $fechaInicialCarbon = Carbon::createFromFormat('Y-m-d', $fecha_ini);
        $nombreDia = $fechaInicialCarbon->locale('es')->isoFormat('dddd');
        $nombreDiaCapitalizado = ucfirst($nombreDia);
        $fecha_inicial = $nombreDiaCapitalizado . ' ' . $fechaInicialCarbon->isoFormat('D [de] MMMM');

        $fecha_f = $curso->fecha_final;
        $fechaInicialCarbon2 = Carbon::createFromFormat('Y-m-d', $fecha_f);
        $nombreDia2 = $fechaInicialCarbon2->locale('es')->isoFormat('dddd');
        $nombreDiaCapitalizado2 = ucfirst($nombreDia2);
        $fecha_final = $nombreDiaCapitalizado2 . ' ' . $fechaInicialCarbon2->isoFormat('D [de] MMMM');

        $horaInicial = $curso->hora_inicial;
        $hora_inicial = Carbon::createFromFormat('H:i:s', $horaInicial)->format('h:i A');

        $horaFinal = $curso->hora_final;
        $hora_final = Carbon::createFromFormat('H:i:s', $horaFinal)->format('h:i A');

    @endphp
@section('content')

<div id="carousel_full" class="carousel slide" data-bs-ride="carousel">
    <span class="mask_calendar"></span>

    <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('{{asset('curso/'. $curso->foto) }}');height: auto;position: relative;" >
                <div class="row postion_row_caledanrio space_single_new">
                    <div class="col-12 col-md-6">
                        <div class="conten_slilder_full">
                            <h1 class="text-white titulo titulo_full" style="">
                                {{$curso->nombre}}
                            </h1>

                            @if($curso->registro_imnas != '1')
                                <a class="btn btn-secundario_grid me-3 mb-2 mb-lg-5 mb-md-4 mt-4 mt-md-4 mt-lg-5">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            {{ $curso->modalidad}}

                                        </p>
                                    </div>
                                </a>

                                <h3 class="text-white parrafo_full mb-4 mb-lg-5 mb-md-4 desaparecer_contenedor_sm">
                                    @php
                                    $descripcion = $curso->descripcion;
                                    if (strlen($descripcion) > 162) {
                                        $descripcion = substr($descripcion, 0, 162) . '...</br><a href="#contenido"style="color:#2D2432;background: #fff;padding: 10px;border-radius: 19px;text-decoration: none;position: relative;top: 1rem;">Continuar leyendo</a>';
                                        echo $descripcion;
                                    }
                                    @endphp
                                </h3>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-start">
                            <div class="card_single_horizon2 mt-3 mt-md-0">
                                @if($curso->registro_imnas != '1')
                                    <h2 class="title_curso">Fecha y Hora</h2>
                                    <p class="text_cards_horizon">

                                        @if ($curso->sin_fin_fecha == '1')
                                            {{$fecha_inicial}},  {{$curso->mensaje}} <br>
                                        @else
                                            {{$fecha_inicial}}
                                            @if ($curso->fecha_inicial == $curso->fecha_final)
                                            @else
                                            al {{$fecha_final}}
                                            @endif,
                                        @endif


                                        @if ($curso->sin_fin == '1')
                                            {{$hora_inicial}}</p>
                                        @else
                                            {{$hora_inicial}} - {{$hora_final}}</p>
                                        @endif
                                    </p>
                                    <h2 class="title_curso">Modalidad</h2>
                                    <p class="text_cards_horizon">
                                        @if ($curso->modalidad == 'Presencial')

                                        @if ($curso->direccion == NULL)

                                        <p class="">Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México.</p>

                                        @else
                                            <p class="">{{ $curso->direccion }}</p>
                                        @endif

                                        @elseif ($curso->modalidad == 'FACEBOOK LIVE')
                                        Online Gratuita
                                        @else

                                        Google Meet
                                        @endif
                                    </p>
                                @endif

                                @if ($curso->estatus == 1 || $curso->registro_imnas == '1')
                                <a class="btn btn-primario space_cs_rs" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="true" aria-controls="collapseinfo" style="display:block ">
                                    <div class="d-flex justify-content-start">
                                                @if ($curso->precio == 0)
                                                    <p class="card_tittle_btn_grid my-auto">
                                                        Registrarse
                                                    </p>
                                                @else
                                                    <p class="card_tittle_btn_grid my-auto">
                                                        Comprar ahora
                                                    </p>
                                                @endif
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn"></i>
                                        </div>
                                    </div>
                                </a>

                                    @if($curso->visibilidad_contactanos == '0')

                                    @else
                                    <a class="btn btn-secundario space_cs_rs mt-3" href="#contactenos" style="display:block ">
                                        <div class="d-flex justify-content-start">
                                            <p class="card_tittle_btn my-auto">
                                                Contáctanos
                                            </p>
                                            <div class="card_bg_btn_secundario">
                                                <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                            </div>
                                        </div>
                                    </a>
                                    @endif

                                <div class="collapse show mt-3" id="collapseinfo">
                                    <div class="card card-body card_colapsable_comprar">
                                        @if($curso->precio == 0)
                                            <div class="row mb-3">
                                                <form method="POST" action="{{ route('clases_gratis') }}" role="form" id="miFormulario">
                                                    @csrf
                                                    <input type="hidden" name="ticket" id="ticket" class="form-control input_custom_checkout" value="{{$curso->id}}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                                <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre(s) *" pattern="[^@.%/&$#]+" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-male"></i></span>
                                                                <input type="text" name="ape_paterno" id="ape_paterno" class="form-control input_custom_checkout" placeholder="Apellido Paterno *" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-female"></i></span>
                                                                <input type="text" name="ape_materno" id="ape_materno" class="form-control input_custom_checkout" placeholder="Apellido Materno *" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                                <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo *" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                                <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control input_custom_checkout" placeholder="55-55-55-55-55" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-center">
                                                                <button class="btn_pagar_checkout" type="button" id="registroBtn">Registrarse</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @else
                                            <div class="row mb-3">
                                                @foreach ($tickets as $ticket)
                                                @php
                                                        $precio = number_format($ticket->precio, 2, '.', ',');
                                                @endphp
                                                    <div class="col-12 mt-3">
                                                        <strong style="color: #2D2432">{{$ticket->nombre}}</strong>
                                                    </div>
                                                    <div class="col-6 col-lg-6 mt-3">
                                                        @if ($ticket->descuento == NULL)
                                                            <h5 style="color: #2D2432"><strong>$ {{ $precio }}</strong></h5>
                                                        @else
                                                            <del style="color: #2D2432"><strong>De ${{ $precio }}</strong></del>
                                                            <h5 style="color: #2D2432"><strong>A ${{$ticket->descuento}}</strong></h5>
                                                        @endif
                                                    </div>

                                                    <div class="col-6 col-lg-6 mt-3">
                                                        <p class="btn-holder">
                                                            <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                                <i class="fas fa-ticket-alt"></i> Comprar
                                                            </a>
                                                        </p>
                                                    </div>

                                                    <div class="col-12">
                                                        <p style="color: #2D2432">{{$ticket->descripcion}}</p>
                                                    </div>
                                                    @if ($curso->registro_imnas == '1')
                                                        @break
                                                    @endif
                                                @endforeach

                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

{{-- Grid --}}
<section class="primario bg_overley" style="background-color:#CCABBE;" id="contenido">
    <div class="row" >
        <div class="col-12 col-md-6">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Información</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/informacion.png')}}" alt="">
                </div>


                <h4> {{$curso->nombre}}</h4>
                <p class="text_cards_horizon">
                    <?php echo $curso->descripcion?>
                </p>
            </div>

            @if($curso->registro_imnas != '1')
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">Temario</h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/prueba.webp')}}" alt="">
                    </div>

                    <p class="text_cards_horizon">
                        <?php echo $curso->temario?>
                    </p>
                    @if($curso->pdf != NULL)
                    <a class="btn btn-primario " href="{{asset('pdf/'. $curso->pdf) }}" target="_blank">
                        <div class="d-flex justify-content-start">
                            <p class="card_tittle_btn my-auto">
                                Descargar
                            </p>
                            <div class="card_bg_btn ">
                                <i class="fas fa-file-pdf card_icon_btn"></i>
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            @endif

            @if($curso->registro_imnas != '1')
                @if($curso->visibilidad_faqs == '0')

                @else
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">Preguntas Frecuentes</h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/mujer_preguntas.png')}}" alt="">
                    </div>

                    <p class="text_preguntas_material">
                        <strong>1. ¿Es necesario tener conocimientos previos?</strong><br>
                        No se requiere ningún conocimiento ni estudios previos, comenzamos desde 0% y cualquier persona que esté interesada en la materia, lo puede estudiar.<br>
                    </p>
                    @if ($curso->modalidad == 'Presencial')
                        <p class="text_preguntas_material">
                            <strong>2. Nuestros cursos y diplomados presenciales están divididos en dos partes:</strong><br>
                            <strong>Teoría: </strong><br> Se llevará a cabo en la las instalaciones de Instituto. El profesor contará con apoyo visual para brindar la teoría necesaria para su compresión, así mismo se compartirán los PDF´s de las clases. <br><br>
                            <strong>Práctica: </strong> <br> Se llevará a cabo con modelo en vivo  y podrás preguntar tus dudas al momento, la práctica se llevará de la mano con el profesor en donde se reforzará lo aprendido.
                        </p>
                    @else
                    <p class="text_preguntas_material">
                        <strong>2. Nuestros cursos y diplomados online están divididos en dos partes:</strong><br>
                        <strong>Teoría: </strong><br> Se llevará a cabo mediante Google Meet. El profesor contará con apoyo visual para brindar la teoría necesaria para su compresión, así mismo se compartirán los PDF´s de las clases. <br><br>
                        <strong>Práctica: </strong> <br> Se llevará a cabo con modelo en vivo  y podrás preguntar tus dudas al momento, la práctica se llevará de la mano con el profesor en donde se reforzará lo aprendido.
                    </p>
                    @endif
                    <p class="text_preguntas_material">
                        <strong>3. ¿Cómo obtengo mi Documento Oficial?</strong><br>
                        @if ($curso->sep == '1' || $curso->imnas == '1' || $curso->redconocer == '1')
                            @if ($curso->nombre == 'Diplomado de Mesoterapia Facial y Corporal')
                                Registro IMNAS<br>
                            @else
                                Registro IMNAS o Red CONOCER<br>
                            @endif
                        1. Sube a la plataforma tu información oficial.<br>
                        2. Si resides fuera de la Ciudad de México (CDMX), te informamos que para recibir tus documentos, será necesario cubrir un costo de envío de $250 MXN.<br>
                        Si te encuentras dentro de la CDMX, tendras que recoger tus documentos en nuestras instalaciones. Para ello, será necesario programar una cita previa.<br>
                        3. IMNAS tendrá máximo un mes para enviarte el documento por paquetería.<br><br>
                        @elseif ($curso->stps == '1')
                        Diploma STPS<br>
                        1. No se necesita ningún proceso de gestoría al término del curso.<br>
                        2. IMNAS te enviará tu diploma a tu correo en máximo una semana.
                        @elseif ($curso->unam == '1')
                        UNAM<br>
                        Te contactará la gestora via whatsApp para el envió de tu Documento Oficial.
                        @endif
                    </p>
                    @if ($curso->modalidad == 'Presencial')
                    <p class="text_preguntas_material">
                        <strong>4. ¿Mi curso incluye material?</strong><br>
                        No, el material de clase deberás adquirirlo por tu cuenta, pero no te preocupes podrás adquirirlo en las instalaciones. Recuerda que el total de tu pago solo incluye el producto para la práctica
                    </p>
                    @else
                    <p class="text_preguntas_material">
                        <strong>4. ¿Las clases quedan grabadas permanentemente?</strong><br>
                        No, después de haber concluido tu clase, tendrás la grabación disponible por <strong>72 horas </strong>para consultarla a la hora que desees. <br>
                        Recuerda que podrás visualizarla en tu perfil, el cual se creará con el número telefónico que proporcionaste al realizar tu compra
                    </p>
                    @endif
                    @if ($curso->modalidad == 'Presencial')
                        <p class="text_preguntas_material">
                            <strong>5. ¿Dónde se impartirá mi curso?</strong><br>
                            Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
                        </p>
                    @else
                        <p class="text_preguntas_material">
                            <strong>5. ¿En qué plataforma se impartirá mi curso?</strong><br>
                            Google meet
                        </p>
                    @endif
                    @if ($curso->modalidad == 'Presencial')
                        <p class="text_preguntas_material">
                            <strong>6. ¿Cuál es el siguiente paso después de haber adquirido mi curso?</strong><br>
                            Una vez realizada tu compra, te llegará un correo de confirmación de pago y posteriormente uno con la dirección de tu clase, es necesario revisar la bandeja de spam.
                        </p>
                        @else
                        <p class="text_preguntas_material">
                            <strong>6. ¿Cuál es el siguiente paso después de haber adquirido mi curso?</strong><br>
                            Una vez realizada tu compra, te llegará un correo de confirmación de pago y posteriormente uno con la liga de tu clase, es necesario revisar la bandeja de spam.
                        </p>
                    @endif
                    <p class="text_preguntas_material">
                        <strong>7. ¿Tiene un costo extra tramitar mis Documentos Oficiales?</strong><br>
                        No, al comprar el curso ya te incluye los Documentos Oficiales.<br>
                    </p>
                    @if ($curso->modalidad == 'Presencial')
                        <p class="text_preguntas_material">
                            <strong>8. ¿Puedo pagar en efectivo?</strong><br>
                            Claro, si no te es posible pagar por la plataforma puedes llegar a pagar a la sede.
                        </p>
                    @endif
                </div>
                @endif
            @endif

        </div>

        <div class="col-12 col-md-6">

            @if($curso->visibilidad_carusel == '0')

            @else
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">
                            Galeria
                        </h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/picture.png')}}" alt="">
                    </div>

                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="row">

                                @foreach ($noticias_gallery as $item)

                                    <div class="col-12">
                                        @if ($item->estatus === 'Activo')
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                                                <div class="d-flex justify-content-center">
                                                    <h6 class="title_curso mb-3" style="color: #2D2432">
                                                        {{ $item->titulo }}
                                                    </h6>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <p class="text_cards_horizon text-left">
                                                        {{ $item->descripcion }}
                                                    </p>
                                                </div>

                                                @if ($item->tipo === 'imagen')
                                                    <img src="{{asset('noticias/'.$item->multimedia) }}" class="d-block w-100" alt="...">
                                                    @elseif ($item->tipo === 'Video')
                                                    <video controls autoplay>
                                                            <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                                                    </video>
                                                @endif

                                                <div class="d-flex justify-content-center">
                                                    <p class="text-center text-white">
                                                        <a href="{{ $item->link }}" class="btn btn-sm btn_enfiar_form text-white" style="background: #2D2432;">Ver Más</a>
                                                    </p>
                                                </div>

                                            </div>

                                        @endif
                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
            @endif

            @if($curso->registro_imnas != '1')
                @if($curso->visibilidad_productos == '0')

                @else
                    <div class="card_single_horizon">
                        <div class="d-flex justify-content-between">
                            <h2 class="title_curso mb-3">
                                @if ($curso->modalidad == 'Presencial')
                                Materiales
                                @else
                                Productos
                                @endif
                            </h2>
                            <img class="icon_nav_course" src="{{asset('assets/user/icons/carrito-de-compras.webp')}}" alt="">
                        </div>


                        @if ($curso->modalidad == 'Presencial')
                        <p class="text_cards_horizon text-left">El material de clase es obligatorio traerlo, en caso de no tenerlo, contamos con tienda dentro de las instalaciones para que puedas hacer la compra de tu material.</p>
                        @else
                        <p class="text_cards_horizon text-left">El producto de clase es opcional, en caso de quererlo puedes checarlo en nuestra tienda en línea dándole click en la imagen o el botón.</p>
                        @endif
                        @if ($curso->materiales != NULL)
                            <p class="text-left">
                                    <a class="example-image-link" href="{{asset('materiales/'.$curso->materiales) }}" data-lightbox="example-2" data-title="{{$curso->nombre}}">
                                        <img id="img_material_clase example-image" src="{{asset('materiales/'.$curso->materiales) }}" alt="material de clase" style="width: 40%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                                    </a>
                            </p>
                            @if ($curso->btn_cotizacion != NULL)
                                <p class="text-left btn-holder mt-2">
                                    <a class="btn_ticket_comprar text-center" href="{{ $curso->btn_cotizacion}}"  role="button" target="_blank">
                                    Comprar Material
                                    </a>
                                </p>
                            @endif
                        @endif
                    </div>
                @endif
            @endif

            @if($curso->registro_imnas != '1')
                @if($curso->visibilidad_liga_clase == '0')

                @else
                <div class="card_single_horizon">
                        <div class="d-flex justify-content-between">
                            <h2 class="title_curso mb-3">
                                @if ($curso->modalidad == 'Presencial')
                                Dirección
                                @else
                                Liga Clase
                                @endif
                            </h2>
                            <img class="icon_nav_course" src="{{asset('assets/user/icons/meet.png')}}" alt="">
                        </div>

                        @if ($curso->modalidad == 'Presencial')
                        <div class="d-flex justify-content-start">

                            @if ($curso->mapa_iframe == NULL)

                            <iframe class="map_custom2 mt-3 mb-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                            @else

                            <iframe class="map_custom2 mt-3 mb-3" src="{{  $curso->mapa_iframe }}"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                            @endif


                        </div>

                        <p class="text_cards_horizon ">
                            @if ($curso->direccion == NULL)

                            <a href="https://goo.gl/maps/NRt7RT1TEkEnfDW38" target="_blank" style="text-decoration: none;color:#2D2432">Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México</a>

                            @else
                                <p class="">{{ $curso->direccion }}</p>
                            @endif

                        </p>
                        @else

                        <p class="text_cards_horizon">
                        Por favor inicie sesión y en caso de haber comprado este curso podra ver la liga de meet para su clase.
                        </p>
                            @guest
                                    <p class="text_cards_horizon text-left">
                                        Por favor inicie sesión y en caso de haber comprado este curso podra ver la liga de meet para su clase.
                                    </p>
                                @else
                                @if ($usuario_compro != NULL)
                                    @if ($curso->modalidad == 'Presencial')
                                    @else
                                        <h4 class="text-left title_curso">Enlace de la reuinion</h4>
                                        <a class="text-left registro_num2 mt-3 mb-5" href="{{$curso->recurso}}" style="" target="_blank">
                                            {{$curso->recurso}}
                                        </a>
                                    @endif
                                @else
                                    <p class="text_cards_horizon text-left">
                                        Usted no ha comprado este curso, si tiene alguna duda nos la puede hacer saber por WhatsApp y con gusto se la resolveremos.
                                    </p>
                                @endif
                            @endguest
                        @endif
                </div>
                @endif
            @endif

            @if($curso->registro_imnas != '1')
                @if($curso->visibilidad_doc == '0')

                @else
                    <div class="card_single_horizon">
                        <div class="d-flex justify-content-between">
                            <h2 class="title_curso mb-3">
                                Documentos
                            </h2>
                            <img class="icon_nav_course" src="{{asset('assets/user/icons/documentos.png')}}" alt="">
                        </div>
                            <div class="row">
                                    @if ($curso->nombre == 'Diplomado en DERMAPEN')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" data-bs-toggle="modal" data-bs-target="#redconcer">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <?php echo $curso->texto_conocer?>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($curso->nombre == 'Diplomado en Regulación y Administración de Spa ante COFEPRIS')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" data-bs-toggle="modal" data-bs-target="#cofepris">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <?php echo $curso->texto_conocer?>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($curso->nombre == 'Diplomado en Cosmetología y Cosmiatría SEP Facial y Corporal')
                                    <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                        <div class="d-flex justify-content-center">
                                            <div class="card_certificaciones" style="position: relative">
                                                    <a class="text-center" data-bs-toggle="modal" data-bs-target="#dccsfc">
                                                        <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                    </a>
                                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </div>
                                        </div>
                                        <p class="text-center">
                                            <?php echo $curso->texto_conocer?>
                                        </p>
                                    </div>
                                    @endif
                                    @if ($curso->nombre == 'Diplomado en Cosmetología SEP y Cosmiatría UNAM Facial y Corporal')
                                    <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                        <div class="d-flex justify-content-center">
                                            <div class="card_certificaciones" style="position: relative">
                                                    <a class="text-center" data-bs-toggle="modal" data-bs-target="#dcscufc">
                                                        <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                    </a>
                                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </div>
                                        </div>
                                        <p class="text-center">
                                            <?php echo $curso->texto_conocer?>
                                        </p>
                                    </div>
                                    @endif
                                    @if ($curso->nombre == 'Diplomado en Auxiliar de Enfermería en Cuidados Básicos de Atención Médica')
                                    <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                        <div class="d-flex justify-content-center">
                                            <div class="card_certificaciones" style="position: relative">
                                                    <a class="text-center" data-bs-toggle="modal" data-bs-target="#enfer">
                                                        <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                    </a>
                                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </div>
                                        </div>
                                        <p class="text-center">
                                            <?php echo $curso->texto_conocer?>
                                        </p>
                                    </div>
                                    @endif
                                    @if ($curso->nombre == 'Diplomado Desarrollo Educativo')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                    <a class="text-center" data-bs-toggle="modal" data-bs-target="#educativo">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                    {{-- <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" > --}}
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <?php echo $curso->texto_conocer?>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($curso->nombre == 'Mes Becario EC0046')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" >
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                EC0046 - Prestación de servicios Cosmetológicos Faciales
                                            </p>
                                        </div>
                                    @endif
                                    @if ($curso->nombre == 'Mes Becario EC0010')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" >
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                EC0010 - Prestación de Servicios Estéticos Corporales
                                            </p>
                                        </div>
                                    @endif

                                    @if ($curso->nombre == 'Diplomado de Cosmetología Facial y Corporal')
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" >
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                EC0010 - Prestación de Servicios Estéticos Corporales
                                            </p>
                                        </div>

                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" >
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                        </a>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                EC0046 - Prestación de servicios Cosmetológicos Faciales
                                            </p>
                                        </div>
                                    @endif

                                    @if($curso->sep == 1)
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                    <a class="text-center" data-bs-toggle="modal" data-bs-target="#revoe">
                                                        <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/revoe.png')}}" alt="">
                                                    </a>
                                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <?php echo $curso->texto_rvoe?>
                                            </p>
                                        </div>
                                    @endif

                                    @if ($curso->unam == 1)
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" data-bs-toggle="modal" data-bs-target="#unam">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                                                        </a>
                                                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <strong>En caso de ser Médico se te dará una constancia UNAM a través de la facultad de estudios Superiores Zaragoza,
                                                    de lo contrario se te dará un Diploma STPS</strong>
                                            </p>
                                        </div>
                                    @endif

                                    @if ($curso->imnas == 1)
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" data-bs-toggle="modal" data-bs-target="#imnas_collage">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/imnas.png')}}" >
                                                        </a>
                                                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            @if ($curso->titulo_hono == 1)
                                                <p class="text-center">
                                                    <strong>Título Honorífico</strong>
                                                </p>
                                            @else
                                                <p class="text-center">
                                                    <strong>Documentos de Certificadora Nacional</strong>
                                                </p>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($curso->stps == 1)
                                        <div class="col-6 col-md-4 me-0 me-sm-2 me-md-3 me-lg-5">
                                            <div class="d-flex justify-content-center">
                                                <div class="card_certificaciones" style="position: relative">
                                                        <a class="text-center" data-bs-toggle="modal" data-bs-target="#stps">
                                                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/stps.png')}}" alt="">
                                                        </a>
                                                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <strong>Diploma STPS</strong>
                                            </p>
                                        </div>
                                    @endif
                            </div>
                    </div>
                @endif
            @endif

            @if($curso->registro_imnas != '1')
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">
                            Fecha y Hora
                        </h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="">
                    </div>
                    <p class="text_cards_horizon">
                        @if ($curso->sin_fin_fecha == '1')
                            {{$fecha_inicial}},  {{$curso->mensaje}} <br>
                        @else
                            {{$fecha_inicial}}
                            @if ($curso->fecha_inicial == $curso->fecha_final)
                            @else
                            al {{$fecha_final}}
                            @endif,
                        @endif
                        @if ($curso->sin_fin == '1')
                            {{$hora_inicial}}</p>
                        @else
                            {{$hora_inicial}} - {{$hora_final}}</p>
                        @endif
                    </p>
                    <h2 class="title_curso">Modalidad</h2>
                    <p class="text_cards_horizon">
                        @if ($curso->modalidad == 'Presencial')
                        Castilla 136, Álamos, Benito Juárez, 03400, CDMX
                        @elseif ($curso->modalidad == 'FACEBOOK LIVE')
                        Online
                        @else
                        Google Meet
                        @endif
                    </p>
                    @if ($curso->estatus == 1)
                    <a class="btn btn-primario space_cs_rs" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="true" aria-controls="collapseinfo" style="display:block ">
                        <div class="d-flex justify-content-start">
                                    @if ($curso->precio == 0)
                                        <p class="card_tittle_btn_grid my-auto">
                                            Registrarse
                                        </p>
                                    @else
                                        <p class="card_tittle_btn_grid my-auto">
                                            Comprar ahora
                                        </p>
                                    @endif
                            <div class="card_bg_btn ">
                                <i class="fas fa-cart-plus card_icon_btn"></i>
                            </div>
                        </div>
                    </a>

                    @if($curso->visibilidad_contactanos == '0')

                    @else
                    <a class="btn btn-secundario space_cs_rs mt-3" href="#contactenos" style="display:block ">
                        <div class="d-flex justify-content-start">
                            <p class="card_tittle_btn my-auto">
                                Contáctanos
                            </p>
                            <div class="card_bg_btn_secundario">
                                <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                            </div>
                        </div>
                    </a>
                    @endif

                    <div class="collapse show mt-3" id="collapseinfo">
                        <div class="card card-body card_colapsable_comprar">
                            @if($curso->precio == 0)
                                <div class="row mb-3">
                                    <form method="POST" action="{{ route('clases_gratis') }}"role="form">
                                        @csrf
                                        <input type="hidden" name="ticket" id="ticket" class="form-control input_custom_checkout" value="{{$curso->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group flex-nowrap mt-4">
                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                    <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="input-group flex-nowrap mt-4">
                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                    <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="input-group flex-nowrap mt-4">
                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                    <input type="number" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn_pagar_checkout " type="submit">Registrarse</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="row mb-3">
                                    @foreach ($tickets as $ticket)
                                    @php
                                            $precio = number_format($ticket->precio, 2, '.', ',');
                                    @endphp
                                        <div class="col-12 mt-3">
                                            <strong style="color: #2D2432">{{$ticket->nombre}}</strong>
                                        </div>
                                        <div class="col-6 col-lg-8 mt-3">
                                            @if ($ticket->descuento == NULL)
                                                <h5 style="color: #2D2432"><strong>${{$precio}}</strong></h5>
                                            @else
                                                <del style="color: #2D2432"><strong>De ${{$precio}}</strong></del>
                                                <h5 style="color: #2D2432"><strong>A ${{$ticket->descuento}}</strong></h5>
                                            @endif
                                        </div>

                                        <div class="col-6 col-lg-4 mt-3">
                                            <p class="btn-holder">
                                                <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                    <i class="fas fa-ticket-alt"></i> Comprar
                                                </a>
                                            </p>
                                        </div>

                                        <div class="col-12">
                                            <p style="color: #2D2432">{{$ticket->descripcion}}</p>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            @endif

            @if($curso->visibilidad_metodos_pago == '0')

            @else

                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">
                            Pago mediante depósitos
                        </h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/depositar.png')}}" alt="">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text_cards_horizon">
                                Si no te es posible realizar el pago por medio de la página,
                                lo podrás hacer mediante estas cuentas enviando tu comprobante al
                                siguiente número de WhatsApp:
                                @if ($curso->nombre == 'Mes Becario EC0010' || $curso->nombre == 'Mes Becario EC0046')
                                    <a href="tel:+52 1 55 2220 8900" target="_blank" r>55 2220 8900</a>
                                @else
                                    <a href="tel:+52 1 55 3116 7046" target="_blank" r>55 3116 7046</a>
                                @endif
                                con tu nombre completo y nombre del curso y/o diplomado que elegiste.
                            </p>
                        </div>
                        <div class="col-12">
                            <a class="text-center" data-bs-toggle="modal" data-bs-target="#depositos">
                            <img class="img_depositos mt-2" src="{{asset('webpage/'.$webpage->img_cuenta_bancaria) }}" alt="">
                            </a>
                        </div>
                        {{-- <div class="col-12">
                            <a class="text-center" data-bs-toggle="modal" data-bs-target="#depositos">
                            <img class="img_depositos mt-2" src="{{asset('assets/user/utilidades/depositos_bbva.jpg')}}" alt="">
                            </a>
                        </div> --}}
                    </div>
                </div>

            @endif

        </div>
    </div>
</section>
@include('user.components.modal_certificados_single');
{{-- Grid --}}


{{--Contactanos --}}
<section class="primario bg_overley" id="contactenos"  style="background-color:#2D2432;">
    <div class="row border_row" style="">

        <div class="col-12 col-md-6">
            <h2 class="text-center tittle-contact">Contáctanos</h2>
            <p class="text-center text-white">
                Complementa tus conocimientos y conviértete un experto de la Cosmetología.
            </p>

            <form method="POST" id="form_contact" action="{{ route('mensaje.form') }}" role="form">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form_contact mt-4" name="nombre" id="nombre" placeholder="Nombre (requerido)" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form_contact mt-4" name="mensaje" id="mensaje" placeholder="Message">
                </div>
                <input type="hidden" class="form-control form_contact mt-4" name="curso" id="curso" value="{{$curso->nombre}}">
                <input type="hidden" class="form-control form_contact mt-4" name="fecha" id="fecha" value="{{$curso->fecha_inicial}}">
                <input type="hidden" class="form-control form_contact mt-4" name="modalidad" id="modalidad" value="{{$curso->modalidad}}">
                <p class="text-center text-white">
                    <button type="submit" class="btn btn_enfiar_form" id="token_submit">Enviar <i class="fab fa-whatsapp"></i></button>
                </p>
            </form>
        </div>

        <div class="col-12 col-md-6 desaparecer_contenedor_sm">
                <div class="d-flex justify-content-center">
                    <img class="img_contact" src="{{asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
                </div>
        </div>

    </div>
</section>

@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/user/custom/lightbox-plus-jquery.min.js')}}"></script>

{{-- <script src="{{asset('assets/user/custom/multistepes.js')}}"></script> --}}
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#token_submit').click(function(e) {
                e.preventDefault();  // Prevenir el envío inmediato del formulario
                grecaptcha.ready(function() {
                    grecaptcha.execute('6LflbR0qAAAAADzEpS4m9oo_7Mftvt7K1OPHjC-D', {
                        action: 'validarUsuario'
                    }).then(function(token) {
                        $('#form_contact').prepend('<input type="hidden" name="token" value="' + token + '" >');
                        $('#form_contact').prepend('<input type="hidden" name="action" value="validarUsuario" >');
                        $('#form_contact').submit();
                    });
                });
            });
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var registroBtn = document.getElementById("registroBtn");
        var formulario = document.getElementById("miFormulario");

        registroBtn.addEventListener("click", function () {
            registroBtn.disabled = true; // Deshabilita el botón después de hacer clic
            registroBtn.textContent = "Registrando..."; // Cambia el texto del botón

            grecaptcha.ready(function() {
                grecaptcha.execute('6LflbR0qAAAAADzEpS4m9oo_7Mftvt7K1OPHjC-D', { action: 'clases_gratis' }).then(function(token) {
                    var tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = 'token';
                    tokenInput.value = token;

                    var actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'clases_gratis';

                    formulario.appendChild(tokenInput);
                    formulario.appendChild(actionInput);

                    formulario.submit(); // Envía el formulario
                }).catch(function(error) {
                    registroBtn.disabled = false; // Rehabilita el botón si ocurre un error
                    registroBtn.textContent = "Registrarse"; // Cambia el texto del botón
                    console.error("reCAPTCHA error:", error);
                });
            });
        });
    });
</script>



<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        paddimg:30,
        nav: false,
        dots:false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            12D2432: {
                items: 3
            }

        }
    })
</script>

@endsection



