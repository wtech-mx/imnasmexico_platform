@extends('layouts.app_user')

@section('template_title')
Mi perfil- {{$cliente->name}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
 {{-- <link src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />  --}}

<style>

    .header{
        display: none;
    }

    .footer{
        display: none;
    }

    .space_newprofile {
        margin-top: 0rem!important;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        background-color: #66C0CC;
        font-size: 24px;
    }

    .title_curso {
        color: #66C0CC;
        font-family: Leelawadee_1;
        font-size: 40px;
        font-weight: bold;
    }

    .btn_ticket_comprar {
        background-color: #66C0CC;
    }

    .icon_footer i {
        color: #66C0CC;
    }

    .nav-tabs .nav-link {
        text-decoration: none;
        color: #66C0CC;
    }

    #page-loader {
        background: #66C0CC none repeat scroll 0% 0%;
    }

</style>

@endsection

@section('content')
<section class="primario bg_overley" style="background-color:#66C0CC;" id="contenido">

    <div class="row space_newprofile" style="">
        <div class="col-12">
            <div class="card_single_horizon row">

                <div class="col-6 col-md-3 col-lg-3">
                    <div class="avatar avatar-xl position-relative">
                      <img src="{{asset('assets/user/logotipos/registro_nacional.png')}}" alt="profile_image" style="height: 80px">
                      <img src="{{asset('assets/user/logotipos/stps.png')}}" alt="" style="height: 100px">
                    </div>
                </div>

                <div class="col-6 col-md-2 col-lg-2 mt-2">
                    <h5 class="mb-1">
                    {{$cliente->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                    {{$cliente->email}}
                    </p>
                    <p class="mb-0 font-weight-bold text-sm">
                    {{$cliente->telefono}}
                    </p>
                </div>

                <div class="col-12 col-md-7 col-lg-7">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="buscador-tab" data-bs-toggle="tab" data-bs-target="#buscador" type="button" role="tab" aria-controls="buscador" aria-selected="true">Buscador</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="estatus-tab" data-bs-toggle="tab" data-bs-target="#estatus" type="button" role="tab" aria-controls="estatus" aria-selected="false">Estatus Documentos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="especialidad-tab" data-bs-toggle="tab" data-bs-target="#especialidad" type="button" role="tab" aria-controls="especialidad" aria-selected="false">Especialidad</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active row" id="buscador" role="tabpanel" aria-labelledby="home-tab" style="background:#fff0!important; min-height: 0px; align-items: unset;">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card_single_horizon" style="margin-right: auto;">
                        <div class="col-12 espace_tittle_avales mb-3">
                            <h3 class="title_curso text-center mb-3">Buscador de Documentos</h3>
                        </div>

                        <h4 class="text-center mt-4 mb-4">
                            Ingresa el Folio de tu documento
                        </h4>

                        <form id="searchForm" class="d-flex" role="search">
                            <input class="form-control me-2" placeholder="Ingresa Folio" name="folio" id="folio">
                            <button class="btn btn-success" type="submit" style="background: #66C0CC">Buscar</button>
                        </form>

                        <div id="resultsContainer" class="p-0 p-md-5 p-lg-5"></div>

                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">

                    <div class="card_single_horizon">
                        <h3 class="text-center mt-4 mb-4">¿Tienes dudas?</h3>
                        <p class="text-center mb-0 font-weight-bold text-sm">Comunicate al telefono 5534316258</p>
                        <div class="row">
                            <div class="col-3 icon_footer">
                                <a target="_blank" href="https://wa.link/3ldnex" class="text-center" style="margin-bottom: 0rem!important">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                            </div>

                            <div class="col-3 icon_footer">
                                <a target="_blank" href="http://api.whatsapp.com/send?phone=525561672283" class="text-center" style="margin-bottom: 0rem!important">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                @foreach ($recien_comprados as $recien_comprado)
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card_single_horizon">
                            <div class="d-flex justify-content-between">
                                <h3 class="title_curso mb-3">Subir documentos</h3>
                                <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                            </div>
                            <h4 style="font-size: 24px">
                                @if ($recien_comprado->tipo == '1')
                                    @if ($recien_comprado->id_ticket == NULL)
                                        Emisión por alumno
                                    @else
                                        {{$recien_comprado->CursosTickets->nombre}}
                                    @endif
                                @elseif ($recien_comprado->tipo == '2')
                                    Especialidad extra
                                @endif
                            </h4>
                            <form   method="POST" action="{{ route('update_clientes.imnas', $recien_comprado->id) }}" enctype="multipart/form-data" role="form" >
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">
                                    <input class="form-control" type="text" value="{{$recien_comprado->id_usuario}}" id="id_usuario" name="id_usuario" style="display: none">

                                    <div class="col-12 col-lg-6 form-group ">
                                        <label for="">Nombre completo *</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/ESTUDIANTE-.webp')}}" alt="">
                                            </span>

                                            <input class="form-control" type="text" id="nombre" name="nombre" required oninput="capitalizeInput(this)">
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 form-group ">
                                        <label for="">Especialidad *</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                                            </span>
                                            <select class="form-control" id="nom_curso" name="nom_curso" required>
                                                @foreach ($especialidades as $especialidad)
                                                <option value="{{ $especialidad->especialidad }}">{{ $especialidad->especialidad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 form-group ">
                                        <label for="">Fecha del curso *</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/calendario.png')}}" alt="">
                                            </span>

                                            <input class="form-control" type="date"  id="fecha_curso" name="fecha_curso" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 form-group ">
                                        <label for="">Diseño Documentos *</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/todos-docs.webp')}}" alt="">
                                            </span>
                                            <select class="form-control" id="diseno_doc" name="diseno_doc" required>
                                                <option value="Clasico">Diseño Clásico</option>
                                                <option value="Nuevo">Diseño nuevo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 form-group ">
                                        <label for="">Comentario extra</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <span class="input-group-text">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="">
                                            </span>

                                            <textarea class="form-control" cols="10" rows="2"  id="comentario_cliente" name="comentario_cliente"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-6 form-group mb-5">
                                        <label for="ine">INE Frente y Atras *</label>
                                        <input id="ine" name="ine" type="file" class="form-control ine_input" required>
                                    </div>
                                    <div class="col-6 form-group mb-5">
                                        <label for="ine">CURP *</label>
                                        <input id="curp_escrito" name="curp_escrito" type="text" class="form-control ine_input" required>
                                    </div>
                                    <div class="col-6 form-group mb-5">
                                        <label for="ine">Foto cuadrada <b>Blanco y negro</b>*</label>
                                        <input id="foto_cuadrada" name="foto_cuadrada" type="file" class="form-control ine_input" required>
                                    </div>

                                    <div class="col-12 col-lg-4 form-group ">
                                        <button type="submit" class="btn_save_profile btn-lg" style="border: solid 0px;">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <h4>NOTA</h4>
                            <h5 class=" mt-4 mb-4">
                                Llena cuidadosamente los campos, asegurándote de que el nombre sea correcto y que los documentos sean correctos, ya que una vez guardado <b> no se podrán realizar correcciones</b>. Después de completar la información, haz clic en el botón <b>"Guardar"</b>.
                            </h5>
                        </div>
                    </div>
                @endforeach

                @if ($recien_comprados->isEmpty())
                    <div class="col-8">
                    </div>
                @endif

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card_single_horizon">
                        <div class="row mb-3">
                            @foreach ($cursos_tickets as $ticket)
                                @if ($ticket->nombre == 'Emisión por alumno' && $ticket->costos_diferentes != $cliente->costos_diferentes)
                                    @continue
                                @endif

                                @php
                                    $precio = number_format($ticket->precio, 2, '.', ',');
                                @endphp

                                <div class="col-12 mt-3">
                                    <strong style="color: #66C0CC">{{ $ticket->nombre }}</strong>
                                </div>

                                <div class="col-6 col-lg-6 mt-3">
                                    @if (is_null($ticket->descuento))
                                        <h5 style="color: #66C0CC"><strong>$ {{ $precio }}</strong></h5>
                                    @else
                                        @if ($ticket->nombre == 'Reconocimiento')
                                            <h5 style="color: #66C0CC"><strong>$ {{ $precio }}</strong></h5>
                                        @else
                                            <del style="color: #66C0CC"><strong>De ${{ $precio }}</strong></del>
                                            <h5 style="color: #66C0CC"><strong>A ${{ $ticket->descuento }}</strong></h5>
                                        @endif
                                    @endif
                                </div>

                                <div class="col-6 col-lg-6 mt-3">
                                    <form action="{{ route('add.to.cart', $ticket->id) }}" method="GET">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" name="quantity" class="form-control" min="1" value="1" style="max-width: 70px; background: #66C0CC !important">
                                            <button type="submit" class="btn_ticket_comprar text-center btn btn-primary" style="background: #66C0CC !important">
                                                <i class="fas fa-ticket-alt"></i> Comprar
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-12">
                                    <p style="color: #66C0CC">{{ $ticket->descripcion }}</p>
                                </div>
                            @endforeach
                            @foreach ($tickets_envio as $ticket)
                                <div class="col-12 mt-3">
                                    <strong style="color: #66C0CC">{{$ticket->nombre}}</strong>
                                </div>
                                <div class="col-12">
                                    <p style="color: #66C0CC">{{$ticket->descripcion}}</p>
                                </div>
                                <div class="col-6 col-lg-6 mt-3">
                                    @if ($ticket->descuento == NULL)
                                        <h5 style="color: #66C0CC"><strong>$ {{ $ticket->precio }}</strong></h5>
                                    @else
                                        <del style="color: #66C0CC"><strong>De ${{ $ticket->precio }}</strong></del>
                                        <h5 style="color: #66C0CC"><strong>A ${{$ticket->descuento}}</strong></h5>
                                    @endif
                                </div>

                                <div class="col-6 col-lg-6 mt-3">
                                    <p class="btn-holder">
                                        <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                            <i class="fas fa-ticket-alt"></i> Comprar
                                        </a>
                                    </p>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade row" id="estatus" role="tabpanel" aria-labelledby="estatus-tab" style="background:#fff0!important; min-height: 0px; align-items: unset;">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card_single_horizon">
                            <h2 class="title_curso">Documentos Faltantes</h2>
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Folio</th>
                                        <th>Guia</th>
                                        <th>Diseño</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros_imnas as $registro_imnas)
                                        @if ($registro_imnas->fecha_realizados == NULL)
                                            <tr>
                                                <td>
                                                    <p>{{ $registro_imnas->nombre }}</p>
                                                </td>
                                                <td><p>{{ $registro_imnas->folio }}</p></td>
                                                <td><p>{{ $registro_imnas->num_guia }}</p></td>
                                                <td>
                                                    <p style="color: {{ $registro_imnas->diseno_doc === 'Clasico' || $registro_imnas->diseno_doc === NULL ? '#836262' : '#66c0cc' }}">
                                                        {{ $registro_imnas->diseno_doc ?? 'Clasico' }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#modalUser{{ $registro_imnas->id }}" title="Ver"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @include('user.modal_registro_imnas')
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card_single_horizon">
                        <h2 class="title_curso">Documentos Finalizados</h2>

                        <table class="table table-flush">
                            <thead class="thead">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Folio</th>
                                    <th>Guia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registros_imnas as $registro_imnas)
                                    @if ($registro_imnas->fecha_realizados != NULL)
                                        <tr>
                                            <td>
                                                <p>{{ $registro_imnas->nombre }}</p>
                                            </td>
                                            <td><p>{{ $registro_imnas->folio }}</p></td>
                                            <td><p>{{ $registro_imnas->num_guia }}</p></td>
                                            <td>
                                                <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#modalUser{{ $registro_imnas->id }}" title="Ver"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @include('user.modal_registro_imnas')
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade row" id="especialidad" role="tabpanel" aria-labelledby="especialidad-tab" style="background:#fff0!important; min-height: 0px; align-items: unset;">

                <div class="col-12">
                    <div class="card_single_horizon">
                        <div class="col-12 form-group mt-4 ">
                            <label for="name">Especialidades Compradas</b></label>
                            @foreach ($especialidades as $especialidad)
                                <div class="input-group mt-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/clase.webp') }}" alt="" width="35px">
                                    </span>
                                    <input type="text" class="form-control" value="{{$especialidad->especialidad}}" disabled>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @foreach ($recien_comprados_especialidad as $recien_comprado_especialidad)
                    <div class="col-6">
                        <div class="card_single_horizon">
                            <form method="POST" class="row" action="{{ route('update_especialidad.imnas',$recien_comprado_especialidad->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <input id="id_usuario" name="id_usuario" type="text" class="form-control" value="{{$recien_comprado_especialidad->id_usuario}}" style="display: none">

                                <h5 class=" mt-4 mb-4">
                                    Llena cuidadosamente el campo de especialidad y los subtemas, asegurándote de que la ortografía sea correcta, ya que una vez guardado <b> no se podrán realizar correcciones</b>. Después de completar la información, haz clic en el botón verde <b>"Guardar"</b>.
                                </h5>
                                <button class="btn btn-sm btn-success w-100 mt-5">Guardar</button>
                                <div class="col-12 form-group mt-4 ">
                                    <label for="name">Especialidad <b style="color: #f80909;">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/user/icons/clase.webp') }}" alt="" width="35px">
                                        </span>
                                        <input id="especialidad" name="especialidad" type="text" class="form-control" required oninput="capitalizeInput(this)">
                                    </div>
                                </div>
                                @for ($i = 1; $i <= 12; $i++)
                                    <div class="col-12 form-group mt-4 ">
                                        <label for="name">Subtema {{ $i }}
                                            @if($i <= 6)
                                                <b style="color: #f80909;">*</b>
                                            @endif
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/user/icons/aprender-en-linea-1.webp') }}" alt="" width="35px">
                                            </span>

                                            <input id="subtema_{{ $i }}" name="subtema_{{ $i }}" type="text" class="form-control" @if($i <= 6) required @endif oninput="capitalizeInput(this)">
                                        </div>
                                    </div>
                                @endfor
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</section>

@endsection

@section('js')
{{-- <script src="{{asset('assets/admin/js/plugins/datatables.js')}}"></script> --}}
<script src="{{asset('assets/admin/js/plugins/datatables.js')}}"></script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search2", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });

</script>

<script>
    $(document).ready(function() {
        function capitalizeInput(input) {
            input.value = input.value
                .toLowerCase()
                .replace(/(^|\s)([a-záéíóúüñ])/g, match => match.toUpperCase());
        }
        // Asigna la función a la ventana global si es necesario
        window.capitalizeInput = capitalizeInput;

        $('#searchForm').on('submit', function(e) {
            e.preventDefault(); // Evita que se recargue la página

            var folio = $('#folio').val();

            $.ajax({
                url: '{{ route("folio_registro.buscador") }}',
                method: 'GET',
                data: { folio: folio },
                success: function(response) {
                    // Aquí puedes manejar la respuesta del servidor
                    // Por ejemplo, mostrar los datos en un div:
                    $('#resultsContainer').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejar errores aquí
                    console.error('Error: ', textStatus, errorThrown);
                }
            });
        });
    });

</script>
@endsection
