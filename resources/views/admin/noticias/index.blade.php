@extends('layouts.app_admin')

@section('template_title')
    Noticias y Videos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff">
                            <i class="fas fa-arrow-left"></i> Regresar
                        </a>
                        <h3 class="mb-3">Noticias y Videos</h3>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_noticia" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear Noticias
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="noticiasTabs" role="tablist">
                        @foreach ($noticiasPorSeccion as $seccion => $noticias)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $seccion }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $seccion }}" type="button" role="tab" aria-controls="{{ $seccion }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ str_replace('_', ' ', $seccion) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="noticiasTabsContent">
                        @foreach ($noticiasPorSeccion as $seccion => $noticias)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $seccion }}" role="tabpanel" aria-labelledby="{{ $seccion }}-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-flush datatable" id="datatable-{{ $seccion }}">

                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Img / Video</th>
                                                <th>Titulo</th>
                                                <th>Descripcion</th>
                                                <th>Estatus</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($noticias as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>


                                                    <th>
                                                        <img id="blah" src="{{asset('noticias/'.$item->multimedia) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                    </th>

                                                    <td>
                                                        @php
                                                            $nombreDelCurso = $item->titulo;

                                                            $palabras = explode(' ', $nombreDelCurso);

                                                            // Inicializa la cadena formateada
                                                            $titulo_formateado = '';
                                                            $contador_palabras = 0;

                                                            foreach ($palabras as $palabra) {
                                                                // Agrega la palabra actual a la cadena formateada
                                                                $titulo_formateado .= $palabra . ' ';

                                                                // Incrementa el contador de palabras
                                                                $contador_palabras++;

                                                                // Agrega un salto de línea después de cada tercera palabra
                                                                if ($contador_palabras % 3 == 0) {
                                                                    $titulo_formateado .= "<br>";
                                                                }
                                                            }
                                                        @endphp

                                                        {!! $titulo_formateado !!}

                                                    </td>

                                                    <td>

                                                        @php
                                                            $descripDelCurso = $item->descripcion;

                                                            $palabras = explode(' ', $descripDelCurso);

                                                            // Inicializa la cadena formateada
                                                            $descrip_formateado = '';
                                                            $contador_palabras = 0;

                                                            foreach ($palabras as $palabra) {
                                                                // Agrega la palabra actual a la cadena formateada
                                                                $descrip_formateado .= $palabra . ' ';

                                                                // Incrementa el contador de palabras
                                                                $contador_palabras++;

                                                                // Agrega un salto de línea después de cada tercera palabra
                                                                if ($contador_palabras % 3 == 0) {
                                                                    $descrip_formateado .= "<br>";
                                                                }
                                                            }
                                                        @endphp

                                                        {!! $descrip_formateado !!}

                                                    </td>

                                                    <td>{{ $item->estatus }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#edit_noticia{{$item->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('noticias.destroy', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fa fa-fw fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>



                                                </tr>
                                                @include('admin.noticias.edit')
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.noticias.create')


@endsection

@section('datatable')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.datatable').forEach(function (table) {
            new simpleDatatables.DataTable(table, {
                deferRender: true,
                paging: true,
                pageLength: 10
            });
        });
    });
</script>
@endsection

