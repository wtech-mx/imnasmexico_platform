@extends('layouts.app_user')

@section('template_title')
Mi perfil- {{$cliente->name}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
@endsection

<style>
    .accordion-button:not(.collapsed) {
        color: #fff!important;
    }

</style>

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="contenido">

    <div class="row space_newprofile" style="">

        <div class="col-12">
            <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3">Mi Perfil</h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/icons/informacion.png')}}" alt="">
                    </div>
                    <form role="form" action="{{ route('perfil.update', $cliente->code) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="title_curso mb-5">Datos del Alumno</h2>
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

                                <input class="form-control prb" type="text"  id="direccion" name="direccion" placeholder="Direccion" value="{{$cliente->direccion}}">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/location-pointer.png')}}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="city" name="city" placeholder="Municipio y/o Provincia" value="{{$cliente->city}}">
                                </div>
                            </div>

                            <div class="col-6 col-lg-4 form-group ">
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cp.png')}}" alt="">

                                </span>

                                <input class="form-control" type="text"  id="postcode" name="postcode" placeholder="CP" value="{{$cliente->postcode}}">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 form-group ">
                                <button type="submit" class="btn_save_profile mb-sm-2" style="border: solid 0px;">
                                    Guardar
                                </button>
                            </div>

                            <div class="col-4 col-lg-4 form-group ">
                                <a class="btn_save_profile" type="button" href="{{ route('signout') }}" style="background: #ff1212cf;">
                                    Cerrar Sesión
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/salida.png')}}" alt="">
                                </a>
                            </div>

                        </div>
                    </form>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Mis Compras</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/objetivo.webp')}}" alt="">
                </div>

                <div class="row space_laaterales_profile">
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
        </div>

        <div class="col-12 col-lg-7">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Documentos</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
                <nav>
                    <div class="d-flex justify-content-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">
                                Doc. Personal
                            </button>
                        </div>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent" style="">
                    <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
                        <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form" onsubmit="disableButton()">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">

                            <div class="row">
                                @php
                                    $tiene_documentos = false;
                                @endphp
                                @foreach($documentos as $documento)
                                        @php
                                            $tiene_documentos = true;
                                        @endphp

                                        <div class="col-6 form-group p-3 mt-2">

                                            @if($documento->ine !== null)

                                            @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')

                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width:100%; height: 100px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                </p>
                                                @else
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 100px;height: 100px;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                    </p>
                                                @endif
                                                <p class="text-center">
                                                    Se ha cargado tu <strong>INE</strong> con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                    ¿Quieres reemplazar el archivo actual?
                                                </p>

                                                <div class="d-flex justify-content-center">
                                                    <a id="noButton" class="btn_save_profile" >No</a>
                                                    <a id="siButton" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                </div>

                                                <div class="content_files">
                                                    <label for="ine">INE Frente y atras</label><br>
                                                    <input name="ine" hidden id="btnoriginal2" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall2').innerText=document.getElementById('btnoriginal2').files[0]['name'];" type="file" value="Adjuntar documento">
                                                    <button type="button" id='botonpersonal2' onClick="document.getElementById('btnoriginal2').click();">Adjuntar documento</button>
                                                    <small id='tagsmall2'></small>
                                                </div>

                                            @else
                                                  <label for="ine">INE Frente y atras</label><br>
                                                  <input name="ine" hidden id="btnoriginal2" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall2').innerText=document.getElementById('btnoriginal2').files[0]['name'];" type="file" value="Adjuntar documento">
                                                  <button type="button" id='botonpersonal2' onClick="document.getElementById('btnoriginal2').click();">Adjuntar documento</button>
                                                  <small id='tagsmall2'></small>
                                            @endif

                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">

                                            @if($documento->curp !== null)

                                            @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')

                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width:100%; height: 100px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                </p>
                                                @else
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 100px;height: 100px;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                    </p>
                                                @endif
                                                <p class="text-center">
                                                    Se ha cargado tu <strong>CURP</strong> con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                    ¿Quieres reemplazar el archivo actual?
                                                </p>

                                                <div class="d-flex justify-content-center">
                                                    <a id="noButton2" class="btn_save_profile" >No</a>
                                                    <a id="siButton2" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                </div>

                                                <div class="content_files2">
                                                    <label for="curp">CURP</label><br>
                                                    <input name="curp" hidden id="btnoriginal3" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall1').innerText=document.getElementById('btnoriginal3').files[0]['name'];" type="file" value="Adjuntar documento">
                                                    <button type="button" id='botonpersonal1' onClick="document.getElementById('btnoriginal3').click();">Adjuntar documento</button>
                                                </div>

                                            @else
                                                <label for="curp">CURP</label><br>
                                                <input name="curp" hidden id="btnoriginal3" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall1').innerText=document.getElementById('btnoriginal3').files[0]['name'];" type="file" value="Adjuntar documento">
                                                <button type="button" id='botonpersonal1' onClick="document.getElementById('btnoriginal3').click();">Adjuntar documento</button>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">

                                            @if($documento->foto_tam_infantil !== null)

                                            @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')

                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 100px;height: 100px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                </p>
                                                @else
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 100px;height: 100px;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                    </p>
                                                @endif
                                                <p class="text-center">
                                                    Se ha cargado tu <strong>FOTO</strong> con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                    ¿Quieres reemplazar el archivo actual?
                                                </p>

                                                <div class="d-flex justify-content-center">
                                                    <a id="noButton3" class="btn_save_profile" >No</a>
                                                    <a id="siButton3" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                </div>

                                                <div class="content_files3">
                                                    <label for="foto_tam_infantil">Foto Infantil blanco y/o negro</label><br>
                                                    <input name="foto_tam_infantil" hidden id="btnoriginal4" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall4').innerText=document.getElementById('btnoriginal4').files[0]['name'];" type="file" value="Adjuntar documento">
                                                    <button type="button" id='botonpersonal4' onClick="document.getElementById('btnoriginal4').click();">Adjuntar documento</button>
                                                </div>

                                            @else
                                                <label for="foto_tam_infantil">Foto Infantil blanco y/o negro</label><br>
                                                <input name="foto_tam_infantil" hidden id="btnoriginal4" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall4').innerText=document.getElementById('btnoriginal4').files[0]['name'];" type="file" value="Adjuntar documento">
                                                <button type="button" id='botonpersonal4' onClick="document.getElementById('btnoriginal4').click();">Adjuntar documento</button>
                                            @endif
                                        </div>
                                @endforeach

                                @if($tiene_documentos)
                                    <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                                @else
                                    <!-- Si el usuario no tiene documentos, mostramos el formulario -->
                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="ine">INE Frente y atras</label><br>
                                        <input name="ine" hidden id="btnoriginal3" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall2').innerText=document.getElementById('btnoriginal3').files[0]['name'];" type="file" value="Adjuntar documento">
                                        <button type="button" id='botonpersonal3' onClick="document.getElementById('btnoriginal3').click();">Adjuntar documento</button>
                                        <small id='tagsmall2'>No hay archivos adjuntos</small>
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="curp">CURP</label><br>
                                        <input name="curp" hidden id="btnoriginal3" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall3').innerText=document.getElementById('btnoriginal3').files[0]['name'];" type="file" value="Adjuntar documento">
                                        <button type="button" id='botonpersonal3' onClick="document.getElementById('btnoriginal3').click();">Adjuntar documento</button>
                                        <small id='tagsmall3'>No hay archivos adjuntos</small>
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="foto_tam_titulo">Foto Infantil blanco y/o negro</label><br>
                                        <input name="foto_tam_infantil" hidden id="btnoriginal4" class="form-control text-center col-md-6" onChange="document.getElementById('tagsma015').innerText=document.getElementById('btnoriginal4').files[0]['name'];" type="file" value="Adjuntar documento">
                                        <button type="button" id='botonpersonal4' onClick="document.getElementById('btnoriginal4').click();">Adjuntar documento</button>
                                        <small id='tagsmall4'>No hay archivos adjuntos</small>
                                    </div>

                                @endif

                                <div class="col-12">
                                    <button type="submit"  id="submitButton" class="btn_save_profile d-inline-block" style="border: solid 0px;" >
                                        Guardar
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">

            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">
                        Mis Clases
                    </h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                </div>

                <div class="row">
                        <div class="col-12">
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
                                                        <h3 class="text-center mt-5 mb-3"><img class="icon_nav_course" src="{{asset('assets/user/icons/clase.webp')}}" alt=""> <strong>Clases grabadas</strong></h3>
                                                    </div>
                                                    <div class="row">
                                                        @if ($video->Orders->clase_grabada_orden == NULL)
                                                            @foreach($usuario_video as $user_video)
                                                                @if ($video->Cursos->id == $user_video->id_curso)
                                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Módulo 1</strong></h5>
                                                                        @php
                                                                            $url = $user_video->clase_grabada;
                                                                            preg_match('/\/file\/d\/(.+?)\//', $url, $matches);
                                                                            $id_link_drive = $matches[1] ?? null;
                                                                        @endphp
                                                                        @if ($id_link_drive)
                                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive }}/preview" class="iframe_clase"></iframe>
                                                                        <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive }}" target="_blank" >Ver Clase</a>
                                                                        @else
                                                                        <a class="text-dark" href="{{$user_video->clase_grabada}}" target="_blank" >Ver Clase</a>
                                                                            {{-- <p>El video se encuentra como privado</p> --}}
                                                                        @endif
                                                                    </div>

                                                                    @if ( $user_video->clase_grabada2 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 2</strong></h5>
                                                                            @php
                                                                                $url2 = $user_video->clase_grabada2;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url2, $matches2);
                                                                                $id_link_drive2 = $matches2[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive2)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive2 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive2 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada3 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 3</strong></h5>
                                                                            @php
                                                                                $url3 = $user_video->clase_grabada3;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url3, $matches3);
                                                                                $id_link_drive3 = $matches3[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive3)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive3 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive3 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada4 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 4</strong></h5>
                                                                            @php
                                                                                $url4 = $user_video->clase_grabada4;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url4, $matches4);
                                                                                $id_link_drive4 = $matches4[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive4)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive4 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive4 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada5 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 5</strong></h5>
                                                                            @php
                                                                                $url5 = $user_video->clase_grabada5;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url5, $matches5);
                                                                                $id_link_drive5 = $matches5[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive5)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive5 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive5 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @foreach($clase_grabada as $user_video)
                                                                @if ($video->Cursos->id == $user_video->id_curso)
                                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Módulo 1</strong></h5>
                                                                        @php
                                                                            $url = $user_video->clase_grabada;
                                                                            preg_match('/\/file\/d\/(.+?)\//', $url, $matches);
                                                                            $id_link_drive = $matches[1] ?? null;
                                                                        @endphp
                                                                        @if ($id_link_drive)
                                                                        <iframe src="https://drive.google.com/file/d/{{ $id_link_drive }}/preview" class="iframe_clase"></iframe>
                                                                        <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive }}" target="_blank" >Ver Clase</a>
                                                                        @else
                                                                            <p>El video se encuentra como privado</p>
                                                                        @endif
                                                                    </div>

                                                                    @if ( $user_video->clase_grabada2 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 2</strong></h5>
                                                                            @php
                                                                                $url2 = $user_video->clase_grabada2;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url2, $matches2);
                                                                                $id_link_drive2 = $matches2[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive2)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive2 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive2 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada3 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 3</strong></h5>
                                                                            @php
                                                                                $url3 = $user_video->clase_grabada3;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url3, $matches3);
                                                                                $id_link_drive3 = $matches3[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive3)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive3 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive3 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada4 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 4</strong></h5>
                                                                            @php
                                                                                $url4 = $user_video->clase_grabada4;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url4, $matches4);
                                                                                $id_link_drive4 = $matches4[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive4)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive4 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive4 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    @if ($user_video->clase_grabada5 != NULL)
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Módulo 5</strong></h5>
                                                                            @php
                                                                                $url5 = $user_video->clase_grabada5;
                                                                                preg_match('/\/file\/d\/(.+?)\//', $url5, $matches5);
                                                                                $id_link_drive5 = $matches5[1] ?? null;
                                                                            @endphp
                                                                            @if ($id_link_drive5)
                                                                            <iframe src="https://drive.google.com/file/d/{{ $id_link_drive5 }}/preview" class="iframe_clase"></iframe>
                                                                            <a class="text-dark" href="https://drive.google.com/file/d/{{ $id_link_drive5 }}" target="_blank" >Ver Clase</a>
                                                                            @else
                                                                                <p>El video se encuentra como privado</p>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="d-flex justify-content-center">
                                                        <ul class="nav nav-tabs" id="myTabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#content1{{$video->id_tickets}}" role="tab" aria-controls="content1" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Material de clase <img src="{{ asset('assets/user/icons/stack-of-books.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#content2{{$video->id_tickets}}" role="tab" aria-controls="content2" style="font-size: 19px;" class="tab_profile_materials" aria-selected="false">Literatura para el estudiante <img src="{{ asset('assets/user/icons/read.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="tab_doc" data-bs-toggle="tab" href="#content_doc{{$video->id_tickets}}" role="tab" aria-controls="content_doc" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Documentos <img src="{{ asset('assets/user/icons/cedula.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                            @if ($video->Cursos->CursosEstandares->count() > 0)
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab_estandar" data-bs-toggle="tab" href="#content_estandar{{$video->id_tickets}}" role="tab" aria-controls="content_estandar" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Estándares <img src="{{ asset('assets/user/icons/certificacion.webp') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab_descargas" data-bs-toggle="tab" href="#content_descargas{{$video->id_tickets}}" role="tab" aria-controls="content_descargas" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Descargas/Subir Documentos <img src="{{ asset('assets/user/icons/documentos.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                                </li>
                                                            @endif
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="tab_costos" data-bs-toggle="tab" href="#content_costos{{$video->id_tickets}}" role="tab" aria-controls="content_costos" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Lista de precios y costos de tratamientos <img src="{{ asset('assets/user/icons/money.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="tab_contacto" data-bs-toggle="tab" href="#content_contacto{{$video->id_tickets}}" role="tab" aria-controls="content_contacto" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Contacto <img src="{{ asset('assets/user/icons/complain.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="tab_avales" data-bs-toggle="tab" href="#content_avales{{$video->id_tickets}}" role="tab" aria-controls="content_avales" style="font-size: 19px;" class="tab_profile_materials" aria-selected="true">Avales y Estándares <img src="{{ asset('assets/user/icons/certificate.png') }}" alt="" class="img_tabs_profile_ss" style=""></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="content1{{$video->id_tickets}}" role="tabpanel" aria-labelledby="tab1">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                @if (isset($carpetas_material) && $carpetas_material != NULL)
                                                                @php
                                                                    $contador = 1; // Inicializamos un contador
                                                                @endphp
                                                                    @foreach ($carpetas_material as $carpeta)
                                                                        @php
                                                                            $file_info = new SplFileInfo($carpeta->nombre_recurso);
                                                                            $extension = $file_info->getExtension();
                                                                        @endphp
                                                                        @if ($carpeta->id_carpeta == $video->Cursos->carpeta)
                                                                            @if ($extension === 'pdf')
                                                                            <div class="col-lg-4 col-md-6 col-sm-12  col-12 mt-3">
                                                                                <p class="text-center">
                                                                                    <h3>{{ substr($carpeta->nombre_recurso, 13) }}</h3>
                                                                                <embed class="embed_pdf" src="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" type="application/pdf"  />
                                                                                    <a class="text-dark d-block" href="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" target="_blank" >
                                                                                        Ver PDF
                                                                                    </a>
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
                                                                @else
                                                                    <!-- Aquí puedes mostrar un mensaje o contenido alternativo cuando no hay datos -->
                                                                    <p>No hay datos disponibles.</p>
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content2{{$video->id_tickets}}" role="tabpanel" aria-labelledby="tab2">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    @if (isset($carpetas_literatura) && $carpetas_literatura != NULL)
                                                                        <h2>Literatura de fase de tratamiento facial  <img src="{{ asset('assets/user/icons/skincare.png') }}" alt="" style="width:30px;"></h2>
                                                                        @foreach ($carpetas_literatura as $carpeta)
                                                                            @if ($carpeta->sub_area_recurso == 'facial')
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
                                                                            @endif
                                                                        @endforeach
                                                                        <h2>Literatura de fase de tratamiento corporal  <img src="{{ asset('assets/user/icons/massage.png') }}" alt="" style="width:30px;"></h2>
                                                                        @foreach ($carpetas_literatura as $carpeta)
                                                                            @if ($carpeta->sub_area_recurso == 'corporal')
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
                                                                            @endif
                                                                        @endforeach
                                                                        @else
                                                                        <!-- Aquí puedes mostrar un mensaje o contenido alternativo cuando no hay datos -->
                                                                        <p>No hay datos disponibles.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content_doc{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
                                                            <div class="row">
                                                            <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">

                                                                    @php
                                                                        $tiene_documentos = false;
                                                                    @endphp
                                                                    @foreach($documentos as $documento)
                                                                    <div class="row">
                                                                            @php
                                                                                $tiene_documentos = true;
                                                                            @endphp

                                                                            @if($documento->foto_tam_infantil !== null)

                                                                            <div class="col-12 form-group p-3 mt-2">
                                                                                @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                                                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 60%; height: 60px;"></iframe>
                                                                                    <p class="text-center ">
                                                                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                                    </p>
                                                                                @else
                                                                                    <p class="text-center mt-2">
                                                                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                                    </p>
                                                                                @endif

                                                                                <p class="text-center">
                                                                                    Se ha cargado tu archivo con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                                    ¿Quieres reemplazar el archivo actual?
                                                                                </p>

                                                                                <div class="d-flex justify-content-center">
                                                                                    <a id="noButton_{{$video->id_tickets}}" class="btn_save_profile" >No</a>
                                                                                    <a id="siButton_{{$video->id_tickets}}" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                                                </div>

                                                                                <div class="content_files_{{$video->id_tickets}}">
                                                                                    <label for="foto_tam_infantil">Foto tamaño Infantil blanco y negro</label>
                                                                                    <input name="foto_tam_infantil" hidden id="btnoriginal5{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall5{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal5{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                    <button type="button" id='botonpersonal5{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal5{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                    <small id='tagsmall5{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                </div>

                                                                            </div>

                                                                            @else

                                                                            <div class="col-12">
                                                                                <label for="foto_tam_infantil">Foto tamaño Infantil blanco y negro</label>
                                                                                <input name="foto_tam_infantil" hidden id="btnoriginal5{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall5{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal5{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                <button type="button" id='botonpersonal5{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal5{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                <small id='tagsmall5{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                            </div>
                                                                            @endif

                                                                            <script>
                                                                                    // Obtener elementos
                                                                                const noButton_{{$video->id_tickets}} = document.getElementById('noButton_{{$video->id_tickets}}');
                                                                                const siButton_{{$video->id_tickets}} = document.getElementById('siButton_{{$video->id_tickets}}');

                                                                                const contentFiles{{$video->id_tickets}} = document.querySelector('.content_files_{{$video->id_tickets}}');

                                                                                // Ocultar el contenedor al principio
                                                                                contentFiles{{$video->id_tickets}}.style.display = 'none';

                                                                                // Agregar eventos de clic a los botones
                                                                                noButton_{{$video->id_tickets}}.addEventListener('click', function () {
                                                                                    contentFiles{{$video->id_tickets}}.style.display = 'none';
                                                                                });

                                                                                siButton_{{$video->id_tickets}}.addEventListener('click', function () {
                                                                                    contentFiles{{$video->id_tickets}}.style.display = 'block';
                                                                                });
                                                                            </script>

                                                                            @if ($video->Cursos->imnas == '1' || $video->Cursos->redconocer == '1')
                                                                                    <div class="col-6 form-group p-3 mt-2">

                                                                                        @if($documento->firma !== null)

                                                                                            @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                                                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 60%; height: 60px;"></iframe>
                                                                                                <p class="text-center ">
                                                                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                                                </p>
                                                                                            @else
                                                                                                <p class="text-center mt-2">
                                                                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                                                </p>
                                                                                            @endif
                                                                                            <p class="text-center">
                                                                                                Se ha cargado tu archivo con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                                                ¿Quieres reemplazar el archivo actual?
                                                                                            </p>

                                                                                            <div class="d-flex justify-content-center">
                                                                                                <a id="noButtonfirma_{{$video->id_tickets}}" class="btn_save_profile" >No</a>
                                                                                                <a id="siButtonfirma_{{$video->id_tickets}}" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                                                            </div>

                                                                                            <div class="content_filesfirma_{{$video->id_tickets}}">
                                                                                                <label for="firma">Firma</label>
                                                                                                <input name="firma" hidden id="btnoriginal6{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall6{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal6{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                                <button type="button" id='botonpersonal6{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal6{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                                <small id='tagsmall6{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                            </div>

                                                                                        @else
                                                                                            <label for="firma">Firma</label>
                                                                                            <input name="firma" hidden id="btnoriginal6{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall6{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal6{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                            <button type="button" id='botonpersonal6{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal6{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                            <small id='tagsmall6{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                        @endif

                                                                                        <script>
                                                                                            // Obtener elementos
                                                                                            const noButtonfirma_{{$video->id_tickets}} = document.getElementById('noButtonfirma_{{$video->id_tickets}}');
                                                                                            const siButtonfirma_{{$video->id_tickets}} = document.getElementById('siButtonfirma_{{$video->id_tickets}}');

                                                                                            const content_filesfirma_{{$video->id_tickets}} = document.querySelector('.content_filesfirma_{{$video->id_tickets}}');

                                                                                            // Ocultar el contenedor al principio
                                                                                            content_filesfirma_{{$video->id_tickets}}.style.display = 'none';

                                                                                            // Agregar eventos de clic a los botones
                                                                                            noButtonfirma_{{$video->id_tickets}}.addEventListener('click', function () {
                                                                                                content_filesfirma_{{$video->id_tickets}}.style.display = 'none';
                                                                                            });

                                                                                            siButtonfirma_{{$video->id_tickets}}.addEventListener('click', function () {
                                                                                                content_filesfirma_{{$video->id_tickets}}.style.display = 'block';
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                            @endif
                                                                    </div>
                                                                    @endforeach

                                                                    @if($tiene_documentos)
                                                                        <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                                                                    @else
                                                                        <!-- Si el usuario no tiene documentos, mostramos el formulario -->
                                                                        <div class="row">
                                                                            <div class="col-12 form-group p-3 mt-2">
                                                                                <label for="foto_tam_infantil">Foto tamaño Infantil blanco y negro</label>
                                                                                <input name="foto_tam_infantil" hidden id="btnoriginal7{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall7{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal7{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                <button type="button" id='botonpersonal7{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal7{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                <small id='tagsmall7{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                            </div>

                                                                            @if ($video->Cursos->imnas == '1' || $video->Cursos->redconocer == '1')
                                                                                    <div class="col-12 form-group p-3 mt-2">
                                                                                        <label for="firma">Firma</label>
                                                                                        <input name="firma" hidden id="btnoriginal8{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall8{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal8{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                        <button type="button" id='botonpersonal8{{$video->id_tickets}}' onClick="document.getElementById('btnoriginal8{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                        <small id='tagsmall8{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                    </div>
                                                                            @endif
                                                                        </div>
                                                                    @endif

                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn_save_profile d-inline-block" >
                                                                            Guardar
                                                                        </button>
                                                                    </div>

                                                            </form>

                                                            <form action="{{ route('documentos.store_cliente', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($carpetas_carta as $documento_carta)
                                                                    <h3 class="mt-5 mb-2">Documentos extras obligatorios</h3>

                                                                    @php
                                                                        $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento_carta->id)->exists();
                                                                        $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento_carta->id)->orderBy('created_at', 'desc')->first();
                                                                    @endphp
                                                                <div class="row">

                                                                    <div class="col-6  mb-2">
                                                                            <a href="{{asset('cursos/' . $carpeta->nombre_carpeta . '/' . $documento_carta->nombre_recurso) }}" download="{{$documento_carta->nombre_recurso}}" style="text-decoration: none; color: #000">
                                                                                <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                                {{ substr($documento_carta->nombre_recurso, 13) }}
                                                                            </a>
                                                                            <a class="text-center text-white btn btn-sm ml-2" href="{{asset('cursos/' . $carpeta->nombre_carpeta . '/' . $documento_carta->nombre_recurso) }}" download="{{$documento_carta->nombre_recurso}}" style="background: #836262; border-radius: 19px;">
                                                                                Descargar
                                                                            </a>
                                                                    </div>

                                                                    <div class="col-3 form-group p-3 mt-2">

                                                                        @if ($documentoDescargado)

                                                                            @if (pathinfo($documentoSubido->documento, PATHINFO_EXTENSION) == 'pdf')
                                                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento)}}" style="width: 60%; height: 60px;"></iframe>
                                                                                <p class="text-center ">
                                                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                                </p>
                                                                            @else
                                                                                <p class="text-center mt-2">
                                                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" alt="Imagen" style="width: 120px;height: 80%;"/><br>
                                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                                </p>
                                                                            @endif

                                                                        </div>

                                                                        <div class="col-3 form-group p-3 mt-2">

                                                                            <p class="text-center">
                                                                                Se ha cargado tu archivo con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                                ¿Quieres reemplazar el archivo actual?
                                                                            </p>

                                                                            <div class="d-flex justify-content-center">
                                                                                <a id="noButtondoc_{{ $documento_carta->id }}" class="btn_save_profile" >No</a>
                                                                                <a id="siButtondoc_{{ $documento_carta->id }}" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                                            </div>

                                                                            <div class="content_files_{{ $documento_carta->id }}">
                                                                                <input type="hidden" name="documento_ids[]" value="{{ $documento_carta->id }}">
                                                                                <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                                <input   name="archivos[]" hidden id="btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall{{ $documento_carta->id }}{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                <button type="button" id="botonpersonal{{ $documento_carta->id }}{{$video->id_tickets}}" onClick="document.getElementById('btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                <small id='tagsmall{{ $documento_carta->id }}{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                            </div>

                                                                        @else
                                                                            <input type="hidden" name="documento_ids[]" value="{{ $documento_carta->id }}">
                                                                            <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                            <input   name="archivos[]" hidden id="btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall{{ $documento_carta->id }}{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                            <button type="button" id="botonpersonal{{ $documento_carta->id }}{{$video->id_tickets}}" onClick="document.getElementById('btnoriginal{{ $documento_carta->id }}{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                            <small id='tagsmall{{ $documento_carta->id }}{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                        @endif

                                                                        <script>
                                                                            // Obtener elementos
                                                                            const noButtondoc_{{ $documento_carta->id }} = document.getElementById('noButtondoc_{{ $documento_carta->id }}');
                                                                            const siButtondoc_{{ $documento_carta->id }} = document.getElementById('siButtondoc_{{ $documento_carta->id }}');

                                                                            const contentFilesdoc_{{ $documento_carta->id }} = document.querySelector('.content_files_{{ $documento_carta->id }}');

                                                                            // Ocultar el contenedor al principio
                                                                            contentFilesdoc_{{ $documento_carta->id }}.style.display = 'none';

                                                                            // Agregar eventos de clic a los botones
                                                                            noButtondoc_{{ $documento_carta->id }}.addEventListener('click', function () {
                                                                                contentFilesdoc_{{ $documento_carta->id }}.style.display = 'none';
                                                                            });

                                                                            siButtondoc_{{ $documento_carta->id }}.addEventListener('click', function () {
                                                                                contentFilesdoc_{{ $documento_carta->id }}.style.display = 'block';
                                                                            });
                                                                        </script>

                                                                    </div>

                                                                </div>
                                                                @endforeach
                                                                @if ($carpetas_carta->count() > 0)
                                                                    <div class="col-6">
                                                                        <button class="btn_save_profile d-inline-block mt-3 mb-3" style="" type="submit">Subir Documento</button>
                                                                    </div>
                                                                @endif

                                                            </form>

                                                        </div>
                                                        </div>
                                                            <div class="tab-pane fade" id="content_estandar{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-estandar-tab" tabindex="0" style="min-height: auto!important;">
                                                                <div class="row">
                                                                    @foreach ($estandaresComprados as $estandar)
                                                                    <div class="col-12">
                                                                            <h4 class="text-center">Guía para estándar {{ $estandar->nombre }}</h4> <br>
                                                                                @php
                                                                                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', '1')->get();
                                                                                @endphp
                                                                                <div class="row">
                                                                                    @foreach ($documentos_estandar as $documento)
                                                                                        @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                                                                                        <div class="col-4">
                                                                                            <p class="text-center ">
                                                                                                <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                                                    <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/><br>
                                                                                                    {{ substr($documento->nombre, 13) }}
                                                                                                </a><br>
                                                                                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                                                    Descargar
                                                                                                </a>
                                                                                            </p>
                                                                                        </div>
                                                                                        @else
                                                                                        <div class="col-4">
                                                                                            <p class="text-center mt-2">
                                                                                                <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                                                    <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 45px; height: 45px;"/><br>
                                                                                                    {{ substr($documento->nombre, 13) }}
                                                                                                </a><br>
                                                                                                <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                                                    Descargar
                                                                                                </a>
                                                                                            </p>
                                                                                        </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="content_descargas{{$video->id_tickets}}" role="tabpanel" aria-labelledby="nav-descargas-tab" tabindex="0" style="min-height: auto!important;">
                                                                <div class="row">
                                                                    @foreach ($estandaresComprados as $estandar)
                                                                        <div class="col-12">
                                                                            <h4 class="text-center">{{ $estandar->nombre }}</h4> <br>
                                                                                @php
                                                                                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', NULL)->get();
                                                                                @endphp
                                                                                    <form action="{{ route('documentos.store_cliente', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @foreach ($documentos_estandar as $documento)
                                                                                            @php
                                                                                                $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->exists();
                                                                                                $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->orderBy('created_at', 'desc')->first();
                                                                                            @endphp
                                                                                        <div class="row">

                                                                                            <div class="col-6  mb-2">
                                                                                                    <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                                                        <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                                                        {{ substr($documento->nombre, 13) }}
                                                                                                    </a>
                                                                                                    <a class="text-center text-white btn btn-sm ml-2" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                                                        Descargar
                                                                                                    </a>
                                                                                            </div>

                                                                                            <div class="col-3 form-group p-3 mt-2">

                                                                                                @if ($documentoDescargado)

                                                                                                    @if (pathinfo($documentoSubido->documento, PATHINFO_EXTENSION) == 'pdf')
                                                                                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento)}}" style="width: 60%; height: 60px;"></iframe>
                                                                                                        <p class="text-center ">
                                                                                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                                                        </p>
                                                                                                    @else
                                                                                                        <p class="text-center mt-2">
                                                                                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" alt="Imagen" style="width: 120px;height: 80%;"/><br>
                                                                                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                                                        </p>
                                                                                                    @endif

                                                                                                </div>

                                                                                                <div class="col-3 form-group p-3 mt-2">

                                                                                                    <p class="text-center">
                                                                                                        Se ha cargado tu archivo con exito <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                                                        ¿Quieres reemplazar el archivo actual?
                                                                                                    </p>

                                                                                                    <div class="d-flex justify-content-center">
                                                                                                        <a id="noButtondoc_{{ $documento->id }}" class="btn_save_profile" >No</a>
                                                                                                        <a id="siButtondoc_{{ $documento->id }}" class="btn_save_profile" style="margin-left: 1rem">Si -</a>
                                                                                                    </div>

                                                                                                    <div class="content_files_{{ $documento->id }}">
                                                                                                        <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                                                        <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                                                        <input   name="archivos[]" hidden id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall{{ $documento->id }}{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                                        <button type="button" id="botonpersonal{{ $documento->id }}{{$video->id_tickets}}" onClick="document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                                        <small id='tagsmall{{ $documento->id }}{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                                    </div>

                                                                                                @else
                                                                                                    <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                                                    <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                                                    <input   name="archivos[]" hidden id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall{{ $documento->id }}{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar documento">
                                                                                                    <button type="button" id="botonpersonal{{ $documento->id }}{{$video->id_tickets}}" onClick="document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').click();">Adjuntar documento</button>
                                                                                                    <small id='tagsmall{{ $documento->id }}{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                                                @endif

                                                                                                <script>
                                                                                                    // Obtener elementos
                                                                                                const noButtondoc_{{ $documento->id }} = document.getElementById('noButtondoc_{{ $documento->id }}');
                                                                                                const siButtondoc_{{ $documento->id }} = document.getElementById('siButtondoc_{{ $documento->id }}');

                                                                                                const contentFilesdoc_{{ $documento->id }} = document.querySelector('.content_files_{{ $documento->id }}');

                                                                                                // Ocultar el contenedor al principio
                                                                                                contentFilesdoc_{{ $documento->id }}.style.display = 'none';

                                                                                                // Agregar eventos de clic a los botones
                                                                                                noButtondoc_{{ $documento->id }}.addEventListener('click', function () {
                                                                                                    contentFilesdoc_{{ $documento->id }}.style.display = 'none';
                                                                                                });

                                                                                                siButtondoc_{{ $documento->id }}.addEventListener('click', function () {
                                                                                                    contentFilesdoc_{{ $documento->id }}.style.display = 'block';
                                                                                                });
                                                                                            </script>

                                                                                            </div>

                                                                                        </div>
                                                                                        @endforeach
                                                                                        <div class="col-6">
                                                                                            <button class="btn_save_profile d-inline-block mt-3 mb-3" style="" type="submit">Subir Documento</button>
                                                                                        </div>
                                                                                    </form>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                        <div class="tab-pane fade" id="content_costos{{$video->id_tickets}}" role="tabpanel" aria-labelledby="tab_costos">
                                                            <div class="col-12">
                                                                <div id="carrousel_publicidad_mb_{{$video->id_tickets}}" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                    @foreach ($publicidad as $item)
                                                                        @php
                                                                            $file_info = new SplFileInfo($item->nombre);
                                                                            $extension = $file_info->getExtension();
                                                                        @endphp
                                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                            @if ($extension == 'jpg')
                                                                            <p class="text-center">
                                                                            <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                                            </p>
                                                                            @elseif ($extension == 'png')
                                                                            <p class="text-center">
                                                                            <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                                            </p>
                                                                            @elseif ($extension == 'jpeg')
                                                                            <p class="text-center">
                                                                            <img class="img_material_clase_pc" src="{{asset('publicidad/'. $item->nombre) }}" class="d-block" alt="{{ $item->nombre }}">
                                                                            </p>
                                                                            @elseif ($extension == 'pdf')
                                                                            <p class="text-center">
                                                                            <embed class="embed_pdf_publicidad" src="{{asset('publicidad/'. $item->nombre) }}" type="application/pdf"  />
                                                                            <a class="text-dark" href="{{ asset('publicidad/' . $item->nombre) }}" target="_blank" >Ver PDF</a>
                                                                            </p>
                                                                            @elseif ($extension == 'mp4')
                                                                            <p class="text-center">
                                                                            <video class="video_publicidad" src="{{asset('publicidad/'. $item->nombre) }}" controls></video>
                                                                            </p>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                    </div>

                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_publicidad_mb_{{$video->id_tickets}}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_publicidad_mb_{{$video->id_tickets}}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content_contacto{{$video->id_tickets}}" role="tabpanel" aria-labelledby="tab_contacto">
                                                            <div class="col-12">
                                                                <div id="carrousel_contacto_mb_{{$video->id_tickets}}" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <div class="carousel-item active">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f3809a6CURSOS ONLINE.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f380e3bCURSOS PRESENCIALES.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f3823e8DOCUMENTACIÓN.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646513beca4b6INSTALACIONES-DOCUMENTOS_4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646513beccf90SEP CONOCER.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f33aeb2CAM-01.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f33bbccCAM.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646512f3812b7DISTRIBUIDAORA DE PRODUCTO.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/646513becd472VENTAS DE PRODCUTO.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/64deb7c5d9f866465176806a32Lic Carla-1.jpeg') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_contacto_mb_{{$video->id_tickets}}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_contacto_mb_{{$video->id_tickets}}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="content_avales{{$video->id_tickets}}" role="tabpanel" aria-labelledby="tab_avales">
                                                            <div class="col-12">
                                                                <div id="carrousel_avales_mb_{{$video->id_tickets}}" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <div class="carousel-item active">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_1.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_2.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_3.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_5.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_6.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_7.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_8.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_9.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_10.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_11.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_12.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_13.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_14.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_15.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_16.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_17.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_18.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_19.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_20.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_21.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_22.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/avales_23.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-1.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-2.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-3.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-5.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-6.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('publicidad/ESTÁNDARES-SECTORES-7.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_avales_mb_{{$video->id_tickets}}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_avales_mb_{{$video->id_tickets}}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                    </button>
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
                        </div>
                </div>

            </div>
        </div>

    </div>

</section>

@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/admin/js/jquery.signature.js') }}"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/jquery.signature.css') }}">

<script>

    var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});
      $('#clear').click(function (e) {
          e.preventDefault();
          sig.signature('clear');
          $("#signed").val('');
      });

    function disableButton() {
        // Deshabilita el botón de guardar después de hacer clic
        document.getElementById('submitButton').disabled = true;
    }

        // Obtener elementos
    const noButton = document.getElementById('noButton');
    const siButton = document.getElementById('siButton');

    const noButton2 = document.getElementById('noButton2');
    const siButton2 = document.getElementById('siButton2');

    const noButton3 = document.getElementById('noButton3');
    const siButton3 = document.getElementById('siButton3');



    const contentFiles = document.querySelector('.content_files');
    const contentFiles2 = document.querySelector('.content_files2');
    const contentFiles3 = document.querySelector('.content_files3');

    // Ocultar el contenedor al principio
    contentFiles.style.display = 'none';
    contentFiles2.style.display = 'none';
    contentFiles3.style.display = 'none';

    // Agregar eventos de clic a los botones
    noButton.addEventListener('click', function () {
        contentFiles.style.display = 'none';
    });

    siButton.addEventListener('click', function () {
        contentFiles.style.display = 'block';
    });

    // Agregar eventos de clic a los botones
    noButton2.addEventListener('click', function () {
        contentFiles2.style.display = 'none';
    });

    siButton2.addEventListener('click', function () {
        contentFiles2.style.display = 'block';
    });

    // Agregar eventos de clic a los botones
    noButton3.addEventListener('click', function () {
        contentFiles3.style.display = 'none';
    });

    siButton3.addEventListener('click', function () {
        contentFiles3.style.display = 'block';
    });


</script>

@endsection


