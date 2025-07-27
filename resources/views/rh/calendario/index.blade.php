@extends('layouts.app_admin')

@section('template_title')
    Solicitudes
@endsection

@section('content')
<body class="g-sidenav-show bg-gray-100">
    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="row">
            <div class="col-4 mt-4">
                <a class="btn" type="button" href="{{ route('panel.index') }}" style="border: 2px solid #fff; color: #fff;">
                    Inicio
                </a>
            </div>

            <div class="col-4 mt-4">
                <a class="btn" type="button" href="{{ route('index.solicitudes') }}" style="border: 2px solid #fff; color: #fff;">
                    Solicitudes
                </a>
            </div>

            <div class="col-4 mt-4">
                <a class="btn" type="button" data-bs-toggle="modal" data-bs-target="#tareasModal" style="border: 2px solid #fff; color: #fff;">
                    Avisos
                </a>
            </div>


            <div class="col-md-5 mt-md-0 mt-4">
                <div class="card h-100 mb-4">
                  <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <h6 class="mb-0">Calendario</h6>
                        </div>
                        <div class="col-md-6 col-6 d-flex justify-content-end align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                        </div>
                    </div>
                  </div>
                  <div class="card-body pt-4 p-3">

                  </div>
                </div>
            </div>
        </div>
    </div>
    @include('rh.modal_tareas')
</body>
@endsection

@section('fullcalendar')

@endsection
