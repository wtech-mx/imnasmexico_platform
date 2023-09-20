
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
                                            <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                                {{$expediente->UserEC->name}}</label>
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
                                    @if ($expediente->check2 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check2" name="check2" value="1" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                            {{$expediente->UserFin->name}}</label>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check2" name="check2" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>2.- Evaluación de Estándares afines</strong></label>
                                    </div>
                                    <input id="evaluacion_afines" name="evaluacion_afines" value="{{$expediente->evaluacion_afines}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check3 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                            {{$expediente->UserCon->name}}</label>
                                    @else
                                        <input class="form-check-input ms-0" type="checkbox" id="check3" name="check3" value="1">
                                    @endif
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-3">
                                        <strong>3.- Refuerzo de transferencia de conocimiento y operatividad</strong></label>
                                    </div>
                                    <input id="refuerzo_conocimiento" name="refuerzo_conocimiento" value="{{$expediente->refuerzo_conocimiento}}" type="date" class="form-control">
                                </div>

                                <div class="form-group col-6 col-sm-4 col-md-4 col-lg-4 p-2 mb-3">
                                    <div class="form-check form-switch ps-0">
                                    @if ($expediente->check4 == '1')
                                        <input class="form-check-input ms-0" type="checkbox" id="check4" name="check4" value="1" checked>
                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                            {{$expediente->UserFor->name}}</label>
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
                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                            {{$expediente->UserEm->name}}</label>
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
                                        <label class="form-check-label text-body ms-3 text-truncate w-30 mb-0">
                                            {{$expediente->UserCar->name}}</label>
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

        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            <h6 class="mb-0">Estandares</h6>
                        </div>
                        <div class="col-md-8 text-end">
                           <h6><strong>Costo emisión:</strong><br> ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">

                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Estatus</th>
                                        <th>Estandar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                @foreach ($estandares_usuario as $estandar_usuario)
                                <tr>
                                    <td>
                                        @if ($estandar_usuario->estatus == 'Pendiente')
                                        <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #c05b21;">Pendiente</p>
                                        @elseif($estandar_usuario->estatus == 'Rechazado')
                                            <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #aa2222;">Rechazado</p>
                                        @else
                                            <p class="border-radius-md shadow text-xs text-white" style="padding:5px;background-color: #63ac28;">Aprovado</p>
                                        @endif
                                    </td>

                                    <td>{{$estandar_usuario->Estandar->estandar}}</td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModalEstatus{{$estandar_usuario->id}}" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">Editar</a>
                                    </td>
                                </tr>
                                @include('cam.admin.expedientes.modal_estatus')
                                @endforeach
                            </table>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>
