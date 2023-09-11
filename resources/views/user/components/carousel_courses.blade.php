<section>
    @php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp
    <div class="bgimg-1" style="height: auto;background-image: url('{{asset('webpage/'.$webpage->parallax) }}')">
        <span class="mask"></span>
        <div class="row">
            <div class="col-12 index_superior">
                <h2 class="titulo_alfa text-center mt-3 mb-5" style="color: #fff!important">
                    Próximos Cursos
                </h2>
            </div>

            <div class="col-12 mb-5">

                <div class="owl-carousel owl-theme">

                    @foreach ($cursos as $curso)
                        @php
                            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
                            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
                            $dia = date("d", strtotime($curso->fecha_inicial));
                            $fecha_i = $curso->fecha_inicial;

                            // Crear un objeto Carbon a partir de la fecha completa
                            $carbonFecha = Carbon::parse($fecha_i);

                            // Establecer la configuración regional a español
                            $carbonFecha->locale('es');

                            // Obtener el nombre del mes en español en el formato completo
                            $mes = rtrim(strtoupper($carbonFecha->isoFormat('MMM')), '.');
                            $precio = number_format($curso->precio, 2, '.', ',');

                            if ($curso->modalidad == 'Presencial') {
                                $presencial_bg = 'background-color:#000;';
                                $presencial_border = 'border-color:#000;';
                                $presencial_color = 'color:#000;';
                            }
                            else {
                                $presencial_bg = '';
                                $presencial_border = '';
                                $presencial_color = '';
                            }
                        @endphp
                        <div class="item" style="">
                            <div class="card card_grid" style="{{ $presencial_border }}">
                                <img class="img_card_grid" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">

                                <p class="precio_grid" style="{{ $presencial_bg }}">${{$precio}} mxn</p>
                                <p class="modalidado_grid" style="{{ $presencial_color }}"><strong>{{$curso->modalidad}}</strong></p>
                                <p class="wish_grid" style="{{ $presencial_bg }}"><i class="fas fa-heart"></i></p>
                                <p class="share_grid" onclick="shareFacebook()" style="{{ $presencial_bg }}"><i class="fas fa-share-alt"></i></p>
                                <p class="horario_grid" style="{{ $presencial_color }}">
                                    @if ($curso->sin_fin == '1')
                                        {{$hora_inicial}}</p>
                                    @else
                                        {{$hora_inicial}} - {{$hora_final}}</p>
                                    @endif


                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mt-4">
                                            <h6 class="fecha_card_grid text-center" style="{{ $presencial_color }}">
                                                {{$mes}} <br> <strong class="fecha_strong_card_grid">{{$dia}}</strong>
                                            </h6>
                                        </div>

                                        <div class="col-10 mt-4">
                                            <h3 class="tittle_card_grid" style="{{ $presencial_color }}" >{{$curso->nombre}}</h3>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex mb-3">
                                                <div class="me-auto p-2">
                                                    <a class="btn btn_primario_grd_curso" data-bs-toggle="collapse" href="#carousel_course{{$curso->id}}" role="button" aria-expanded="false" aria-controls="carousel_course" style="{{ $presencial_bg }}">
                                                        <div class="d-flex justify-content-around">
                                                            @if ($curso->precio == 0)
                                                                <p class="card_tittle_btn_grid my-auto">
                                                                    Registrarse
                                                                </p>
                                                            @else
                                                                <p class="card_tittle_btn_grid my-auto">
                                                                    Comprar ahora
                                                                </p>
                                                            @endif
                                                            <div class="card_bg_btn ">
                                                                <i class="fas fa-cart-plus card_icon_btn_grid" style="{{ $presencial_color }}"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="p-2">
                                                    <a class="btn btn_secundario_grd_curso" href="{{ route('cursos.show',$curso->slug) }}">
                                                        <div class="d-flex justify-content-around">
                                                            <p class="card_tittle_btn_grid my-auto" style="{{ $presencial_color }}">
                                                                Saber más
                                                            </p>

                                                            <div class="card_bg_btn_secundario" style="{{ $presencial_bg }}">
                                                                <i class="fas fa-plus card_icon_btn_secundario_grid"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="collapse mt-3" id="carousel_course{{$curso->id}}">
                                                <div class="card card-body card_colapsable_comprar">
                                                    <div class="row mb-3">
                                                        @foreach ($tickets as $ticket)
                                                            @if ($ticket->id_curso == $curso->id)
                                                                @if($curso->precio == 0)
                                                                    <div class="row mb-3">
                                                                        <form method="POST" action="{{ route('clases_gratis') }}"role="form" >
                                                                            @csrf
                                                                            <input type="hidden" name="ticket" id="ticket" class="form-control input_custom_checkout" value="{{$curso->id}}">
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
                                                                                        <input type="number" name="telefono" id="telefono" class="form-control input_custom_checkout" placeholder="Telefono *" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <div class="d-flex justify-content-center">
                                                                                        <button class="btn_pagar_checkout " type="submit">Registrarse</button>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @else
                                                                    <div class="col-12 mt-3">
                                                                        <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                                                    </div>
                                                                    <div class="col-6 mt-3">
                                                                        @if ($ticket->descuento == NULL)
                                                                            <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                                        @else
                                                                            <del style="color: #836262"><strong>De ${{$ticket->precio}}</strong></del>
                                                                            <h5 style="color: #836262"><strong>A ${{$ticket->descuento}}</strong></h5>
                                                                        @endif
                                                                    </div>

                                                                    <div class="col-6 mt-3">
                                                                        <p class="btn-holder">
                                                                            <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                                                <i class="fas fa-ticket-alt"></i> Comprar
                                                                            </a>
                                                                        </p>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <p style="color: #836262">{{$ticket->descripcion}}</p>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                    </div>
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


@foreach ($cursos as $curso)
<script>
    function shareFacebook() {
if (navigator.share) {
    navigator.share({
    title: '{{$curso->nombre}}',
    text: '{{$curso->nombre}}',
    url:'{{ route('cursos.show',$curso->slug) }}',
    // files: [
    // new File(['imagen'], 'https://plataforma.imnasmexico.com/{{asset('curso/'. $curso->foto) }}', { type: 'image/png' }),
    // ],
    })
    .then(() => console.log('Publicación compartida con éxito'))
    .catch(error => console.error('Error al compartir publicación', error));
} else {
    console.error('La funcionalidad de compartir no está soportada en este navegador');
}
}
</script>
@endforeach
