@extends('layouts.app_user')

@section('template_title')
    Inicio
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/avales.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/tabs_ubicacion.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/slider_products.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/slide_cursos.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/comentarios.css')}}" rel="stylesheet" />

{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<style>
    #registroBtn[disabled] {
    background-color: #ccc; /* Cambia el color de fondo */
    cursor: not-allowed; /* Cambia el cursor al estilo "no permitido" */
    color: #666; /* Cambia el color del texto */
}
</style>
@endsection
@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp
@section('content')

<section class="primario bg_overley" style="position:relative;background-image: url('{{asset('webpage/'.$webpage->stone_home_bg) }}')">
    <span class="mask"></span>
    <div class="row margin_home_nav">
        <div class="col-12 col-md-6 index_superior">
            <h1 class="text-white titulo space_ttile" style="">
                {{ $webpage->stone_home_tittle }}
            </h1>
            <p class="text-white parrafo" style="">
                {{ $webpage->stone_home_text }}
            </p>
            <div class="d-flex justify-content-center justify-content-md-start space_btn_section1">
                <a class="btn btn-primario me-4" href="{{ route('cursos.index_user') }}">
                    Oferta Educativa
                </a>
                <a class="btn btn-secundario" href="{{ route('user.nosotros') }}">
                    Nosotros
                </a>
            </div>
        </div>

        <div class="col-12 col-md-6 ">
            <div id="carouselExample" class="carousel slide carrusel_space">

                <div class="carousel-inner">

                    @foreach ($cursos as $curso)

                    @php
                        $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
                        $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;

                        $fecha_ini = $curso->fecha_inicial;
                        $fechaInicialCarbon = Carbon::createFromFormat('Y-m-d', $fecha_ini);
                        $nombreDia = $fechaInicialCarbon->locale('es')->isoFormat('dddd');
                        $nombreDiaCapitalizado = ucfirst($nombreDia);

                        $fecha_inicial = $nombreDiaCapitalizado . ' ' . $fechaInicialCarbon->isoFormat('D [de] MMMM');
                    @endphp
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="d-flex justify-content-center">

                            <div class="card card-custom" style="">
                                <img class="card_image" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">
                                <div class="card-body card_body_custom">
                                <h5 class="card-title card_modalidad">{{$curso->modalidad}}</h5>
                                <h3 class="card_titulo">{{$curso->nombre}}</h3>
                                <h4 class="card_date">{{$fecha_inicial}} - {{$hora_inicial}}</h4>

                                <a class="btn btn-primario me-2 me-sm-3" data-bs-toggle="collapse" href="#collapseobjetivos{{$curso->id}}" role="button" aria-expanded="false" aria-controls="collapseobjetivos">
                                    <div class="d-flex justify-content-around">
                                        @if ($curso->precio == 0)
                                            <p class="card_tittle_btn my-auto">
                                                Registrarse
                                            </p>
                                        @else
                                            <p class="card_tittle_btn my-auto">
                                                Comprar ahora
                                            </p>
                                        @endif
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn"></i>
                                        </div>
                                    </div>
                                </a>

                                <a class="btn btn-secundario me-0 me-sm-3" href="{{ route('cursos.show',$curso->slug) }}">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Saber más
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="collapse mt-3" id="collapseobjetivos{{$curso->id}}">
                                            <div class="card card-body card_colapsable_comprar">
                                                <div class="row mb-3">
                                                    @foreach ($tickets as $ticket)
                                                        @if ($ticket->id_curso == $curso->id)
                                                            @if($curso->precio == 0)
                                                                <div class="row mb-3">
                                                                    <form method="POST" action="{{ route('clases_gratis') }}"role="form" id="miFormulario">
                                                                        @csrf
                                                                        <input type="hidden" name="ticket" id="ticket" class="form-control input_custom_checkout" value="{{$curso->id}}">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="input-group flex-nowrap mt-4">
                                                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                                                    <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre(s)" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="input-group flex-nowrap mt-4">
                                                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-male"></i></span>
                                                                                    <input type="text" name="ape_paterno" id="ape_paterno" class="form-control input_custom_checkout" placeholder="Apellido Paterno" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="input-group flex-nowrap mt-4">
                                                                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-female"></i></span>
                                                                                    <input type="text" name="ape_materno" id="ape_materno" class="form-control input_custom_checkout" placeholder="Apellido Materno" required>
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
                                                                                    <button class="btn_pagar_checkout " type="submit" id="registroBtn">Registrarse</button>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <div class="col-12 mt-3">
                                                                    <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                                                </div>
                                                                <div class="col-6 mt-3">
                                                                    @if ($ticket->descuento == NULL)
                                                                        <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                                    @else
                                                                        <del style="color: #836262"><strong>De ${{$ticket->precio}}</strong></del>
                                                                        <h5 style="color: #836262"><strong>A ${{$ticket->descuento}}</strong></h5>
                                                                    @endif
                                                                </div>

                                                                <div class="col-6 mt-3">
                                                                    <p class="btn-holder">
                                                                        <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                                            <i class="fas fa-ticket-alt"></i> Comprar
                                                                        </a>
                                                                    </p>
                                                                </div>

                                                                <div class="col-12">
                                                                    <p style="color: #836262">{{$ticket->descripcion}}</p>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

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
    </div>
