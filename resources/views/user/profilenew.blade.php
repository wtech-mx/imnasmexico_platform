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

    @keyframes blinking {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0.6;
        }
        100% {
            opacity: 1;
        }
    }

        .blinking {
        animation: blinking 1.7s infinite;
        }
</style>

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="contenido">

    <div class="row space_newprofile" style="">

        @if($cliente->user_cam == '4' || $cliente->user_cam == '3')
            <div class="col-12 col-lg-12">
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3" style="color: #6EC1E4!important">CAM</h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/logotipos/cam.png')}}" style="background-color: #6EC1E4!important">
                    </div>

                    <div class="row space_laaterales_profile">
                        <a href="{{ route('cam.index', $cliente->code) }}">

                            @if($cliente->user_cam == '4')
                                <h3 class="title_curso mb-3">Bienvenido Centro  Evaluador - Ver videos de CAM</h3>
                            @else
                                <h3 class="title_curso mb-3">Bienvenido Evaluador independiente - Ver videos de CAM</h3>
                            @endif

                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if($cliente->registro_imnas == '1')
            <div class="col-12 col-lg-12">
                <div class="card_single_horizon">
                    <div class="d-flex justify-content-between">
                        <h2 class="title_curso mb-3" style="color: #5a0421!important">Registros IMNAS</h2>
                        <img class="icon_nav_course" src="{{asset('assets/user/logotipos/imnas.webp')}}" style="background-color: #5a0421!important">
                    </div>

                    <div class="row space_laaterales_profile" >
                        <a href="{{ route('clientes.imnas', $cliente->code) }}" style=" text-decoration: none;" >
                            <h3 class="title_curso mb-3" >
                                Bienvenido - Ir a registros IMNAS <img class="" src="{{asset('assets/user/icons/clic2.png')}}" alt="" style="width: 50px;bottom: -30px;right: -30px;transform: rotate(-40deg);transition: transform 0.3s ease;">
                            </h3>
                        </a>
                    </div>

                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card_single_horizon">

                <div class="row">
                    <div class="col-12 mt-3 mb-3">

                        <p class="d-inline-flex gap-1" style="position: relative">
                            <a class="btn_save_profile" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="border: solid 3px #836262!important;color: #836262!important;background: transparent;">
                              Preguntas Frecuentes <img class="icon_nav_course" src="{{asset('assets/user/icons/pregunta.png')}}" alt="">
                            </a>
                            <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" style="z-index: 10">
                          </p>
                          <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <p>
                                    <strong>Da click en tu pregunta para mas informacion</strong>
                                </p>
                                <ul class="mt-3" style="list-style:none;padding-left: 0rem!important;">
                                    <li class="mt-2" style="">
                                        <a class="td_title_checkout text-dark" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            1- ¿Como puedo ver mis <strong>CLASES GRABADAS</strong>?

                                        </a>
                                    </li>

                                    <li class="mt-2" style="">
                                        <a class="td_title_checkout text-dark" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#subir_docs">
                                            2- ¿Como subir documentos?
                                        </a>
                                    </li>

                                    <li class="mt-2" style="">
                                        <a class="td_title_checkout text-dark" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#sep_cononcer">
                                            3- ¿Como subir documentos para la certificacion <strong>SEP CONOCER</strong>?
                                        </a>
                                    </li>

                                    <li class="mt-2" style="">
                                        <a class="td_title_checkout text-dark" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#mis_clases">
                                            4- ¿Como puedo ver el <strong>MATERIAL DE MIS CLASES</strong>?
                                        </a>
                                    </li>

                                    <li class="mt-2" style="">
                                        <a class="td_title_checkout text-dark" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#diploma_Stp">
                                            5- ¿Como puedo descargar <strong>MI DIPLOMA STPS</strong>?
                                        </a>
                                    </li>
                                </ul>
                            </div>
                          </div>

                    </div>
                </div>

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

                                <input class="form-control" type="text"  id="name" name="name" value="{{$cliente->name}}" readonly>
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

        @include('user.components.faqs.clases_gravadas')
        @include('user.components.faqs.diploma_stps')
        @include('user.components.faqs.mis_clases')
        @include('user.components.faqs.sep_conocer')
        @include('user.components.faqs.subir_documentos')

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
                @include('user.profile_documentos')
            </div>
        </div>

        <div class="col-12">

            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">
                        Mis Clases y Diplomas
                    </h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/video-call.png')}}" alt="">
                </div>

                <div class="row">
                        <div class="col-12">
                            <div class="accordion" id="acordcion_mb_clases">
                                @php
                                    $displayedFolders = []; // Keep track of displayed folders
                                @endphp
                                @foreach ($usuario_compro as $video)
                                @php
                                    // Check if the folder has been displayed already
                                    if (!in_array($video->Cursos->nombre, $displayedFolders)) {
                                        $displayedFolders[] = $video->Cursos->nombre; // Mark the folder as displayed
                                    } else {
                                        continue; // Skip displaying the folder if it has been displayed already
                                    }
                                @endphp
                                    <div class="accordion-item">

                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$video->id_tickets}}" aria-expanded="true" aria-controls="collapseOne{{$video->id}}" style="background-color: #836262;">
                                                <img class="icon_nav_course" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="">
                                                {{$video->Cursos->nombre}}  @if($video->Cursos->stps == '1') (Descargar Diploma STPS) @endif
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </button>
                                        </h2>

                                        <div id="collapseOne{{$video->id_tickets}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acordcion_mb_clases">
                                            <div class="accordion-body">
                                                <div class="row">

                                                        @if($video->Cursos->stps == '1')

                                                            @if($video->Cursos->pack_stps == "Si")

                                                                @php
                                                                    $stps_columns = [
                                                                        'p_stps_1',
                                                                        'p_stps_2',
                                                                        'p_stps_3',
                                                                        'p_stps_4',
                                                                        'p_stps_5',
                                                                        'p_stps_6',
                                                                    ];

                                                                    $stps_values = array_map(function ($column) use ($video) {
                                                                        return $video->Cursos->$column;
                                                                    }, $stps_columns);

                                                                    // Filtra los valores nulos
                                                                    $non_null_values = array_filter($stps_values, function ($value) {
                                                                        return $value !== null;
                                                                    });

                                                                @endphp

                                                                @foreach ($non_null_values as $index => $value)
                                                                <div class="col-6">
                                                                    <form method="POST" action="{{ route('generar_alumno.documento') }}" enctype="multipart/form-data" role="form">
                                                                        @csrf
                                                                        <div class="row">
                                                                                <div class="form-group col-12 mt-3" style="display: none;">
                                                                                    <label for="name">Nombre Completo *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{$cliente->name}}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-12" id="precioMayoristaContainer" style="display: none;">
                                                                                    <label for="name" class="label_custom_primary_product mb-2">Nombre del curso:</label>
                                                                                    <div class="input-group ">
                                                                                        <span class="input-group-text span_custom_tab" >
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="curso_name" name="curso_name" type="text"  class="form-control input_custom_tab "  value="{{ $value }}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6 "style="display: none;">
                                                                                    <label for="name">Fecha del Curso *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $video->Cursos->fecha_final }}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6 "style="display: none;">
                                                                                    <label for="name">Duracion del curso en horas: </label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="duracion_hrs" name="duracion_hrs" type="number" class="form-control" value="48" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6"style="display: none;">
                                                                                    <label for="name">Tipo de documento *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <select name="tipo" id="tipo" class="form-select" >
                                                                                                <option value="1" selected >Diploma STPS General</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-4 d-flex justify-content-center">
                                                                                    <button type="submit" class="text-center mt-5 mb-3" style="background: transparent;border: 0px;">
                                                                                        <h3 class=""><img class="icon_nav_course" src="{{asset('assets/user/icons/certificate.png')}}" alt=""> <strong>Descargar Diploma {{ $value }}</strong></h3>
                                                                                    </button>
                                                                                </div>

                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                @endforeach

                                                            @else
                                                                <div class="col-12 ">
                                                                    <form method="POST" action="{{ route('generar_alumno.documento') }}" enctype="multipart/form-data" role="form">
                                                                        @csrf
                                                                        <div class="row">

                                                                                <div class="form-group col-12 mt-3" style="display: none;">
                                                                                    <label for="name">Nombre Completo *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{$cliente->name}}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-12" id="precioMayoristaContainer" style="display: none;">
                                                                                    <label for="name" class="label_custom_primary_product mb-2">Nombre del curso:</label>
                                                                                    <div class="input-group ">
                                                                                        <span class="input-group-text span_custom_tab" >
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="curso_name" name="curso_name" type="text"  class="form-control input_custom_tab "  value="{{ $video->Cursos->nombre }}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6 "style="display: none;">
                                                                                    <label for="name">Fecha del Curso *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $video->Cursos->fecha_final }}" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6 "style="display: none;">
                                                                                    <label for="name">Duracion del curso en horas: </label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="duracion_hrs" name="duracion_hrs" type="number" class="form-control" value="48" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-6"style="display: none;">
                                                                                    <label for="name">Tipo de documento *</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text" id="basic-addon1">
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <select name="tipo" id="tipo" class="form-select" >
                                                                                                <option value="1" selected >Diploma STPS General</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12 d-flex justify-content-center">
                                                                                    <button type="submit" class="text-center mt-5 mb-3" style="background: transparent;border: 0px;">
                                                                                        <h3 class=""><img class="icon_nav_course" src="{{asset('assets/user/icons/certificate.png')}}" alt=""> <strong>Descargar Diploma STPS</strong></h3>
                                                                                    </button>
                                                                                </div>

                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                @if($video->Cursos->nombre == 'Micropuntura Brasileña')

                                                                <div class="col-12 ">
                                                                    <form method="POST" action="{{ route('generar_alumno_dc.documento') }}" enctype="multipart/form-data" role="form">
                                                                        @csrf
                                                                        <div class="row">

                                                                                <input id="nombre" name="nombre" type="hidden" class="form-control" value="{{$cliente->name}}" >

                                                                                <input id="curso_name" name="curso_name" type="hidden"  class="form-control input_custom_tab "  value="{{ $video->Cursos->nombre }}" >

                                                                                <input id="fecha_inicial" name="fecha_inicial" type="hidden" class="form-control" value="{{ $video->Cursos->fecha_inicial }}" >
                                                                                <input id="fecha" name="fecha" type="hidden" class="form-control" value="{{ $video->Cursos->fecha_final }}" >

                                                                                <input id="duracion_hrs" name="duracion_hrs" type="hidden" class="form-control" value="20" >

                                                                                <div class="form-group col-12 col-md-6 col-lg-6" id="precioMayoristaContainer" >
                                                                                    <label for="name" class="label_custom_primary_product mb-2">CURP</label>
                                                                                    <div class="input-group ">
                                                                                        <span class="input-group-text span_custom_tab" >
                                                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                                                                        </span>
                                                                                        <input id="curp" name="curp" type="text"  class="form-control input_custom_tab " placeholder="Ingresa tu CURP" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                                    <button type="submit" class="text-center mt-4" style="background: transparent;border: 0px;">
                                                                                        <h3 class=""><img class="icon_nav_course" src="{{asset('assets/user/icons/pdf.png')}}" alt=""> <strong>Descargar Formato DC-3</strong></h3>
                                                                                    </button>
                                                                                </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                @endif

                                                            @endif


                                                        @endif

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
                                                                    @break
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
                                                                @break
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="col-12">
                                                        <h3 class="text-center mt-5 mb-5"><img class="icon_nav_course" src="{{asset('assets/user/icons/maestro.png')}}" alt=""> <strong>Material de clase , Literatura , Avales, ETC..</strong></h3>
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
                                                                                <div class="col-lg-6 col-md-6 col-sm-12  col-12 mt-3">
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
                                                            <div class="row">

                                                                    @if (isset($carpetas_literatura) && $carpetas_literatura != NULL)
                                                                    <div class="col-12  mt-2 mb-2">
                                                                        <h2>Literatura de fase de tratamiento facial  <img src="{{ asset('assets/user/icons/skincare.png') }}" alt="" style="width:30px;"></h2>
                                                                    </div>
                                                                        @foreach ($carpetas_literatura as $carpeta)
                                                                            @if ($carpeta->sub_area_recurso == 'facial')
                                                                                @php
                                                                                    $file_info = new SplFileInfo($carpeta->nombre_recurso);
                                                                                    $extension = $file_info->getExtension();
                                                                                @endphp
                                                                                @if ($carpeta->id_carpeta == $video->Cursos->carpeta)
                                                                                    @if ($extension === 'pdf')
                                                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                                                                                        <p class="text-center">
                                                                                        <embed class="embed_pdf" src="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" type="application/pdf"  />
                                                                                        <a class="text-dark" href="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" target="_blank" >Ver PDF</a>
                                                                                        </p>
                                                                                    </div>
                                                                                    @else

                                                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                                                                                        <p class="text-center">
                                                                                            <img class="img_material_clase_pc" id="img_material_clase" src="{{asset('cursos/'. $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" />
                                                                                        </p>
                                                                                    </div>

                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="col-12 mt-2 mb-2">
                                                                            <h2>Literatura de fase de tratamiento corporal  <img src="{{ asset('assets/user/icons/massage.png') }}" alt="" style="width:30px;"></h2>
                                                                        </div>
                                                                        @foreach ($carpetas_literatura as $carpeta)
                                                                            @if ($carpeta->sub_area_recurso == 'corporal')
                                                                                @php
                                                                                    $file_info = new SplFileInfo($carpeta->nombre_recurso);
                                                                                    $extension = $file_info->getExtension();
                                                                                @endphp
                                                                                @if ($carpeta->id_carpeta == $video->Cursos->carpeta)
                                                                                    @if ($extension === 'pdf')
                                                                                      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                                                                                        <p class="text-center">
                                                                                        <embed class="embed_pdf" src="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" type="application/pdf"  />
                                                                                        <a class="text-dark" href="{{ asset('cursos/' . $carpeta->nombre_carpeta . '/' . $carpeta->nombre_recurso) }}" target="_blank" >Ver PDF</a>
                                                                                        </p>
                                                                                    </div>
                                                                                    @else
                                                                                      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
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
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f3809a6CURSOS ONLINE.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f380e3bCURSOS PRESENCIALES.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f3823e8DOCUMENTACIÓN.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646513beca4b6INSTALACIONES-DOCUMENTOS_4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646513beccf90SEP CONOCER.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f33aeb2CAM-01.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f33bbccCAM.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646512f3812b7DISTRIBUIDAORA DE PRODUCTO.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/646513becd472VENTAS DE PRODCUTO.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>
                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/64deb7c5d9f866465176806a32Lic Carla-1.jpeg') }}" class="d-block">
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
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_1.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_2.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_3.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_5.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_6.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_7.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_8.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_9.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_10.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_11.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_12.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_13.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_14.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_15.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_16.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_17.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_18.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_19.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_20.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_21.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_22.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item ">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/avales_23.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-1.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>

                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-2.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-3.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-4.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-5.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-6.png') }}" class="d-block">
                                                                            </p>
                                                                        </div>


                                                                        <div class="carousel-item">
                                                                            <p class="text-center">
                                                                                <img class="img_material_clase_pc" src="{{asset('archivos/ESTÁNDARES-SECTORES-7.png') }}" class="d-block">
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

