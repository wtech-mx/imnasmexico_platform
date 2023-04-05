<div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="checkout_modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg modalblur">

      <div class="modal-content modal_content_checkout">

        <div class="modal-body">
          <div class="row">

            <div class="col-6">
                <p class="text-center tittle_modal_cka">Detalles del cliente</p>

                    <div class="row">

                        <form id="datos-usuario">
                            <input type="text" name="nombre">
                            <input type="email" name="correo">
                            <input type="tel" name="telefono">
                            <button type="button" id="boton-pago">Pagar con Mercado Pago</button>
                          </form>

                        <div class="col-6">
                            <div class="input-group flex-nowrap mt-4">
                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                <input type="text" class="form-control input_custom_checkout" placeholder="Nombre" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group flex-nowrap mt-4">
                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                <input type="text" class="form-control input_custom_checkout" placeholder="Apellido" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group flex-nowrap mt-4">
                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                <input type="text" class="form-control input_custom_checkout" placeholder="Telefono" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group flex-nowrap mt-4">
                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                <input type="text" class="form-control input_custom_checkout" placeholder="Correo" >
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5">

                            <a class="btn btn-factura" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                ¿Quieres Facturar?
                            </a>

                    </div>

            </div>

            <div class="col-6">
                <p class="text-center tittle_modal_cka">Certificacion</p>
                @php $total = 0 @endphp
                <table class="table">
                    <thead>
                      <tr class="tr_checkout">
                        <th >#</th>
                        <th >Certificado</th>
                        <th >Costos</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <th>
                                    <img class="image_checkout" src="{{ asset('curso/'. $details['image'] )}}" class="card-img-top" alt="...">
                                </th>
                                <td class="td_title_checkout">{{ $details['name'] }}</td>
                                <td>${{ $details['price'] }}</td>
                                {{-- <td data-th="Quantity">

                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />

                                </td>
                                <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td> --}}
                                <td>
                                    <a class="btn btn-danger btn-sm remove-from-cart" ><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="tr_checkout">
                        <th></th>
                        <th>Total:</th>
                        <th>$ {{ $total }}</th>
                        <th></th>
                    </tr>
                    </tbody>
                </table>

                  <p class="text-center tittle_modal_cka">Método de Pago</p>

                  <div class="d-flex justify-content-center">
                    <a class="btn  me-3" >
                        <div class="d-flex justify-content-around">
                            <div class="card_tittle_btn my-auto cho-container"></div>
                            {{-- <div class="card_bg_btn ">
                                <i class="fas fa-cart-plus card_icon_btn"></i>
                            </div> --}}
                        </div>
                    </a>
                  </div>

                  <div style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                      <div class="card card-body" style="width: auto;border: solid 0px;padding: 0!important;">

                        <div class="row">

                            <div class="col-6">
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                    <input type="text" class="form-control input_custom_checkout" placeholder="RFC" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                    <input type="text" class="form-control input_custom_checkout" placeholder="Nombre" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                    <input type="text" class="form-control input_custom_checkout" placeholder="Nombre" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group flex-nowrap mt-4">
                                    <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-sort-alpha-up"></i></span>
                                    <input type="file" class="form-control input_custom_checkout" >
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <form role="form" action="{{ route('order.pay_stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group flex-nowrap mt-4">
                                                <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                                <input class='form-control' size='4' type='text' placeholder="Nombre del titular">
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

                                    <div class="col-12 error form-group hide">
                                        <div class='alert-danger alert'>
                                            Por favor, corrija los errores e inténtelo de nuevo
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Comprar</button>
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

      </div>

    </div>

  </div>
