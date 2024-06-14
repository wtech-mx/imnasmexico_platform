<div class="footer" style="">
    <div class="row">
        <div class="col-12 col-md-6 space_principal_footer">

            <div class="d-flex justify-content-center space_secundario_footer">
                <div class="card_footer">
                    <p class="text-center" style="margin-bottom: 0rem!important;">
                        <img class="img_card_footer" src="{{asset('assets/user/logotipos/imnas.webp')}}" alt="">
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-center">

                <div class="icon_footer">
                    <a target="_blank" href="tel:%2055%208494%207222" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fas fa-phone-alt"></i>
                    </a>
                </div>

                <div class="icon_footer">
                    <a target="_blank" href="http://api.whatsapp.com/send?phone=525545365893" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>

                <div class="icon_footer">
                    <a target="_blank" href="https://www.instagram.com/naturalesainspaoficial/" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>

                <div class="icon_footer">
                    <a target="_blank" href="https://www.facebook.com/naturalesainspa/" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fab fa-facebook"></i>
                    </a>
                </div>

                {{-- <div class="icon_footer">
                    <a target="_blank" href="mailto:imnasmexico@naturalesainspa.com" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>--}}

                <div class="icon_footer">
                    <a target="_blank" href="https://www.tiktok.com/@carla_rizo" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>

                <div class="icon_footer">
                    <a target="_blank" href="https://www.tiktok.com/@imnasmexico" class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>

                {{-- <div class="icon_footer">
                    <p class="text-center" style="margin-bottom: 0rem!important">
                        <i class="fas fa-file"></i>
                    </p>
                </div> --}}

            </div>

            {{-- <div class="d-flex justify-content-center">
                <p class="registro_num mt-5">
                    SUSCRÍBETE A LA SECCIÓN DE NOTICIAS
                </p>
            </div> --}}

            <hr class="hr_custom" style="">

            <div class="d-flex justify-content-center">
                <p class="preguntas_freceuntas">
                    <a data-bs-toggle="modal" data-bs-target="#preguntas">
                            PREGUNTAS FRECUENTES
                    </a>
                </p>

            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('folio.index') }}" class="preguntas_freceuntas">
                    Buscar Documentos
                </a>
            </div>

            <div class="d-flex justify-content-center">
                <a class="preguntas_freceuntas btn_ticket_comprar text-center" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false">Registro IMNAS</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body mb-5">
                            <form method="POST" action="{{ route('order.pay_registro') }}" role="form">
                                @csrf
                                <div class="col-12">
                                    <div class="input-group flex-nowrap mt-4">
                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                        <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="input-group flex-nowrap mt-4">
                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="input-group flex-nowrap mt-4">
                                        <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                        <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" pattern="[0-9]{10}" class="form-control input_custom_checkout" placeholder="55-55-55-55-55" required>
                                    </div>
                                </div>

                                <button class="btn_pagar_checkout" type="submit">Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="d-flex justify-content-center">
                <a class="preguntas_freceuntas btn_ticket_comprar text-center" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false">Pagar Envio</a>
            </div>
                <div class="row">
                    <div class="col-12">
                      <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body mb-5">
                            <form method="POST" action="{{ route('order.pay_envio') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control input_custom_checkout" placeholder="Nombre" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fa fa-building"></i></span>
                                            <input type="text" name="address_1" id="address_1" class="form-control input_custom_checkout" placeholder="Dirección" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fa fa-map-pin"></i></span>
                                            <input type="text" name="city" id="city" class="form-control input_custom_checkout" placeholder="Ciudad" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fa fa-map"></i></span>
                                            <input type="text" name="state" id="state" class="form-control input_custom_checkout" placeholder="Región / Provincia" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fa fa-map-marker"></i></span>
                                            <input type="number" name="postcode" id="postcode" class="form-control input_custom_checkout" placeholder="Código Postal" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email" id="email" class="form-control input_custom_checkout" placeholder="Correo" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group flex-nowrap mt-4">
                                            <span class="input-group-text span_custom_checkout" id=""><i class="fas fa-phone-alt"></i></span>
                                            <input type="tel" minlength="10" maxlength="10" name="telefono" id="telefono" pattern="[0-9]{10}" class="form-control input_custom_checkout" placeholder="55-55-55-55-55" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn_pagar_checkout " type="submit">Pagar Envio</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                      </div>
                    </div>
                </div> --}}


        </div>

        <div class="col-12 col-md-6 spaciador_footer mt-5 mb-5">

            <div class="d-flex justify-content-center espaciador_fp mb-5">
                <div class="card_footer">
                    <p class="text-center" style="margin-bottom: 0rem!important;">
                        <img class="img_card_footer" src="{{asset('assets/user/icons/pago-seguro.png')}}" alt="">
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <p class="preguntas_freceuntas">
                    FORMAS DE PAGO
                </p>
            </div>

            <div class="d-flex justify-content-center">
                <p class="registro_num mt-5">
                    <img class="img_footer_pago" src="{{asset('assets/user/utilidades/formas_pago.png')}}" alt="">
                </p>
            </div>

            <hr class="hr_custom" style="">

            <div class="row">
                <div class="col-4 margen_footer_calendar">
                    <p class="text_calendario_footer_calendar">
                        <i class="fas fa-calendar-alt icon_footer_2"></i>
                        Lunes a Viernes
                    </p>
                    <p class="text_calendario_footer_calendar">
                        <i class="far fa-clock icon_footer_2"></i>
                        10:00 am - 7:00 pm
                    </p>
                </div>

                <div class="col-4 margen_footer_calendar">
                    <p class="text_calendario_footer_calendar">
                        <i class="fas fa-calendar-alt icon_footer_2"></i>
                        Sábado
                    </p>
                    <p class="text_calendario_footer_calendar">
                        <i class="far fa-clock icon_footer_2"></i>
                        10:00 am - 5:00 pm
                    </p>
                </div>

                <div class="col-4 margen_footer_calendar">
                    <p class="text_calendario_footer_calendar">
                        <i class="fas fa-calendar-alt icon_footer_2"></i>
                        Domingo
                    </p>
                    <p class="text_calendario_footer_calendar">
                        <i class="far fa-clock icon_footer_2"></i>
                        10:00 am - 5:00 pm
                    </p>
                </div>

            </div>

        </div>

        <div class="col-12 spaciador_footer mt-5 mb-5 text-center">
            <p class="text-center text-white">Todos los derechos reservados © 2023
                <strong>Instituto Mexicano Naturales Ain Spa</strong>
            </p>
        </div>

    </div>
</div>
