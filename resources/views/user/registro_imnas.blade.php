@extends('layouts.app_user')

@section('template_title')
Mi perfil- {{$cliente->name}}
@endsection

@section('css_custom')
<link href="{{asset('assets/user/custom/single_cours.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/custom/perfil.css')}}" rel="stylesheet" />
{{-- <link src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" /> --}}
@endsection

<style>
    .accordion-button:not(.collapsed) {
        color: #fff!important;
    }

    @keyframes blinking {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0.6;
        }
        100% {
            opacity: 1;
        }
    }

        .blinking {
        animation: blinking 1.7s infinite;
        }
</style>

@section('content')

<section class="primario bg_overley" style="background-color:#F5ECE4;" id="contenido">

    <div class="row space_newprofile" style="">

        <div class="col-12">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Requisitos</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                </div>
                <div class="row">
                    <div class="col-4">
                        <a class="example-image-link" href="{{asset('documentos/imnas1.jpg') }}" data-lightbox="example-2" data-title="imnas" target="_blank">
                            <img id="img_material_clase example-image" src="{{asset('documentos/imnas1.jpg') }}" alt="material de clase" style="width: 80%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                        </a>
                    </div>

                    <div class="col-8">
                        <p>
                            <h4>{{$cliente->name}}</h4>
                            <h5>{{$cliente->email}}</h5>
                            <h5>{{$cliente->telefono}}</h5>
                        </p>

                        <p>
                            <h5>Registros IMNAS comprados: {{ count($recien_comprados)}}</h5>
                        </p>

                        <a href="#section1" class="btn btn-outline-danger mb-sm-2" style="border: solid 0px;">
                            Subir documentos
                        </a>

                        <a href="#section2" class="btn btn-outline-warning mb-sm-2" style="border: solid 0px;">
                            Estatus documento
                        </a>
                    </div>

                    <div class="collapse show mt-3" id="collapseinfo">
                        <div class="card card-body card_colapsable_comprar">
                            <div class="row mb-3">
                                @foreach ($cursos_tickets as $ticket)
                                @php
                                        $precio = number_format($ticket->precio, 2, '.', ',');
                                @endphp
                                    <div class="col-12 mt-3">
                                        <strong style="color: #836262">{{$ticket->nombre}}</strong>
                                    </div>
                                    <div class="col-6 col-lg-6 mt-3">
                                        @if ($ticket->descuento == NULL)
                                            <h5 style="color: #836262"><strong>$ {{ $precio }}</strong></h5>
                                        @else
                                            <del style="color: #836262"><strong>De ${{ $precio }}</strong></del>
                                            <h5 style="color: #836262"><strong>A ${{$ticket->descuento}}</strong></h5>
                                        @endif
                                    </div>

                                    <div class="col-6 col-lg-6 mt-3">
                                        <p class="btn-holder">
                                            <a class="btn_ticket_comprar text-center" href="{{ route('add.to.cart', $ticket->id) }}"  role="button">
                                                <i class="fas fa-ticket-alt"></i> Comprar
                                            </a>
                                        </p>
                                    </div>

                                    <div class="col-12">
                                        <p style="color: #836262">{{$ticket->descripcion}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="section1" class="section">
        </div>

            @foreach ($recien_comprados as $recien_comprado)
                <div class="col-12 col-lg-6">
                    <div class="card_single_horizon">
                        <div class="d-flex justify-content-between">
                            <h3 class="title_curso mb-3">Subir documentos</h3>
                            <img class="icon_nav_course" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                        </div>
                        <h4>
                            @if ($recien_comprado->tipo == '1')
                                Emisión por alumno
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

                                        <input class="form-control" type="text"  id="nombre" name="nombre" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 form-group ">
                                    <label for="">Nombre del curso *</label>
                                    <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                        <img class="img_profile_label" src="{{asset('assets/user/icons/certificacion.webp')}}" alt="">
                                    </span>

                                    <input class="form-control" type="text"  id="nom_curso" name="nom_curso" required>
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
                                    <input id="curp" name="curp" type="file" class="form-control ine_input" required>
                                </div>
                                <div class="col-6 form-group mb-5">
                                    <label for="ine">Foto cuadrada *</label>
                                    <input id="foto_cuadrada" name="foto_cuadrada" type="file" class="form-control ine_input" required>
                                </div>
                                <div class="col-6 form-group mb-5">
                                    <label for="ine">Firma *</label>
                                    <input id="firma" name="firma" type="file" class="form-control ine_input" required>
                                </div>
                                <div class="col-6 form-group mb-5">
                                    <label for="ine">Logo</label>
                                    <input id="logo" name="logo" type="file" class="form-control ine_input">
                                </div>

                                <div class="col-12 col-lg-4 form-group ">
                                    <button type="submit" class="btn_save_profile btn-lg" style="border: solid 0px;">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach


        <div id="section2" class="section">
        </div>

        <div class="col-12">
            <div class="card_single_horizon">
                <div class="d-flex justify-content-between">
                    <h2 class="title_curso mb-3">Estatus Documentos IMNAS</h2>
                    <img class="icon_nav_course" src="{{asset('assets/user/icons/informacion.png')}}" alt="">
                </div>

                <table class="table table-flush" id="datatable-search">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>

</section>

@endsection

@section('js')
{{-- <script src="{{asset('assets/admin/js/plugins/datatables.js')}}"></script> --}}
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>
@endsection


