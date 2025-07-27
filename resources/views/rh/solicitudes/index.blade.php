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
                <a class="btn" type="button" href="{{ route('finanzas.index') }}" style="border: 2px solid #fff; color: #fff;">
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
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Hoy</h6>
                    <ul class="list-group">
                        @foreach ($solicitudes as $solicitud)
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
                                    @if ($solicitud->estado == NULL)
                                        <div class="d-flex align-items-center text-warning text-gradient text-sm font-weight-bold">
                                    @else
                                        <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                    @endif
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
    @include('rh.solicitudes.show_solicitud')
</body>
@endsection

@section('datatable')

@endsection
