@extends('layouts.app_admin')

@section('template_title')
    Nominas
@endsection


@section('content')
<div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card overflow-scroll">
            <div class="card-body d-flex">
              <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                <a data-bs-toggle="modal" data-bs-target="#tareasModal" class="avatar avatar-lg border-1 rounded-circle bg-gradient-primary">
                  <i class="fas fa-plus text-white"></i>
                </a>
                <p class="mb-0 text-sm" style="margin-top:6px;">Tareas</p>
              </div>
                @include('rh.modal_tareas')
              @foreach ($users as $user)
                @php
                    if($user->genero == 'M'){
                        $img = asset('images/img5.jpg');
                    }else {
                        $img = asset('images/img7.jpg');
                    }
                @endphp
                <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                    <a href="{{ route('show.nomina', $user->id) }}" class="avatar avatar-lg rounded-circle border border-primary">
                    <img alt="Image placeholder" class="p-1" src="{{ $img }}">
                    </a>
                    <p class="mb-0 text-sm">{{ $user->name }}</p>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mt-4 mb-4">
            <div class="card">
                <div class="table-responsive">
                    <h3>Sesiones de usuario</h3>
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Usuario</th>
                            <th>IP</th>
                            <th>Agente</th>
                            <th>Login</th>
                            <th>Logout</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $s)
                            <tr class="{{ is_null($s->logout_at) ? 'table-success' : '' }}">
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->ip_address }}</td>
                            <td>{{ Str::limit($s->user_agent, 50) }}</td>
                            <td>{{ $s->login_at }}</td>
                            <td>{{ $s->logout_at ?? 'Activa' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============= Ventas Cotizaciones ============= -->
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Ventas Cotizaciones</h6>
            </div>
            <div class="card-body pb-0 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-capitalize">Itzel Oliver</span>
                      <span class="ms-auto text-sm font-weight-bold">80%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-gradient-info w-80" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-capitalize">Daniela</span>
                      <span class="ms-auto text-sm font-weight-bold">17%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-gradient-dark w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-capitalize">Perla</span>
                      <span class="ms-auto text-sm font-weight-bold">3%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-gradient-danger w-5" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="card-footer pt-0 p-3 d-flex align-items-center">
              <div class="w-60">
                <p class="text-sm">
                  Grafica de ventas del mes
                </p>
              </div>
              <div class="w-40 text-end">
                <a class="btn bg-gradient-dark mb-0 text-end" href="javascript:;">Descargar reporte</a>
              </div>
            </div>
          </div>
        </div>

        <!-- ============= Ventas Cursos ============= -->
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Ventas Cursos</h6>
            </div>
            <div class="card-body pb-0 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-capitalize">Ariel</span>
                      <span class="ms-auto text-sm font-weight-bold">80%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-gradient-info w-80" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-capitalize">Juan Pablo</span>
                      <span class="ms-auto text-sm font-weight-bold">17%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-gradient-dark w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="card-footer pt-0 p-3 d-flex align-items-center">
              <div class="w-60">
                <p class="text-sm">
                  Grafica de ventas del mes
                </p>
              </div>
              <div class="w-40 text-end">
                <a class="btn bg-gradient-dark mb-0 text-end" href="javascript:;">Descargar reporte</a>
              </div>
            </div>
          </div>
        </div>

        <!-- ============= Proximos eventos ============= -->
        <div class="col-lg-6 col-sm-12 mt-4 mt-lg-4">
          <div class="card">
            <div class="card-header p-3 pb-0">
              <h6 class="mb-0">Proximos eventos</h6>
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Julio</p>
            </div>
            <div class="card-body border-radius-lg p-3">
              <div class="d-flex">
                <div>
                  <div class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                    <i class="ni ni-money-coins text-lg text-info text-gradient opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="numbers">
                    <h6 class="mb-1 text-dark text-sm">Cumpleaños Ariel</h6>
                    <span class="text-sm">30 de Julio - 28 años</span>
                  </div>
                </div>
              </div>
              <div class="d-flex mt-4">
                <div>
                  <div class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                    <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="ms-3">
                  <div class="numbers">
                    <h6 class="mb-1 text-dark text-sm">HedSpa</h6>
                    <span class="text-sm">27 de Julio - 10:00 PM</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ============= Vacaciones ============= -->
        <div class="col-lg-6 col-sm-12 mt-4 mt-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Vacaciones Autorizadas</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-bell-55 text-success"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Itzel Oliver</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 2025</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ============= Empleados ============= -->
        <div class="col-12 mt-4 mb-4">
          <div class="card">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Función</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contratado</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sueldo</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @php
                            if($user->genero == 'M'){
                                $img = asset('images/img5.jpg');
                            }else {
                                $img = asset('images/img7.jpg');
                            }
                        @endphp
                      <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ $img }}" class="avatar avatar-sm me-3" alt="avatar image">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <span class="text-secondary text-sm">ID. {{ $user->id }}</span>
                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>

                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm text-secondary mb-0">{{ $user->puesto }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-secondary mb-0 text-sm">{{ $user->telefono }}</p>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-sm">{{ $user->fecha_ingreso }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-sm">{{ $user->sueldo }}</span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{ route('show.nomina', $user->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
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


@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.estandares').select2();
        });
    </script>
@endsection
