<section class="primario bg_overley" style="background-color:#ffffff;">
    <div class="row">
        <div class="col-12 mb-5">
            <h2 class="titulo_alfa text-center">¡Conoce todos nuestros Estándares </h2>
            <h3 class="titulo_beta text-center">y Certifícate!</h3>
        </div>

        <div class="col-12 m-auto">

            <div class="owl-carousel owl-theme">

                @foreach ($estandares as $estandar)
                @if($loop->even)
                <div class="item">
                    <div class="card card_certificados">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo">{{$estandar->num_estandar}}</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{asset('estandares/'.$estandar->image) }}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado">
                                    {{$estandar->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="item">
                    <div class="card card_certificados_2">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center num_certifiacdo_2">{{$estandar->num_estandar}}</h4>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="contenedor_img_estandartes tamano_1">
                                <p class="text-center">
                                <img src="{{asset('estandares/'.$estandar->image) }}" alt="" class="img_estandars">
                                </p>
                            </div>
                        </div>

                        <div class="card-body space_text_certificados">
                            <div class="card-title text-center">
                                <p class="text-center text_certifcado_2">
                                    {{$estandar->name}}
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
