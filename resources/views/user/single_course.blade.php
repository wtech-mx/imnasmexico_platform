@extends('layouts.app_user')

@section('template_title')
   {{$curso->nombre}}
@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
@endsection

@section('content')


<section class="primario bg_overley" style="background:#836262;">

    @include('user.components.navbar');

    <div class="tab_section">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">
                <p class="d-inline text-left">Informacion</p>
                <div class="content_nav d-inline-block">
                    <i class="fas fa-info-circle icon_nav_course2"></i>
                </div>
              </button>

              <button class="nav-link" id="v-pills-objetivos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-objetivos" type="button" role="tab" aria-controls="v-pills-objetivos" aria-selected="false">
                <p class="d-inline text-left">Objetivos</p>
                <div class="content_nav d-inline-block">
                    <img class="icon_nav_course" src="{{ asset('assets/user/icons/objetivo.webp')}}" alt="">
                </div>
            </button>

              <button class="nav-link" id="v-pills-temarios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-temarios" type="button" role="tab" aria-controls="v-pills-temarios" aria-selected="false" >
                <p class="d-inline text-left">Temarios</p>
                <div class="content_nav d-inline-block">
                    <img class="icon_nav_course" src="{{ asset('assets/user/icons/prueba.webp')}}" alt="">
                </div>
              </button>

              <button class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-documentos" type="button" role="tab" aria-controls="v-pills-documentos" aria-selected="false">
                <p class="d-inline text-left">Documentos</p>
                <div class="content_nav d-inline-block">
                    <img class="icon_nav_course" src="{{ asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
              </button>

              <button class="nav-link" id="v-pills-dirijido-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dirijido" type="button" role="tab" aria-controls="v-pills-dirijido" aria-selected="false">
                <p class="d-inline text-left">Dirigido a</p>
                <div class="content_nav d-inline-block">
                    <img class="icon_nav_course" src="{{ asset('assets/user/icons/personas.webp')}}" alt="">
                </div>
              </button>

              <button class="nav-link" id="v-pills-recursos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-recursos" type="button" role="tab" aria-controls="v-pills-recursos" aria-selected="false">
                <p class="d-inline text-left">Recursos</p>
                <div class="content_nav d-inline-block">
                    <img class="icon_nav_course" src="{{ asset('assets/user/icons/video-call.png')}}" alt="">
                </div>
              </button>

            </div>

            <div class="tab-content" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-informacion" role="tabpanel" aria-labelledby="v-pills-informacion-tab" tabindex="0">
                <div class="row">
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
                        </div>
                    </div>

                    <div class="col-7">
                        <h1 class="title_curso">
                            {{$curso->nombre}}
                        </h1>

                        <p class="tittle_abstract mt-3 mb-3">
                            {{$curso->descripcion}}
                        </p>

                        <h2 class="title_curso">Fecha y Hora</h2>

                        <p class="tittle_abstract">
                            {{$curso->fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                            {{$curso->fecha_final}}
                            @endif, {{$curso->hora_inicial}} - {{$curso->hora_final}}
                        </p>
                        <a class="btn btn-primario me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Comprar ahora
                                </p>
                                <div class="card_bg_btn ">
                                    <i class="fas fa-cart-plus card_icon_btn"></i>
                                </div>
                            </div>
                        </a>

                        <a class="btn btn-secundario me-1">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Contactar
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-objetivos" role="tabpanel" aria-labelledby="v-pills-objetivos-tab" tabindex="0">
                <div class="row">
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
                        </div>
                    </div>

                    <div class="col-7">

                        <h2 class="title_curso">Objetivo</h2>

                        <p class="tittle_abstract mt-3 mb-3">
                            {{$curso->objetivo}}
                        </p>

                        <a class="btn btn-primario me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Comprar ahora
                                </p>
                                <div class="card_bg_btn ">
                                    <i class="fas fa-cart-plus card_icon_btn"></i>
                                </div>
                            </div>
                        </a>

                        <a class="btn btn-secundario me-1">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Contactar
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">
                <div class="row">
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
                        </div>
                    </div>

                    <div class="col-7">

                        <h2 class="title_curso">Temario</h2>

                        <p class="tittle_abstract mt-3 mb-3">
                            {{$curso->temario}}
                        </p>

                        <a class="btn btn-primario me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Comprar ahora
                                </p>
                                <div class="card_bg_btn ">
                                    <i class="fas fa-cart-plus card_icon_btn"></i>
                                </div>
                            </div>
                        </a>

                        <a class="btn btn-secundario me-1">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Contactar
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab" tabindex="0">
                <div class="row">
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <img class="img_destacada img-fluid" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
                        </div>
                    </div>

                    <div class="col-7">

                        <h2 class="title_curso">Certificaciones</h2>

                        <div class="row">
                            @if ($curso->redconocer == 1)
                                <div class="col-6 col-md-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card_certificaciones">
                                                <p class="text-center">
                                                    <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/sepconocer.png')}}" alt="">
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
                                                    <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/revoe.png')}}" alt="">
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
                                                    <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/unam.png')}}" alt="">
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
                                                    <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/imnas.webp')}}" style="width: 50%">
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
                                                    <img class="img_card_certificaciones" src="{{ asset('assets/user/logotipos/stps.png')}}" alt="">
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>


                        <a class="btn btn-primario me-3">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Comprar ahora
                                </p>
                                <div class="card_bg_btn ">
                                    <i class="fas fa-cart-plus card_icon_btn"></i>
                                </div>
                            </div>
                        </a>

                        <a class="btn btn-secundario me-1">
                            <div class="d-flex justify-content-around">
                                <p class="card_tittle_btn my-auto">
                                    Contactar
                                </p>
                                <div class="card_bg_btn_secundario">
                                    <i class="fab fa-whatsapp card_icon_btn_secundario"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <div class="card_objetivos2">
                                <p class="text-center">
                                    <img class="img_card_objetivos2" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
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
                                    <img class="img_card_objetivos2" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
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
                                    <img class="img_card_objetivos2" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
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
                                    <img class="img_card_objetivos2" src="{{ asset('assets/user/icons/ama-de-casa.webp')}}" alt="">
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
                @if ($curso->modalidad == 'Presencial')
                    <div class="row">
                        <div class="col-6">
                            <h2 class="title_curso">Ubicacion</h2>
                            <iframe class="map_custom2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30110.056826145097!2d-99.14852410230698!3d19.379667296620767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fe40772ea94d%3A0x6b392a4717cc4368!2sInstituto%20Mexicano%20Naturales%20Ain%20Spa%20SC!5e0!3m2!1ses-419!2smx!4v1678243651126!5m2!1ses-419!2smx"  style="" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-6">
                                <p class="tittle_abstract py-5 my-5">
                                    Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
                                </p>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center title_curso">Enlace de la reuinion</h2>

                            <a class="text-center registro_num2 mt-3 mb-5" href=" {{$curso->recurso}}" style="margin-left: 13rem;" target="_blank">
                                {{$curso->recurso}}
                            </a>

                        </div>
                    </div>
                @endif

              </div>

            </div>
          </div>

    </div>

</section>

{{-- slide de cursos --}}
<section>
    <div class="bgimg-1" style="height: 500px;background-image: url('{{ asset('assets/user/utilidades/spa.jpg')}}')">

    </div>
</section>


{{--Contactanos --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">
<div class="row border_row" style="">

    <div class="col-6">
        <h2 class="text-center tittle-contact">Contactenos</h2>
        <p class="text-center text-white">
            Complementa tus conocimientos y conviértete un experto de la cosmología,
        </p>
        <form action="">
            <div class="form-group">
                <input type="text" class="form-control form_contact mt-3" id="" placeholder="Nombre (requerido)">
            </div>
            <div class="form-group">
                <input type="email" class="form-control form_contact mt-3" id="" placeholder="Correo Electrónico (requerido)">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form_contact mt-3" id="" placeholder="Teléfono (requerido)">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form_contact mt-3" id="" placeholder="Message">
            </div>
            <p class="text-center text-white">
                <a class="btn btn_enfiar_form">Enviar <i class="fas fa-paper-plane"></i></a>
            </p>

        </form>
    </div>

    <div class="col-6">
            <div class="d-flex justify-content-center">
                <img class="img_contact" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
            </div>
    </div>

</div>
</section>


{{-- footer --}}
@include('admin.users.components.footer')
{{-- footer --}}

@endsection

@section('js')


@endsection


