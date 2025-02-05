@extends('layouts.app_tienda_cosmica')

@section('template_title')
    Cart
@endsection

@section('body_custom')
    bg_single_product
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/ecomeerce_cosmica_cart.css')}}" rel="stylesheet" />
<style>
    /* Ocultar por defecto */
    #inputs_direciion,
    #inputs_pickup {
        display: none;
    }

</style>
@endsection

@section('content')

<div class="container ">

    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-5 m-5"><strong>Continuar</strong> con pago</h2>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-3">
            <div class="d-flex justify-content-between">
                <p style="width: 30px">-</p>
                <h4>Articulos</h4>
                <h4>Cantidad</h4>
                <h4>Costos</h4>
            </div>

            @if(session('cart_productos'))
                @foreach(session('cart_productos') as $id => $producto)
                    <div class="container_list_product mb-2">
                        <div class="d-flex justify-content-between">

                            <img class="my-auto" src="{{ $producto['imagen'] }}" alt="" style="height: 60px;width:60px;" >

                            <p class="my-auto">{{ $producto['nombre'] }}</p>

                            <p class="my-auto">
                                <a href="javascript:void(0);" class="icon_list_cart incrementar" data-id="{{ $id }}">+</a>
                                <input class="input_cart_list" type="number" value="{{ $producto['cantidad'] }}" min="1" data-id="{{ $id }}">
                                <a href="javascript:void(0);" class="icon_list_cart decrementar" data-id="{{ $id }}">-</a>
                            </p>

                            <p class="my-auto total-precio" id="total-{{ $id }}">
                                ${{ number_format($producto['precio'] * $producto['cantidad'], 0, '.', ',') }}
                            </p>

                            <button class="btn btn-sm eliminar-producto" data-id="{{ $id }}" style="background: transparent;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-3">
                <p class="text-center tittle_modal_cka"> <strong>Detalles del cliente</strong> </p>

                    <div class="col-12">

                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item" style="background: transparent;border: solid 1px transparent;">
                                <h2 class="accordion-header" id="headingcollapseMeli">
                                  <button class="accordion-button button_collapse_cart" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMeli" aria-expanded="true" aria-controls="collapseMeli" style="background: #FFE900">
                                          <img class="" style="width: 100px;" src="{{asset('assets/user/utilidades/meli.png')}}" alt="">
                                  </button>
                                </h2>

                                <div id="collapseMeli" class="accordion-collapse collapse " aria-labelledby="headingcollapseMeli" data-bs-parent="#accordionExample">
                                  <div class="accordion-body" style="padding: 0px!important;">
                                      <div class="row">
                                        <div class="col-12">
                                            <p class="text-start tittle_modal_cka mt-3">Con esta opcion se creara un producto de Mercado Libre directamente en su plataforma para que lo puedeas comprar directamente en su tienda</p>
                                            <p><strong>Nota: Se creara con un numero de Folio y su respectivo nombre</strong></p>

                                            @if(session('cart_productos'))
                                            @php
                                                $cart_productos = session('cart_productos', []);
                                                $total_carrito = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
                                            @endphp
                                                <h4 class="mt-3"><b>Total: </b> <span id="total-carrito">${{ number_format($total_carrito, 0, '.', ',') }}</span></h4>
                                            @endif

                                            <form method="POST" action="{{ route('processPaymentMeli') }}">
                                                @csrf
                                                @guest
                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                            <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre(s) *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-male"></i></span>
                                                            <input type="text" name="ape_paterno" id="ape_paterno" class="form-control input_custom_checkout" placeholder="Apellido Paterno *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-female"></i></span>
                                                            <input type="text" name="ape_materno" id="ape_materno" class="form-control input_custom_checkout" placeholder="Apellido Materno *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                            <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                            <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono *" required>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                            <input type="text" name="name" id="name" class="form-control input_custom_checkout" value="{{auth()->user()->name}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                            <input type="email" name="email" id="email" class="form-control input_custom_checkout" value="{{auth()->user()->email}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                            <input type="number" name="telefono" id="telefono" class="form-control input_custom_checkout" value="{{auth()->user()->telefono}}" required>
                                                        </div>
                                                    </div>
                                                @endguest
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn_pagar_checkout " type="submit" style="background: #FFE900;color:#000;border: solid #000;;">Pagar en Meli</button>
                                                </div>

                                            </form>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <div class="accordion-item" style="background: transparent;border: solid 1px transparent;">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button button_collapse_cart" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <img class="" style="width: 260px;" src="{{asset('assets/user/utilidades/formas_pago.png')}}" alt="">
                                </button>
                              </h2>

                              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 0px!important;">
                                    <div class="row">
                                        <div class="col-12">
                                            @if(session('cart_productos'))
                                            @php
                                                $cart_productos = session('cart_productos', []);
                                                $total_carrito = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
                                            @endphp

                                                <h4 class="mt-3"><b>Total: </b> <span id="total-carrito">${{ number_format($total_carrito, 0, '.', ',') }}</span></h4>
                                            @endif

                                            <form method="POST" action="{{ route('process-payment_cosmica') }}">
                                                @csrf
                                                <div class="row">
                                                @guest
                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                            <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre(s) *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-male"></i></span>
                                                            <input type="text" name="ape_paterno" id="ape_paterno" class="form-control input_custom_checkout" placeholder="Apellido Paterno *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-female"></i></span>
                                                            <input type="text" name="ape_materno" id="ape_materno" class="form-control input_custom_checkout" placeholder="Apellido Materno *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                            <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo *" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                            <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono *" required>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                            <input type="text" name="name" id="name" class="form-control input_custom_checkout" value="{{auth()->user()->name}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                            <input type="email" name="email" id="email" class="form-control input_custom_checkout" value="{{auth()->user()->email}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                            <input type="number" name="telefono" id="telefono" class="form-control input_custom_checkout" value="{{auth()->user()->telefono}}" required>
                                                        </div>
                                                    </div>
                                                @endguest
                                                @include('tienda_cosmica.Components.opcion_envio')

                                                <div class="col-12 form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="checkbox" id="terminos" value="si" required>
                                                    <label class="form-check-label" for="terminos">He leído y acepto los <a href="{{ route('user.terminos') }}" style="color: #000;"> términos y condiciones</a> del sitio</label>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn_pagar_checkout " type="submit">Pagar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item" style="background: transparent;border: solid 1px transparent;">
                              <h2 class="accordion-header " id="headingTwo">
                                <button class="accordion-button button_collapse_cart text-white collapsed mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    ¿Quieres Facturar?
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 0px!important;">
                                    @if(session('cart_productos'))
                                        @php
                                            $cart_productos = session('cart_productos', []);
                                            $total_carrito = array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], $cart_productos));
                                            $iva = $total_carrito * .16;
                                            $total_iva = $total_carrito + $iva;
                                        @endphp
                                        <h4 class="mt-3"><b>Total: </b> <span id="total-carrito">${{ number_format($total_iva, 0, '.', ',') }}</span></h4>
                                    @endif
                                    @guest
                                        <form role="form" action="{{ route('order.pay_stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">

                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                        <input type="text" name="razon_social" id="razon_social" class="form-control input_custom_checkout" placeholder="Nombre / Razon Social" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-address-card"></i></span>
                                                        <input type="text" name="rfc" id="rfc" class="form-control input_custom_checkout" placeholder="RFC" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-file"></i></span>
                                                        <select name="cfdi" id="cfdi" required style="width: 100px;">
                                                            <option value="">CFDI</option>
                                                            <option value="G01 Adquisición de Mercancías">G01 Adquisición de Mercancías</option>
                                                            <option value="G02 Devoluciones, Descuentos o bonificaciones">G02 Devoluciones, Descuentos o bonificaciones</option>
                                                            <option value="G03 Gastos en general">G03 Gastos en general</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                        <input type="text" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone"></i></span>
                                                        <input name="telefono" id="telefono" type="tel" minlength="10" maxlength="10" class="form-control input_custom_checkout" placeholder="Telefono" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-compass"></i></span>
                                                        <input type="text" name="direccion" id="direccion" class="form-control input_custom_checkout" placeholder="Direccion de factura" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                            <input class='form-control input_custom_checkout' size='4' type='text' name="name" id="name" placeholder="Nombre">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-credit-card"></i></i></span>
                                                        <input class='form-control input_custom_checkout card-number' autocomplete='off' size='20' type='text' placeholder="Numero de Tarjeta">
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-numeric-up-alt"></i></span>
                                                        <input class='form-control input_custom_checkout card-cvc' autocomplete='off' placeholder='CVV' size='4' type='text'>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-calendar-alt"></i></i></span>
                                                        <input class='form-control input_custom_checkout card-expiry-month' autocomplete='off' placeholder='MES' size='2' type='text'>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                        <input class='form-control input_custom_checkout card-expiry-year' autocomplete='off' placeholder='AÑO' size='4'type='text'>
                                                    </div>
                                                </div>

                                                @include('tienda_cosmica.Components.opcion_envio')

                                                <div class="col-12 form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="checkbox" id="terminos" value="si" required>
                                                    <label class="form-check-label" for="terminos">He leído y acepto los <a href="{{ route('user.terminos') }}" style="color: #000;"> términos y condiciones</a> del sitio</label>
                                                </div>

                                                {{-- <div class="col-12 error form-group hide">
                                                    <div class='alert-danger alert'>
                                                        Por favor, corrija los errores e inténtelo de nuevo
                                                    </div>
                                                </div> --}}

                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="container_lineas_single mt-3">
                                                                <a class="text_shop_single " type="submit">Pagar ahora</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        @else
                                        <form role="form" action="{{ route('order.pay_stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">

                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                            <input class='form-control input_custom_checkout' size='4' type='text' name="name" id="name" value="{{auth()->user()->name}}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                        <input type="text" name="razon_social" id="razon_social" class="form-control input_custom_checkout" value="{{auth()->user()->razon_social}}" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-address-card"></i></span>
                                                        <input type="text" name="rfc" id="rfc" class="form-control input_custom_checkout" value="{{auth()->user()->rfc}}" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-file"></i></span>
                                                        <select name="cfdi" id="cfdi" required>
                                                            <option value="{{auth()->user()->cfdi}}">{{auth()->user()->cfdi}}</option>
                                                            <option value="G01 Adquisición de Mercancías">G01 Adquisición de Mercancías</option>
                                                            <option value="G02 Devoluciones, Descuentos o bonificaciones">G02 Devoluciones, Descuentos o bonificaciones</option>
                                                            <option value="G03 Gastos en general">G03 Gastos en general</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                        <input type="text" name="email" id="email" class="form-control input_custom_checkout" value="{{auth()->user()->email}}" required>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone"></i></span>
                                                        <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" value="{{auth()->user()->telefono}}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-compass"></i></span>
                                                        <input type="text" name="direccion" id="direccion" class="form-control input_custom_checkout" value="{{auth()->user()->direccion}}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                            <input class='form-control' size='4' type='text' placeholder="Nombre de la tarjeta">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-credit-card"></i></i></span>
                                                        <input class='form-control card-number' autocomplete='off' size='20' type='text' placeholder="Numero de Tarjeta">
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-numeric-up-alt"></i></span>
                                                        <input class='form-control card-cvc' autocomplete='off' placeholder='CVV' size='4' type='text'>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-calendar-alt"></i></i></span>
                                                        <input class='form-control card-expiry-month' autocomplete='off' placeholder='MES' size='2' type='text'>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="input-group flex-nowrap mt-4">
                                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                        <input class='form-control card-expiry-year' autocomplete='off' placeholder='AÑO' size='4'type='text'>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-12 error form-group hide">
                                                    <div class='alert-danger alert'>
                                                        Por favor, corrija los errores e inténtelo de nuevo
                                                    </div>
                                                </div> --}}

                                                @include('tienda_cosmica.Components.opcion_envio')

                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn_pagar_checkout " type="submit">Pagar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    @endguest
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="collapse collapse-horizontal" id="collapse_mp">
                                    <div class="card card-body" style="width: auto;border: solid 0px;padding: 0!important;">

                                        <div class="row">
                                            <div class="col-12">
                                                <form method="POST" action="{{ route('process-payment') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                                                <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                                                <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="input-group flex-nowrap mt-4">
                                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                                                <input type="text" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="card_tittle_btn my-auto" type="submit">Pagar</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                          </div>


                          <div class="collapse collapse-horizontal" id="collapse_factura">
                            <div class="card card-body" style="width: auto;border: solid 0px;padding: 0!important;" >
                              </div>
                          </div>

                    </div>

            </div>
    </div>