</section>

<section class="primario bg_overley mb-lg-0 mb-md-0 mb-5" style="background-color:#F5ECE4;">

    <div class="row mt-5">

        <div class="col-6 col-md-3 ">
            <div class="d-flex justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#redconcer">
                    <div class="card_certificaciones" style="position: relative">
                        <p class="text-center">
                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                        </p>
                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                    </div>
                </a>
            </div>

        </div>

        <div class="col-6 col-md-3 ">
            <div class="d-flex justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#revoe">
                <div class="card_certificaciones" style="position: relative">
                    <p class="text-center">
                        <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/revoe.png')}}" alt="">
                    </p>
                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                </div>
                </a>
            </div>

        </div>

        <div class="col-6 col-md-3 mt-3 mt-md-0">
            <div class="d-flex justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#unam">
                    <div class="card_certificaciones" style="position: relative">
                        <p class="text-center">
                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                        </p>
                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                    </div>
                </a>
            </div>

        </div>

        <div class="col-6 col-md-3 mt-3 mt-md-0">
            <div class="d-flex justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#stps">
                    <div class="card_certificaciones" style="position: relative">
                        <p class="text-center">
                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/stps.png')}}" alt="">
                        </p>
                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 mt-3 mt-md-4 mt-lg-5 mt-md-0">
            <div class="d-flex justify-content-center">
                <a data-bs-toggle="modal" data-bs-target="#registro_nacianal">
                    <div class="card_certificaciones" style="position: relative">
                        <p class="text-center">
                            <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/registro_nacional.png')}}" alt="">
                        </p>
                        <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                    </div>
                </a>
            </div>
        </div>

    </div>

</section>


<section class="primario bg_overley" style="background-color:#836262;"id="tienda">
    <div class="row">

        <div class="col-12 p-3">
                    <div id="carousel_tiendita" class="carousel slide">
                        <div class="carousel-inner">
                           @foreach ($noticias_inicio as $item)
                                @if ($item->seccion === 'Inicio')

                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <div class="d-flex justify-content-center">
                                                <div class="card card-custom space_Card mb-3 mt-lg-3 mt-md-5" style="">
                                                    @if ($item->tipo === 'imagen')

                                                        <img class="card_image" src="{{asset('noticias/'.$item->multimedia) }}"  style="width: 100%;">

                                                    @elseif ($item->tipo === 'Video')

                                                    <video controls autoplay muted>
                                                            <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                                                        </video>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 col-md-6 my-auto">
                                            <h1 class="text-white text-center titulo mt-3 mb-3  mt-md-5 mb-md-5" style="">{{ $item->titulo }}</h1>
                                            <p class="text-center text-white mt-auto parrafo_instalaciones">
                                                {{ $item->descripcion }}
                                            </p>

                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-cuarto" style="margin-left: 1rem;" target="_blank" href="{{ $item->link }}">
                                                    Ver
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif
                           @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel_tiendita" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carousel_tiendita" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>
        </div>

    </div>
</section>


