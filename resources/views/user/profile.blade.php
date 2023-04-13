@extends('layouts.app_user')

@section('template_title')

@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />


@endsection

@section('content')


<section class="primario bg_overley" style="background:#836262;">

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
                <div class="row">
                    <div class="col-12 col-xl-7">
                        <div class="row">

                            <div class="col-12">
                                <h2 class="title_curso mb-5">Datos de cliente</h2>
                            </div>
                            <form role="form" action="{{ route('perfil.update', $cliente->code) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">
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
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/email.png')}}" alt="">
                                        </span>

                                        <input class="form-control" type="email"  id="email" name="email" value="{{$cliente->email}}">
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
                                </div>

                                <div class="col-12">
                                    <h2 class="title_curso mb-5">Datos de Facturación</h2>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6 form-group ">
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/document.png')}}" alt="">
                                            </span>
                                            <select name="cfdi" id="cfdi">
                                                <option value="{{$cliente->cfdi}}">{{$cliente->cfdi}}</option>
                                                <option value="G01 Adquisición de Mercancías">G01 Adquisición de Mercancías</option>
                                                <option value="G02 Devoluciones, Descuentos o bonificaciones">G02 Devoluciones, Descuentos o bonificaciones</option>
                                                <option value="G03 Gastos en general">G03 Gastos en general</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 form-group ">
                                        <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text">
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/document.png')}}" alt="">
                                        </span>

                                        <input class="form-control" type="text"  id="rfc" name="rfc" placeholder="RFC" value="{{$cliente->rfc}}">
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-6 form-group ">
                                        <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text">
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/user.png')}}" alt="">
                                        </span>

                                        <input class="form-control" type="text"  id="razon_social" name="razon_social" placeholder="Razon Social" value="{{$cliente->razon_social}}">
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-6 form-group ">
                                        <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text">
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/location-pointer.png')}}" alt="">
                                        </span>

                                        <input class="form-control" type="text"  id="direccion" name="direccion" placeholder="Direccion" value="{{$cliente->direccion}}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 form-group ">
                                        <button type="submit" class="btn_save_profile" >
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    </div>
              </div>

              <div class="tab-pane fade" id="v-pills-objetivos" role="tabpanel" aria-labelledby="v-pills-objetivos-tab" tabindex="0">
                <div class="row space_laaterales_profile">

                    <div class="col-12 space_laaterales_profile">
                        <h2 class="title_curso mb-5">Mis compras</h2>
                    </div>
                    <table class="table">
                        <thead class="text-center">
                          <tr class="tr_checkout">
                            <th >Num. Pedido</th>
                            <th >Fecha de Compra</th>
                            <th >Total</th>
                            <th>Forma de Pago</th>
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
                                    <th>
                                        {{$order->fecha}}
                                    </th>
                                    <td>${{$order->pago}}</td>
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

              <div class="tab-pane fade" id="v-pills-temarios" role="tabpanel" aria-labelledby="v-pills-temarios-tab" tabindex="0">
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
                    @foreach ($usuario_compro as $video)
                        <h5>{{$video->nombre}}</h5>

                        <video width="560" height="315" controls>
                            <source src="{{asset('clase_grabada/'. $video->clase_grabada) }}" type="video/mp4">
                          </video>


                    @endforeach
                </div>
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
                            <th >Num. Pedido</th>
                            <th >Fecha de Compra</th>
                            <th >Total</th>
                            <th>Forma de Pago</th>
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
                                    <th>
                                        {{$order->fecha}}
                                    </th>
                                    <td>${{$order->pago}}</td>
                                    <td class="td_title_checkout">{{$order->forma_pago}}</td>
                                    <td>
                                        @if ($order->estatus == '1')
                                            Completado
                                        @else
                                            En espera
                                        @endif
                                    </td>
                                    <th>
                                        {{$order->fecha}}
                                    </th>
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
                        <h2 class="title_curso mb-5">Mis Clases </h2>
                    </div>



                </div>
            </div>


          </div>
    </div>

</section>



@endsection

@section('js')

@endsection


