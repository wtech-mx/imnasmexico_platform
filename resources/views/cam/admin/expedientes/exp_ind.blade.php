@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{asset('assets/user/logotipos/cam.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
            </div>
            <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                    {{$expediente->Nota->Cliente->name}}
                </h5>
                <p class="mb-0 font-weight-bold text-sm">
                    {{$expediente->Nota->tipo}}
                </p>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " id="pills-cam-exp-inicio-tab" data-bs-toggle="pill" data-bs-target="#pills-cam-exp-inicio" type="button" role="tab" aria-controls="pills-cam-exp-inicio" aria-selected="true">
                    <i class="ni ni-app"></i>
                    <span class="ms-2">Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "id="pills-cam-exp-doc-tab" data-bs-toggle="pill" data-bs-target="#pills-cam-exp-doc" type="button" role="tab" aria-controls="pills-cam-exp-doc" aria-selected="false">
                    <i class="ni ni-email-83"></i>
                    <span class="ms-2">Documentación</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-settings-gear-65"></i>
                    <span class="ms-2">Estandares</span>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </div>
    </div>

                <div class="container-fluid py-4">
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">Checklist</h6>
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Primera Fase</h6>
                                    <ul class="list-group">
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="1" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            1.- NOMBRAMIENTO DEL EVALUADOR INDEPENDIENTE POR PARTE DE LA ENTIDAD DE
                                            CERTIFICACIÓN Y EVALUACIÓN JUNTO CON DECÁLOGO DEL EVALUADOR DE COMPETENCIA.</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="2" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            2.- ACUERDO DE CONFIENCIALIDAD ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL
                                            EVALUADOR INDEPENDIENTE.</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="3">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            3.- LOGO DEL EVALUADOR INDEPENDIENTE QUE UTILIZARA EN SUS PUBLICACIONES</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="4">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            4.- COMPROBANTE DE DOMICILIO DEL EVALAUDOR INDEPENDIENTE</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="5">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            5.- CONTRATO INDIVIDUAL DE TRABAJO DEL EVALUADOR CON ANEXO DE ARTICULOS 64, 65 Y 66.
                                            ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL EVALUADOR INDEPENDIENTE</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0 pb-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="6">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            6.- CURRICULUM VITAE DEL EVALUADOR INDEPENDIENTE</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="7">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            7.- INE</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="8">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            8.- CURP</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0 pb-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="9">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            9.- ACTA DE NACIMIENTO</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="10">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            10.- RECONOCIMIENOS O CERTIFICADOS RELACIONADOS CON LOS ESTÁNDARES QUE SE
                                            ACREDITAN</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="11">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            11.- LISTADO DE LOS ESTÁNDARES ACREDITADOS DEBE INCLUIR EL EC0076</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0 px-0 pb-0">
                                        <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-0" type="checkbox" id="12">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                            12.- ACREDITACIONES DE LOS ESTÁNDARES POR PARTE DE LA ENTIDAD DE CERTIFICACIÓN Y
                                            EVALUACIÓN</label>
                                        </div>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                        <h6 class="mb-0">Información {{$expediente->Nota->tipo}}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <p class="text-sm">
                                        {{$expediente->Nota->nota}}
                                    </p>
                                    <hr class="horizontal gray-light my-4">
                                    <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; {{$expediente->Nota->Cliente->name}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; {{$expediente->Nota->Cliente->telefono}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp; {{$expediente->Nota->Cliente->email}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Referencia:</strong> &nbsp; {{$expediente->Nota->referencia}}</li>
                                    <li class="list-group-item border-0 ps-0 pb-0">
                                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.facebook.com/{{$expediente->Nota->Cliente->facebook}}" target="_blank">
                                        <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.tiktok.com/{{$expediente->Nota->Cliente->tiktok}}" target="_blank">
                                        <i class="fab fa-tiktok fa-lg"></i>
                                        </a>
                                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="https://www.instagram.com/{{$expediente->Nota->Cliente->instagram}}" target="_blank">
                                        <i class="fab fa-instagram fa-lg"></i>
                                        </a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="col-12 col-xl-4 mt-xl-0 mt-4">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Estandares</h6>
                                        <div class="col-md-4 text-end">
                                            <a href="javascript:;">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    @foreach ($estandares_usuario as $estandar_usuario)

                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                            <div class="avatar me-4">
                                                @if ($estandar_usuario->estatus == 'Pendiente')
                                                    <p class="border-radius-lg shadow" style="background-color: #c05b21;">Pendiente</p>
                                                @elseif($estandar_usuario->estatus == 'Rechazado')
                                                    <p class="border-radius-lg shadow" style="background-color: #aa2222;">Rechazado</p>
                                                @else
                                                    <p class="border-radius-lg shadow" style="background-color: #63ac28;">Aprovado</p>
                                                @endif

                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$estandar_usuario->Estandar->estandar}}</h6>
                                            <p class="mb-0 text-xs">{{$estandar_usuario->evaluador}}</p>
                                            </div>
                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Editar</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


        <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1">Expedientes Evaluadores</h6>
                <p class="text-sm">Architects design houses</p>
            </div>
            <div class="card-body p-3">
                <div class="row">
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                    <div class="position-relative">
                        <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('assets/user/logotipos/sepconocer.png')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                        </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                        <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                        <a href="javascript:;">
                        <h5>
                            Bubbles
                        </h5>
                        </a>
                        <p class="mb-4 text-sm">
                        As Bubble works through a huge amount of internal management turmoil.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/ama-de-casa.webp')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/apasionada.webp')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/EMPRENDEDORA.webp')}}">
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                    <div class="position-relative">
                        <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('assets/user/logotipos/imnas.png')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                        </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                        <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                        <a href="javascript:;">
                        <h5>
                            Scandinavian
                        </h5>
                        </a>
                        <p class="mb-4 text-sm">
                        Music is something that every person has his or her own specific opinion about.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/cheque-de-pago.png')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/depositar.png')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/meet.png')}}">
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                    <div class="position-relative">
                        <a class="d-block shadow-xl border-radius-xl">
                        <img src="{{asset('assets/user/logotipos/DOCTORA.png')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                        </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                        <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                        <a href="javascript:;">
                        <h5>
                            Minimalist
                        </h5>
                        </a>
                        <p class="mb-4 text-sm">
                        Different people have different taste, and various types of music.
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/document.png')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/edificio.png')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/email.png')}}">
                            </a>
                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="{{asset('assets/user/icons/location-pointer.png')}}">
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card h-100 card-plain border">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                        <a href="javascript:;">
                        <i class="fa fa-plus text-secondary mb-3"></i>
                        <h5 class=" text-secondary"> New project </h5>
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                    document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Web Tech</a>
                for a better web.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                    <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Web Tech</a>
                </li>
                <li class="nav-item">
                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </footer>
    </div>
</div>
@endsection

@section('datatable')

@endsection
