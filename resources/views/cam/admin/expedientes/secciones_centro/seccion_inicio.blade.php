<form method="POST" action="{{ route('update_exp_user', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
        <div class="row mt-n2 mb-3">
            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                            <div class="card card-background card-background-mask-danger">
                        @else
                            <div class="card card-background card-background-mask-success">
                        @endif
                            <div class="full-background" style="background-image: url({{asset('assets/user/instalaciones/salon.jpg')}})"></div>
                            <div class="card-body pt-4 text-center">

                                <p class="text-white mb-0"><strong>Clave centro evaluador:</strong><br>
                                    {{ $expediente->Nota->Cliente->num_user }}
                                </p>
                                <p class="text-white">
                                    <strong>Costo emisión:</strong><br>
                                    ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn
                                </p>
                                <span class="badge d-block bg-gradient-dark mb-2">
                                    <strong>CURP:</strong><br>
                                    {{ $expediente->Nota->Cliente->curp }}
                                </span>
                                @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                    <p class="text-white mb-0">
                                        EN PROCESO.
                                    </p>
                                @else
                                    <p class="text-white mb-0">
                                        COMPLETO Y LISTO PARA LA OPERACIÓN. SE COMPARTÍO AL EVALUADOR INDEPENDIENTE TODOS LOS ARCHIVOS NECESARIOS PARA LA OPERACIÓN
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                        <div class="form-group">
                            <h6 for="name" style="color: #ffffff">Clave centro evaluador</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                </span>
                                <input id="num_user" name="num_user" class="form-control" type="text" placeholder="numero usuario" value="{{ $expediente->Nota->Cliente->num_user }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 for="name" >Usuario SII</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\cam\nombre.png') }}" alt="" width="35px">
                                </span>
                                <input id="usuario_eva" name="usuario_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->usuario_eva }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 for="name" >Nombre centro evaluador</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                </span>
                                <input id="nomb_centro" name="nomb_centro" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->nomb_centro }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">

                        <div class="form-group">
                            <h6 for="name" style="color: #ffffff">Costo emisión</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\bolsa-de-dinero.png') }}" alt="" width="35px">
                                </span>
                                <input id="costo_emi" name="costo_emi" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->costo_emi }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 for="name" >Contraseña SII</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\password.png') }}" alt="" width="35px">
                                </span>
                                <input id="contrasena_eva" name="contrasena_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->contrasena_eva }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 for="name" >Fecha inicio operaciones</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\calendario.png') }}" alt="" width="35px">
                                </span>
                                <input id="fecha_concluyo" name="fecha_concluyo" class="form-control" type="date" value="{{ $expediente->Nota->fecha_concluyo }}">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">

                    <div class="card-body p-3 pt-1 mt-2">
                        <h6 class="text-success">Inicio de operaciones.</h6>
                        <p class="text-sm">{{$fecha_formateada}}</p>
                        <h6 class="text-danger">Fin de Operaciones</h6>
                        <p class="text-sm">{{$fecha_formateada2}}</p>
                        <h6 class="text-primary mb-0">Dias restantes</h6>
                        <h4 class="font-weight-bolder"><span class="small"></span><span id="state1" countTo="{{$diferencia_dias}}"></span></h4>

                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body p-3 pt-1 mt-2">
                        <h6 class="text-dark mb-3">Progreso de videos vistos por el evaluador</h6>
                        <div class="row">
                            @foreach ($videos_dinamicos as $item)
                                <div class="col-3">
                                    @if ($item->orden == 1 || ($video->{"check" . ($item->orden - 1)} !== null && $video->{"check" . ($item->orden - 1)} !== ""))

                                    <p class="text-sm text-center">{{ $item->orden }}- {{ $item->nombre }}</p>
                                    <p  class="text-center">
                                        <img src="{{ asset('assets\cam\loading.png') }}" alt="" width="35">
                                    </p>
                                    @else
                                    <p class="text-sm text-center">{{ $item->orden }}- {{ $item->nombre }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                            <span class="ms-auto text-sm font-weight-bold">%</span>
                        <div>
                            <div class="progress progress-md">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: %;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Información {{$expediente->Nota->tipo}}</h6>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-sm">
                            {{$expediente->Nota->nota}}
                        </p>
                        <hr class="horizontal gray-light my-2">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; {{$expediente->Nota->Cliente->name}}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; {{$expediente->Nota->Cliente->telefono}}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp; {{$expediente->Nota->Cliente->email}}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Referencia:</strong> &nbsp; {{$expediente->Nota->referencia}}</li>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <strong class="text-dark text-sm">Social:</strong> &nbsp;
                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.facebook.com/{{$expediente->Nota->Cliente->facebook}}" target="_blank">
                            <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.tiktok.com/{{$expediente->Nota->Cliente->tiktok}}" target="_blank">
                            <i class="fab fa-tiktok fa-lg"></i>
                            </a>
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-1 py-0" href="https://www.instagram.com/{{$expediente->Nota->Cliente->instagram}}" target="_blank">
                            <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-1 py-0" href="https://{{$expediente->Nota->Cliente->pagina_web}}" target="_blank">
                                <i class="fa fa-globe fa-lg"></i>
                            </a>
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-1 py-0" href="https://{{$expediente->Nota->Cliente->otra_red}}" target="_blank">
                                <i class="fa fa-heart fa-lg"></i>
                            </a>
                        </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
</form>

<div class="row mt-3">
        <div class="col-12 " >
            <div class="card h-100" >
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
            </div>
        </div>

        <div class="col-12 " >
            <div class="card h-100" >
                <div class="card-header">
                    <h6 class="mb-0">Checklist</h6>
                </div>
                <div class="card-body ">
                    <ul class="list-group">
                        <form method="POST" action="{{ route('expediente.checklist_centro', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH" >
                            <div class="col-4">
                                <button type="submit" class="btn btn-sm close-modal" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                            </div>
                        <input type="text" name="id_nota" id="id_nota" value="{{$expediente->Nota->id}}" style="display: none">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c1 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                1.- Solicitud de acreditación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c2 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c2" name="c2" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c2" name="c2" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                2.- Contrato de Acreditación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c3 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c3" name="c3" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c3" name="c3" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                3.- Carta compromiso.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c4 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c4" name="c4" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c4" name="c4" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                4.- Acta constitutiva o documentación legal (copia simple).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c5 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c5" name="c5" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c5" name="c5" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                5.- Identificación Oficial INE VIGENTE del representante legal (copia simple).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c6 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                6.- CURP (Copia simple).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c7 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c7" name="c7" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c7" name="c7" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                7.- RFC Constancia de situación Fiscal actualizada que corresponda con la<br>
                                razón social del Centro de Evaluación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c8 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c8" name="c8" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c8" name="c8" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                8.- Comprobante de domicilio.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c9 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c9" name="c9" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c9" name="c9" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                9.- Registro de marca o Carta del registro de marca.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c10 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c10" name="c10" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c10" name="c10" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                10.- Contrato de arrendamiento o Escritura de la propiedad donde se <br> establecerá el Centro de Evaluación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c11 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c11" name="c11" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c11" name="c11" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                11.- Organigrama del Centro de Evaluación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c12 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c12" name="c12" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c12" name="c12" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                12.- Listado de equipamiento para el desarrollo de las actividades administrativas<br>
                                del Centro de Evaluación. (Fotografías).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c13 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c13" name="c13" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c13" name="c13" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                13.- Listado de equipamiento para el desarrollo de las actividades de evaluación. (Fotografías).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c14 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c14" name="c14" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c14" name="c14" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                14.- Medios de comunicación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c15 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c15" name="c15" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c15" name="c15" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                15.- Tamaño e impacto del CE.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c16 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c16" name="c16" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c16" name="c16" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                16.- Reconocimientos/Constancias profesionales.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c17 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c17" name="c17" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c17" name="c17" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                17.- Página de internet con buzón de quejas y sugerencias.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c18 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c18" name="c18" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c18" name="c18" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                18.- Redes sociales.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c19 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c19" name="c19" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c19" name="c19" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                19.- Expedientes completos por cada Evaluador Independiente y personal administrativo que participe <br>
                                en las áreas del CONOCER del Centro de Evaluación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c20 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c20" name="c20" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c20" name="c20" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                20.- Buzón físico de quejas y sugerencias con formatos impresos de quejas y sugerencias a un<br>
                                lado para los candidatos (debe tener la página del CONOCER, así como los números de contacto<br>
                                del CONOCER y también los datos de contacto de la Entidad de Certificación y Evaluación).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c21 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c21" name="c21" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c21" name="c21" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                21.- Lista de Precios Explicita. Precios separados y exhibidos de los Estándares de forma<br>
                                que le candidato los pueda ver y enterarse de ellos, si tiene precios de capacitaciones o<br>
                                alineaciones estarán separados de las evaluaciones.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c22 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c22" name="c22" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c22" name="c22" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                22.- Manuales digitales de la Normatividad, operatividad y funcionalidad del CONOCER.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c23 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c23" name="c23" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c23" name="c23" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                23.- Reglamento Interno de la Entidad para reglamentar al CE (Diseñado con logos del CE).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c24 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c24" name="c24" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c24" name="c24" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                24.- Manual de procedimientos de aseguramiento de la calidad con logos del CE.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c25 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c25" name="c25" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c25" name="c25" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                25.- Manual de Procedimientos de Atención al Cliente Reporte y Graficación con Logos del CE.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c26 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c26" name="c26" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c26" name="c26" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                26.- Manual del Participante.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c27 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c27" name="c27" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c27" name="c27" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                27.- Ligas de Accesos y contraseñas al Módulo de Evaluación del CONOCER.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c28 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c28" name="c28" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c28" name="c28" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                28.- Ligas de Videos para la formación de Evaluadores.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c29 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c29" name="c29" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c29" name="c29" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                29.- Logos diferenciados del CONOCER para cada Entidad de Certificación y Evaluación (ECE),<br>
                                Centro de Evaluación (CE) y Evaluador Independiente (EI).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c30 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c30" name="c30" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c30" name="c30" value="1">
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                30.- Entrega Oficial del registro ante SEP CONOCER y Placa de Aluminio otorgada por<br>
                                parte de la Entidad de Certificación al Centro de Evaluación.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c31 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c31" name="c31" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c31" name="c31" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                31.- Especificaciones de las fotografías. Si no tiene las especificaciones<br>
                                correctas acarrea retrasos en las entregas de Certificados.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c32 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c32" name="c32" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c32" name="c32" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                32.- Papelería proporcionada por la Entidad de Certificación y Evaluación con logos<br>
                                del Centro de Evaluación para su operación (Diagnóstico, Plan de Evaluación, Cédula<br>
                                de Evaluación, Encuesta de Satisfacción).</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c33 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c33" name="c33" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c33" name="c33" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                33.- Tríptico del protocolo de la evaluación con datos del Centro de Evaluación con logos,<br>
                                dirección del Centro de Evaluación, así como los números de contacto del CONOCER y también<br>
                                los datos de contacto de la Entidad de Certificación y Evaluación. La Entidad de Certificación<br>
                                y Evaluación proporciona este tríptico.</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c34 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c34" name="c34" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c34" name="c34" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                34.- Formatos de resolución de quejas proporcionados por la Entidad de<br>
                                Certificación y Evaluación (Colocarlos al lado de Buzón de quejas).
                            </label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                            @if ($check->c35 == '1')
                                <input class="form-check-input ms-0" type="checkbox" id="c35" name="c35" value="1" checked>
                            @else
                                <input class="form-check-input ms-0" type="checkbox" id="c35" name="c35" value="1" checked>
                            @endif
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                35.- Formatos Seguimiento de resolución de quejas proporcionados por la Entidad de<br>
                                Certificación y Evaluación (Tenerlos en la papelería del Área del CONOCER del CE).
                            </label>
                            </div>
                        </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('cam.admin.expedientes.seccion_estandares')
        </div>
    </div>


