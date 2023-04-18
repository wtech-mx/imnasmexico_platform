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
@php
use Carbon\Carbon;
$fecha_ini = $curso->fecha_inicial;
$fecha_inicial = Carbon::createFromFormat('Y-m-d', $fecha_ini)->locale('es')->isoFormat('D [de] MMMM');

$fecha_f = $curso->fecha_final;
$fecha_final = Carbon::createFromFormat('Y-m-d', $fecha_f)->locale('es')->isoFormat('D [de] MMMM');

$horaInicial = $curso->hora_inicial;
$hora_inicial = Carbon::createFromFormat('H:i:s', $horaInicial)->format('h:i A');

$horaFinal = $curso->hora_final;
$hora_final = Carbon::createFromFormat('H:i:s', $horaFinal)->format('h:i A');
@endphp
<section class="primario bg_overley" style="background:#836262;">

    <div class="tab_section margin_home_nav desaparecer_contenedor_sm">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">
                <div class="d-flex justify-content-around">
                     <p class="espacio_w">Información</p>
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
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/mujer_preguntas.png')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-recursos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-recursos" type="button" role="tab" aria-controls="v-pills-recursos" aria-selected="false">
                <div class="d-flex justify-content-around">
                    @guest
                        <p class="espacio_w">Contacto</p>
                     @else
                        @if ($usuario_compro != NULL)
                            @if ($curso->modalidad == 'Presencial')
                            <p class="espacio_w">Dirección</p>
                            @else
                            <p class="espacio_w">Liga Clase</p>
                            @endif

                        @else
                            <p class="espacio_w">Contácto</p>
                        @endif
                    @endguest
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
                            {{$fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                            - {{$fecha_final}}
                            @endif, {{$hora_inicial}} - {{$hora_final}}
                        </p>

                        <h2 class="title_curso">Modalidad</h2>
                        <p class="tittle_abstract ">{{$curso->modalidad}}</p>


                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
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

                            <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
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

                            <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseobjetivos">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
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

                        <p class="tittle_abstract "><?php echo $curso->temario?></p>

                        <div class="row">
                            <div class="col-12">
                                @if($curso->pdf != NULL)
                                <a class="btn btn-primario " href="{{asset('pdf/'. $curso->pdf) }}" target="_blank">
                                    <div class="d-flex justify-content-around">
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

                            <div class="col-12">

                                @if ($curso->estatus == 1)
                                <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapsetemario" role="button" aria-expanded="false" aria-controls="collapsetemario">
                                    <div class="d-flex justify-content-around">
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

                                <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Contáctanos
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                                <div class="collapse mt-3" id="collapsetemario">
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
                                                                <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>


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

                        <h2 class="title_curso mb-5">Documentación que obtendrás</h2>

                        <div class="row">
                            @if ($curso->redconocer == 1)
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

                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
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

                            <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h2 class="title_curso mt-4 mb-4"> Preguntas Frecuentes</h2>
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
                            1. Te contactará la gestora vía whatsApp donde te dará un usuario y contraseña para subir a la plataforma tu información oficial.<br>
                            2. Una vez aceptada por la gestora, IMNAS tendrá máximo un mes para enviarte el documento por paquetería.<br><br>
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
                                Una vez realizada tu compra, te llegará un correo de <br> confirmación de pago y posteriormente uno con la dirección de tu <br>clase, es necesario revisar la bandeja de spam.
                            </p>
                            @else
                            <p class="text_preguntas_material">
                                <strong>6. ¿Cuál es el siguiente paso después de haber adquirido mi curso?</strong><br>
                                Una vez realizada tu compra, te llegará un correo de <br> confirmación de pago y posteriormente uno con la liga de tu <br>clase, es necesario revisar la bandeja de spam.
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

                    @if ($curso->materiales != NULL)
                        <div class="col-12 col-lg-6">
                            <h2 class="title_curso mt-4 mb-4"> Materiales de clase</h2>
                            <img id="img_material_clase" src="{{asset('materiales/'.$curso->materiales) }}" alt="material de clase" style="width: 100%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                        </div>
                    @endif

                    <div class="col-12 mt-4 mb-4">
                        <h2 class="title_curso text-center">Dirigido a...</h2>
                    </div>

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
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/EMPRENDEDORA.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">EMPRENDEDORAS</p>
                                <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                                <p class="text-center card_text_objetivos">Construye una carrera profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/apasionada.webp')}}" alt="">
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
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/MEDICOS.png')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">MÉDICOS</p>
                                <p class="text-center card_text_objetivos">

                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/EXPERTOS DE LA SALUD.png')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">APASIONADAS POR LA SALUD</p>
                                <p class="text-center card_text_objetivos">
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
                        <h2 class="title_curso text-center mb-5">Contáctanos</h2>
                    </div>

                    <div class="col-12 m-auto">
                            <p class="text-center">
                                Por favor inicie sesión y en caso de haber comprado este curso podrá ver la dirección o liga de meet para su clase. <br>
                                Si tiene dudas puede consultarlas vía WhastApp
                            </p>
                    </div>
                    @if ($curso->estatus == 1)
                    <div class="d-flex justify-content-center">

                        <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                            <div class="d-flex justify-content-around">
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

                        <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Contáctanos
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>

                    </div>
                        <div class="collapse mt-3" id="collapseinfo">
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
                                                        <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @else
                    @if ($usuario_compro != NULL)
                        @if ($curso->modalidad == 'Presencial')
                        <div class="row">
                            <div class="col-6">
                                <h2 class="title_curso text-center mb-5">Ubicación</h2>
                                <div class="d-flex justify-content-center">
                                    <iframe class="map_custom2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>

                            <div class="col-6 m-auto">
                                    <p class="  ">
                                        Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
                                    </p>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-12 mt">
                                <h2 class="text-center title_curso">Enlace de la reuinión</h2>

                                <a class="text-center registro_num2 mt-3 mb-5" href="{{$curso->recurso}}" style="" target="_blank">
                                    {{$curso->recurso}}
                                </a>

                            </div>
                        </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-12">
                                <h2 class="title_curso text-center mb-5">Contáctanos</h2>
                            </div>

                            <div class="col-12 m-auto">
                                    <p class="text-center">
                                        Usted no ha comprado este curso, si tiene alguna duda nos la puede hacer saber por WhatsApp y con gusto se la resolveremos.
                                    </p>

                                @if ($curso->estatus == 1)
                                <div class="d-flex justify-content-center">

                                    <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                        <div class="d-flex justify-content-around">
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

                                    <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                        <div class="d-flex justify-content-around">
                                            <p class="card_tittle_btn my-auto">
                                                Contáctanos
                                            </p>
                                            <div class="card_bg_btn_secundario">
                                                <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                    <div class="collapse mt-3" id="collapseinfo">
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
                                                                    <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

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
                        Preguntas <img class="icon_res_tabs" src="{{asset('assets/user/icons/mujer_preguntas.png')}}" alt="">
                    </button>

                    @guest
                        <button class="nav-link" id="nav-recursos_res-tab" data-bs-toggle="tab" data-bs-target="#nav-recursos_res" type="button" role="tab" aria-controls="nav-recursos_res" aria-selected="false">
                            Contacto <img class="icon_res_tabs" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                        </button>
                        @else
                            @if ($usuario_compro != NULL)
                                    @if ($curso->modalidad == 'Presencial')
                                    <button class="nav-link" id="nav-recursos_res-tab" data-bs-toggle="tab" data-bs-target="#nav-recursos_res" type="button" role="tab" aria-controls="nav-recursos_res" aria-selected="false">
                                        Dirección <img class="icon_res_tabs" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                                    </button>
                                @else
                                    <button class="nav-link" id="nav-recursos_res-tab" data-bs-toggle="tab" data-bs-target="#nav-recursos_res" type="button" role="tab" aria-controls="nav-recursos_res" aria-selected="false">
                                        Clase <img class="icon_res_tabs" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                                    </button>
                                @endif
                            @endif
                    @endguest
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
                            {{$fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                            - {{$fecha_final}}
                            @endif, {{$hora_inicial}} - {{$hora_final}}
                        </p>

                        <h2 class="title_curso">Modalidad</h2>
                        <p class="tittle_abstract ">{{$curso->modalidad}}</p>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseinfo" role="button" aria-expanded="false" aria-controls="collapseinfo">
                                <div class="d-flex justify-content-around">
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

                            <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseinfo">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
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

                            <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseobjetivos">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
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

                    </div>

                    <div class="col-12">

                        @if($curso->pdf != NULL)
                            <a class="btn btn-primario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" href="{{asset('pdf/'. $curso->pdf) }}" target="_blank">
                                <div class="d-flex justify-content-around">
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

                    <div class="col-12">
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" data-bs-toggle="collapse" href="#collapsetemario" role="button" aria-expanded="false" aria-controls="collapsetemario">
                                <div class="d-flex justify-content-around">
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

                            <a class="btn btn-secundario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapsetemario">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-docus_res" role="tabpanel" aria-labelledby="nav-docus_res-tab" tabindex="0">
                <div class="row">

                    <div class="col-12">

                        <h2 class="title_curso mb-md-5 mt-md-5 mt-2 mb-2">Documentación que obtendrás
                        </h2>

                        <div class="row">
                            @if ($curso->redconocer == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones" style="position: relative">
                                                <p class="text-center">
                                                    <a  data-bs-toggle="modal" data-bs-target="#redconcer">
                                                        <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="">
                                                    </a>
                                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($curso->sep == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones" style="position: relative">
                                            <p class="text-center">
                                                <a  data-bs-toggle="modal" data-bs-target="#revoe">
                                                    <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/revoe.png')}}" alt="">
                                                </a>
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->unam == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones" style="position: relative">
                                            <p class="text-center">
                                                <a class="text-center" data-bs-toggle="modal" data-bs-target="#unam">
                                                    <img class="img_card_certificaciones tres_img_cert" src="{{asset('assets/user/logotipos/unam.png')}}" alt="">
                                                </a>
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($curso->imnas == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones" style="position: relative">
                                            <p class="text-center">
                                                <a  data-bs-toggle="modal" data-bs-target="#imnas_collage">
                                                    <img class="img_card_certificaciones" src="{{asset('assets/user/logotipos/imnas.png')}}" >
                                                </a>
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </p>
                                        </div>
                                    </div>
                                    @if ($curso->titulo_hono == 1)
                                        <p class="text-center">
                                            <strong>Titulo Honorifico</strong>
                                        </p>
                                    @else
                                        <p class="text-center">
                                            <strong>Documentos de Certificadora Nacional</strong>
                                        </p>
                                    @endif
                                </div>
                            @endif

                            @if ($curso->stps == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones" style="position: relative">
                                            <p class="text-center">
                                                <a class="text-center" data-bs-toggle="modal" data-bs-target="#stps">
                                                    <img class="img_card_certificaciones dos_img_cert" src="{{asset('assets/user/logotipos/stps.png')}}" alt="">
                                                </a>
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($curso->estatus == 1)
                            <a class="btn btn-primario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" data-bs-toggle="collapse" href="#collapseavales" role="button" aria-expanded="false" aria-controls="collapseavales">
                                <div class="d-flex justify-content-around">
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

                            <a class="btn btn-secundario space_cs_rs mb-md-5 mt-md-5 mt-2 mb-2" href="#contactenos">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        Contáctanos
                                    </p>
                                    <div class="card_bg_btn_secundario">
                                        <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                    </div>
                                </div>
                            </a>

                            <div class="collapse mt-3" id="collapseavales">
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
                                                            <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-dirigido_res" role="tabpanel" aria-labelledby="nav-dirigido_res-tab" tabindex="0">
                <div class="row">

                    <div class="col-12 ">
                        <h2 class="title_curso mt-2 mb-2"> Preguntas Frecuentes</h2>
                        @if ($curso->modalidad == 'Presencial')
                            <p class="text_preguntas_material">
                                Nuestros cursos y diplomados presenciales estan divididos en dos partes: <br><br>
                                <strong>TEORÍA: </strong><br> Se llevará a cabo en salón de clases con las debidas medidas sanitarias. <br> El profesor contará con apoyo visual para brindar la teoría necesaria para su comprensión. <br><br>
                                <strong>PRÁCTICA: </strong> <br> Se llevará a cabo con camilla personal y auxiliar con PRODUCTO INCLUÍDO. <br> La práctica se hará de la mano con el profesor en donde se reforzará lo aprendido
                            </p>
                        @else
                            <p class="text_preguntas_material">
                                <strong>CLASES GRABADAS: </strong><br> Las clases quedarán grabadas y tendrás acceso a ellas por <strong>72 horas. </strong> <br><br>
                                <strong>DESPUES DE COMPRAR: </strong><br> Una vez realizada su compra, a su correo llegará un email de <br> confirmación de pago y posteriormente uno con la liga de su <br>clase, es necesario revisar la bandeja de spam.
                            </p>
                        @endif
                    </div>

                    @if ($curso->materiales != NULL)
                        <div class="col-12 col-lg-6">
                            <h2 class="title_curso mt-4 mb-4"> Materiales de clase</h2>
                            <img id="img_material_clase" src="{{asset('materiales/'.$curso->materiales) }}" alt="Material de clase" style="width: 100%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                        </div>
                    @endif

                    <div class="col-12 mt-2 mb-2">
                        <h2 class="title_curso text-center">Dirigido a...</h2>
                    </div>

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
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/EMPRENDEDORA.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">EMPRENDEDORAS</p>
                                <p class="text-center card_text_objetivos">Inicia tu propio Negocio.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">ESTUDIANTES DE BELLEZA</p>
                                <p class="text-center card_text_objetivos">Construye una carrera profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/apasionada.webp')}}" alt="">
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
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/MEDICOS.png')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">MÉDICOS</p>
                                <p class="text-center card_text_objetivos">

                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 py-3">
                        <div class="d-flex justify-content-start">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{asset('assets/user/icons/EXPERTOS DE LA SALUD.png')}}" alt="">
                                </p>
                                <p class="text-center card_title_objetivos">APASIONADAS POR LA SALUD</p>
                                <p class="text-center card_text_objetivos">
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
                            <h2 class="title_curso text-center mb-5">Contáctanos</h2>
                        </div>

                        <div class="col-12 m-auto">
                                <p class="  ">
                                   Por favor inicie sesión y en caso de haber comprado este curso podra ver la dirección o liga de meet para su clase.
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
                                            Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México
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
                                <h2 class="title_curso text-center mb-5">Contáctanos</h2>
                            </div>

                            <div class="col-12 m-auto">
                                    <p class="  ">
                                        Usted no ha comprado este curso, si tiene alguna duda nos la puede hacer saber por WhatsApp y con gusto se la resolveremos.
                                    </p>
                            </div>
                            @if ($curso->estatus == 1)
                            <div class="d-flex justify-content-center">

                                <a class="btn btn-primario space_cs_rs mt-5" data-bs-toggle="collapse" href="#collapseconta" role="button" aria-expanded="false" aria-controls="collapseconta">
                                    <div class="d-flex justify-content-around">
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

                                <a class="btn btn-secundario space_cs_rs mt-5" href="#contactenos">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Contáctanos
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>

                            </div>
                                <div class="collapse mt-3" id="collapseconta">
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
                                                                <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
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
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endguest
            </div>

          </div>
    </div>

</section>

{{-- slide de cursos --}}
@include('user.components.carousel_courses')
{{-- slide de cursos --}}

{{--Contactanos --}}
<section class="primario bg_overley" id="contactenos"  style="background-color:#F5ECE4;">
    <div class="row border_row" style="">

        <div class="col-12 col-md-6">
            <h2 class="text-center tittle-contact">Contáctanos</h2>
            <p class="text-center text-white">
                Complementa tus conocimientos y conviértete un experto de la Cosmetología.
            </p>

            <form method="POST" action="{{ route('mensaje.form') }}"role="form">
                @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form_contact mt-4" name="nombre" id="nombre" placeholder="Nombre (requerido)" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form_contact mt-4" name="correo" id="correo" placeholder="Correo Electrónico (requerido)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form_contact mt-4" name="mensaje" id="mensaje" placeholder="Message">
                    </div>
                    <input type="hidden" class="form-control form_contact mt-4" name="curso" id="curso" value="{{$curso->nombre}}">
                    <input type="hidden" class="form-control form_contact mt-4" name="fecha" id="fecha" value="{{$curso->fecha_inicial}}">
                    <input type="hidden" class="form-control form_contact mt-4" name="modalidad" id="modalidad" value="{{$curso->modalidad}}">

                    <p class="text-center text-white">
                        <button type="submit" class="btn btn_enfiar_form">Enviar <i class="fab fa-whatsapp"></i></button>
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

@include('user.components.modal_certificados_single');
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
        nav: false,
        dots:false,
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