<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">

        <div class="col-12 tittle_section2 mb-3">
            <h2 class="titulo_alfa text-center">Materializa tus metas</h2>
            <h3 class="titulo_beta text-center">Da tu primer paso con nosotros</h3>
            <div class="d-flex justify-content-center">
            </div>
        </div>

        <div class="col-12 col-md-6 objetivos_mt">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">AMAS DE CASA</p>
                            <p class="text-center card_text_objetivos">Aprovecha tu tiempo libre</p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/EMPRENDEDORA.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">EMPRENDEDORAS</p>
                            <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-end">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                            <p class="text-center card_text_objetivos">Construye una carrera profesional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/apasionada.webp')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">APASIONADAS POR LA BELLEZA</p>
                            <p class="text-center card_text_objetivos">
                                Ya eres una profesional, ahora
                                estudia tu pasión.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/MEDICOS.png')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">MÉDICOS</p>
                            <p class="text-center card_text_objetivos">

                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6 py-3">
                    <div class="d-flex justify-content-start">
                        <div class="card_objetivos">
                            <p class="text-center">
                                <img class="img_card_objetivos" src="{{asset('assets/user/icons/EXPERTOS DE LA SALUD.png')}}" alt="">
                            </p>
                            <p class="text-center card_title_objetivos">APASIONADAS POR LA SALUD</p>
                            <p class="text-center card_text_objetivos">
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Nuestros Beneficios --}}
        <div class="col-12 col-md-6 objetivosmin_mt">
            <h2 class="titulomin_alfa text-center mb-4">Nuestros Beneficios</h2>

            <div class="row ">
                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/certificado-de-garantia.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Garantía de estudiar en una escuela avalada por las máximas dependencias gubernamentales y la máxima casa de estudios, UNAM.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/clase.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Las clases son teórico-demostrativas, donde el profesor realizará el procedimiento con modelo en vivo.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/documentos.png')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        La documentación que recibirás estará avalada por la UNAM, SEP o STPS
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Nuestros <strong style="font-weight: bold">cursos, carreras y diplomados</strong> quedarán grabados por 72 hrs para que puedas verlos nuevamente.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Recibirás material de apoyo de acuerdo a tu clase como: ponencia módulo por módulo, fichas técnicas, libros digitales, grabación de la clase, catálogos y más.
                    </p>
                </div>

                <div class="col-2 py-2">
                    <div class="point_icon_beneficios">
                        <img class="img_icon_beneficios" src="{{asset('assets/user/icons/aprender-en-linea-1.webp')}}" alt="">
                    </div>
                </div>
                <div class="col-10 py-2">
                    <p class="text-left text_beneficios">
                        Nuestros <strong style="font-weight: bold">cursos, carreras y diplomados</strong> van dirigidos a personas sin conocimiento que quieran prepararse desde cero o que cuentan con conocimiento y experiencia previa.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- slide de cursos --}}
@include('user.components.carousel_courses')
{{-- slide de cursos --}}

{{-- Estandares --}}
@include('user.components.estandares')
{{-- Estandares --}}

