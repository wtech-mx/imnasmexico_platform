@extends('layouts.app_user')

@section('template_title')
Mi perfil- {{$cliente->name}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />@endsection

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
                                <button type="submit" class="btn_save_profile" >
                                    Guardar
                                </button>
                            </div>

                            <div class="col-4 col-lg-4 form-group ">
                                <a class="btn_save_profile" type="button" href="{{ route('signout') }}">Cerrar Sesión</a>
                            </div>

                        </div>
                    </form>
            </div>
        </div>

        <div class="col-12 col-lg-6">
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

        <div class="col-12 col-lg-6">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Reconocimientos</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
                <nav>
                    <div class="d-flex justify-content-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-descargas-tab" data-bs-toggle="tab" data-bs-target="#nav-descargas" type="button" role="tab" aria-controls="nav-descargas" aria-selected="true">
                                Descargas
                            </button>

                            <button class="nav-link" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">
                                Oficiales
                            </button>

                            <button class="nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                                Estandares
                            </button>
                        </div>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent" style="">
                    <div class="tab-pane fade show active" id="nav-descargas" role="tabpanel" aria-labelledby="nav-descargas-tab" tabindex="0" style="min-height: auto!important;">
                        <div class="row">
                            @foreach ($estandaresComprados as $estandar)
                            <div class="col-12">
                                    <h4 class="text-center">{{ $estandar->nombre }}</h4> <br>
                                        @php
                                            $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->get();
                                        @endphp
                                        <div class="row">
                                            @foreach ($documentos_estandar as $documento)
                                                @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                                                <div class="col-4">
                                                    <p class="text-center ">
                                                        <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 70px; height: 70px;"/>
                                                        <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                            Descargar
                                                        </a>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="col-4">
                                                    <p class="text-center mt-2">
                                                        <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 70px; height: 70px;"/>
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

                    <div class="tab-pane fade" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
                        <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
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
                                            <label for="ine">INE </label>
                                            <input id="ine" name="ine" type="file" class="form-control" >
                                            @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">
                                            <label for="curp">CURP</label>
                                            <input id="curp" name="curp" type="file" class="form-control" >
                                            @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">
                                            <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                            <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                            @if (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">
                                            <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                            <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                            @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">
                                            <label for="carta_compromiso">Carta Compromiso</label>
                                            <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                            @if (pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="col-6 form-group p-3 mt-2">
                                            <label for="firma">Firma</label>
                                            <input id="firma" name="firma" type="file" class="form-control" >
                                            @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        </div>
                                @endforeach

                                @if($tiene_documentos)
                                    <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                                @else
                                    <!-- Si el usuario no tiene documentos, mostramos el formulario -->
                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="ine">INE </label>
                                        <input id="ine" name="ine" type="file" class="form-control" >
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="foto_tam_titulo">CURP</label>
                                        <input id="curp" name="curp" type="file" class="form-control" >
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                        <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="carta_compromiso">Carta Compromiso</label>
                                        <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                    </div>

                                    <div class="col-6 form-group p-3 mt-2">
                                        <label for="firma">Firma</label>
                                        <input id="firma" name="firma" type="file" class="form-control" >
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button type="submit" class="btn_save_profile d-inline-block" >
                                        Guardar
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
                        @php
                            $tiene_documentos_estandar = false;
                        @endphp
                        <div clasS="row">
                            @foreach($documentos_estandares as $documento)
                                    @php
                                        $tiene_documentos = true;
                                    @endphp
                                    <div class="col-6">
                                        @if (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                            </p>
                                        @endif
                                    </div>
                            @endforeach
                        </div>

                        <div clasS="row">

                            @if($tiene_documentos)
                                <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                                @else
                                <div class="col-12">
                                    <p class="text-center">No se han subido archivos aún.</p>
                                </div>
                            @endif

                            <div class="col-12">
                                <div class="d-flex justify-content-center">

                                    <form method="POST" action="{{ route('documentos.store_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input class="form-control" type="file" name="archivos[]" multiple>
                                        <button class="btn_save_profile d-inline-block mt-3" style="margin-left:8rem;" type="submit">Subir archivos</button>
                                    </form>

                                </div>
                            </div>

                        </div>

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
                                                        @if ($video->Orders->clase_grabada_orden == NULL)
                                                            @foreach($usuario_video as $user_video)
                                                                @if ($video->Cursos->id == $user_video->id_curso)
                                                                    <div class="col-12 col-lg-12">
                                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Día 1</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 2</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 3</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 4</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 5</strong></h5>
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
                                                                    <div class="col-12 col-lg-12">
                                                                        <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}}  - <strong>Día 1</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 2</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 3</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 4</strong></h5>
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
                                                                        <div class="col-12 col-lg-12">
                                                                            <h5 class="titile_clase_grabada mt-3 mb-5">{{$user_video->nombre}} - <strong>Día 5</strong></h5>
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

@endsection