</div>


@endsection

@section('js')
<script>
    // Obtener referencias a los elementos
    const envioRadio = document.getElementById('inlineRadio1');
    const pickupRadio = document.getElementById('inlineRadio2');
    const direccionInputs = document.getElementById('inputs_direciion');
    const pickupInputs = document.getElementById('inputs_pickup');

    // Función para alternar visibilidad
    function toggleInputs() {
        if (envioRadio.checked) {
            direccionInputs.style.display = 'block';
            pickupInputs.style.display = 'none';
        } else if (pickupRadio.checked) {
            direccionInputs.style.display = 'none';
            pickupInputs.style.display = 'block';
        }
    }

    // Agregar eventos a los radios
    envioRadio.addEventListener('change', toggleInputs);
    pickupRadio.addEventListener('change', toggleInputs);

    // Inicializar estado
    toggleInputs();
</script>

<script>
    $(document).ready(function () {
        // Aumentar cantidad
        $('.incrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) + 1;
            actualizarCantidad(id, cantidad);
        });

        // Disminuir cantidad
        $('.decrementar').click(function () {
            let id = $(this).data('id');
            let input = $('input[data-id="' + id + '"]');
            let cantidad = parseInt(input.val()) - 1;
            if (cantidad > 0) {
                actualizarCantidad(id, cantidad);
            }
        });

        // Actualizar cantidad desde input
        $('.input_cart_list').on('change', function () {
            let id = $(this).data('id');
            let cantidad = parseInt($(this).val());
            if (cantidad > 0) {
                actualizarCantidad(id, cantidad);
            }
        });

        // Función AJAX para actualizar cantidad
        function actualizarCantidad(id, cantidad) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    cantidad: cantidad
                },
                success: function (response) {
                    if (response.success) {
                        $('input[data-id="' + id + '"]').val(cantidad);
                        $('#total-' + id).text('$' + response.total_producto);
                        $('#total-carrito').text('$' + response.total_carrito);
                    }
                }
            });
        }

        // Eliminar producto del carrito
        $('.eliminar-producto').click(function () {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        location.reload(); // Recargar la página para actualizar el carrito
                    }
                }
            });
        });
    });
</script>

@endsection


