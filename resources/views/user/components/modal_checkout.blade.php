<div class="modal fade" id="checkout_modal" tabindex="-1" aria-labelledby="checkout_modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg modalblur">

      <div class="modal-content modal_content_checkout">

        <div class="modal-body">
          <div class="row">

            <div class="col-6">
                <p class="text-center tittle_modal_cka">Detalles del cliente</p>

                    <div class="row">
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

                              </div>
                            </div>
                          </div>

                    </div>

            </div>

            <div class="col-6">
                <p class="text-center tittle_modal_cka">Certificacion</p>

                <table class="table">
                    <thead>
                      <tr class="tr_checkout">
                        <th >#</th>
                        <th >Certificado</th>
                        <th >Costos</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <th>
                            <img class="image_checkout" src="{{ asset('assets/user/utilidades/piedras_calientes.jpg')}}" class="card-img-top" alt="...">
                        </th>
                        <td class="td_title_checkout">Curso de Piedras Calientes Curativas y Alineación de Chacras</td>
                        <td>$700.00</td>
                      </tr>
                    </tbody>
                  </table>

                  <p class="text-center tittle_modal_cka">Método de Pago</p>

                  <div class="d-flex justify-content-center">
                    <a class="btn btn-primario me-3" >
                        <div class="d-flex justify-content-around">
                            <p class="card_tittle_btn my-auto">
                                Comprar ahora
                            </p>
                            <div class="card_bg_btn ">
                                <i class="fas fa-cart-plus card_icon_btn"></i>
                            </div>
                        </div>
                    </a>
                  </div>

            </div>

          </div>
        </div>

      </div>

    </div>

  </div>