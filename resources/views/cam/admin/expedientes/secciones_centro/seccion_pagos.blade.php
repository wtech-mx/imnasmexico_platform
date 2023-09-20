<div class="row mt-3">
    <div class="col-12 col-md-12 mt-3 ">
        <div class="card h-100">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mb-0 px-0 py-1 active d-flex align-items-center justify-content-center" role="presentation">
                <button class="nav-link active" id="pills-emision-tab" data-bs-toggle="pill" data-bs-target="#pills-emision" type="button" role="tab" aria-controls="pills-emision" aria-selected="true">Nueva emision</button>
                </li>
                <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                <button class="nav-link " id="pills-nuevo-estandar-tab" data-bs-toggle="pill" data-bs-target="#pills-nuevo-estandar" type="button" role="tab" aria-controls="pills-nuevo-estandar" aria-selected="false">Nuevo Estandar</button>
                </li>
                <li class="nav-item mb-0 px-0 py-1 d-flex align-items-center justify-content-center" role="presentation">
                <button class="nav-link " id="pills-renovacion-tab" data-bs-toggle="pill" data-bs-target="#pills-renovacion" type="button" role="tab" aria-controls="pills-renovacion" aria-selected="false">Renovación</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
                <div class="tab-pane fade show active" id="pills-emision" role="tabpanel" aria-labelledby="pills-emision-tab">
                    <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="mb-0">Nueva emision - ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h6>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <label for="contrato_general">Nombre</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="num_user" name="num_user" class="form-control" type="text" placeholder="Nombre cliente">
                                </div>

                                <div class="form-group">
                                    <label for="">Seleccione estandar(es) *</label><br>
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                            @foreach ($estandares_cam_user as $estandar_cam)
                                                <option value="{{$estandar_cam->id_estandar}}">{{$estandar_cam->Estandar->estandar}}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Foto</label><br>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="comprobante" name="comprobante" type="file" class="form-control" placeholder="foto">
                                    </div>
                                </div>

                                <label for="contrato_general">Total</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="costo_total" name="costo_total" class="form-control" type="text">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
                <div class="tab-pane fade" id="pills-nuevo-estandar" role="tabpanel" aria-labelledby="pills-nuevo-estandar-tab">
                    <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="mb-0">Nueva emision - ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h6>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <label for="contrato_general">Nombre</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="num_user" name="num_user" class="form-control" type="text" placeholder="Nombre cliente">
                                </div>

                                <div class="form-group">
                                    <label for="">Seleccione estandar(es) *</label><br>
                                        <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                            @foreach ($estandares_cam as $estandar_cam)
                                                <option value="{{$estandar_cam->id}}">{{$estandar_cam->estandar}}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Foto</label><br>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="comprobante" name="comprobante" type="file" class="form-control" placeholder="foto">
                                    </div>
                                </div>

                                <label for="contrato_general">Total</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="costo_total" name="costo_total" class="form-control" type="text">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                {{-- ==================== S E C C I O N  D O C U M E N T O S ==================== --}}
                <div class="tab-pane fade" id="pills-renovacion" role="tabpanel" aria-labelledby="pills-renovacion-tab">
                    <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="mb-0">Renovación</h6>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                @php
                                    $fecha = $expediente->Nota->created_at;
                                    // Convertir a una marca de tiempo Unix
                                    $timestamp = strtotime($fecha);
                                    // Obtener la fecha con un año adicional
                                    $nueva_fecha_timestamp = strtotime('+1 year', $timestamp);
                                    // Formatear la fecha original
                                    $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                    // Formatear la fecha con un año adicional
                                    $nueva_fecha_formateada = strftime('%e de %B del %Y', $nueva_fecha_timestamp);
                                    // Formatear la hora
                                    $hora_formateada = date('h:i A', $timestamp);
                                    // Combinar fecha y hora
                                    $fecha_hora_formateada = $fecha_formateada;
                                    // Combinar nueva fecha y hora (con un año adicional)
                                    $fecha_hora_fin = $nueva_fecha_formateada;
                                @endphp
                                <label for="contrato_general">Fin de Operaciones</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="num_user" name="num_user" class="form-control" type="text" value="{{ $fecha_hora_fin}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="name">Foto</label><br>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="comprobante" name="comprobante" type="file" class="form-control" placeholder="foto">
                                    </div>
                                </div>

                                <label for="contrato_general">Total</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="costo_total" name="costo_total" class="form-control" type="text">
                                </div>

                                <label for="name">Fecha *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="fecha" name="fecha" type="text" class="form-control" value="{{$fecha}}">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
