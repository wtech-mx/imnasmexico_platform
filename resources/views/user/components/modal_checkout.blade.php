<div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="checkout_modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg modalblur">

      <div class="modal-content modal_content_checkout">

        <div class="modal-body">
          <div class="row">

            <div class="col-12 col-md-6">
                <div class="d-flex justify-content-between">
                    <p class="text-center tittle_modal_cka">Compras</p>
                    <button type="button" class="btn_close_custom" data-bs-dismiss="modal">X</button>
                </div>

                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                      <tr class="tr_checkout">
                        <th >#</th>
                        <th >Curso</th>
                        <th >Costos</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    @php $total = 0 @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php
                            $total += $details['price'] * $details['quantity'];


                            if($details['paquete'] == 0){
                                $price = $details['price'];
                            }else{
                                $price = 0;
                                $nombre = 'Principiantes cosmetología';
                            }
                            @endphp
                            <tr data-id="{{ $id }}">
                                <th>
                                    <img class="image_checkout" src="{{ asset('curso/'. $details['image'] )}}" class="card-img-top" alt="...">
                                </th>
                                <td class="td_title_checkout">{{ $details['name'] }}</td>
                                <td>${{ $price }}</td>
                                {{-- <td data-th="Quantity">

                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />

                                </td>
                                <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td> --}}
                                @if($details['paquete'] == 0)
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                @endif
                                    <th></th>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="tr_checkout">
                        <th></th>
                        <th>Total:</th>
                        <th>${{ $total }}</th>
                        <th>
                            <form action="{{ route('vaciar_carrito') }}" method="post">
                                @csrf
                                <button class="btn">Vaciar carrito</button>
                            </form>
                        </th>
                    </tr>
                    </tbody>
                </table>
                @if(session()->has('coupon_applied'))
                    <p>Cupón aplicado</p>
                    <form action="{{ route('removeCoupon') }}" method="POST">
                        @csrf
                        <button class="btn_pagar_checkout " type="submit">Eliminar cupón</button>
                    </form>
                @else
                <form action="{{ route('cupon.aplicar') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <div class="input-group flex-nowrap mt-4">
                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-ticket"></i></span>
                            <input type="text" name="coupon" id="coupon" class="form-control input_custom_checkout" placeholder="Código de cupón">
                        </div>
                    </div>
                    <button class="btn_pagar_checkout " type="submit">Aplicar cupón</button>
                </form>
                @endif
            </div>

            <div class="col-12 col-md-6">
                <p class="text-center tittle_modal_cka">Detalles del cliente</p>



                    <div class="col-12 mt-5">

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <img class="" style="width: 260px;" src="{{asset('assets/user/utilidades/formas_pago.png')}}" alt="">
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 0px!important;">
                                    <div class="row">
                                        <div class="col-12">
                                            @guest
                                            <form method="POST" action="{{ route('process-payment') }}">
                                                @csrf
                                                <div class="row">
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

                                                    <div class="col-12 form-check form-check-inline mt-3">
                                                        <input class="form-check-input" type="checkbox" id="terminos" value="si" required>
                                                        <label class="form-check-label" for="terminos">He leído y acepto los <a href="{{ route('user.terminos') }}" style="color: #000;"> términos y condiciones</a> del sitio</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn_pagar_checkout " type="submit">Pagar</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('process-payment') }}">
                                                @csrf
                                                <div class="row">
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

                                                    <div class="col-12 form-check form-check-inline mt-3">
                                                        <input class="form-check-input" type="checkbox" id="terminos" value="si" required>
                                                        <label class="form-check-label" for="terminos">He leído y acepto los <a href="{{ route('user.terminos') }}" style="color: #000;"> términos y condiciones</a> del sitio</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn_pagar_checkout " type="submit">Pagar</button>
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

                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    ¿Quieres Facturar?
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 0px!important;">
                                    @if(session('cart'))
                                        @php
                                            $total = 0;
                                            foreach(session('cart') as $id => $details){
                                                $total += $details['price'] * $details['quantity'];
                                                $iva = $total * .16;
                                                $total_iva = $total + $iva;
                                            }
                                        @endphp
                                    <b>Total con IVA: </b> {{$total_iva}}
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
                                                            <input class='form-control' size='4' type='text' name="name" id="name" placeholder="Nombre">
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
                                                            <button class="btn_pagar_checkout " type="submit">Pagar</button>
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
                                  <div class="card card-body" style="width: auto;border: solid 0px;padding: 0!important;">



                                </div>
                              </div>

                    </div>

            </div>

          </div>
        </div>

      </div>

    </div>

  </div>
