@extends('layouts.app_user')

@section('template_title')
    Nombre del curso
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
                            Curso de Piedras Calientes
                            Curativas y Alineación de Chacras
                        </h1>

                        <p class="tittle_abstract mt-3 mb-3">
                            Aprender a realizar masajes con piedras calientes, conociendo los beneficios y técnicas correctas logrando la descontractura de tu paciente.
                        </p>

                        <h2 class="title_curso">Fecha y Hora</h2>

                        <p class="tittle_abstract">
                            Jueves , 16 de Febrero a las 11:00 AM - 3:00 PM
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

              </div>

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">

              </div>

              <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab" tabindex="0">

              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">

              </div>

              <div class="tab-pane fade" id="v-pills-recursos" role="tabpanel" aria-labelledby="v-pills-recursos-tab" tabindex="0">

              </div>

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