<script>

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

<script>
    $(document).ready(function() {
    // Cuando se selecciona un archivo en un input con clase "documento-input"
    $(".ine_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('ine', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_ine').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_ine");
                contenedor.setAttribute("style", "display:none;");

            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);
                alert('Error al cargar el archivo');
            }
        });
    });

    $(".curp_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('curp', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX

        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_curp').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_curp");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);
            }
        });
    });

    $(".foto_tam_infantil_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('foto_tam_infantil', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_foto_tam_infantil').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_foto_tam_infantil");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);

            }
        });
    });

    $(".tam_titulo_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('foto_tam_titulo', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_foto_tam_titulo').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_foto_tam_titulo");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);

            }
        });
    });

    $(".infantil_blanco_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('foto_infantil_blanco', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_foto_infantil_blanco').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_foto_infantil_blanco");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);

            }
        });
    });

    $(".firma_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('firma', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Firma cargado con éxito');
                $('#resultado_firma').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_firma");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);

            }
        });
    });

    $(".estudios_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('estudios', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_estudios').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_estudios");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);
            }
        });
    });

    $(".domicilio_input").change(function() {
        console.log('Archivo seleccionado');

        // Obtener el archivo seleccionado
        var file = $(this).prop('files')[0];

        // Crear un objeto FormData y agregar solo el archivo seleccionado
        var formData = new FormData();
        formData.append('domicilio', file);

        // Obtener el token CSRF
        var token = $('meta[name="csrf-token"]').attr('content');

        // Agregar el token CSRF a los datos de la solicitud AJAX
        formData.append('_token', token);

        // Realizar una solicitud AJAX
        $.ajax({
            url: "{{ route('clientes.update_documentos_cliente', $cliente->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                // Por ejemplo, mostrar un mensaje de éxito
                alert('Archivo cargado con éxito');
                $('#resultado_domicilio').html(response); // Actualiza la sección con los datos del servicio
                var contenedor = document.getElementById("contenedor_domicilio");
                contenedor.setAttribute("style", "display:none;");
            },
            error: function(error) {
                // Manejar errores, si es necesario
                console.log(error);

            }
        });
    });

});


