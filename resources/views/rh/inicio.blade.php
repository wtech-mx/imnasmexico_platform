@extends('layouts.app_admin')

@section('template_title')
    INICIO
@endsection


@section('content')
<body class="g-sidenav-show bg-gray-100">
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="row">

            <div class="col-md-5 mt-md-0 mt-4">
                <div class="card h-100 mb-4">
                  <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <h6 class="mb-0">Notificaciones</h6>
                        </div>
                        <div class="col-md-6 col-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <small>30 March 2025</small>
                        </div>
                    </div>
                  </div>
                  <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Hoy</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                            <span class="text-xs">27 March 2020, at 12:30 PM</span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                          - $ 2,500
                        </div>
                      </li>
                      <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Apple</h6>
                            <span class="text-xs">27 March 2020, at 04:30 AM</span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                          + $ 2,000
                        </div>
                      </li>
                    </ul>

                  </div>
                </div>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <div class="card h-100 text-center">
                    <p class="text-center">
                        <img src="{{ asset('assets/cam/calenda.png') }}" class="mt-2" width="40px">
                    </p>
                    <h6 class="mb-0">Calendario</h6>
                </div>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <a href="{{ route('index.nominas') }}">
                    <div class="card h-100 text-center">
                        <p class="text-center">
                            <img src="{{ asset('assets/cam/megafono.webp') }}" class="mt-2" width="40px">
                        </p>
                        <h6 class="mb-0">Comunicados</h6>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <a href="{{ route('index.solicitudes') }}">
                    <div class="card h-100 text-center">
                        <p class="text-center">
                            <img src="{{ asset('assets/cam/solicitud.png') }}" class="mt-2" width="40px">
                        </p>
                        <h6 class="mb-0">Solicitudes</h6>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <a href="{{ route('index.nominas') }}">
                    <div class="card h-100 text-center">
                        <p class="text-center">
                            <img src="{{ asset('assets/cam/empleados.webp') }}" class="mt-2" width="40px">
                        </p>
                        <h6 class="mb-0">Equipo</h6>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <a href="{{ route('index.proveedores') }}">
                    <div class="card h-100 text-center">
                        <p class="text-center">
                            <img src="{{ asset('assets/cam/distribuidor-imageonline.co-1952752.webp') }}" class="mt-2" width="40px">
                        </p>
                        <h6 class="mb-0">Proveedores</h6>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4">
                <a href="{{ route('finanzas.index') }}">
                    <div class="card h-100 text-center">
                        <p class="text-center">
                            <img src="{{ asset('assets/cam/depositar.png') }}" class="mt-2" width="40px">
                        </p>
                        <h6 class="mb-0">Finanzas</h6>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4 mb-5">
                <div class="card h-100 text-center">
                    <p class="text-center">
                        <img src="{{ asset('assets/cam/comprobante.png') }}" class="mt-2" width="40px">
                    </p>
                    <h6 class="mb-0">Reportes</h6>
                </div>
            </div>

            <div class="col-6 col-md-6 col-xl-4 mt-md-0 mt-4 mb-5">
                <div class="card h-100 text-center">
                    <p class="text-center">
                        <img src="{{ asset('assets/cam/usuario.png') }}" class="mt-2" width="40px">
                    </p>
                    <h6 class="mb-0">Documentos</h6>
                </div>
            </div>

        </div>
    </div>
</body>
@endsection

@section('datatable')

@endsection
