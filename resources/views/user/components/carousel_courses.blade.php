<section>
    <div class="bgimg-1" style="height: auto;background-image: url('{{asset('assets/user/utilidades/spa.jpg')}}')">
        <span class="mask"></span>
        <div class="row">
            <div class="col-12 index_superior">
                <h2 class="titulo_alfa text-center mt-3 mb-5" style="color: #fff!important">
                    Próximas Certificaciones
                </h2>
            </div>

            <div class="col-12 mb-5">

                <div class="owl-carousel owl-theme">

                    @foreach ($cursos as $curso)
                        @php
                            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
                            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
                            $dia = date("d", strtotime($curso->fecha_inicial));
                            $mes = date("M", strtotime($curso->fecha_inicial));
                        @endphp
                        <div class="item" style="">
                            <div class="card card_grid" style="">
                                <img class="img_card_grid" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">

                                <p class="precio_grid">${{$curso->precio}} mxn</p>
                                <p class="modalidado_grid">{{$curso->modalidad}}</p>
                                <p class="wish_grid"><i class="fas fa-heart"></i></p>
                                <p class="share_grid"><i class="fas fa-share-alt"></i></p>
                                <p class="horario_grid">{{$hora_inicial}} - {{$hora_final}}</p>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mt-4">
                                            <h4 class="fecha_card_grid text-center">
                                                {{$mes}} <br> <strong class="fecha_strong_card_grid">{{$dia}}</strong>
                                            </h4>
                                        </div>

                                        <div class="col-10 mt-4">
                                            <h3 class="tittle_card_grid">{{$curso->nombre}}</h3>

                                            <div class="d-flex mb-3">
                                                <div class="me-auto p-2">
                                                    <a class="btn btn_primario_grd_curso">
                                                        <div class="d-flex justify-content-around">
                                                            <p class="card_tittle_btn_grid my-auto">
                                                                Comprar ahora
                                                            </p>
                                                            <div class="card_bg_btn ">
                                                                <i class="fas fa-cart-plus card_icon_btn_grid"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="p-2">
                                                    <a class="btn btn_secundario_grd_curso" href="{{ route('cursos.show',$curso->slug) }}">
                                                        <div class="d-flex justify-content-around">
                                                            <p class="card_tittle_btn_grid my-auto">
                                                                Saber mas
                                                            </p>

                                                            <div class="card_bg_btn_secundario">
                                                                <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
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
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
