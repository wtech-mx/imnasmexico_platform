@extends('layouts.app_user')

@section('template_title')
Mi perfil- {{$cliente->name}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
<style>
    .accordion-button:not(.collapsed) {
    color: #fff!important;
}
</style>

@endsection

@section('content')


<section class="primario bg_overley space_profile" style="background:#836262;">

    <div class="tab_section margin_home_nav desaparecer_contenedor_sm">

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
                     <p class="espacio_p">Mis Compras </p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/objetivo.webp')}}" alt="">
                    </div>
                </div>

            </button>

              <button class="nav-link" id="v-pills-temarios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-temarios" type="button" role="tab" aria-controls="v-pills-temarios" aria-selected="false" >
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Material de clase</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/libros.png')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-documentos" type="button" role="tab" aria-controls="v-pills-documentos" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Reconocimientos</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                    </div>
                </div>
              </button>

              <button class="nav-link" id="v-pills-dirijido-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dirijido" type="button" role="tab" aria-controls="v-pills-dirijido" aria-selected="false">
                <div class="d-flex justify-content-around">
                     <p class="espacio_p">Mis Clases</p>
                    <div class="content_nav d-inline-block">
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                    </div>
                </div>
              </button>

            </div>

            <div class="tab-content" id="v-pills-tabContent">

              <div class="tab-pane fade show active" id="v-pills-informacion" role="tabpanel" aria-labelledby="v-pills-informacion-tab" tabindex="0">
                @include('user.components.profile.tab_informacion')
              </div>

              <div class="tab-pane fade" id="v-pills-objetivos" role="tabpanel" aria-labelledby="v-pills-objetivos-tab" tabindex="0">
                @include('user.components.profile.tab_objetivos')
              </div>

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">
                @include('user.components.profile.tab_temarios')
              </div>

              <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab" tabindex="0">
                @include('user.components.profile.tab_documentos')
              </div>

              <div class="tab-pane fade" id="v-pills-dirijido" role="tabpanel" aria-labelledby="v-pills-dirijido-tab" tabindex="0">
                @include('user.components.profile.tab_clases')
              </div>

            </div>
          </div>

    </div>

    <div class="tab_content_tabs_mobil">
        <nav class="nav_tab_mb">
            <div class="nav nav-tabs centrar_tabs" id="nav-tab" role="tablist">
                <div class="d-flex justify-content-between  mb-3">

                    <button class="nav-link active" id="nav-infor_res-tab" data-bs-toggle="tab" data-bs-target="#nav-infor_res" type="button" role="tab" aria-controls="nav-infor_res" aria-selected="true">
                        Mi Perfil <img class="icon_res_tabs" src="{{asset('assets/user/icons/informacion.png')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-profile_res-tab" data-bs-toggle="tab" data-bs-target="#nav-profile_res" type="button" role="tab" aria-controls="nav-profile_res" aria-selected="false">
                        Compras <img class="icon_res_tabs" src="{{asset('assets/user/icons/objetivo.webp')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-temarios_res-tab" data-bs-toggle="tab" data-bs-target="#nav-temarios_res" type="button" role="tab" aria-controls="nav-temarios_res" aria-selected="false">
                        Material de clase <img class="icon_res_tabs" src="{{asset('assets/user/icons/libros.png')}}" alt="">
                    </button>
                </div>

                <div class="d-flex justify-content-evenly">
                    <button class="nav-link" id="nav-docus_res-tab" data-bs-toggle="tab" data-bs-target="#nav-docus_res" type="button" role="tab" aria-controls="nav-docus_res" aria-selected="false">
                        Reconocimientos <img class="icon_res_tabs" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-dirigido_res-tab" data-bs-toggle="tab" data-bs-target="#nav-dirigido_res" type="button" role="tab" aria-controls="nav-dirigido_res" aria-selected="false">
                        Mis Clases <img class="icon_res_tabs" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                    </button>

                    <button class="nav-link" id="nav-recursos_res-tab" data-bs-toggle="tab" data-bs-target="#nav-recursos_res" type="button" role="tab" aria-controls="nav-recursos_res" aria-selected="false" style="background: transparent;">
                    </button>
                </div>
            </div>
        </nav>

          <div class="tab-content" id="nav-tabContent" style="padding: 0 0 30px 0;">
            <div class="tab-pane fade show active" id="nav-infor_res" role="tabpanel" aria-labelledby="nav-infor_res-tab" tabindex="0">
                <div class="row">

                    <div class="col-12">
                        <h2 class="title_curso mb-5">Datos de cliente</h2>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/usuario.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="name" name="name" value="{{$cliente->name}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/letter.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="email" name="email" value="{{$cliente->email}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/ring-phone.png')}}" alt="">
                        </span>

                        <input class="form-control" type="number"  id="telefono" name="telefono" value="{{$cliente->telefono}}">
                        </div>
                    </div>

                    <div class="col-12">
                        <h2 class="title_curso mb-5">Dirección de envio</h2>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/edificio.png')}}" alt="" >
                        </span>

                        <input class="form-control prb" type="text"  id="nombre" name="nombre" placeholder="Direccion">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/location-pointer.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="nombre" name="nombre" placeholder="Municipio y/o Provincia">
                        </div>
                    </div>

                    <div class="col-6 col-lg-4 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/cp.png')}}" alt="">

                        </span>

                        <input class="form-control" type="text"  id="nombre" name="nombre" placeholder="CP">
                        </div>
                    </div>

                    <div class="col-6 col-lg-4 form-group ">
                        <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text">
                            <img class="img_profile_label" src="{{asset('assets/user/icons/ring-phone.png')}}" alt="">
                        </span>

                        <input class="form-control" type="text"  id="telefono" name="telefono" placeholder="Telefono">
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 form-group ">
                        <a class="btn_save_profile" href="">
                            Guardar
                        </a>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile_res" role="tabpanel" aria-labelledby="nav-profile_res-tab" tabindex="0">
                <div class="row space_laaterales_profile">

                    <div class="col-12 space_laaterales_profile">
                        <h2 class="title_curso mb-5">Mis compras</h2>
                    </div>

                    <table class="table">
                        <thead class="text-center">
                          <tr class="tr_checkout">
                            <th>#</th>
                            {{-- <th >Fecha de Compra</th> --}}
                            <th >Total</th>
                            <th>Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>

                        <tbody class="text-center">
                        @if(!empty($orders))
                            @foreach($orders as $order)
                            @include('user.profile_show')
                                <tr>
                                    <th>
                                        #{{$order->id}}
                                    </th>
                                    {{-- <th>
                                        {{$order->fecha}}
                                    </th> --}}
                                    <td>{{$order->pago}}</td>
                                    <td class="td_title_checkout">{{$order->forma_pago}}</td>
                                    <td>
                                        @if ($order->estatus == '1')
                                            Completado
                                        @else
                                            En espera
                                        @endif
                                    </td>
                                    <th>

                                        <a type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#showDataModal{{$order->id}}" style="color: #ffff; background: #836262"><i class="fa fa-fw fa-eye"></i></a>
                                    </th>
                                </tr>
                            @endforeach
                            @else
                            <p>Upps... aun no tiene compras de Curosos o Diplomados</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-temarios_res" role="tabpanel" aria-labelledby="nav-temarios_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-5">Material de Clase</h2>
                    </div>
                    @foreach ($order_ticket as $tiket)
                        @if ($tiket->Cursos->materiales != NULL && $tiket->Cursos->estatus == '1')
                        <div class="col-6 mt-3">
                            <b><label>Nombre Curso/Diplomado</label></b><br>
                            <label>{{$tiket->Cursos->nombre}}</label>
                            <img id="blah" src="{{asset('materiales/'.$tiket->Cursos->materiales) }}" alt="Imagen" style="width: 450px; height: 450px;"/>
                        </div>
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="nav-docus_res" role="tabpanel" aria-labelledby="nav-docus_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-5">Reconocimientos</h2>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-dirigido_res" role="tabpanel" aria-labelledby="nav-dirigido_res-tab" tabindex="0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title_curso mb-1 mb-lg-5 mb-sm-2">Mis Clases </h2>
                    </div>

                    <div class="accordion" id="acordcion_mb_clases">
                        @foreach ($usuario_compro as $video)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$video->id_tickets}}" aria-expanded="true" aria-controls="collapseOne{{$video->id}}" style="background-color: #836262;">
                                        <img class="icon_nav_course" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt=""> {{$video->Cursos->nombre}}
                                    </button>
                                </h2>

                                <div id="collapseOne{{$video->id_tickets}}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#acordcion_mb_clases">
                                    <div class="accordion-body">
                                        <div class="row">
                                                <div class="col-12">
                                                    <h3 class="text-center mb-3"><img class="icon_nav_course" src="{{asset('assets/user/icons/libros.png')}}" alt=""> <strong>Material de clase</strong></h3>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                    @if ($carpetas != NULL)
                                                        @foreach ($carpetas as $carpeta)
                                                            @php
                                                                $file_info = new SplFileInfo($carpeta->nombre_recurso);
                                                                $extension = $file_info->getExtension();
                                                            @endphp
                                                            @if ($carpeta->id_carpeta == $video->Cursos->carpeta)
                                                                @if ($extension === 'pdf')
                                                                <div class="col-12 mt-3">
                                                                    <p class="text-center">
                                                                    <embed class="embed_pdf" src="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" type="application/pdf"  />
                                                                    <a class="text-dark" href="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" target="_blank" >Ver PDF</a>
                                                                    </p>
                                                                </div>
                                                                @else
                                                                <div class="col-12 mt-3">
                                                                    <p class="text-center">
                                                                        <img class="img_material_clase_pc" id="img_material_clase" src="{{asset('cursos/'. $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" />
                                                                    </p>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h3 class="text-center mt-5 mb-3"><img class="icon_nav_course" src="{{asset('assets/user/icons/promocion.png')}}" alt=""> <strong>Promociones y descuentos</strong></h3>
                                                </div>

                                                <div class="col-12">
                                                    <div id="carrousel_publicidad_mb" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                        @foreach ($publicidad as $item)
                                                        @php
                                                            $file_info = new SplFileInfo($item->nombre);
                                                            $extension = $file_info->getExtension();
                                                        @endphp
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            @if ($extension == 'jpg')
                                                            <p class="text-center">
                                                            <img class="img_material_clase_pc" src="{{asset('archivos/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                            </p>
                                                            @elseif ($extension == 'png')
                                                            <p class="text-center">
                                                            <img class="img_material_clase_pc" src="{{asset('archivos/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                            </p>
                                                            @elseif ($extension == 'jpeg')
                                                            <p class="text-center">
                                                            <img class="img_material_clase_pc" src="{{asset('archivos/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                            </p>
                                                            @elseif ($extension == 'pdf')
                                                            <p class="text-center">
                                                            <embed class="embed_pdf_publicidad" src="{{asset('archivos/'. $item->nombre) }}" type="application/pdf"  />
                                                            <a class="text-dark" href="{{ asset('archivos/' . $item->nombre) }}" target="_blank" >Ver PDF</a>
                                                            </p>
                                                            @elseif ($extension == 'mp4')
                                                            <p class="text-center">
                                                            <video class="video_publicidad" src="{{asset('archivos/'. $item->nombre) }}" controls></video>
                                                            </p>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                        </div>

                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_publicidad_mb" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carrousel_publicidad_mb" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h3 class="text-center mt-5 mb-3"><img class="icon_nav_course" src="{{asset('assets/user/icons/clase.webp')}}" alt=""> <strong>Clases grabadas</strong></h3>
                                                </div>
                                                <div class="row">
                                                @foreach($usuario_video as $user_video)
                                                    @if ($video->Cursos->id == $user_video->id_curso)
                                                        <div class="col-12 col-lg-6">
                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Día 1</strong></h5>
                                                            @php
                                                                $url = $user_video->clase_grabada;
                                                                preg_match('/\/file\/d\/(.+?)\//', $url, $matches);
                                                                $id_link_drive = $matches[1];
                                                            @endphp
                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive }}/preview" class="iframe_clase"></iframe>
                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive }}" target="_blank" >Ver Clase</a>
                                                        </div>

                                                        @if ( $user_video->clase_grabada2 != NULL)
                                                            <div class="col-12 col-lg-6">
                                                                <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 2</strong></h5>
                                                                @php
                                                                    $url2 = $user_video->clase_grabada2;
                                                                    preg_match('/\/file\/d\/(.+?)\//', $url2, $matches2);
                                                                    $id_link_drive2 = $matches2[1];
                                                                @endphp
                                                                <iframe src="https://drive.google.com/file/d/{{ $id_link_drive2 }}/preview" class="iframe_clase"></iframe>
                                                                <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive2 }}" target="_blank" >Ver Clase</a>
                                                            </div>
                                                        @endif

                                                        @if ($user_video->clase_grabada3 != NULL)
                                                            <div class="col-12 col-lg-6">
                                                                <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 3</strong></h5>
                                                                @php
                                                                    $url3 = $user_video->clase_grabada3;
                                                                    preg_match('/\/file\/d\/(.+?)\//', $url3, $matches3);
                                                                    $id_link_drive3 = $matches3[1];
                                                                @endphp
                                                                <iframe src="https://drive.google.com/file/d/{{ $id_link_drive3 }}/preview" class="iframe_clase"></iframe>
                                                                <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive3 }}" target="_blank" >Ver Clase</a>
                                                            </div>
                                                        @endif

                                                        @if ($user_video->clase_grabada4 != NULL)
                                                            <div class="col-12 col-lg-6">
                                                                <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 4</strong></h5>
                                                                @php
                                                                    $url4 = $user_video->clase_grabada4;
                                                                    preg_match('/\/file\/d\/(.+?)\//', $url4, $matches4);
                                                                    $id_link_drive4 = $matches4[1];
                                                                @endphp
                                                                <iframe src="https://drive.google.com/file/d/{{ $id_link_drive4 }}/preview" class="iframe_clase"></iframe>
                                                                <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive4 }}" target="_blank" >Ver Clase</a>
                                                            </div>
                                                        @endif

                                                        @if ($user_video->clase_grabada5 != NULL)
                                                            <div class="col-12 col-lg-6">
                                                                <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 5</strong></h5>
                                                                @php
                                                                    $url5 = $user_video->clase_grabada5;
                                                                    preg_match('/\/file\/d\/(.+?)\//', $url5, $matches5);
                                                                    $id_link_drive5 = $matches5[1];
                                                                @endphp
                                                                <iframe src="https://drive.google.com/file/d/{{ $id_link_drive5 }}/preview" class="iframe_clase"></iframe>
                                                                <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive5 }}" target="_blank" >Ver Clase</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
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
    </div>

</section>



@endsection

@section('js')

@endsection


