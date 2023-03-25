@extends('layouts.app_user')

@section('template_title')

@endsection

@section('css_custom')
<link href="{{ asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{ asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
@endsection

@section('content')


<section class="primario bg_overley" style="background:#836262;">

    <div class="tab_section margin_home_nav">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-informacion-tab" data-bs-toggle="pill" data-bs-target="#v-pills-informacion" type="button" role="tab" aria-controls="v-pills-informacion" aria-selected="true">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Mi perfil</p>
                    <div class="content_nav d-inline-block">
                        <i class="fas fa-info-circle icon_nav_course2"></i>
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-objetivos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-objetivos" type="button" role="tab" aria-controls="v-pills-objetivos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Mis Producto </p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{ asset('assets/user/icons/objetivo.webp')}}" alt="">
                    </div>
                </div>

            </button>

              <button class="nav-link" id="v-pills-temarios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-temarios" type="button" role="tab" aria-controls="v-pills-temarios" aria-selected="false" >
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Material de clase</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{ asset('assets/user/icons/libros.png')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-documentos" type="button" role="tab" aria-controls="v-pills-documentos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Reconocimientos</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{ asset('assets/user/icons/certificacion.webp')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-dirijido-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dirijido" type="button" role="tab" aria-controls="v-pills-dirijido" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Mis Clases</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{ asset('assets/user/icons/video-call.png')}}" alt="">
                    </div>
                </div>
              </button>

            </div>

            <div class="tab-content" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-informacion" role="tabpanel" aria-labelledby="v-pills-informacion-tab" tabindex="0">
                <div class="row">
                    <div class="col-7">
                        <div class="row">

                            <div class="col-12">
                                <h2 class="title_curso mb-5">Datos de cliente</h2>
                            </div>

                            <div class="col-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/usuario.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/letter.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/ring-phone.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-12">
                                <h2 class="title_curso mb-5">Dirección de envio</h2>
                            </div>

                            <div class="col-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/edificio.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/cp.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-4 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/location-pointer.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-4 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{ asset('assets/user/icons/ring-phone.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="nombre" name="nombre" >
                                </div>
                            </div>

                            <div class="col-4 form-group ">
                                <a class="btn_save_profile" href="">
                                    Guardar
                                </a>
                            </div>
                        </div>
                    </div>

                    </div>
              </div>

              <div class="tab-pane fade" id="v-pills-objetivos" role="tabpanel" aria-labelledby="v-pills-objetivos-tab" tabindex="0">
                <div class="row">

                    <div class="col-12">
                        <h2 class="title_curso mb-5">Mis productos</h2>
                    </div>

                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-5">Material de Clase</h2>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-5">Reconocimeitnos</h2>
                    </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-5">Mis Clases</h2>
                    </div>
                </div>
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

    <div class="col-6">
            <div class="d-flex justify-content-center">
                <img class="img_contact" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" alt="">
            </div>
    </div>

</div>
</section>

@endsection

@section('js')

@endsection


