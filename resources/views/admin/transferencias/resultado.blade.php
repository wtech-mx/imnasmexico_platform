@extends('layouts.app_admin')

@section('template_title')
    Notas Productos
@endsection

<style>
    .status-success {
        color: #03c103;
    }
    .status-failure {
        color: red;
    }

    .status_border_success {
        border:5px solid #03c103;
    }
    .status_border_failure {
        border:5px solid red;
    }
</style>


@section('content')
    @if(isset($error))


    <div class="row">
        <div class="col-12">
                <h5 class="text-center status-failure">
                    {{ $error }}
                </h5>
                <div class="d-flex justify-content-center">
                <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff">Regresar </a>
            </div>
        </div>
    </div>



    @else

        <div class="container-fluid">
            <div class="row">

                <div class="col-3">

                </div>

                <div class="col-6">

                    <h5 class="text-center {{ $data['status'] == 'SUCCESS' ? 'status-success' : 'status-failure' }}">
                        Transferencia <br> {{ $data['status'] }}
                    </h5>

                    <div class="container_card {{ $data['status'] == 'SUCCESS' ? 'status_border_success' : 'status_border_failure' }} row" style="padding: 10px;background: #fff;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);border-radius: 16px">
                        <div class="col-12">

                            <h5 class="mt-5"> <img class="card_image" src="{{asset('assets/cam/pago-movil.png') }}" width="30px"> Operacion</h5>
                            <p>
                                <strong>Clave de rastreo</strong>:{{  $data['response']['claveRastreo'] }} <br>
                                <strong>Clave Spei: </strong> {{ $data['response']['claveSpei'] }} <br>
                                <strong>Fecha de operacion: </strong> {{ $data['response']['fechaOperacion'] }} <br>
                                <strong>Hora: </strong> {{ $data['response']['hora'] }} <br>
                            </p>
                            <hr style="background-color: #000">

                            <h5 class="mt-5"><img class="card_image" src="https://plataforma.imnasmexico.com/assets/user/logotipos/imnas.webp" width="30px"> Beneficiario (Receptor)</h5>
                            <p>
                                <strong>Banco Receptor: </strong> {{ $data['response']['beneficiario']['bancoReceptor'] }} <br>
                                <strong>Concepto: </strong> {{ $data['response']['beneficiario']['concepto'] }} <br>
                                <strong>Cuenta: </strong> {{ $data['response']['beneficiario']['cuenta'] }} <br>
                                <strong>IVA: </strong> {{ $data['response']['beneficiario']['iva'] }} <br>
                                <strong>Monto de Pago: </strong> {{ $data['response']['beneficiario']['montoPago'] }} <br>
                                <strong>Nombre: </strong> {{ $data['response']['beneficiario']['nombre'] }} <br>
                                <strong>RFC: </strong> {{ $data['response']['beneficiario']['rfc'] }} <br>
                            </p>
                            <hr style="background-color: #000">

                            <h5 class="mt-5"><img class="card_image" src="{{asset('assets/cam/dar-dinero.png') }}" width="30px"> Ordentante (Emisor)</h5>
                            <p>
                                <strong>Banco Emisor:</strong> {{ $data['response']['ordenante']['bancoEmisor'] }}  <br>
                                <strong>Cuenta: </strong> {{ $data['response']['ordenante']['cuenta'] }} <br>
                                <strong>Nombre: </strong> {{ $data['response']['ordenante']['nombre'] }} <br>
                                <strong>RFC:</strong> {{ $data['response']['ordenante']['rfc'] }}  <br>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-3">

                </div>

            </div>
        </div>
    @endif
@endsection

@section('datatable')


@endsection