{{--Laboratorio --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="titulomin_alfa espaciodor_lab text-left  mb-4" style="margin-left: 30px;">{{ $webpage->stfive_home_tittle }}</h2>
            <p class="text-left text_beneficios espaciodor_lab_text mb-4">
                {{ $webpage->stfive_home_text }}
            </p>
            <div class="row">
                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                                <img class="img_rounded_lab" src="{{asset('assets/user/icons/icono-bb-glow-1.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                            <img class="img_rounded_lab" src="{{asset('assets/user/icons/icono-corporal.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                            <img class="img_rounded_lab" src="{{asset('assets/user/icons/icono-facial.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-3" style="">
                    <div class="d-flex justify-content-center">
                        <div class="rounded_lab">
                            <p class="text-center">
                            <img class="img_rounded_lab" src="{{asset('assets/user/icons/icono-relex-1.webp')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col_adaptable_mobil mt-5">
                    <a class="btn btn-cuarto" style="margin-left: 1rem;" target="_blank" href="http://imnasmexico.com/new/tienda/">
                        Ver Catálogo
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="row margin_galery_lab">

                <div class="col-12 mb-3">
                        <img class="img_lab_principal" src="{{asset('assets/user/utilidades/IMAGEN LABORATORIO.png')}}" alt="">

                </div>
            </div>
        </div>
    </div>
</section>

{{--Productos--}}
@include('user.components.carousel_productos')
{{--Productos--}}

{{--UNAM --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 col-md-6">
            <div id="slide_unam" class="carousel slide space_unam">

                <div class="carousel-inner">
                    @foreach ($unam as $item)
                    @php
                        $dia = date("d/m", strtotime($item->fecha_inicial));
                    @endphp
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="d-flex justify-content-center">
                                <div class="card card-custom" style="">
                                    <img class="card_image" src="{{asset('curso/'. $item->foto) }}" class="card-img-top" alt="...">
                                    <div class="card-body card_body_custom">
                                    <h5 class="card-title card_modalidad">{{$item->modalidad}}</h5>
                                    <h3 class="card_titulo">{{$item->nombre}}</h3>
                                    <h4 class="card_date">{{$dia}}</h4>

                                    <a class="btn btn-primario me-3">
                                        <div class="d-flex justify-content-around" data-bs-toggle="collapse" href="#collapseobjetivos{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseobjetivos">
                                            <p class="card_tittle_btn my-auto">
                                                Comprar ahora
                                            </p>
                                            <div class="card_bg_btn ">
                                                <i class="fas fa-cart-plus card_icon_btn"></i>
                                            </div>
                                        </div>
                                    </a>

                                    <a class="btn btn-secundario me-1" href="{{ route('cursos.show',$item->slug) }}">
                                        <div class="d-flex justify-content-around">
                                            <p class="card_tittle_btn my-auto">
                                                Saber más
                                            </p>
                                            <div class="card_bg_btn_secundario">
                                                <i class="fas fa-plus card_icon_btn_secundario"></i>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="collapse mt-3" id="collapseobjetivos{{$item->id}}">
                                        <div class="card card-body card_colapsable_comprar">
                                            <div class="row mb-3">
                                                @foreach ($tickets as $ticket)
                                                @if ($ticket->id_curso == $item->id)
                                                    <div class="col-12 mt-3">
                                                        <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        @if ($ticket->descuento == NULL)
                                                            <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                        @else
                                                            <del style="color: #836262"><strong>De ${{$ticket->precio}}</strong></del>
                                                            <h5 style="color: #836262"><strong>A ${{$ticket->descuento}}</strong></h5>
                                                        @endif
                                                    </div>

                                                    <div class="col-12 mt-3">
                                                        <p class="btn-holder">
                                                            <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                                <i class="fas fa-ticket-alt"></i> Comprar
                                                            </a>
                                                        </p>
                                                    </div>

                                                    <div class="col-12">
                                                        <p style="color: #836262">{{$ticket->descripcion}}</p>
                                                    </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#slide_unam" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#slide_unam" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <h2 class="titulomin_alfa espaciodor_unam_text text-left mb-4">
                ¡Avalados ante la casa máxima <br>
                de estudios UNAM!
            </h2>
            <p class="text-left text_beneficios espaciodor_lab_text mb-4" style="margin-left: 0px!important">
                Medicina Estética <br>
                Cosmiatría estética
            </p>
            <p class="registro_num2 mt-3 mb-5">
                Número de Registro : 60616-1263-17-X-22
            </p>
            <div class="row">
                <div class="col-6 col-md-3 spaciador_logos_unam">
                    <div class="d-flex justify-content-center">
                        <div class="card_certificaciones">
                            <p class="text-center">
                                <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/DOCTORA.png')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 spaciador_logos_unam">
                    <div class="d-flex justify-content-center">
                        <div class="card_certificaciones">
                            <p class="text-center">
                                <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@include('user.components.comentarios')

{{-- Ubicacion --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row">
        <div class="col-12 espaciador_ubicacion">

            <div class="d-flex justify-content-center">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation" style="margin-right: 30px;">
                    <button class="nav-link active" id="pills-alamos-tab" data-bs-toggle="pill" data-bs-target="#pills-alamos" type="button" role="tab" aria-controls="pills-alamos" aria-selected="true">
                        <i class="fas fa-map-marker-alt"></i> Álamos
                    </button>
                    </li>

                    {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-churubusco-tab" data-bs-toggle="pill" data-bs-target="#pills-churubusco" type="button" role="tab" aria-controls="pills-churubusco" aria-selected="false">
                        <i class="fas fa-map-marker-alt"></i> Churubusco
                    </button>
                    </li> --}}

                </ul>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-alamos" role="tabpanel" aria-labelledby="pills-alamos-tab" tabindex="0">

                        <iframe class="map_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

                    {{-- <div class="tab-pane fade" id="pills-churubusco" role="tabpanel" aria-labelledby="pills-churubusco-tab" tabindex="0">
                        <iframe class="map_custom" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15057.050845494474!2d-99.12426469013091!3d19.35777413013712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe13ff298e83%3A0xbf7af804aa5b83a4!2sSur%20109-A%20260%2C%20H%C3%A9roes%20de%20Churubusco%2C%20Iztapalapa%2C%2009090%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1678243972623!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div> --}}

                </div>
            </div>



        </div>
    </div>
</section>
{{-- Ubicacion --}}

@include('user.components.modal_certificados');

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="{{asset('assets/user/custom/multistepes.js')}}"></script> --}}
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<style>

</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var registroBtn = document.getElementById("registroBtn");
        var formulario = document.getElementById("miFormulario"); // Reemplaza "miFormulario" con el ID de tu formulario

        registroBtn.addEventListener("click", function () {
            registroBtn.disabled = true; // Deshabilita el botón después de hacer clic
            registroBtn.textContent = "Registrando..."; // Cambia el texto del botón
            formulario.submit(); // Envía el formulario
        });
    });
</script>
<script>

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        left:30,
        paddimg:30,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }

        }
    })
</script>

@endsection


