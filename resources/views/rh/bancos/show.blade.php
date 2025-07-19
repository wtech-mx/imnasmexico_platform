@extends('layouts.app_admin')
@section('template_title')
    Bancos Edit
@endsection

@section('content')

<div class="container-fluid my-5 py-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="" method="GET">
                    <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                        <h5>Buscador por fechas</h5>
                        <div class="row">
                            <div class="col-4">
                                <label for="user_id">Rango de fecha DE:</label>
                                <input class="form-control" type="date" id="fecha_de" name="fecha_de" required>
                            </div>
                            <div class="col-4">
                                <label for="user_id">Rango de fecha Hasta:</label>
                                <input class="form-control" type="date" id="fecha_hasta" name="fecha_hasta" required>
                            </div>
                            <div class="col-4">
                                <br><br>
                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Datos Bancarios</h6>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('update.bancos',$banco->id) }}" id="" enctype="multipart/form-data" role="form">
                        <input type="hidden" name="_method" value="PATCH">
                        @csrf

                        <div class="modal-body">
                            <div class="row">

                                <div class="col-12 form-group">
                                    <label for="name">Nombre Beneficiario*</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="nombre_beneficiario" id="nombre_beneficiario" type="text" class="form-control" value="{{$banco->nombre_beneficiario}}">
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="name">Nombre Banco *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/sobre.png.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="nombre_banco" id="nombre_banco" type="text" class="form-control" value="{{$banco->nombre_banco}}">
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="name">Cuenta Bancaria *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/business-card-design.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="cuenta_bancaria" id="cuenta_bancaria" type="text" class="form-control" value="{{$banco->cuenta_bancaria}}">
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="name">Saldo inicial *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/bolsa-de-dinero.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="saldo_inicial" id="saldo_inicial" type="number" class="form-control" value="{{$banco->saldo_inicial}}">
                                    </div>
                                </div>

                                {{-- <div class="col-12 form-group">
                                    <label for="name">Saldo actual *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/bolsa-de-dinero.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="saldo" id="saldo" type="number" class="form-control" value="{{$banco->saldo}}">
                                    </div>
                                </div> --}}
                                <div class="col-12 form-group">
                                    <label for="name">Clabe *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/mapa-de-la-ciudad.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="clabe" id="clabe" type="text" class="form-control"  value="{{$banco->clabe}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>

      <div class="col-md-8 col-sm-10 mx-auto mt-3">
          <div class="card my-sm-5 my-lg-0">
            <div class="card-header text-center">
              <div class="row justify-content-between">
                <div class="col-md-4 text-start">
                    @if ($configuracion->logo == NULL)
                        <img class="mb-2 w-25 p-2" src="{{asset('assets/cam/logo.jpg') }}" alt="Logo">
                    @else
                        <img class="mb-2 w-25 p-2" src="{{asset('logo/'.$configuracion->logo) }}" alt="Logo">
                    @endif

                  <h6>
                    Reporte de Banco
                  </h6>
                  <p class="d-block text-secondary">{{$banco->nombre_banco}}</p>


                </div>
                <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                  <h6 class="d-block mt-2 mb-0">Nombre Beneficiario:</h6>
                  <p class="text-secondary">{{$banco->nombre_beneficiario}} <br> {{$banco->cuenta_bancaria}}</p>
                </div>
              </div>
              <br>
              <div class="row justify-content-md-between">
                <div class="col-md-4 mt-auto">
                  <h6 class="mb-0 text-start text-secondary">
                    Total
                  </h6>
                  <h5 class="text-start mb-0">
                   <span id="diferenciaColumna"></span>
                  </h5>
                </div>
                <div class="col-lg-5 col-md-7 mt-auto">
                  <div class="row mt-md-5 mt-4 text-md-end text-start">
                    <div class="col-md-6">
                      <h6 class="text-secondary mb-0">Inicio de Semana:</h6>
                    </div>
                    <div class="col-md-6">
                      <h6 class="text-dark mb-0">{{ \Carbon\Carbon::parse($startOfWeek)->translatedFormat('j \d\e F') }}</h6>
                    </div>
                  </div>
                  <div class="row text-md-end text-start">
                    <div class="col-md-6">
                      <h6 class="text-secondary mb-0">Dia actual:</h6>
                    </div>
                    <div class="col-md-6">
                      <h6 class="text-dark mb-0">{{ \Carbon\Carbon::parse($fecha)->translatedFormat('j \d\e F') }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive border-radius-lg">
                    <table class="table text-right">
                      <thead class="bg-default">
                        <tr>
                          <th scope="col" class="pe-2 text-start ps-2 text-white">Fecha</th>
                          <th scope="col" class="pe-2 text-white">Contenedor</th>
                          <th scope="col" class="pe-2 text-white" colspan="2">Cobros</th>
                          <th scope="col" class="pe-2 text-white">Pagos</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th class="h5 ps-4" colspan="2">SubTotal</th>
                          <td id="totalPenultimaColumna" colspan="1" class="text-right h5 ps-4"></td>
                          <td id="totalUltimaColumna" colspan="1" class="text-right h5 ps-4"></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="h5 ps-4" colspan="2">Total</th>
                            <td id="diferenciaColumna2" colspan="1" class="text-right h5 ps-4"></td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
@section('datatable')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calcular el total de la penúltima columna
        let totalPenultima = 0;
        document.querySelectorAll('.penultima-columna').forEach(function(cell) {
            let text = cell.textContent.trim().replace('$', '').replace(/,/g, '');
            totalPenultima += parseFloat(text) || 0;
        });
        document.getElementById('totalPenultimaColumna').textContent = `$ ${totalPenultima.toLocaleString('en-US')}`;

        // Calcular el total de la última columna
        let totalUltima = 0;
        document.querySelectorAll('.ultima-columna').forEach(function(cell) {
            let text = cell.textContent.trim().replace('$', '').replace(/,/g, '');
            totalUltima += parseFloat(text) || 0;
        });
        document.getElementById('totalUltimaColumna').textContent = `$ ${totalUltima.toLocaleString('en-US')}`;

        // Calcular la diferencia y mostrarla
        let diferencia = totalPenultima - totalUltima;
        document.getElementById('diferenciaColumna').textContent = `$ ${diferencia.toLocaleString('en-US')}`;
        document.getElementById('diferenciaColumna2').textContent = `$ ${diferencia.toLocaleString('en-US')}`;
    });
</script>

@endsection
