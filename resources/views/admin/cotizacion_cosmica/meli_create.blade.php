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

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Cotizacion
                              </button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Mercado Libre
                              </button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                Guia
                              </button>
                            </li>

                        </ul>

                          <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <form method="POST" action="{{ route('meli.publish', $cotizacion->id) }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <h4>Folio # {{ $cotizacion->folio  }}</h4>
                                                <h5 style="color:#783E5D"><strong>Datos del cliente</strong> </h5>
                                            </div>
                                            <input id="id_cliente" name="id_cliente" type="hidden" class="form-control" value="{{ $cotizacion->id_usuario }}" >
                                            @if ($cotizacion->id_usuario == NULL)

                                                <div class="form-group col-4">
                                                    <label for="name">Nombre *</label>
                                                    <div class="input-group mb-1">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input id="name" name="name" type="text" class="form-control" readonly value="{{ $cotizacion->nombre }}" >

                                                    </div>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="name">Telefono *</label>
                                                    <div class="input-group mb-1">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input id="telefono" name="telefono" type="number" class="form-control" readonly value="{{ $cotizacion->telefono }}">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group col-4">
                                                <label for="name">Fecha *</label>
                                                <div class="input-group mb-1">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input id="fecha" name="fecha" type="date" class="form-control" readonly value="{{ $cotizacion->fecha }}">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h5 style="color:#783E5D"><strong>Productos Selecionados</strong> </h5>
                                            </div>

                                            @php
                                                $total = 0;
                                                $totalCantidad = 0;
                                            @endphp

                                            @foreach ($cotizacion_productos as  $productos)
                                                <div class="row campo3" data-id="{{ $productos->id }}">
                                                    @php
                                                        if($productos->cantidad != NULL){
                                                            $precio_unitario = $productos->price / $productos->cantidad;
                                                            $precio_format = number_format($productos->price, 0, '.', ',');
                                                            $precio_unitario_format = number_format($precio_unitario, 0, '.', ',');
                                                        }
                                                    @endphp

                                                    <div class="col-3">
                                                        <label for="">Nombre</label>
                                                        <input type="text"  name="productos[]" class="form-control d-inline-block" readonly value="{{ $productos->producto }}" readonly>
                                                    </div>

                                                    <div class="form-group col-3">
                                                        <label for="cantidad_{{ $productos->id }}">Cantidad *</label>
                                                        <div class="input-group mb-1">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="cantidad_{{ $productos->id }}" name="cantidad[]" class="form-control cantidad" style="width: 65%;" readonly value="{{ $productos->cantidad }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-2">
                                                        <label for="descuento_{{ $productos->id }}">Descuento *</label>
                                                        <div class="input-group mb-1">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="descuento_{{ $productos->id }}" name="descuento[]" class="form-control descuento" readonly value="{{ $productos->descuento }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-3">
                                                        <label for="subtotal_{{ $productos->id }}">Subtotal *</label>
                                                        <div class="input-group mb-1">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" id="subtotal_{{ $productos->id }}" name="price[]" class="form-control subtotal" readonly value="${{ $precio_format }}" readonly>
                                                        </div>
                                                    </div>

                                                    <!-- Campo oculto para el precio unitario -->
                                                    <input type="hidden" id="precio_unitario_{{ $productos->id }}" value="{{ $precio_unitario }}">

                                                    @php
                                                        $subtotal = $productos->price;
                                                        $total += $subtotal;
                                                        $precio = $total;
                                                    @endphp
                                                </div>
                                            @endforeach

                                            <div class="col-12 mb-2">
                                                <h5 style="color:#783E5D"><strong>Pago</strong> </h5>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Subtotal *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input id="subtotal_final" name="subtotal_final" type="text" class="form-control"  value="{{ $precio }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Descuento *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/descuento.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input class="form-control" type="number" id="descuento_total" name="descuento_total" readonly value="{{ $cotizacion->restante }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="name">Total *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/user/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input id="price" name="price" type="text" class="form-control"  value="{{ $cotizacion->total }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <h3 style="color:#783E5D"><strong>Mercado Libre</strong> </h3>
                                                <p style="color:#783E5D">Vamos a crear y publicar esta cotizacion en Meli</p>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="name">Titulo de la publicacion *</label>
                                                <div class="input-group mb-1">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input id="title" name="title" type="text" class="form-control" value="{{ $cotizacion->item_title_meli ?? $productNames }}">
                                                    {{-- <input id="title" name="title" type="text" class="form-control" value="{{ $productNames }}"> --}}
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="name">ID ITEM MELI</label>
                                                <div class="input-group mb-1">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" width="45px">
                                                    </span>
                                                    <input id="" name="" type="text" class="form-control" value="{{ $cotizacion->item_id_meli }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group col-7 my-auto">
                                                <p for="name"> <strong>Link de Mercado Libre</strong> <br>
                                                    <a href="{{ $cotizacion->item_descripcion_permalink }}" target="_blank" rel="noopener noreferrer">
                                                        {{ $cotizacion->item_descripcion_permalink }}
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="form-group col-2 my-auto">
                                                @if (!empty($cotizacion->item_descripcion_permalink) && !empty($cotizacion->telefono) && !empty($cotizacion->nombre))
                                                    <a href="https://wa.me/{{ $cotizacion->telefono }}?text={{ urlencode('Hola ' . $cotizacion->nombre . '! Este es el link de tu compra de Mercado Libre de tu cotización. Puedes comprar en el siguiente enlace: ') }}{{ urlencode($cotizacion->item_descripcion_permalink) }}"
                                                    target="_blank"
                                                    class="btn btn-sm btn-success">
                                                        Enviar WhatsApp
                                                    </a>
                                                @else
                                                    <p>No publicado en MELI</p>
                                                @endif
                                            </div>

                                            <div class="form-group col-3 my-auto">

                                                    @if ($orderDetails ?? null)
                                                            <p for="name"> <strong>Guia de Mercado Libre</strong> <br></p>

                                                            <a href="{{ route('meli.downloadShippingLabel',$orderDetails['shipping']['id']) }}"
                                                            class="btn btn-primary btn-sm">
                                                                Imprimir Guía
                                                            </a>

                                                        @else
                                                        <p for="name"> <strong>Guía no disponible</strong> <br></p>
                                                    @endif

                                            </div>

                                            {{-- <div class="form-group col-6">
                                                <label for="categoria">Categoría *</label>
                                                <select class="form-select categoria d-inline-block" id="category_id" name="category_id">
                                                    <option value="">Seleccionar Categoría</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}

                                            <div class="form-group col-12">
                                                <label for="" class="form-label">Descripcion</label>
                                                <textarea class="form-control" id="description" name="description" rows="9">{{ $cotizacion->item_descripcion_meli }}</textarea>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn close-modal" style="background: #322338; color: #ffff">Guardar</button>

                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

                                <div class="row">

                                    @if ($orderDetails ?? null)
                                        <div class="col-8">

                                            <div class="row">
                                                <div class="col-12 ">
                                                    <h5>{{ $orderDetails['payments'][0]['reason'] }}</h5>
                                                    <p>Venta #{{ $orderDetails['id'] }} / {{ $orderDetails['date_created'] }} </p>
                                                </div>

                                                <div class="col-12 my-auto">
                                                    <div class="container_user_data ">
                                                        <div class="d-flex justify-content-between my-auto">

                                                            <p>
                                                                <strong>{{ $orderDetails['buyer']['first_name'] .' '. $orderDetails['buyer']['last_name']}} </strong> <br>
                                                                {{ $orderDetails['buyer']['nickname'] }}
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
                                    @endif

                                </div>

                            </div>

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

                                <form method="POST" action="{{ route('notas_cosmica.update_guia', $cotizacion->id) }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                        <div class="row">
                                            <div class="form-group col-12">
                                                    <label for="name">Doc Guia</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input class="form-control" type="file" id="doc_guia" name="doc_guia">
                                                    </div>
                                            </div>

                                            <div class="col-12">
                                                <embed src="{{ asset('pago_fuera/'.$cotizacion->doc_guia) }}" type="application/pdf" style="width: 450px; height: 400px;" />
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>

                                        </div>
                                </form>

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
