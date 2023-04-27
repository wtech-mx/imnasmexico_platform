<section class="primario bg_overley padding_avales_cont" style="background-color:#fff;">
    <div class="row">
        <div class="col-12 mb-5">
            <h2 class="titulo_alfa text-center">Conoce todos</h2>
            <h3 class="titulo_beta text-center">nuestros RVOES</h3>
        </div>

        <div class="col-12 m-auto">

            <div class="owl-carousel owl-theme">

                @foreach ($revoes as $revoe)
                @if($loop->even)
                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">{{$revoe->num_revoe}}</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{asset('revoes/'.$revoe->image) }}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    {{$revoe->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">{{$revoe->num_revoe}}</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{asset('revoes/'.$revoe->image) }}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    {{$revoe->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</section>
