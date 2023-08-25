@extends('layouts.app_admin')

@section('template_title')
Expediente {{$expediente->id}}
@endsection

@section('content')

<div class="container-fluid ">
    <div class="card shadow-lg">
        <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="{{asset('assets/user/logotipos/cam.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
            </div>
            <div class="col-auto my-auto">
            <div class="">
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
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item mb-0 px-0 py-1 active d-flex align-items-center justify-content-center" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Inicio</button>
                    </li>
                    <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                      <button class="nav-link " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Documentación</button>
                    </li>
                    <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                      <button class="nav-link " id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Estandares</button>
                    </li>
                  </ul>
            </div>
            </div>
        </div>
        </div>
    </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container-fluid ">
                    <div class="row mt-3">
                       {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card h-100">
                                @if ($expediente->check1 === NULL || $expediente->check2 === NULL || $expediente->check3 === NULL || $expediente->check4 === NULL || $expediente->check5 === NULL || $expediente->check6 === NULL)
                                    <form method="POST" action="{{ route('expediente.cita', $expediente->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <div class="card-header ">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h6 class="mb-0">Programa de Citas</h6>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-sm close-modal" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">{{$expediente->Nota->tipo}}</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check1 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check1" name="check1" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserEC->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check1" name="check1" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        1. Evaluación del EC0076</label>
                                                    </div>
                                                    <input id="evaluacion_ec0076" name="evaluacion_ec0076" value="{{$expediente->evaluacion_ec0076}}" type="date" class="form-control">
                                                </li>
                                                <hr>
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check2 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check2" name="check2" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserFin->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check2" name="check2" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        2.- Evaluación de Estándares afines</label>
                                                    </div>
                                                    <input id="evaluacion_afines" name="evaluacion_afines" value="{{$expediente->evaluacion_afines}}" type="date" class="form-control">
                                                </li>
                                                <hr>
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check3 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserCon->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        3.- Refuerzo de transferencia de conocimiento y operatividad</label>
                                                    </div>
                                                    <input id="refuerzo_conocimiento" name="refuerzo_conocimiento" value="{{$expediente->refuerzo_conocimiento}}" type="date" class="form-control">
                                                </li>
                                                <hr>
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check4 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check4" name="check4" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserFor->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check4" name="check4" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        4.- Refuerzo de llenado de formatos</label>
                                                    </div>
                                                    <input id="refuerzo_formatos" name="refuerzo_formatos" value="{{$expediente->refuerzo_formatos}}" type="date" class="form-control">
                                                </li>
                                                <hr>
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check5 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check5" name="check5" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserEm->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check5" name="check5" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        5.- Coaching empresarial</label>
                                                    </div>
                                                    <input id="coaching_empresarial" name="coaching_empresarial" value="{{$expediente->coaching_empresarial}}" type="date" class="form-control">
                                                </li>
                                                <hr>
                                                <li class="list-group-item border-0 px-0 pb-0">
                                                    <div class="form-check form-switch ps-0">
                                                    @if ($expediente->check6 == '1')
                                                        <input class="form-check-input ms-0" type="checkbox" id="check6" name="check6" value="1" checked>
                                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                            {{$expediente->UserCar->name}}</label>
                                                    @else
                                                        <input class="form-check-input ms-0" type="checkbox" id="check6" name="check6" value="1">
                                                    @endif
                                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                        6.- Entrega de carpeta cam y formatos</label>
                                                    </div>
                                                    <input id="carpeta_cam" name="carpeta_cam" value="{{$expediente->carpeta_cam}}" type="date" class="form-control">
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                @elseif ($expediente->check1 != NULL && $expediente->check2 != NULL && $expediente->check3 != NULL && $expediente->check4 != NULL && $expediente->check5 != NULL && $expediente->check6 != NULL)
                                    <div class="card-header">
                                        <h6 class="mb-0">Checklist</h6>
                                    </div>
                                    <div class="card-body ">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c1 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User1->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    1.- NOMBRAMIENTO DEL EVALUADOR INDEPENDIENTE POR PARTE DE LA ENTIDAD DE
                                                    CERTIFICACIÓN Y EVALUACIÓN JUNTO CON DECÁLOGO DEL EVALUADOR DE COMPETENCIA.</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c2 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c2" name="c2" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User2->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c2" name="c2" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    2.- ACUERDO DE CONFIENCIALIDAD ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL
                                                    EVALUADOR INDEPENDIENTE.</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c3 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c3" name="c3" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User3->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c3" name="c3" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    3.- LOGO DEL EVALUADOR INDEPENDIENTE QUE UTILIZARA EN SUS PUBLICACIONES</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c4 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c4" name="c4" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User4->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c4" name="c4" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    4.- COMPROBANTE DE DOMICILIO DEL EVALAUDOR INDEPENDIENTE</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c5 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c5" name="c5" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User5->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c5" name="c5" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    5.- CONTRATO INDIVIDUAL DE TRABAJO DEL EVALUADOR CON ANEXO DE ARTICULOS 64, 65 Y 66.
                                                    ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL EVALUADOR INDEPENDIENTE</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0 pb-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c6 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User6->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    6.- CURRICULUM VITAE DEL EVALUADOR INDEPENDIENTE</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c7 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c7" name="c7" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User7->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c7" name="c7" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    7.- INE</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c8 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c8" name="c8" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User8->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c8" name="c8" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    8.- CURP</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0 pb-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c9 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c9" name="c9" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User9->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c9" name="c9" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    9.- ACTA DE NACIMIENTO</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c10 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c10" name="c10" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User10->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c10" name="c10" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    10.- RECONOCIMIENOS O CERTIFICADOS RELACIONADOS CON LOS ESTÁNDARES QUE SE
                                                    ACREDITAN</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c11 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c11" name="c11" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User11->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c11" name="c11" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    11.- LISTADO DE LOS ESTÁNDARES ACREDITADOS DEBE INCLUIR EL EC0076</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0 px-0 pb-0">
                                                <div class="form-check form-switch ps-0">
                                                @if ($check->c12 == '1')
                                                    <input class="form-check-input ms-0" type="checkbox" id="c12" name="c12" value="1" checked>
                                                    <label class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                                        {{$check->User12->name}}</label>
                                                @else
                                                    <input class="form-check-input ms-0" type="checkbox" id="c12" name="c12" value="1">
                                                @endif
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                                    12.- ACREDITACIONES DE LOS ESTÁNDARES POR PARTE DE LA ENTIDAD DE CERTIFICACIÓN Y
                                                    EVALUACIÓN</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif

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
                </div>
            </div>

            {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="container-fluid py-4">
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card h-100">
                                 <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <div class="card-header pb-0 p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h6 class="mb-0">Documentos</h6>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="logo">Logo </label>
                                                    <input id="logo" name="logo" type="file" class="form-control" value="">
                                                        @if ($documentos->logo != NULL)
                                                            @if (pathinfo($documentos->logo, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="acuerdo_confidencialidad">Acuerdo confidencialidad </label>
                                                    <input id="acuerdo_confidencialidad" name="acuerdo_confidencialidad" type="file" class="form-control" >
                                                        @if ($documentos->acuerdo_confidencialidad != NULL)
                                                            @if (pathinfo($documentos->acuerdo_confidencialidad, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="comprobante_domicilio">Comprobante domicilio </label>
                                                    <input id="comprobante_domicilio" name="comprobante_domicilio" type="file" class="form-control" >
                                                        @if ($documentos->comprobante_domicilio != NULL)
                                                            @if (pathinfo($documentos->comprobante_domicilio, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="contrato_individual">Contrato individual</label>
                                                    <input id="contrato_individual" name="contrato_individual" type="file" class="form-control" >
                                                        @if ($documentos->contrato_individual != NULL)
                                                            @if (pathinfo($documentos->contrato_individual, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="curriculum">Curriculum </label>
                                                    <input id="curriculum" name="curriculum" type="file" class="form-control" >
                                                        @if ($documentos->curriculum != NULL)
                                                            @if (pathinfo($documentos->curriculum, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="ine">INE</label>
                                                    <input id="ine" name="ine" type="file" class="form-control" >
                                                        @if ($documentos->ine != NULL)
                                                            @if (pathinfo($documentos->ine, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="curp">Curp </label>
                                                    <input id="curp" name="curp" type="file" class="form-control" >
                                                        @if ($documentos->curp != NULL)
                                                            @if (pathinfo($documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="acta_nacimiento">Acta nacimiento</label>
                                                    <input id="acta_nacimiento" name="acta_nacimiento" type="file" class="form-control" >
                                                        @if ($documentos->acta_nacimiento != NULL)
                                                            @if (pathinfo($documentos->acta_nacimiento, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="foto">foto </label>
                                                    <input id="foto" name="foto" type="file" class="form-control" >
                                                        @if ($documentos->foto != NULL)
                                                            @if (pathinfo($documentos->foto, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="contrato_general">Contrato general</label>
                                                    <input id="contrato_general" name="contrato_general" type="file" class="form-control" >
                                                        @if ($documentos->contrato_general != NULL)
                                                            @if (pathinfo($documentos->contrato_general, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="solicitud_acreditacion">Solicitud acreditacion </label>
                                                    <input id="solicitud_acreditacion" name="solicitud_acreditacion" type="file" class="form-control" >
                                                        @if ($documentos->solicitud_acreditacion != NULL)
                                                            @if (pathinfo($documentos->solicitud_acreditacion, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="carta_compromiso">Carta compromiso</label>
                                                    <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                                        @if ($documentos->carta_compromiso != NULL)
                                                            @if (pathinfo($documentos->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>

                                                <div class="col-6">
                                                    <label for="carta_responsabilidad">Carta responsabilidad </label>
                                                    <input id="carta_responsabilidad" name="carta_responsabilidad" type="file" class="form-control" >
                                                        @if ($documentos->carta_responsabilidad != NULL)
                                                            @if (pathinfo($documentos->carta_responsabilidad, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>


                        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                        <h6 class="mb-0">Carpetas</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('7')">
                                                <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">1. Manuales Digitales CONOCER</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('8')">
                                                <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">2. Reglamento Y Manuales De Procedimientos IMNAS</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->Nota->id }}); mostrarCarpetasCompradas({{ $expediente->Nota->id }})">
                                                <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">3. Formatos Estándares</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('10')">
                                                <img src="{{asset('assets/user/icons/illustrator.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">4. Logo Conocer Evaluador Independiente</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('certificado', {{ $expediente->Nota->id }})">
                                                <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">5. Certificados Conocer</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->Nota->id }})">
                                                <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">6. Cedulas De Acreditación</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('nombramiento', {{ $expediente->Nota->id }})">
                                                <img src="{{asset('assets/user/icons/certificate.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">7. Nombramiento</label>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('9')">
                                                <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 40%;">
                                                <label for="">8. Formatos Resolucion De Quejas</label>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-xl-4 mt-xl-0 mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Documentos</h6>
                                            <div class="col-md-4 text-end">
                                                <a href="javascript:;">
                                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div id="contenedorSubirArchivos" style="display: none;">
                                        <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                                            <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                                            <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                                            <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                        </form>
                                    </div>
                                    <div id="contenedorArchivos" ></div>
                                    <div id="contenedorArchivosCarp"></div>

                                    <div id="contenedorCarpetas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== S E C C I O N  E S T A N D A R E S ==================== --}}
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"><H1>aDIOS</H1></div>
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

    </div>

@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function mostrarArchivos(categoria, expedienteId) {
        // Oculta el formulario y vacía el contenedor de archivos
        $('#contenedorSubirArchivos').hide();
        $('#contenedorArchivos').empty();

        // Limpia el contenedor de carpetas (estándares)
        $('#contenedorCarpetas').empty();

        if (categoria === 'estandares') {
            mostrarCarpetasCompradas(expedienteId);
        }

        $.ajax({
            url: '{{ route("obtener.archivos") }}', // Cambiar a la ruta correcta en tu aplicación
            method: 'GET',
            data: { categoria: categoria,  expediente_id: expedienteId },
            success: function(data) {
                var archivosHTML = '';

                if (data.length > 0) {
                    data.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;


                            if (extension === 'pdf') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                                archivosHTML += '</div>';
                            } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                                archivosHTML += '<div class="archivo">';
                                archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                                archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                                archivosHTML += '</div>';
                            } else {
                                archivosHTML += '<div class="archivo">' + archivo.nombre + '</div>';
                            }

                    });
                } else {
                    archivosHTML = '<p>No hay archivos disponibles.</p>';
                }

                $('#contenedorArchivos').html(archivosHTML);
            },
            error: function() {
                alert('Error al cargar los archivos.');
            }
        });

        if (categoria === 'nombramiento') {
            $('#contenedorSubirArchivos').show();
        }
    }

    function mostrarCarpetasCompradas(notaId) {
        $.ajax({
            url: '{{ route("obtener.carpetas", ["notaId" => $expediente->Nota->id]) }}',
            method: 'GET',
            success: function(data) {
                var carpetasHTML = '';

                data.forEach(function(carpeta, index) {
                    console.log('Nombre de Carpeta:', carpeta); // Agrega esta línea para verificar el nombre
                    carpetasHTML += '<div class="col-4">';
                    carpetasHTML += '<button class="btn btn-sm btnCarpeta" data-nombre_carpeta="' + carpeta + '">';
                    carpetasHTML += '<img src="{{ asset('assets/user/icons/folder.png') }}" class="img-fluid" style="width: 40%;">';
                    carpetasHTML += '<label for="">' + (index + 1) + '. ' + carpeta + '</label>';
                    carpetasHTML += '</button>';
                    carpetasHTML += '</div>';
                });


                $('#contenedorCarpetas').html(carpetasHTML);

                // Asignar evento de clic a los botones de carpeta
                $('.btnCarpeta').click(function() {
                    var nombreCarpeta = $(this).data('nombre_carpeta');
                    console.log(nombreCarpeta);
                    mostrarArchivosCarpetas(nombreCarpeta);
                });
            },
            error: function() {
                alert('Error al obtener las carpetas compradas.');
            }
        });
    }

    function mostrarArchivosCarpetas(nombreCarpeta) {
        $('#contenedorArchivos').empty();

        $.ajax({
            url: '{{ route("obtener.archivos.carp") }}',
            method: 'GET',
            data: { nombre_carpeta: nombreCarpeta },
            success: function(documentos) { // Cambia 'data' por 'documentos'
                var archivosHTML = '';

                if (documentos.length > 0) {
                    documentos.forEach(function(archivo) {
                        var extension = obtenerExtension(archivo.nombre);
                        var archivoURL = '{{ asset('cam_doc_general/') }}/' + archivo.nombre;

                        if (extension === 'pdf') {
                            archivosHTML += '<div class="archivo">';
                            archivosHTML += '<embed src="' + archivoURL + '" type="application/pdf" style="width: 120px; height: 120px;" />';
                            archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir PDF</a>';
                            archivosHTML += '</div>';
                        } else if (extension === 'jpg' || extension === 'png' || extension === 'jpeg') {
                            archivosHTML += '<div class="archivo">';
                            archivosHTML += '<img src="' + archivoURL + '" alt="' + archivo.nombre + '" style="width: 100px; height: 100px;">';
                            archivosHTML += '<a href="' + archivoURL + '" target="_blank">Abrir Imagen</a>';
                            archivosHTML += '</div>';
                        } else {
                            archivosHTML += '<div class="archivo">' + archivo.nombre + '</div>';
                        }
                    });
                } else {
                    archivosHTML = '<p>No hay archivos disponibles.</p>';
                }

                $('#contenedorArchivos').html(archivosHTML);
            },
            error: function() {
                alert('Error al cargar los archivos de la carpeta.');
            }
        });
    }



    function obtenerExtension(nombreArchivo) {
        var partes = nombreArchivo.split('.');
        if (partes.length > 1) {
            return partes[partes.length - 1].toLowerCase();
        } else {
            return '';
        }
    }
</script>
@endsection