</script>


<script>
    $(document).ready(function () {
        $(document).on("change", "input[type=file]", function () {
            let input = $(this);
            let form = input.closest("form");
            let progressContainer = input.siblings(".progress-subida");
            let progressBar = progressContainer.find(".progress-bar");

            let formData = new FormData(form[0]);

            progressContainer.removeClass("d-none");

            $.ajax({
                url: form.attr("action") || "{{ route('documentos.store_cliente', $cliente->id) }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    let xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            progressBar.css("width", percentComplete + "%");
                            progressBar.attr("aria-valuenow", percentComplete);
                            progressBar.text(percentComplete + "%");
                        }
                    }, false);

                    return xhr;
                },
                success: function (response) {
                    if (response.success) {
                        progressBar.removeClass('bg-danger').addClass('bg-success');
                        progressBar.text('¡Listo!');

                        // Crear el botón para ver el archivo
                        let url = `/documentos/${response.telefono}/${response.archivo}`;
                        let html = `
                            <a href="${url}" target="_blank" class="btn btn-sm btn-success mt-2">
                                Ver documento
                            </a>
                        `;

                        // Insertar el botón en el contenedor correspondiente
                        input.closest('.col-lg-4, .col-md-3, .col-6').find('.archivo-subido').html(html);
                    } else {
                        alert('Hubo un problema al cargar el archivo.');
                    }
                },
                error: function () {
                    progressBar.removeClass('bg-success').addClass('bg-danger');
                    progressBar.text('Error');
                },
                complete: function () {
                    setTimeout(function () {
                        progressBar.css("width", "0%").attr("aria-valuenow", "0").text("0%");
                        progressBar.removeClass('bg-success bg-danger');
                        progressContainer.addClass("d-none");
                    }, 1500);
                }
            });
        });
    });
</script>




@endsection


