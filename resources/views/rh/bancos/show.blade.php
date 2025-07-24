@extends('layouts.app_admin')
@section('template_title')
    Bancos Edit
@endsection

@section('content')
@php
    if($banco->nombre_banco == 'STP') {
        $img = asset('assets/bancos/stp.jpg');
        $logo = asset('assets/bancos/logo_stp.png');
    } elseif($banco->nombre_banco == 'BBVA') {
        $img = asset('assets/bancos/bbva.webp');
        $logo = asset('assets/bancos/logo_bbva.png');
    } elseif($banco->nombre_banco == 'Banamex') {
        $img = asset('assets/bancos/banamex.jpg');
        $logo = asset('assets/bancos/logo_banamex.png');
    } elseif($banco->nombre_banco == 'Inbursa') {
        $img = asset('assets/bancos/inbursa.jpg');
        $logo = asset('assets/bancos/logo_inbursa.png');
    } elseif($banco->nombre_banco == 'Mercado Pago') {
        $img = asset('assets/bancos/mercado_pago.jpg');
        $logo = asset('assets/bancos/logo_mercado.png');
    } elseif($banco->nombre_banco == 'Banco Azteca') {
        $img = asset('assets/bancos/azteca.jpeg');
        $logo = asset('assets/bancos/logo_azteca.png');
    } elseif($banco->nombre_banco == 'NU') {
        $img = asset('assets/bancos/nu.jpg');
        $logo = asset('assets/bancos/logo_nu.png');
    } else {
        $img = 'https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg';
    }
@endphp
<div class="container-fluid my-5 py-2">
    <div class="row">
        <div class="col-12 mb-2">
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

      <div class="col-md-8 col-sm-10 mx-auto">
          <div class="card my-sm-5 my-lg-0">
            <div class="card-header text-center">
              <div class="row justify-content-between">
                <div class="col-md-4 text-start">
                   <img class="mb-2 w-25 p-2" src="{{$logo}}" alt="Logo">

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
                    <table class="table text-right" >
                      <thead class="bg-default">
                        <tr>
                        <th scope="col" class="pe-2 text-start ps-2 text-white">ID</th>
                          <th scope="col" class="pe-2 text-white">Fecha</th>
                          <th scope="col" class="pe-2 text-white">Descripción</th>
                          <th scope="col" class="pe-2 text-white" colspan="2">Entradas</th>
                          <th scope="col" class="pe-2 text-white">Salidas</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transacciones as $t)
                            <tr>
                                <td class="text-start ps-2 pe-2">{{ $t['id'] }}</td>
                                <td>
                                @php
                                    $ts = strtotime($t['fecha']);
                                    $fecha = strftime('%e de %B del %Y', $ts);
                                    $hora  = date('h:i A', $ts);
                                @endphp
                                {!! $fecha . '<br>a las ' . $hora !!}
                                </td>
                                <td style="white-space: pre-line;">
                                    @php
                                        $words = explode(' ', $t['descripcion']);
                                        $formattedDesc = collect($words)
                                        ->chunk(3)                // agrupa de 3 en 3
                                        ->map->join(' ')          // por cada sub-colección une con espacio
                                        ->join("\n");             // une las líneas con salto de línea
                                    @endphp
                                    {!! nl2br(e($formattedDesc)) !!}
                                </td>
                                <td style="color: rgb(114, 190, 14);">
                                {{ $t['entrada'] !== null ? '$'.number_format($t['entrada'],2) : '' }}
                                </td>
                                <td style="color: red;">
                                {{ $t['salida']  !== null ? '$'.number_format($t['salida'],2)  : '' }}
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                            <th colspan="3" class="h5 ps-4">SubTotales:</th>
                            <td class="h5 ps-4" id="totalEntradas"></td>
                            <td class="h5 ps-4" id="totalSalidas"></td>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th class="h5 ps-4">Saldo del mes:</th>
                            <td class="h5 ps-4" id="diferencia"></td>
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
  // Opcional: calcular totales en frontend
  function fmt(num) {
    return num.toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }

  let sumE = 0, sumS = 0;
  document.querySelectorAll('tbody tr').forEach(tr => {
    const e = parseFloat(tr.cells[3].textContent.replace(/[^0-9.-]+/g,'')) || 0;
    const s = parseFloat(tr.cells[4].textContent.replace(/[^0-9.-]+/g,'')) || 0;
    sumE += e;
    sumS += s;
  });

  const dif = sumE - sumS;

  document.getElementById('totalEntradas').textContent = '$' + fmt(sumE);
  document.getElementById('totalSalidas').textContent  = '$' + fmt(sumS);
  document.getElementById('diferencia').textContent    = '$' + fmt(dif);
</script>

@endsection
