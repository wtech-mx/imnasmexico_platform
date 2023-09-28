<div class="row mt-3">
    <div class="col-12 col-md-12 mt-3 ">
        <div class="card h-100 p-2">

            <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
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
                {{-- ==================== N U E V A  E M I S I O N ==================== --}}
                <div class="tab-pane fade show active" id="pills-emision" role="tabpanel" aria-labelledby="pills-emision-tab">
                    <form method="POST" action="{{ route('nueva_emision.pago') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">Costo de emision - ${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h4>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">

                                <div class="col-6">
                                    <h6 for="contrato_general">Nombre *</h6>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="nombre" name="nombre" class="form-control" type="text" placeholder="Nombre cliente" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h6 for="">Seleccione estandar *</h6>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\icons\certificate.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="estandares" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" required>
                                            @foreach ($estandares_cam_user as $estandar_cam)
                                                <option value="{{$estandar_cam->id_estandar}}">{{$estandar_cam->Estandar->estandar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h6 for="name">Comprobante de pago *</h6>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="comprobante_pago" name="comprobante_pago" type="file" class="form-control" placeholder="foto" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <input id="cantidad_total" name="cantidad_total" class="form-control" type="number" value="{{ $expediente->Nota->Cliente->costo_emi }}" style="display: none">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <h4>Pagos nueva emision</h4>
                    <table class="table table-flush mt-2" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Estandar</th>
                                <th>Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($pagos_emision as $pago_emision)
                                    <tr>
                                        <td>{{$pago_emision->id}}</td>
                                        <th>{{$pago_emision->nombre}}</th>
                                        <td>
                                            @php
                                                $fecha = $pago_emision->created_at;
                                                // Convertir a una marca de tiempo Unix
                                                $timestamp = strtotime($fecha);
                                                // Formatear la fecha
                                                $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                // Formatear la hora
                                                $hora_formateada = date('h:i A', $timestamp);
                                                // Combinar fecha y hora
                                                $fecha_hora_formateada = $fecha_formateada;
                                            @endphp
                                            {{ $fecha_hora_formateada}}
                                        </td>
                                        <td>{{$pago_emision->Estandar->estandar}}</td>
                                        <td>
                                            <a target="_blank" href="{{asset('cam_pagos/'.$pago_emision->comprobante_pago)}}">Ver comprobante</a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ==================== N U E V O  E S T A N D A R ==================== --}}
                <div class="tab-pane fade" id="pills-nuevo-estandar" role="tabpanel" aria-labelledby="pills-nuevo-estandar-tab">
                    <form method="POST" action="{{ route('nuevo_estandar.pago') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">Pago para un nuevo estandar</h4>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6 for="">Seleccione estandar(es) *</h6>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets\user\icons\certificate.png') }}" alt="" width="35px">
                                            </span>
                                            <select name="estandares[]" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" multiple="multiple">
                                                @foreach ($estandares_cam as $estandar_cam)
                                                    <option value="{{$estandar_cam->id}}">{{$estandar_cam->estandar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h6 for="name">Comprobante de pago</h6>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="comprobante_pago" name="comprobante_pago" type="file" class="form-control" placeholder="foto">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <h6 for="contrato_general">Cantidad total</h6>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\dinero.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="cantidad_total" name="cantidad_total" class="form-control" type="text">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <h4>Pagos nuevo estandar</h4>
                    <table class="table table-flush mt-2" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>Fecha</th>
                                <th>Cantidad total</th>
                                <th>Comprobante</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($pagos_estandar as $pago_estandar)
                                    <tr>
                                        <td>{{$pago_estandar->id}}</td>
                                        <td>
                                            @php
                                                $fecha = $pago_estandar->created_at;
                                                // Convertir a una marca de tiempo Unix
                                                $timestamp = strtotime($fecha);
                                                // Formatear la fecha
                                                $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                                // Formatear la hora
                                                $hora_formateada = date('h:i A', $timestamp);
                                                // Combinar fecha y hora
                                                $fecha_hora_formateada = $fecha_formateada;
                                            @endphp
                                            {{ $fecha_hora_formateada}}
                                        </td>
                                        <td>{{$pago_estandar->cantidad_total}}</td>
                                        <td>
                                            <a target="_blank" href="{{asset('cam_pagos/'.$pago_estandar->comprobante_pago)}}">Ver comprobante</a>
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModalEstandar{{$pago_estandar->id}}" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">Ver detalles</a>
                                        </td>
                                    </tr>
                                    @include('cam.admin.expedientes.modal_pago_estandar')
                                @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ==================== R E N O V A C I O N ==================== --}}
                <div class="tab-pane fade" id="pills-renovacion" role="tabpanel" aria-labelledby="pills-renovacion-tab">
                    <form method="POST" action="{{ route('renovacion.pago') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                        <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">Dias restantes - <span class="small"></span><span id="state2" countTo="{{$diferencia_dias}}"></span></h4>
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

                                <div class="col-6">
                                    <h6 for="contrato_general">Fin de Operaciones</h6>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input class="form-control" type="text" value="{{ $fecha_hora_fin}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <h6 for="name">Comprobante de pago</h6>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/cam/camara.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="comprobante_pago" name="comprobante_pago" type="file" class="form-control" placeholder="foto">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h6 for="contrato_general">Cantidad total</h6>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\dinero.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="cantidad_total" name="cantidad_total" class="form-control" type="text">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <h4>Pagos renovación</h4>
                    <table class="table table-flush mt-2" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>Cantidad total</th>
                                <th>Fecha incio</th>
                                <th>Fecha fin</th>
                                <th>Comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($pagos_renovacion as $pago_renovacion)
                                    <tr>
                                        <td>{{$pago_renovacion->id}}</td>
                                        <td>{{$pago_renovacion->cantidad_total}}</td>
                                        <td>
                                            {{ $fecha_hora_formateada}}
                                        </td>
                                        <td>{{ $fecha_hora_fin}}</td>
                                        <td>
                                            <a target="_blank" href="{{asset('cam_pagos/'.$pago_renovacion->comprobante_pago)}}">Ver comprobante</a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
