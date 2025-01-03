@extends('layouts.app_admin')

@section('template_title')
    Meli Cotizacion Post
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">

    <style>
        .container_user_data{
            background: #E9ECEF;
            border-radius: 9px;
            padding: 15px;
        }


    </style>

 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-8">

                                <div class="row">

                                    <div class="col-12 my-auto">
                                        <div class="container_user_data ">
                                            <div class="d-flex justify-content-between my-auto">

                                                <p>
                                                    <strong>{{ $shipmentDetails['destination']['receiver_name']}} </strong> <br>
                                                </p>

                                                <p>
                                                    <a href="" class="btn btn-primary btn-xs">Conversacion</a>
                                                </p>
                                            </div>

                                            <div class="container_user_data mt-4">
                                                <div class="d-flex justify-content-between my-auto">
                                                    <p>
                                                        <strong>{{ $shipmentDetails['substatus'] }}</strong> <br>
                                                    </p>

                                                    <p>
                                                        <a href="https://envios.mercadolibre.com.mx/shipping/agencies-map?flow=drop-off-places" target="_blank" class="btn btn-primary btn-xs">
                                                            Donde lo despacho
                                                        </a>
                                                    </p>
                                                </div>

                                                <p>
                                                    <strong class="mt-3">Datos del envío</strong> <br>
                                                    CP {{ $shipmentDetails['destination']['shipping_address']['zip_code'] }}
                                                    {{ $shipmentDetails['destination']['shipping_address']['street_name'] }} <br> {{ $shipmentDetails['destination']['shipping_address']['comment'] }} <br>
                                                    {{ $shipmentDetails['destination']['shipping_address']['city']['name'] }} {{ $shipmentDetails['destination']['shipping_address']['state']['name'] }}<br>
                                                </p>
                                            </div>

                                        </div>
                                    </div>



                                </div>


                            </div>

                            <div class="col-4">

                            </div>

                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.categoria').select2();
    });

</script>
@endsection
