@extends('layouts.app_user')

@section('template_title')
   {{$curso->nombre}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/grid_cursos.css')}}" rel="stylesheet" />
{{-- css carrusel --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
@endsection

@section('content')

<section class="primario bg_overley" style="background:#836262;">

    <div class="tab_section margin_home_nav desaparecer_contenedor_sm">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Informacion</p>
                    <div class="content_nav d-inline-block">
                        <i class="fas fa-info-circle icon_nav_course2"></i>
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-objetivos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-objetivos" type="button" role="tab" aria-controls="v-pills-objetivos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Objetivos</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/objetivo.webp')}}" alt="">
                    </div>
                </div>
            </button>

              <button class="nav-link" id="v-pills-temarios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-temarios" type="button" role="tab" aria-controls="v-pills-temarios" aria-selected="false" >
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Temarios</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/prueba.webp')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-documentos" type="button" role="tab" aria-controls="v-pills-documentos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Documentos</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-dirijido-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dirijido" type="button" role="tab" aria-controls="v-pills-dirijido" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Preguntas</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/personas.webp')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-recursos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-recursos" type="button" role="tab" aria-controls="v-pills-recursos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Recursos</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                    </div>
                </div>
              </button>

            </div>

            <div class="tab-content" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-informacion" role="tabpanel" aria-labelledby="v-pills-informacion-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-lg-7">
                        <h1 class="title_curso">
                            {{$curso->nombre}}
                        </h1>

                        <p class="tittle_abstract mt-5 mb-5">
                            <?php echo $curso->descripcion?>
                        </p>

                        <h2 class="title_curso">Fecha y Hora</h2>

                        <p class="tittle_abstract ">
                            {{$curso->fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                            {{$curso->fecha_final}}
                            @endif, {{$curso->hora_inicial}} - {{$curso->hora_final}}
                        </p>

                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-objetivos" role="tabpanel" aria-labelledby="v-pills-objetivos-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-lg-7">

                        <h2 class="title_curso mb-5">Objetivo</h2>

                        <p class="tittle_abstract mt-3 mb-3">
                            <?php echo $curso->objetivo?>
                        </p>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs  mt-5" data-bs-toggle="collapse" href="#collapseobjetivos" role="button" aria-expanded="false" aria-controls="collapseobjetivos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseobjetivos">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-lg-7">

                        <h2 class="title_curso mb-5">Temario</h2>

                        <p class="tittle_abstract ">
                            <?php echo $curso->temario?>
                        </p>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapsetemario" role="button" aria-expanded="false" aria-controls="collapsetemario">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapsetemario">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-lg-7">

                        <h2 class="title_curso mb-5">Certificaciones</h2>

                        <div class="row">
                            @if ($curso->redconocer == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($curso->sep == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/revoe.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->unam == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->imnas == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/imnas.webp')}}" >
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->stps == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/stps.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">
                <div class="row">
                    <div class="col-6 ">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">AMAS DE CASA</p>
                                <p class="text-center card_text_objetivos">Aprovecha tu tiempo libre</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">EMPRENDERORAS</p>
                                <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                                <p class="text-center card_text_objetivos">Construye una carera profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">APASIONADAS POR LA BELLEZA</p>
                                <p class="text-center card_text_objetivos">
                                    Ya eres una profesional, ahora
                                    estudia tu pasión.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-recursos" role="tabpanel" aria-labelledby="v-pills-recursos-tab" tabindex="0">
                @guest
                    <div class="row">
                        <div class="col-12">
                            <h2 class="title_curso text-center mb-5">Rescursos</h2>
                        </div>

                        <div class="col-12 m-auto">
                                <p class="  ">
                                   Por favor inicie sesion y en caso de haber comprado este curso podra ver la direccion o liga de meet para su clase
                                </p>
                        </div>
                    </div>
                @else
                    @if ($usuario_compro != NULL)
                        @if ($curso->modalidad == 'Presencial')
                        <div class="row">
                            <div class="col-6">
                                <h2 class="title_curso text-center mb-5">Ubicacion</h2>
                                <div class="d-flex justify-content-center">
                                    <iframe class="map_custom2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>

                            <div class="col-6 m-auto">
                                    <p class="  ">
                                        Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
                                    </p>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-12 mt">
                                <h2 class="text-center title_curso">Enlace de la reuinion</h2>

                                <a class="text-center registro_num2 mt-3 mb-5" href="{{$curso->recurso}}" style="" target="_blank">
                                    {{$curso->recurso}}
                                </a>

                            </div>
                        </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-12">
                                <h2 class="title_curso text-center mb-5">Rescursos</h2>
                            </div>

                            <div class="col-12 m-auto">
                                    <p class="  ">
                                        Usted no ha comprado este curso
                                    </p>
                            </div>
                            @if ($curso->estatus == 1)
                                <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapsetemario" role="button" aria-expanded="false" aria-controls="collapsetemario">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Comprar ahora
                                        </p>
                                        <div class="card_bg_btn ">
                                            <i class="fas fa-cart-plus card_icon_btn"></i>
                                        </div>
                                    </div>
                                </a>

                                <a class="btn btn-secundario space_cs_rs mt-5">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Contactar
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                                <div class="collapse mt-3" id="collapsetemario">
                                    <div class="card card-body card_colapsable_comprar">
                                        <div class="row mb-3">
                                            @foreach ($tickets as $ticket)
                                                <div class="col-4 mt-3">
                                                    <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                                </div>
                                                <div class="col-3 mt-3">
                                                    @if ($ticket->descuento == NULL)
                                                        <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                    @else
                                                        <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                        <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                    @endif
                                                </div>

                                                <div class="col-5 mt-3">
                                                    <p class="btn-holder">
                                                        <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                            <i class="fas fa-ticket-alt"></i> Comprar
                                                        </a>
                                                    </p>
                                                </div>

                                                <div class="col-12">
                                                    <p style="color: #836262">{{$ticket->descripcion}}</p>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                @endguest
              </div>

            </div>
          </div>

    </div>

    <div class="tab_content_tabs_mobil">
        <nav class="nav_tab_mb">
            <div class="nav nav-tabs centrar_tabs" id="nav-tab" role="tablist">
                <div class="d-flex justify-content-between  mb-3">

                    <button class="nav-link active" id="nav-infor_res-tab" data-bs-toggle="tab" data-bs-target="#nav-infor_res" type="button" role="tab" aria-controls="nav-infor_res" aria-selected="true">
                        Informacion <img class="icon_res_tabs" src="{{asset('assets/user/icons/informacion.png')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-profile_res-tab" data-bs-toggle="tab" data-bs-target="#nav-profile_res" type="button" role="tab" aria-controls="nav-profile_res" aria-selected="false">
                        Objetivos <img class="icon_res_tabs" src="{{asset('assets/user/icons/objetivo.webp')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-temarios_res-tab" data-bs-toggle="tab" data-bs-target="#nav-temarios_res" type="button" role="tab" aria-controls="nav-temarios_res" aria-selected="false">
                        Temarios <img class="icon_res_tabs" src="{{asset('assets/user/icons/prueba.webp')}}" alt="">
                    </button>
                </div>

                <div class="d-flex justify-content-between">
                    <button class="nav-link" id="nav-docus_res-tab" data-bs-toggle="tab" data-bs-target="#nav-docus_res" type="button" role="tab" aria-controls="nav-docus_res" aria-selected="false">
                        Documentos <img class="icon_res_tabs" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-dirigido_res-tab" data-bs-toggle="tab" data-bs-target="#nav-dirigido_res" type="button" role="tab" aria-controls="nav-dirigido_res" aria-selected="false">
                        Dirigido a <img class="icon_res_tabs" src="{{asset('assets/user/icons/personas.webp')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-recursos_res-tab" data-bs-toggle="tab" data-bs-target="#nav-recursos_res" type="button" role="tab" aria-controls="nav-recursos_res" aria-selected="false">
                        Recursos <img class="icon_res_tabs" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                    </button>
                </div>
            </div>
          </nav>

          <div class="tab-content" id="nav-tabContent" style="padding: 0 0 30px 0;">
            <div class="tab-pane fade show active" id="nav-infor_res" role="tabpanel" aria-labelledby="nav-infor_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">

                        <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">


                        <h1 class="title_curso">
                            {{$curso->nombre}}
                        </h1>

                        <p class="tittle_abstract mb-md-5 mt-md-5 mt-2 mb-2">
                            <?php echo $curso->descripcion?>
                        </p>

                        <h2 class="title_curso">Fecha y Hora</h2>

                        <p class="tittle_abstract ">
                            {{$curso->fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                            {{$curso->fecha_final}}
                            @endif, {{$curso->hora_inicial}} - {{$curso->hora_final}}
                        </p>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile_res" role="tabpanel" aria-labelledby="nav-profile_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 ">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12 ">

                        <h2 class="title_curso mb-md-5 mt-md-5 mt-2 mb-2">Objetivo</h2>

                        <p class="tittle_abstract mb-md-5 mt-md-5 mt-2 mb-2">
                            <?php echo $curso->objetivo?>
                        </p>

                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs  mb-md-5 mt-md-5 mt-2 mb-2" data-bs-toggle="collapse" href="#collapseobjetivos" role="button" aria-expanded="false" aria-controls="collapseobjetivos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mt-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseobjetivos">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-temarios_res" role="tabpanel" aria-labelledby="nav-temarios_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{asset('curso/'. $curso->foto) }}" alt="">
                        </div>
                    </div>

                    <div class="col-12">

                        <h2 class="title_curso mb-md-5 mt-md-5 mt-2 mb-2">Temario</h2>

                        <p class="tittle_abstract mb-md-5 mt-md-5 mt-2 mb-2">
                            <?php echo $curso->temario?>
                        </p>

                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" data-bs-toggle="collapse" href="#collapsetemario" role="button" aria-expanded="false" aria-controls="collapsetemario">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapsetemario">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-docus_res" role="tabpanel" aria-labelledby="nav-docus_res-tab" tabindex="0">
                <div class="row">

                    <div class="col-12">

                        <h2 class="title_curso mb-md-5 mt-md-5 mt-2 mb-2">Certificaciones</h2>

                        <div class="row">
                            @if ($curso->redconocer == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($curso->sep == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/revoe.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->unam == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones tres_img_cert" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->imnas == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/imnas.webp')}}" >
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->stps == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/stps.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Comprar ahora
                                    </p>
                                    <div class="card_bg_btn ">
                                        <i class="fas fa-cart-plus card_icon_btn"></i>
                                    </div>
                                </div>
                            </a>

                            <a class="btn btn-secundario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contactar
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            <div class="col-4 mt-3">
                                                <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                            </div>
                                            <div class="col-3 mt-3">
                                                @if ($ticket->descuento == NULL)
                                                    <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                @else
                                                    <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                    <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                @endif
                                            </div>

                                            <div class="col-5 mt-3">
                                                <p class="btn-holder">
                                                    <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                        <i class="fas fa-ticket-alt"></i> Comprar
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <p style="color: #836262">{{$ticket->descripcion}}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-dirigido_res" role="tabpanel" aria-labelledby="nav-dirigido_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-6 ">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">AMAS DE CASA</p>
                                <p class="text-center card_text_objetivos">Aprovecha tu tiempo libre</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">EMPRENDERORAS</p>
                                <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                                <p class="text-center card_text_objetivos">Construye una carera profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">APASIONADAS POR LA BELLEZA</p>
                                <p class="text-center card_text_objetivos">
                                    Ya eres una profesional, ahora
                                    estudia tu pasión.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-recursos_res" role="tabpanel" aria-labelledby="nav-recursos_res-tab" tabindex="0">
                @guest
                    <div class="row">
                        <div class="col-12">
                            <h2 class="title_curso text-center mb-5">Rescursos</h2>
                        </div>

                        <div class="col-12 m-auto">
                                <p class="  ">
                                   Por favor inicie sesion y en caso de haber comprado este curso podra ver la direccion o liga de meet para su clase
                                </p>
                        </div>
                    </div>
                @else
                    @if ($curso->modalidad == 'Presencial')
                        <div class="row">
                            <div class="col-6">
                                <h2 class="title_curso text-center mb-5">Ubicacion</h2>
                                <div class="d-flex justify-content-center">
                                    <iframe class="map_custom2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>

                            <div class="col-6 m-auto">
                                    <p class="  ">
                                        Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
                                    </p>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12 mt">
                                <h2 class="text-center title_curso">Enlace de la reuinion</h2>

                                <a class="text-center registro_num2 mt-3 mb-5" href="{{$curso->recurso}}" style="" target="_blank">
                                    {{$curso->recurso}}
                                </a>

                            </div>
                        </div>
                    @endif
                @endguest
            </div>

          </div>
    </div>

</section>

{{-- slide de cursos --}}
<section>
    <div class="bgimg-1" style="height: auto;background-image: url('{{asset('assets/user/utilidades/spa.jpg')}}')">
        <span class="mask"></span>
        <div class="row">
            <div class="col-12 index_superior">
                <h2 class="titulo_alfa text-center mt-3 mb-5" style="color: #fff!important">
                    Próximas Certificaciones
                </h2>
            </div>

            <div class="col-12 mb-5">

                <div class="owl-carousel owl-theme">

                    @foreach ($cursos as $curso)
                        @php
                            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
                            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
                            $dia = date("d", strtotime($curso->fecha_inicial));
                            $mes = date("M", strtotime($curso->fecha_inicial));
                        @endphp
                        <div class="item" style="">
                            <div class="card card_grid" style="">
                                <img class="img_card_grid" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">

                                <p class="precio_grid">${{$curso->precio}} mxn</p>
                                <p class="modalidado_grid">{{$curso->modalidad}}</p>
                                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                                <p class="horario_grid">{{$hora_inicial}} - {{$hora_final}}</p>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mt-4">
                                            <h4 class="fecha_card_grid text-center">
                                                {{$mes}} <br> <strong class="fecha_strong_card_grid">{{$dia}}</strong>
                                            </h4>
                                        </div>

                                        <div class="col-10 mt-4">
                                            <h3 class="tittle_card_grid">{{$curso->nombre}}</h3>

                                            <div class="d-flex mb-3">
                                                <div class="me-auto p-2">
                                                    <a class="btn btn_primario_grd_curso">
                                                        <div class="d-flex justify-content-around">
                                                            <p class="card_tittle_btn_grid my-auto">
                                                                Comprar ahora
                                                            </p>
                                                            <div class="card_bg_btn ">
                                                                <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="p-2">
                                                    <a class="btn btn_secundario_grd_curso" href="{{ route('cursos.show',$curso->slug) }}">
                                                        <div class="d-flex justify-content-around">
                                                            <p class="card_tittle_btn_grid my-auto">
                                                                Saber mas
                                                            </p>

                                                            <div class="card_bg_btn_secundario">
                                                                <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>

{{--Contactanos --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
    <div class="row border_row" style="">

        <div class="col-12 col-md-6">
            <h2 class="text-center tittle-contact">Contactenos</h2>
            <p class="text-center text-white">
                Complementa tus conocimientos y conviértete un experto de la cosmología,
            </p>

            <form class="form_contactenos" action="">

                    <div class="form-group">
                        <input type="text" class="form-control form_contact mt-4" id="" placeholder="Nombre (requerido)">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form_contact mt-4" id="" placeholder="Correo Electrónico (requerido)">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form_contact mt-4" id="" placeholder="Teléfono (requerido)">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form_contact mt-4" id="" placeholder="Message">
                    </div>
                    <p class="text-center text-white">
                        <a class="btn btn_enfiar_form">Enviar <i class="fas fa-paper-plane"></i></a>
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
{{-- <script src="{{asset('assets/user/custom/multistepes.js')}}"></script> --}}
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        paddimg:30,
        nav: true,
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
