@extends('layouts.app_admin')

@section('template_title')
    Notas Cursos
@endsection

@php
    $fecha = date('d-m-Y');
    $total_caja = $total_pagos - $total_egresos;
@endphp
@section('content')
<div class="container-fluid my-5 py-2">

    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xl-6 mb-xl-0 mb-4">
            {{-- <div class="card bg-transparent shadow-xl">
              <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 p-3">
                  <i class="fas fa-wifi text-white p-2"></i>
                  <h5 class="text-white mt-4 mb-5 pb-2">4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                  <div class="d-flex">
                    <div class="d-flex">
                      <div class="me-4">
                        <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                        <h6 class="text-white mb-0">Jack Peterson</h6>
                      </div>
                      <div>
                        <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                        <h6 class="text-white mb-0">11/22</h6>
                      </div>
                    </div>
                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                      <img class="w-60 mt-2" src="../../../assets/img/logos/mastercard.png" alt="logo">
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}

            <div class="card">
                <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="fab fa-paypal opacity-10"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Total del Día</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">$ {{$total_caja}}</h5>
                </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                      <i class="fas fa-landmark opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Ingreso</h6>
                    <span class="text-xs">Efectivo del Día</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">$ {{$total_pagos}}</h5>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mt-md-0 mt-4">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                      <i class="fab fa-paypal opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Egresos</h6>
                    <span class="text-xs">Egresos del Día</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">$ {{$total_egresos}}</h5>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card mt-4">
                @if ($caja == NULL)
                    <form method="POST" action="{{ route('caja.caja_inicial') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="card-header">
                            <div class="row">
                                <h6 >Saldo inicial en caja</h6>
                                <div class="col-3 ">
                                    <input name="monto_inicial" id="monto_inicial" type="number" class="form-control" placeholder="$ $ $ $" required>
                                </div>
                                <div class="col-3 ">
                                    <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
                <form method="POST" action="{{ route('caja.store') }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Formulario Egresos</h6>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn bg-gradient-dark mb-0"><i class="fas fa-plus"></i>&nbsp;&nbsp;Agregar</button>
                        </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-md-6 mb-md-0 mb-4">
                            <h6 >Importe</h6>
                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                <input class="form-control" type="number" id="egresos" name="egresos" placeholder="$ $ $ $" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 >Concepto</h6>
                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                <textarea name="concepto" id="concepto" class="form-control" cols="2" rows="1" required></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Egresos</h6>
              </div>
              <div class="col-6 text-end">
                <a type="button" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" href="{{ route('caja.print_corte') }}"><i class="fas fa-file-pdf text-lg me-1"></i>Corte</a>
              </div>
            </div>
          </div>
          <div class="card-body p-3 pb-0">
            <ul class="list-group">
                @foreach ($caja_egresos as $caja_egreso)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{$caja_egreso->concepto}}</h6>
                        <span class="text-xs">#{{$caja_egreso->id}}</span>
                        </div>
                        <div class="d-flex align-items-center text-sm">
                        ${{$caja_egreso->egresos}}
                        </div>
                    </li>
                @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-7">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Notas Cursos</h6>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
                @foreach ($notas_pagos as $nota_pago)
                    @php
                        $fecha = $nota_pago->Nota->fecha;
                        $fechaCarbon = \Carbon\Carbon::parse($fecha);
                        $fechaFormateada = $fechaCarbon->format('d/F/y');
                    @endphp
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">{{$nota_pago->Nota->User->name}}</h6>
                            <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">{{$fechaFormateada}}</span></span>
                            <span class="mb-2 text-xs">Monto: <span class="text-dark ms-sm-2 font-weight-bold">${{$nota_pago->monto}}</span></span>
                            <span class="text-xs">ID Nota: <span class="text-dark ms-sm-2 font-weight-bold">#{{$nota_pago->Nota->id}}</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="text-warning text-gradient px-3 mb-0"><i class="fa fa-graduation-cap me-2"></i>Nota Cursos</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('notas_cursos.edit', $nota_pago->Nota->id) }}" target="_blank"><i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>Ver</a>
                        </div>
                    </li>
                @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-5 mt-md-0 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Notas Productos</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="far fa-calendar-alt me-2"></i>
                <small>{{$fecha}}</small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
                @foreach ($notas_producto as $nota_producto)
                    @php
                        $fecha = $nota_producto->fecha;
                        $fechaCarbon = \Carbon\Carbon::parse($fecha);
                        $fechaFormateada = $fechaCarbon->format('d/F/y');
                    @endphp
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">{{$nota_producto->User->name}}</h6>
                            <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">{{$fechaFormateada}}</span></span>
                            <span class="mb-2 text-xs">Monto: <span class="text-dark ms-sm-2 font-weight-bold">${{$nota_producto->total}}</span></span>
                            <span class="text-xs">ID Nota: <span class="text-dark ms-sm-2 font-weight-bold">#{{$nota_producto->id}}</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="text-success text-gradient px-3 mb-0"><i class="fa fa-shopping-bag me-2"></i><b> Nota Productos </b></a>
                        </div>
                    </li>
                @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('datatable')

@endsection


