@extends('layouts.app_admin')

@section('template_title')
    Solicitudes
@endsection


@section('content')
<body class="g-sidenav-show bg-gray-100">
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-4 mt-4">
                <a class="btn" type="button" href="{{ route('panel.index') }}" style="border: 2px solid #fff; color: #fff;">
                    Inicio
                </a>
            </div>

            <div class="col-4 mt-4">
                <a class="btn" type="button" href="{{ route('index.calendario') }}" style="border: 2px solid #fff; color: #fff;">
                    Calendario
                </a>
            </div>


            <div class="col-md-5 mt-md-0 mt-4">
                <div class="card h-100 mb-4">
                  <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <h6 class="mb-0">Solicitudes</h6>
                        </div>
                        <div class="col-md-6 col-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <small>{{$today}}</small>
                        </div>
                    </div>
                  </div>
                  <div class="card-body pt-4 p-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            <p style="font-size: 12px">Pendientes</p>
                          </button>

                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            <p style="font-size: 12px">Aprobadas</p>
                          </button>

                          <button class="nav-link" id="nav-cancelada-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelada" type="button" role="tab" aria-controls="nav-cancelada" aria-selected="false">
                            <p style="font-size: 12px">Canceladas</p>
                          </button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <ul class="list-group">
                                @foreach ($solicitudes_pendientes as $solicitud)
                                    @php
                                        if($solicitud->tipo_permiso == 'Vacaciones'){
                                            $icon = asset('assets/cam/cp.png');
                                        } elseif ($solicitud->tipo_permiso == 'Enfermedad') {
                                            $icon = asset('assets/cam/medico.png');
                                        } else {
                                            $icon = asset('assets/cam/servidor-en-la-nube.png');
                                        }
                                    @endphp
                                    <a data-bs-toggle="modal" data-bs-target="#aprobarModal">
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                                    <img src="{{ $icon }}" width="20px">
                                                </button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{$solicitud->User->name}}</h6>
                                                    <span class="text-xs">Del {{ $solicitud->fecha_inicio->format('d \d\e F') }}, <span class="font-weight-bold">al {{ $solicitud->fecha_fin->format('d \d\e F') }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-warning text-gradient text-sm font-weight-bold">
                                                {{ $solicitud->tipo_permiso }}
                                            </div>
                                        </li>
                                    </a>
                                    <hr class="horizontal dark my-3">
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <ul class="list-group">
                                @foreach ($solicitudes_aprobadas as $solicitud)
                                    @php
                                        if($solicitud->tipo_permiso == 'Vacaciones'){
                                            $icon = asset('assets/cam/cp.png');
                                        } elseif ($solicitud->tipo_permiso == 'Enfermedad') {
                                            $icon = asset('assets/cam/medico.png');
                                        } else {
                                            $icon = asset('assets/cam/servidor-en-la-nube.png');
                                        }
                                    @endphp
                                    <a data-bs-toggle="modal" data-bs-target="#aprobarModal">
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                                    <img src="{{ $icon }}" width="20px">
                                                </button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{$solicitud->User->name}}</h6>
                                                    <span class="text-xs">Del {{ $solicitud->fecha_inicio->format('d \d\e F') }}, <span class="font-weight-bold">al {{ $solicitud->fecha_fin->format('d \d\e F') }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                                {{ $solicitud->tipo_permiso }}
                                            </div>
                                        </li>
                                    </a>
                                    <hr class="horizontal dark my-3">
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="nav-cancelada" role="tabpanel" aria-labelledby="nav-cancelada-tab" tabindex="0">
                            <ul class="list-group">
                                @foreach ($solicitudes_cancelada as $solicitud)
                                    @php
                                        if($solicitud->tipo_permiso == 'Vacaciones'){
                                            $icon = asset('assets/cam/cp.png');
                                        } elseif ($solicitud->tipo_permiso == 'Enfermedad') {
                                            $icon = asset('assets/cam/medico.png');
                                        } else {
                                            $icon = asset('assets/cam/servidor-en-la-nube.png');
                                        }
                                    @endphp
                                    <a data-bs-toggle="modal" data-bs-target="#aprobarModal">
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                                    <img src="{{ $icon }}" width="20px">
                                                </button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{$solicitud->User->name}}</h6>
                                                    <span class="text-xs">Del {{ $solicitud->fecha_inicio->format('d \d\e F') }}, <span class="font-weight-bold">al {{ $solicitud->fecha_fin->format('d \d\e F') }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                {{ $solicitud->tipo_permiso }}
                                            </div>
                                        </li>
                                    </a>
                                    <hr class="horizontal dark my-3">
                                @endforeach
                            </ul>
                        </div>
                    </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
    @include('rh.solicitudes.show_solicitud')
</body>
@endsection

@section('datatable')

@endsection
