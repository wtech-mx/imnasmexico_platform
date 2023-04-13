{{-- testimonios --}}
<section class="primario bg_overley" style="background-color:#836262;">
    <div class="row">

        <div class="col-12">
            <h2 class="titulo_alfa text-center" style="color: #fff!important">
                Lo que dicen <br>
                nuestros estudiantes...
            </h2>
        </div>

        <div class="col-12 mt-4 mb-4">
            <div class="owl-carousel owl-theme">
                @foreach ($comentarios as $comentario)
                <div class="item" style="">
                        <div class="content_comentarios">
                                <p class="text-center">
                                    <img class="img_coment" src="{{asset('comentarios/'.$comentario->foto) }}" alt="">
                                </p>
                                <h4 class="tiitle_name text-center">{{$comentario->nombre}}</h4>
                                <p class="text-center">
                                    <img class="img_estrellas" src="{{asset('assets/user/utilidades/starts.png')}}" alt="">
                                </p>
                                <p class="text_coments text-center">
                                    {{$comentario->mensaje}} <br>
                                    <a class="link_comentarios" href="https://www.facebook.com/naturalesainspa/reviews" target="_blank">Seguir leyendo</a>
                                </p>
                        </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
{{-- testimonios --}}
