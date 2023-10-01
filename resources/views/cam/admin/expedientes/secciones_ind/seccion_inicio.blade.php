<form method="POST" action="{{ route('update_exp_user', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
        <div class="row mt-n2 mb-3 mt-3 ">
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

                                <p class="text-white mb-0"><strong>Clave evaluador:</strong><br>
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
                                    <p class="text-white text-sm mb-0">
                                        COMPLETO Y LISTO PARA LA OPERACIÓN. SE COMPARTÍO AL EVALUADOR INDEPENDIENTE TODOS LOS ARCHIVOS NECESARIOS PARA LA OPERACIÓN
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                        <div class="form-group">
                            <label for="name" >Clave evaluador</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                </span>
                                <input id="num_user" name="num_user" class="form-control" type="text" placeholder="numero usuario" value="{{ $expediente->Nota->Cliente->num_user }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" >Usuario módulo de evaluación</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\cam\nombre.png') }}" alt="" width="35px">
                                </span>
                                <input id="usuario_eva" name="usuario_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->usuario_eva }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">

                        <div class="form-group">
                            <label for="name" >Costo emisión</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\bolsa-de-dinero.png') }}" alt="" width="35px">
                                </span>
                                <input id="costo_emi" name="costo_emi" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->costo_emi }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" >Contraseña módulo de evaluación</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets\user\icons\password.png') }}" alt="" width="35px">
                                </span>
                                <input id="contrasena_eva" name="contrasena_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->contrasena_eva }}">
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
                        <p class="text-sm">{{ $fecha_formateada}}</p>
                        <h6 class="text-danger">Fin de Operaciones</h6>
                        <p class="text-sm">{{ $fecha_formateada2}}</p>
                        <h6 class="text-primary mb-0">Dias restantes</h6>
                        <h4 class="font-weight-bolder"><span class="small"></span><span id="state1" countTo="{{$diferencia_dias}}"></span></h4>

                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card mt-2">
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
                <div class="card mt-2">
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
                            <div class="row">

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                        @if ($expediente->check1 == '1')
                                            <input class="form-check-input ms-0" type="checkbox" id="check1" name="check1" value="1" checked>
                                        @else
                                            <input class="form-check-input ms-0" type="checkbox" id="check1" name="check1" value="1">
                                        @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>1. Evaluación del EC0076</strong></label>
                                    </div>
                                    <input id="evaluacion_ec0076" name="evaluacion_ec0076" value="{{$expediente->evaluacion_ec0076}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check3 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1" checked>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>3.- Refuerzo de transferencia de <br> conocimiento y operatividad</strong></label>
                                    </div>
                                    <input id="refuerzo_conocimiento" name="refuerzo_conocimiento" value="{{$expediente->refuerzo_conocimiento}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check4 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check4" name="check4" value="1" checked>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check4" name="check4" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>4.- Refuerzo de llenado de formatos</strong></label>
                                    </div>
                                    <input id="refuerzo_formatos" name="refuerzo_formatos" value="{{$expediente->refuerzo_formatos}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check5 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check5" name="check5" value="1" checked>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check5" name="check5" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>5.- Coaching empresarial</strong></label>
                                    </div>
                                    <input id="coaching_empresarial" name="coaching_empresarial" value="{{$expediente->coaching_empresarial}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3 ">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check6 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check6" name="check6" value="1" checked>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check6" name="check6" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>6.- Entrega de carpeta cam y formatos</strong></label>
                                    </div>
                                    <input id="carpeta_cam" name="carpeta_cam" value="{{$expediente->carpeta_cam}}" type="date" class="form-control">
                                </div>

                            </div>
                        </div>
                    </form>
                @elseif ($expediente->check1 != NULL && $expediente->check2 != NULL && $expediente->check3 != NULL && $expediente->check4 != NULL && $expediente->check5 != NULL && $expediente->check6 != NULL)
                    <div class="card-header">
                        <h6 class="">Checklist</h6>
                    </div>
                    <div class="card-body ">
                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">

                                @if ($check->c1 == '1')
                                    <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1" checked>
                                @else
                                    <input class="form-check-input ms-0" type="checkbox" id="c1" name="c1" value="1">
                                @endif

                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                    1.- NOMBRAMIENTO DEL EVALUADOR INDEPENDIENTE POR PARTE DE LA ENTIDAD DE <br>
                                    CERTIFICACIÓN Y EVALUACIÓN JUNTO CON DECÁLOGO DEL EVALUADOR DE COMPETENCIA.</label>
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
                                    2.- ACUERDO DE CONFIENCIALIDAD ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL <br>
                                    EVALUADOR INDEPENDIENTE.</label>
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
                                    3.- LOGO DEL EVALUADOR INDEPENDIENTE QUE UTILIZARA EN SUS PUBLICACIONES</label>
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
                                    4.- COMPROBANTE DE DOMICILIO DEL EVALAUDOR INDEPENDIENTE</label>
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
                                    5.- CONTRATO INDIVIDUAL DE TRABAJO DEL EVALUADOR CON ANEXO DE ARTICULOS 64, 65 Y 66. <br>
                                    ENTRE LA ENTIDAD DE CERTIFICACIÓN Y EVALUACIÓN Y EL EVALUADOR INDEPENDIENTE</label>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 pb-0">
                                <div class="form-check form-switch ps-0">
                                    @if ($check->c6 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1" checked>
                                        <p class="form-check-label text-body ms-3 text-truncate w-15 mb-0">
                                            {{$check->User6->name}}
                                        </p>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="c6" name="c6" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0">
                                        6.- CURRICULUM VITAE DEL EVALUADOR INDEPENDIENTE
                                    </label>
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
                                    7.- INE</label>
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
                                    8.- CURP</label>
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
                                    9.- ACTA DE NACIMIENTO</label>
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
                                    10.- RECONOCIMIENOS O CERTIFICADOS RELACIONADOS CON LOS ESTÁNDARES QUE SE
                                    ACREDITAN</label>
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
                                    11.- LISTADO DE LOS ESTÁNDARES ACREDITADOS DEBE INCLUIR EL EC0076</label>
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
                                    12.- ACREDITACIONES DE LOS ESTÁNDARES POR PARTE DE <br> LA ENTIDAD DE CERTIFICACIÓN Y
                                    EVALUACIÓN</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>

        <div class="col-12">
            @include('cam.admin.expedientes.seccion_estandares')
        </div>
    </div>
