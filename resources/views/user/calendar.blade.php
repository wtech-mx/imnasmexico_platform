@extends('layouts.app_user')

@section('template_title')
    Calendario
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/grid_cursos.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/calendario.css')}}" rel="stylesheet" />
@endsection
@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp
@section('content')

<div id="carousel_full" class="carousel slide" data-bs-ride="carousel">
    <span class="mask_calendar"></span>
{{--
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel_full" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carousel_full" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carousel_full" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> --}}

    <div class="carousel-inner">

        @foreach ($cursos_slide as $curso)
        @php
            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
            $dia = date("d", strtotime($curso->fecha_inicial));
            $mes = date("M", strtotime($curso->fecha_inicial));

            $fecha_ini = $curso->fecha_inicial;
            $fecha_inicial = Carbon::createFromFormat('Y-m-d', $fecha_ini)->locale('es')->isoFormat('D [de] MMMM');

            $fecha_f = $curso->fecha_final;
            $fecha_final = Carbon::createFromFormat('Y-m-d', $fecha_f)->locale('es')->isoFormat('D [de] MMMM');

            $horaInicial = $curso->hora_inicial;
            $hora_inicial = Carbon::createFromFormat('H:i:s', $horaInicial)->format('h:i A');

            $horaFinal = $curso->hora_final;
            $hora_final = Carbon::createFromFormat('H:i:s', $horaFinal)->format('h:i A');
        @endphp
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{asset('curso/'. $curso->foto) }}')">
                <div class="row postion_row_caledanrio">
                    <div class="col-12 col-md-8">
                        <div class="conten_slilder_full">
                            <h1 class="text-white titulo titulo_full" style="">
                                {{$curso->nombre}}
                            </h1>

                            <a class="btn btn-secundario_grid me-3 mb-2 mb-lg-5 mb-md-4 mt-4 mt-md-4 mt-lg-5">
                                <div class="d-flex justify-content-around">
                                    <p class="card_tittle_btn my-auto">
                                        {{$curso->modalidad}}
                                    </p>
                                </div>
                            </a>

                            <h3 class="text-white parrafo_full mb-4 mb-lg-5 mb-md-4">
                                {{$fecha_inicial}} @if ($curso->fecha_inicial == $curso->fecha_final) @else
                                al {{$fecha_final}} <br>
                                @endif {{$hora_inicial}} - {{$hora_final}}
                            </h3>

                            <div class="d-flex justify-content-start">
                                <a class="btn btn-secundario me-1" href="{{ route('cursos.show',$curso->slug) }}">
                                    <div class="d-flex justify-content-around">
                                        <p class="card_tittle_btn my-auto">
                                            Saber más
                                        </p>
                                        <div class="card_bg_btn_secundario">
                                            <i class="fas fa-plus card_icon_btn_secundario"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_full" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel_full" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    </div>
{{-- Grid --}}
<section class="primario bg_overley" style="background-color:#F5ECE4;">

    <div class="row">

        <div class="col-12">
            <form class="row form_search_calendar desaparecer_form_seach" action="{{ route('advance_search') }}" method="GET" >
                @csrf
                <div class="col-12 col-md-5">
                    <label class="form-label style_search_label">Modalidad</label>
                    <select class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" name="modalidad" id="modalidad">
                        <option value="" selected>Modalidad</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Online">Online</option>
                    </select>
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label style_search_label">Nombre</label>
                    <div class="input-group">
                        <input name="nombre" class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" type="text" placeholder="Nombre">
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <label class="form-label style_search_label">-</label>
                    <div class="input-group">
                        <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit">
                            <i class="fas fa-search-plus  icon_search_style"></i>
                        </button>
                        <a class="btn btn-sm mb-0 mt-sm-0 mt-1" href="{{ route('cursos.index_user') }}">
                            <i class="fas fa-eraser  icon_search_style_2"></i>
                        </a>
                    </div>

                </div>

            </form>

            <div class="container aparecer_form_seach" style="display: contents;">
                <button class="mb-4" type="button" data-bs-toggle="collapse" data-bs-target="#content_search" aria-expanded="false" aria-controls="content_search" style="background: transparent;border: solid transparent;">
                    <i class="fas fa-search  icon_search_style"></i> <strong>Buscar : </strong>
                </button>

                <div class="collapse" id="content_search">
                    <form class="row" action="{{ route('advance_search') }}" method="GET" >
                        @csrf
                        <div class="col-4">
                            <label class="form-label style_search_label">Modalidad</label>
                            <select class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" name="modalidad" id="modalidad">
                                <option value="" selected>Modalidad</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>

                        <div class="col-8">
                            <label class="form-label style_search_label">Nombre</label>
                            <div class="input-group">
                                <input name="nombre" class="form-control" style="background: #F5ECE4!important;border: solid transparent;color: #836262;font-weight: bold;border-style: solid;border-width: 0px 0px 3px 0px;border-color: #000;border-radius: 0px;" type="text" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label style_search_label">-</label>
                            <div class="input-group">
                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit">
                                    <i class="fas fa-search-plus  icon_search_style"></i>
                                </button>
                                <a class="btn btn-sm mb-0 mt-sm-0 mt-1" href="{{ route('cursos.index_user') }}">
                                    <i class="fas fa-eraser  icon_search_style_2"></i>
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
              </div>

        </div>

        <div class="col-12 mt-2 mt-sm-5 mt-md-5">
            <div class="d-flex mb-0 mb-sm-5">

                <div class="me-auto p-2">
                    <h5 class="tittle_proximas_cer">{{ $titulo }}</h5>
                </div>

                <div class="p-2">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- card_grid --}}
        @foreach ($cursos as $curso)
        @php
            $hora_inicial = strftime("%H:%M %p", strtotime($curso->hora_inicial)) ;
            $hora_final = strftime("%H:%M %p", strtotime($curso->hora_final)) ;
            $dia = date("d", strtotime($curso->fecha_inicial));
            // $mes = date("M", strtotime($curso->fecha_inicial));

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
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card_grid card_grid_cale  mb-5 mb-md-3" style="{{ $presencial_border }}">
                <img class="img_card_grid" src="{{asset('curso/'. $curso->foto) }}" class="card-img-top" alt="...">

                <p class="precio_grid" style="{{ $presencial_bg }}">${{$precio}} mxn</p>
                <p class="modalidado_grid"><strong>{{$curso->modalidad}}</strong></p>
                <p class="wish_grid" style="{{ $presencial_bg }}"><i class="fas fa-heart"></i></p>
                <p class="share_grid" onclick="shareFacebook()" style="{{ $presencial_bg }}"><i class="fas fa-share-alt"></i></p>
                <p class="horario_grid">{{$hora_inicial}} - {{$hora_final}}</p>

                <div class="card-body">
                    <div class="row">

                        <div class="col-2 mt-4">
                            <h5 class="fecha_card_grid text-center" style="{{ $presencial_color }}">
                                {{$mes}} <br> <strong class="fecha_strong_card_grid">{{$dia}}</strong>
                            </h5>
                        </div>

                        <div class="col-10 mt-4">
                            <h3 class="tittle_card_grid" style="{{ $presencial_color }}" >{{$curso->nombre}}</h3>

                            <div class="d-flex mb-3">
                                <div class="me-auto p-2">
                                    <a class="btn btn_primario_grd_curso" data-bs-toggle="collapse" href="#collapseobjetivos{{$curso->id}}" role="button" aria-expanded="false" aria-controls="collapseobjetivos" style="{{ $presencial_bg }}">
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
                                            <p class="card_tittle_btn_grid my-auto">
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
                            <div class="collapse mt-3" id="collapseobjetivos{{$curso->id}}">
                                <div class="card card-body card_colapsable_comprar">
                                    <div class="row mb-3">
                                        @foreach ($tickets as $ticket)
                                            @if ($ticket->id_curso == $curso->id)
                                                @if($curso->precio == 0)
                                                    <div class="row mb-3">
                                                        <form method="POST" action="{{ route('clases_gratis') }}"role="form">
                                                            @csrf
                                                            <input type="hidden" name="ticket" id="ticket" class="form-control input_custom_checkout" value="{{$curso->id}}">
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
                                                    <div class="col-6 col-lg-4 mt-3">
                                                        @if ($ticket->descuento == NULL)
                                                            <h5 style="color: #836262"><strong>${{$ticket->precio}}</strong></h5>
                                                        @else
                                                            <del style="color: #836262"><strong>${{$ticket->precio}}</strong></del>
                                                            <h5 style="color: #836262"><strong>${{$ticket->descuento}}</strong></h5>
                                                        @endif
                                                    </div>

                                                    <div class="col-6 col-lg-8 mt-3">
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
        {{-- card_grid --}}
        <!-- Mostrar mensaje si no se encontraron resultados -->
        @if ($cursos->isEmpty())
            <h3 class="title_curso">
                No se encontraron cursos que coincidan con los criterios de búsqueda.
            </h3>
        @endif
    </div>

</section>
{{-- Grid --}}

@endsection

@section('js')

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
@endsection


